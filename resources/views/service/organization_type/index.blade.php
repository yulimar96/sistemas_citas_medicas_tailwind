@extends('layouts.app')

@section('title', 'Tipos de Unidades Organizativas')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet">
<style>
    .hq-card {
        transition: all 0.3s ease;
    }
    .hq-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .unit-type-badge {
        transition: all 0.2s ease;
    }
    .unit-type-badge:hover {
        transform: scale(1.05);
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
        to { transform: rotate(360deg); }
    }
    
    /* Empty state */
    .empty-state {
        transition: all 0.3s ease;
    }
    .empty-state:hover {
        transform: scale(1.02);
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
                            Tipos de Unidades</span>
                    </div>
                </li>
            </ol>
        </nav>
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Tipos de Unidades por Sede</h1>
            <p class="text-gray-600 dark:text-gray-400">Gestión de especialidades médicas por ubicación</p>
        </div>
        
        <div class="flex gap-3">
            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex items-center" 
                    data-modal-target="create-unit-type-modal">
                <i class="fas fa-plus mr-2"></i> Nuevo Tipo
            </button>
            <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:focus:ring-gray-800 flex items-center" 
                    id="filter-toggle">
                <i class="fas fa-filter mr-2"></i> Filtrar
            </button>
        </div>
    </div>

    <!-- Filtros (inicialmente ocultos) -->
    <div class="hidden mb-6 p-4 bg-white dark:bg-gray-800 rounded-lg shadow" id="filter-section">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Organización</label>
                <select id="organization-filter" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Todas</option>
                    @foreach($organizations as $org)
                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Sede</label>
                <select id="headquarter-filter" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">Todas</option>
                    @foreach($headquartersWithUnitTypes as $hq)
                        <option value="{{ $hq->id }}" data-organization="{{ $hq->organizational_id }}">{{ $hq->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full flex items-center justify-center" 
                        id="apply-filters">
                    <span class="spinner mr-2"></span>
                    <span>Aplicar Filtros</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="grid grid-cols-1 gap-6" id="hq-container">
        @forelse($headquartersWithUnitTypes as $headquarter)
            <div class="hq-card bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden" 
                 data-organization="{{ $headquarter->organizational_id }}" 
                 data-headquarter="{{ $headquarter->id }}">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">{{ $headquarter->name }}</h3>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-200">
                        {{ $headquarter->unitTypes->count() }} especialidades
                    </span>
                </div>
                
                <div class="p-6">
                    @if($headquarter->unitTypes->isEmpty())
                        <div class="text-center py-4 text-gray-500 dark:text-gray-400">
                            <i class="fas fa-clinic-medical text-3xl mb-2"></i>
                            <p>No hay tipos de unidades registradas en esta sede</p>
                        </div>
                    @else
                        <div class="flex flex-wrap gap-3">
                            @foreach($headquarter->unitTypes as $type)
                                <div class="unit-type-badge relative group">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $type->name }}
                                        <button class="ml-2 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-150" 
                                                data-id="{{ $type->id }}"
                                                data-action="edit">
                                            <i class="fas fa-pencil-alt text-xs"></i>
                                        </button>
                                    </span>
                                    <div class="absolute z-10 hidden group-hover:block bg-white dark:bg-gray-700 shadow-lg rounded-md p-2 mt-1 w-64">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $type->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow">
                <i class="fas fa-hospital text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">No hay sedes registradas</h3>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Comienza agregando una nueva sede y sus tipos de unidades</p>
                <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4 mx-auto inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i> Agregar Sede
                </button>
            </div>
        @endforelse
    </div>

    <!-- Empty state for filtered results -->
    <div id="no-results" class="hidden text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow">
        <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">No se encontraron resultados</h3>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Intenta con otros criterios de búsqueda</p>
        <button id="reset-filters" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:focus:ring-gray-800 mt-4 mx-auto inline-flex items-center">
            <i class="fas fa-redo mr-2"></i> Restablecer filtros
        </button>
    </div>
</div>

{{-- @include('service.organization_type.modals.create') --}}
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar selects avanzados
        const orgSelect = new TomSelect('#organization-filter', {
            placeholder: 'Seleccione una organización',
            create: false,
            onChange: function(orgId) {
                updateHeadquartersFilter(orgId);
            }
        });
        
        const hqSelect = new TomSelect('#headquarter-filter', {
            placeholder: 'Seleccione una sede',
            create: false
        });

        // Actualizar sedes cuando cambia la organización
        function updateHeadquartersFilter(orgId) {
            hqSelect.clear();
            hqSelect.clearOptions();
            
            // Agregar opción "Todas"
            hqSelect.addOption({value: '', text: 'Todas'});
            
            if (orgId) {
                // Filtrar sedes por organización seleccionada
                const hqOptions = document.querySelectorAll('#headquarter-filter option[data-organization]');
                hqOptions.forEach(option => {
                    if (option.dataset.organization === orgId) {
                        hqSelect.addOption({
                            value: option.value,
                            text: option.textContent
                        });
                    }
                });
            } else {
                // Mostrar todas las sedes si no se selecciona organización
                const hqOptions = document.querySelectorAll('#headquarter-filter option[value]');
                hqOptions.forEach(option => {
                    if (option.value) {
                        hqSelect.addOption({
                            value: option.value,
                            text: option.textContent
                        });
                    }
                });
            }
        }

        // Aplicar filtros
        document.getElementById('apply-filters').addEventListener('click', function() {
            const btn = this;
            const spinner = btn.querySelector('.spinner');
            const orgId = orgSelect.getValue();
            const hqId = hqSelect.getValue();
            
            // Mostrar spinner
            btn.disabled = true;
            spinner.style.display = 'block';
            
            // Simular carga (en producción sería una llamada AJAX)
            setTimeout(function() {
                filterCards(orgId, hqId);
                
                // Ocultar spinner
                spinner.style.display = 'none';
                btn.disabled = false;
            }, 500);
        });

        // Función para filtrar tarjetas
        function filterCards(orgId, hqId) {
            let hasResults = false;
            const cards = document.querySelectorAll('.hq-card');
            
            cards.forEach(card => {
                const cardOrgId = card.dataset.organization;
                const cardHqId = card.dataset.headquarter;
                
                const orgMatch = !orgId || cardOrgId === orgId;
                const hqMatch = !hqId || cardHqId === hqId;
                
                if (orgMatch && hqMatch) {
                    card.style.display = 'block';
                    hasResults = true;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Mostrar mensaje si no hay resultados
            const noResults = document.getElementById('no-results');
            if (hasResults) {
                noResults.classList.add('hidden');
            } else {
                noResults.classList.remove('hidden');
            }
        }

        // Restablecer filtros
        document.getElementById('reset-filters').addEventListener('click', function() {
            orgSelect.clear();
            hqSelect.clear();
            hqSelect.addOptions(document.querySelectorAll('#headquarter-filter option[value]'));
            filterCards('', '');
            document.getElementById('no-results').classList.add('hidden');
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

        // Manejar clics en botones de acción
        document.querySelectorAll('[data-action="edit"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                console.log('Editar tipo con ID:', id);
                // Aquí iría la lógica para abrir el modal de edición
            });
        });
    });
</script>
@endpush