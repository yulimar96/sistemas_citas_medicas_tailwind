
@extends('layouts.app')

@section('title', 'Pagos')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .alert {
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .hq-card {
            transition: all 0.3s ease;
        }

        .hq-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Loading spinner */
        .spinner {
            display: none;
            width: 1.5rem;
            height: 1.5rem;
            border: 0.25rem solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Empty state */
        .empty-state {
            transition: all 0.3s ease;
        }

        .empty-state:hover {
            transform: scale(1.02);
        }

        .payment-card {
            transition: all 0.2s ease;
        }

        .payment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

@section('content')
    <div class="p-4">
        <!-- Header con breadcrumbs -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-white">
                        <i class="fas fa-home mr-2"></i>
                        Inicio
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-angle-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Gestión de
                            Pagos</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestión de Pagos</h1>
                <p class="text-gray-600 dark:text-gray-400">Registro y seguimiento de pagos de pacientes</p>
            </div>

            <div class="flex gap-3">
                <button
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex items-center"
                    data-modal-target="payments-modal" data-modal-toggle="payments-modal">
                    <i class="fas fa-plus mr-2"></i> Nuevo Pago
                </button>
                <button
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:focus:ring-gray-800 flex items-center"
                    id="filter-toggle">
                    <i class="fas fa-filter mr-2"></i> Filtrar
                </button>
            </div>
        </div>

        <!-- Filtros (inicialmente ocultos) -->
        <div class="hidden mb-6 p-4 bg-white dark:bg-gray-800 rounded-lg shadow" id="filter-section">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Paciente</label>
                    <select id="patient-filter"
                        class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Todos</option>
                        @foreach ($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Doctor</label>
                    <select id="doctor-filter"
                        class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">Todos</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Fecha desde</label>
                    <input type="date" id="date-from"
                        class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div class="flex items-end">
                    <button
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full flex items-center justify-center"
                        id="apply-filters">
                        <span class="spinner mr-2"></span>
                        <span>Aplicar Filtros</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Alertas -->
        <div class="container mx-auto sm:ml-64">
            <div class="p-4 border-0 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-2">
                @if (session('success'))
                    <div class="alert fixed top-16 right-4 bg-green-500 text-white p-4 rounded shadow-lg" role="alert">
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert fixed top-16 right-4 bg-red-500 text-white p-4 rounded shadow-lg" role="alert">
                        <div class="ms-3 text-sm font-medium">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert fixed top-16 right-4 bg-red-600 text-white p-4 rounded shadow-lg" role="alert">
                        <div class="ms-3 text-sm font-medium">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-white">Listado de Pagos</h3>
                <span
                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-200">
                    {{ $payments->count() }} registros
                </span>
            </div>

            <div class="p-6">
                @if ($payments->isEmpty())
                    <div class="empty-state text-center py-12">
                        <i class="fas fa-money-bill-wave text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">No hay pagos registrados</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-1">Comienza agregando un nuevo pago</p>
                        <button
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4 mx-auto inline-flex items-center"
                            data-modal-target="payments-modal" data-modal-toggle="payments-modal">
                            <i class="fas fa-plus mr-2"></i> Agregar Pago
                        </button>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full data-table">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="px-4 py-3 text-left">{{ __('Id') }}</th>
                                    <th class="px-4 py-3 text-left">{{ __('Monto') }}</th>
                                    <th class="px-4 py-3 text-left">{{ __('Fecha de Pago') }}</th>
                                    <th class="px-4 py-3 text-left">{{ __('Paciente') }}</th>
                                    <th class="px-4 py-3 text-left">{{ __('Doctor') }}</th>
                                    <th class="px-4 py-3 text-left">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $pay)
                                    <tr
                                        class="payment-card border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <td class="px-4 py-3 font-medium text-blue-900 dark:text-blue-200">
                                            {{ $pay->id }}</td>
                                        <td class="px-4 py-3 font-medium text-blue-900 dark:text-blue-200">
                                            ${{ number_format($pay->monto, 2) }}</td>
                                        <td class="px-4 py-3 font-medium text-blue-900 dark:text-blue-200">
                                            {{ \Carbon\Carbon::parse($pay->pay_date)->format('d/m/Y') }}</td>
                                        <td class="px-4 py-3 font-medium text-blue-900 dark:text-blue-200">
                                            {{ $pay->patient->person->name_1 ?? 'N/A' }}
                                            {{ $pay->patient->person->surname_1 ?? '' }}</td>
                                        <td class="px-4 py-3 font-medium text-blue-900 dark:text-blue-200">
                                            {{ $pay->employee->person->name_1 ?? 'N/A' }}
                                            {{ $pay->employee->person->surname_1 ?? '' }}
                                            <br>
                                            <small
                                                class="text-gray-500 dark:text-gray-400">{{ $pay->employee->speciality->name ?? 'No especificada' }}</small>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap flex items-center space-x-2">
                                            <button data-modal-target="show-payment-modal"
                                                data-modal-toggle="show-payment-modal"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 focus:outline-none"
                                                type="button" onclick="loadPaymentData({{ $pay->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                              <button data-modal-target="show-payment-modal"
                                                data-modal-toggle="show-payment-modal"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 focus:outline-none"
                                                type="button" onclick="loadPaymentData({{ $pay->id }})">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <button data-modal-target="edit-payment-modal" data-modal-toggle="edit-payment-modal"
                                                class="text-yellow-500 hover:text-yellow-700 dark:text-yellow-400 dark:hover:text-yellow-300 focus:outline-none"
                                                type="button" onclick="editarPay({{ $pay->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <form method="POST"
                                                action="{{ route('payment.destroy', ['payment' => $pay->id]) }}"
                                                class="form-eliminar" id="form-eliminar-{{ $pay->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 focus:outline-none"
                                                    onclick="confirmDelete({{ $pay->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Empty state for filtered results -->
        <div id="no-results" class="hidden text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow">
            <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">No se encontraron resultados</h3>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Intenta con otros criterios de búsqueda</p>
            <button id="reset-filters"
                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:focus:ring-gray-800 mt-4 mx-auto inline-flex items-center">
                <i class="fas fa-redo mr-2"></i> Restablecer filtros
            </button>
        </div>
    </div>

    @include('service.payments.create')
    @include('service.payments.show')
    @include('service.payments.edit')

@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
    <script src="{{ asset('js/dataTable.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar selects avanzados
            const patientSelect = new TomSelect('#patient-filter', {
                placeholder: 'Seleccione un paciente',
                create: false
            });

            const doctorSelect = new TomSelect('#doctor-filter', {
                placeholder: 'Seleccione un doctor',
                create: false
            });

            // Mostrar/ocultar filtros
            document.getElementById('filter-toggle').addEventListener('click', function() {
                const filterSection = document.getElementById('filter-section');
                const icon = this.querySelector('i');

                filterSection.classList.toggle('hidden');

                if (filterSection.classList.contains('hidden')) {
                    icon.classList.replace('fa-times', 'fa-filter');
                    this.classList.remove('bg-blue-100', 'dark:bg-blue-900');
                } else {
                    icon.classList.replace('fa-filter', 'fa-times');
                    this.classList.add('bg-blue-100', 'dark:bg-blue-900');
                }
            });

            // Aplicar filtros
            document.getElementById('apply-filters').addEventListener('click', function() {
                const btn = this;
                const spinner = btn.querySelector('.spinner');
                const patientId = patientSelect.getValue();
                const doctorId = doctorSelect.getValue();
                const dateFrom = document.getElementById('date-from').value;

                // Mostrar spinner
                btn.disabled = true;
                spinner.style.display = 'block';

                // Simular carga (en producción sería una llamada AJAX)
                setTimeout(function() {
                    // Aquí iría la lógica para filtrar los pagos
                    console.log('Filtrando por:', {
                        patientId,
                        doctorId,
                        dateFrom
                    });

                    // Ocultar spinner
                    spinner.style.display = 'none';
                    btn.disabled = false;
                }, 500);
            });

            // Restablecer filtros
            document.getElementById('reset-filters').addEventListener('click', function() {
                patientSelect.clear();
                doctorSelect.clear();
                document.getElementById('date-from').value = '';
                // Aquí iría la lógica para restablecer los resultados
                document.getElementById('no-results').classList.add('hidden');
            });

            // Ocultar alertas después de 5 segundos
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });

        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-eliminar-${id}`).submit();
                }
            });
        }

        function editarPay(id) {
            fetch(`/payment/mostrar/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const pay = data.data;
                        document.getElementById('edit-monto').value = pay.monto;
                        document.getElementById('edit-pay_date').value = pay.pay_date;
                        document.getElementById('edit-pacient_id').value = pay.pacient_id;
                        document.getElementById('edit-doctor_id').value = pay.doctor_id;
                        document.getElementById('edit-description').value = pay.description || '';
                        const form = document.getElementById('edit-payment-form');
                        form.action = `/payment/actualizar/${pay.id}`;
                        const modal = document.getElementById('edit-payment-modal');
                        modal.classList.remove('hidden');
                    } else {
                        Swal.fire('Error', 'No se pudo cargar el pago', 'error');
                    }
                })
                .catch(() => {
                    Swal.fire('Error', 'No se pudo cargar el pago', 'error');
                });
        }
    </script>
@endpush
