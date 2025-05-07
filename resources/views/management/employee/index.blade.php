@extends('layouts.app')

@section('title', 'Gestión de Empleados')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .action-btn {
        transition: all 0.2s ease;
    }
    .action-btn:hover {
        transform: scale(1.1);
    }
    .alert-fade {
        opacity: 1;
        transition: opacity 1s ease;
    }
    .alert-fade.hide {
        opacity: 0;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Notificaciones -->
    @if(session('success'))
    <div id="success-alert" class="alert-fade fixed top-20 right-4 z-50 flex items-center p-4 mb-4 text-white bg-green-500 rounded-lg shadow-lg" role="alert">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium">
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="error-alert" class="alert-fade fixed top-20 right-4 z-50 flex items-center p-4 mb-4 text-white bg-red-500 rounded-lg shadow-lg" role="alert">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium">
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Header y estadísticas -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Gestión de Empleados</h1>
                <p class="text-gray-600 dark:text-gray-400">Administración completa del personal</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                    {{ Auth::user()->roles->pluck('name')->first() }}
                </span>
            </div>
        </div>

        <!-- Tarjeta de resumen -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="card-hover p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 mr-4 bg-blue-100 rounded-full dark:bg-blue-900">
                        <svg class="w-6 h-6 text-blue-800 dark:text-blue-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Empleados</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $employees->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="card-hover p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 mr-4 bg-green-100 rounded-full dark:bg-green-900">
                        <svg class="w-6 h-6 text-green-800 dark:text-green-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Activos</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $employees->where('status', 'active')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="card-hover p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 mr-4 bg-purple-100 rounded-full dark:bg-purple-900">
                        <svg class="w-6 h-6 text-purple-800 dark:text-purple-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Doctores</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $employees->where('employee_type', 'Doctor')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="card-hover p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center">
                    <div class="p-3 mr-4 bg-yellow-100 rounded-full dark:bg-yellow-900">
                        <svg class="w-6 h-6 text-yellow-800 dark:text-yellow-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Administrativos</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $employees->where('employee_type', 'admin')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de empleados -->
    <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between items-start md:items-center">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 md:mb-0">Listado de Empleados</h2>
            <div class="flex space-x-2">
                <button data-modal-target="employee-modal" data-modal-toggle="employee-modal"
                    class="flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Nuevo Empleado
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full data-table">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cédula</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre Completo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estatus</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($employees as $employee)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ $employee->person->nacionality }}-{{ number_format($employee->person->identification_number, 0, '', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                @if($employee->person)
                                    {{ $employee->person->surname_1 }} {{ $employee->person->surname_2 }}
                                    {{ $employee->person->name_1 }} {{ $employee->person->name_2 }}
                                @else
                                    Sin información
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($employee->employee_type == 'doctor') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @elseif($employee->employee_type == 'admin') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                                @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 @endif">
                                {{ ucfirst($employee->employee_type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($employee->status == 'active') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @else bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @endif">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button data-modal-target="show-employee-modal" data-modal-toggle="show-employee-modal"
                                    class="action-btn text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                    onclick="showEmployee({{ $employee->id }})" title="Ver detalles">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <button data-modal-target="edit-employee-modal" data-modal-toggle="edit-employee-modal"
                                    class="action-btn text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                                    onclick="editEmployee({{ $employee->id }})" title="Editar">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('employee.destroy', $employee->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        onclick="confirmDelete({{ $employee->id }})" title="Eliminar">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('management.employee.create')
{{-- @include('management.employee.edit')
@include('management.employee.show') --}}

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Auto-ocultar alertas después de 5 segundos
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert-fade');
        alerts.forEach(alert => {
            alert.classList.add('hide');
            setTimeout(() => alert.remove(), 1000);
        });
    }, 5000);

    // Inicializar DataTable
    new simpleDatatables.DataTable(".data-table", {
        searchable: true,
        fixedHeight: false,
        perPage: 10,
        labels: {
            placeholder: "Buscar...",
            perPage: "{select} registros por página",
            noRows: "No se encontraron registros",
            info: "Mostrando {start} a {end} de {rows} registros",
        }
    });

    // Confirmación de eliminación
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`form-eliminar-${id}`).submit();
            }
        });
    }

    // Mostrar empleado
    function showEmployee(id) {
        fetch(`/employee/${id}`)
            .then(response => response.json())
            .then(data => {
                // Llenar el modal con los datos del empleado
                document.getElementById('show-name').textContent = data.person.full_name;
                // ... completar con más campos según necesidad

                // Mostrar el modal
                const modal = new Modal(document.getElementById('show-employee-modal'));
                modal.show();
            });
    }

    // Editar empleado
    function editEmployee(id) {
        fetch(`/employee/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                // Llenar el formulario de edición
                document.getElementById('edit-name').value = data.person.name;
                // ... completar con más campos según necesidad

                // Mostrar el modal
                const modal = new Modal(document.getElementById('edit-employee-modal'));
                modal.show();
            });
    }

    // Inicializar Select2 para los selects
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'classic',
            width: '100%'
        });
    });
</script>
@endpush