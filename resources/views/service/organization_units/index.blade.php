@extends('layouts.app')

@section('title', 'Unidades Organizativas')

@push('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .unit-card {
            transition: all 0.3s ease;
            min-height: 120px;
        }

        .unit-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .badge-type {
            position: absolute;
            top: -10px;
            right: -10px;
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
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Unidades
                            Médicas</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Título y acciones -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Unidades Organizativas</h1>
                <p class="text-gray-600 dark:text-gray-400">Gestión de áreas y departamentos médicos</p>
            </div>

            <div class="flex gap-3">
                <button
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex items-center">
                    <i class="fas fa-plsus mr-2"></i>
                    Nuevo
                </button>
                <button data-modal-target="create-modal" data-modal-toggle="create-modal" type="button"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 transition-all duration-300">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nuevo Registro
                </button>
                <button class="btn btn-outline-secondary flex items-center" id="toggle-view">
                    <i class="fas fa-th mr-2"></i> Vista de Tarjetas
                </button>
            </div>
        </div>

        <!-- Vista de tabla (predeterminada) -->
        <div id="table-view" class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <table id="units-table" class="w-full display">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <th class="px-6 py-3 text-left">Nombre</th>
                        <th class="px-6 py-3 text-left">Tipo</th>
                        <th class="px-6 py-3 text-left">Ubicación</th>
                        <th class="px-6 py-3 text-left">Contacto</th>
                        <th class="px-6 py-3 text-left">Estado</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($organizationalUnits as $unit)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-clinic-medical text-blue-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $unit->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 line-clamp-1">
                                            {{ $unit->description }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $unit->unitType->name ?? 'Sin tipo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $unit->location }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $unit->phone_area_codes }}
                                    {{ $unit->phone_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Activo
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="" class="text-blue-600 hover:text-blue-900" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="text-green-600 hover:text-green-900" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Vista de tarjetas (oculta inicialmente) -->
        <div id="card-view" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
            @foreach ($organizationalUnits as $unit)
                <div class="unit-card bg-white dark:bg-gray-800 rounded-lg shadow p-6 relative">
                    <div
                        class="absolute badge-type bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        {{ $unit->unitType->name ?? 'General' }}
                    </div>

                    <div class="flex items-start mb-4">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-clinic-medical text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $unit->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $unit->location }}</p>
                        </div>
                    </div>

                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 line-clamp-2">
                        {{ $unit->description }}
                    </p>

                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                <i class="fas fa-phone-alt mr-1 text-blue-500"></i>
                                {{ $unit->phone_area_codes }} {{ $unit->phone_number }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="" class="text-blue-600 hover:text-blue-900 p-1" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="" class="text-green-600 hover:text-green-900 p-1" title="Ver">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar DataTable
            $('#units-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                },
                responsive: true
            });

            // Alternar entre vistas
            $('#toggle-view').click(function() {
                $('#table-view').toggleClass('hidden');
                $('#card-view').toggleClass('hidden');

                // Cambiar ícono y texto del botón
                const icon = $(this).find('i');
                if (icon.hasClass('fa-th')) {
                    icon.removeClass('fa-th').addClass('fa-list');
                    $(this).html('<i class="fas fa-list mr-2"></i> Vista de Tabla');
                } else {
                    icon.removeClass('fa-list').addClass('fa-th');
                    $(this).html('<i class="fas fa-th mr-2"></i> Vista de Tarjetas');
                }
            });
        });
    </script>
@endpush