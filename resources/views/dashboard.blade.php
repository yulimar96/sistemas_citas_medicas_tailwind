@extends('layouts.app')

@section('title', 'Dashboard Administrativo')

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<style>
    /* Efectos personalizados */
    .card-hover-effect {
        transition: all 0.3s ease;
    }
    .card-hover-effect:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .icon-hover-effect {
        transition: all 0.3s ease;
    }
    .card-hover-effect:hover .icon-hover-effect {
        transform: scale(1.1) rotate(5deg);
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header mejorado -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Panel de Control</h1>
        <div class="flex items-center mt-2">
            <span class="text-gray-600 dark:text-gray-400">Bienvenido,</span>
            <span class="ml-2 font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</span>
            <span class="mx-2 text-gray-400">|</span>
            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                {{ Auth::user()->roles->pluck('name')->first() }}
            </span>
        </div>
    </div>

    <!-- Grid de tarjetas -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @can('ver_usuarios')
        <!-- Tarjeta Usuarios -->
        <div class="relative p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 card-hover-effect">
            <div class="absolute -top-6 left-6 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shadow-lg icon-hover-effect dark:bg-blue-900">
                <svg class="w-6 h-6 text-blue-800 dark:text-blue-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Usuarios</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $users }}</p>
            <a href="{{ route('user') }}" class="inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                Ver detalles
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        @endcan

        @can('ver_usuarios')
        <!-- Tarjeta Secretarias -->
        <div class="relative p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 card-hover-effect">
            <div class="absolute -top-6 left-6 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center shadow-lg icon-hover-effect dark:bg-purple-900">
                <svg class="w-6 h-6 text-purple-800 dark:text-purple-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Secretarias</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $secretariat }}</p>
            <a href="{{ route('secretariat') }}" class="inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                Ver detalles
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        @endcan

        @can('ver_doctor')
        <!-- Tarjeta Doctores -->
        <div class="relative p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 card-hover-effect">
            <div class="absolute -top-6 left-6 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center shadow-lg icon-hover-effect dark:bg-green-900">
                <svg class="w-6 h-6 text-green-800 dark:text-green-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Doctores</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $doctors }}</p>
            <a href="{{ route('doctor') }}" class="inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                Ver detalles
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        @endcan

        @can('ver_paciente')
        <!-- Tarjeta Pacientes -->
        <div class="relative p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 card-hover-effect">
            <div class="absolute -top-6 left-6 w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center shadow-lg icon-hover-effect dark:bg-red-900">
                <svg class="w-6 h-6 text-red-800 dark:text-red-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Pacientes</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $patients }}</p>
            <a href="{{ route('patient') }}" class="inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                Ver detalles
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        @endcan

        <!-- Tarjeta Consultorios -->
        <div class="relative p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 card-hover-effect">
            <div class="absolute -top-6 left-6 w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center shadow-lg icon-hover-effect dark:bg-indigo-900">
                <svg class="w-6 h-6 text-indigo-800 dark:text-indigo-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Consultorios</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $organizationalunit }}</p>
            <a href="{{ route('unit') }}" class="inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                Ver detalles
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>

        <!-- Tarjeta Horarios -->
        <div class="relative p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 card-hover-effect">
            <div class="absolute -top-6 left-6 w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center shadow-lg icon-hover-effect dark:bg-yellow-900">
                <svg class="w-6 h-6 text-yellow-800 dark:text-yellow-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Horarios</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $doctorschedule }}</p>
            <a href="{{ route('doctor_schedule') }}" class="inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                Ver detalles
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <div class="relative p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 card-hover-effect">
            <div class="absolute -top-6 left-6 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center shadow-lg icon-hover-effect dark:bg-blue-900">
                <svg class="w-6 h-6 text-blue-800 dark:text-blue-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">Eventos</h3>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mb-4">{{ $events }}</p>
            <a href="{{ route('appointments') }}" class="inline-flex items-center text-blue-600 hover:underline dark:text-blue-400">
                Ver detalles
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Sección de estadísticas -->
    <div class="mt-8 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h2 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white">Estadísticas Recientes</h2>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Estadística 1 -->
            <div class="p-6 bg-blue-50 border border-blue-100 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Citas Hoy</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mb-1">24</p>
                <p class="text-sm font-medium text-green-600 dark:text-green-400">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                        </svg>
                        +2 desde ayer
                    </span>
                </p>
            </div>
            
            <!-- Estadística 2 -->
            <div class="p-6 bg-green-50 border border-green-100 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pacientes Nuevos</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mb-1">5</p>
                <p class="text-sm font-medium text-green-600 dark:text-green-400">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                        </svg>
                        +3 esta semana
                    </span>
                </p>
            </div>
            
            <!-- Estadística 3 -->
            <div class="p-6 bg-orange-50 border border-orange-100 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Consultas Pendientes</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mb-1">8</p>
                <p class="text-sm font-medium text-red-600 dark:text-red-400">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586l-4.293-4.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"></path>
                        </svg>
                        -2 desde ayer
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script>
    // Efectos de hover mejorados
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card-hover-effect');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s ease';
            });
            
            // Efecto al hacer clic
            card.addEventListener('click', function(e) {
                // Si el clic fue en un enlace, no hacer nada adicional
                if (e.target.tagName === 'A' || e.target.closest('a')) {
                    return;
                }
                
                // Buscar el primer enlace dentro de la tarjeta y navegar
                const link = this.querySelector('a');
                if (link) {
                    window.location.href = link.href;
                }
            });
        });
        
        // Tooltips para iconos
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-tooltip-target]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            new Flowbite.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush