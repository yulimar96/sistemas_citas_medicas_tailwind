<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-blue-100 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <!-- Ítem del Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200
              {{ request()->routeIs('dashboard')
                  ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                  : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                    <!-- Icono del Dashboard -->
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>

                    <!-- Texto del enlace -->
                    <span class="ms-3">{{ __('Panel de Control') }}</span>

                    <!-- Indicador de ruta activa -->
                    @if (request()->routeIs('dashboard'))
                        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    @endif
                </a>
            </li>

            <!-- Dropdown de Gestión Clínica -->
            <li>
                <button type="button"
                    class="flex items-center w-full p-3 text-gray-800 transition-all duration-300 rounded-xl group hover:bg-indigo-50 dark:hover:bg-gray-700/60 dark:text-gray-200 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-500"
                    aria-controls="dropdown-clinic" data-collapse-toggle="dropdown-clinic">
                    <div
                        class="p-2 mr-3 rounded-lg bg-indigo-100/80 dark:bg-gray-700 group-hover:bg-indigo-200 dark:group-hover:bg-indigo-500 transition-colors">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span
                        class="flex-1 text-left font-medium text-gray-700 dark:text-gray-100">{{ __('Clinic Management') }}</span>
                    <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                @can('ver_usuarios')
                    <!-- Menú desplegable -->
                    <ul id="dropdown-clinic"
                        class="hidden py-2 pl-2 space-y-1 border-l-2 border-indigo-100 dark:border-gray-600 ml-9">

                        <li>
                            <a href="{{ route('user') }}"
                                class="flex items-center px-4 py-2.5 text-sm rounded-lg transition-all duration-200 group
                  {{ request()->routeIs('user')
                      ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-semibold'
                      : 'text-gray-600 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">
                                <!-- Icono de usuarios -->
                                <svg class="w-4 h-4 mr-3 text-indigo-500 dark:text-indigo-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <!-- Texto del enlace -->
                                <span>{{ __('Users') }}</span>
                                <!-- Indicador de ruta activa -->
                                @if (request()->routeIs('user'))
                                    <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                                @endif
                            </a>
                        </li>
                    @endcan
                    @can('ver_usuarios')
                        <li>
                            <a href="{{ route('secretariat') }}"
                                class="flex items-center px-4 py-2.5 text-sm rounded-lg transition-all hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20 group {{ request()->routeIs('secretariat') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-semibold' : 'text-gray-600 dark:text-gray-300' }}">
                            <svg class="w-4 h-4 mr-3 text-green-500 dark:text-green-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                                {{ __('Secretariats') }}
                                <span
                                    class="ml-auto px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 rounded-full">3</span>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a href="{{ route('employee') }}"
                            class="flex items-center px-4 py-2.5 text-sm rounded-lg transition-all hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20 group {{ request()->routeIs('employee') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-semibold' : 'text-gray-600 dark:text-gray-300' }}">
                            <svg class="w-4 h-4 mr-3 text-green-500 dark:text-green-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ __('Employees') }}
                            <span
                                class="ml-auto px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 rounded-full">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('doctor') }}"
                            class="flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20 group {{ request()->routeIs('doctor') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-semibold' : 'text-gray-600 dark:text-gray-300' }}">
                            <svg class="w-4 h-4 mr-3 text-teal-500 dark:text-teal-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            {{ __('Doctors') }}
                        </a>
                    </li>

                    @can('ver_paciente')
                        <li>
                            <a href="{{ route('patient') }}"
                                class="flex items-center px-4 py-2.5 text-sm rounded-lg hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20 group {{ request()->routeIs('patient') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-semibold' : 'text-gray-600 dark:text-gray-300' }}">
                                <svg class="w-4 h-4 mr-3 text-purple-500 dark:text-purple-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                                </svg>
                                {{ __('Patients') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>

            @can('ver_horario_doctor')
                <li>
                    <a href="{{ route('doctor_schedule') }}"
                        class="flex items-center p-3 rounded-lg group transition-colors duration-200
                      {{ request()->routeIs('doctor_schedule')
                          ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                          : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>

                        <span class="ms-3 whitespace-nowrap">{{ __('Doctor Schedule') }}</span>

                        @if (request()->routeIs('doctor_schedule'))
                            <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                        @endif
                    </a>
                </li>
            @endcan
            <li>
                <a href="{{ route('organization') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200
              {{ request()->routeIs('organization')
                  ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                  : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                    <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>

                    <span class="ms-3 whitespace-nowrap">{{ __('Organización') }}</span>

                    @if (request()->routeIs('organization'))
                        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    @endif
                </a>
            </li>
            <!-- Tipo de Organización -->
            <li>
                <a href="{{ route('unit_type') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200
              {{ request()->routeIs('unit_type')
                  ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                  : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                    <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>

                    <span class="ms-3 whitespace-nowrap">{{ __('Tipo de Organización') }}</span>

                    @if (request()->routeIs('unit_type'))
                        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    @endif
                </a>
            </li>

            <!-- Consultorio Management -->
            <li>
                <a href="{{ route('unit') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200
              {{ request()->routeIs('unit')
                  ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                  : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                    <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>

                    <span class="ms-3 whitespace-nowrap">{{ __('Consultorio Management') }}</span>

                    @if (request()->routeIs('unit'))
                        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    @endif
                </a>
            </li>

            <!-- My Information -->
            <li>
                <a href="{{ route('patient') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200
              {{ request()->routeIs('patient')
                  ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                  : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    <span class="ms-3 whitespace-nowrap">{{ __('My Information') }}</span>

                    @if (request()->routeIs('patient'))
                        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('appointments') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200
              {{ request()->routeIs('appointments')
                  ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                  : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>

                    <span class="ms-3 whitespace-nowrap">{{ __('Medical Appointments') }}</span>

                    @if (request()->routeIs('appointments'))
                        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('payment') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200
              {{ request()->routeIs('payment')
                  ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                  : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <rect width="20" height="14" x="2" y="5" rx="2" ry="2" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 10h20" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15h.01" />
                    </svg>

                    <span class="ms-3 whitespace-nowrap">{{ __('Payments') }}</span>

                    @if (request()->routeIs('payment'))
                        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('configuration') }}"
                    class="flex items-center p-3 rounded-lg group transition-colors duration-200
                      {{ request()->routeIs('configuration')
                          ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-500/10 dark:text-indigo-300 font-medium'
                          : 'text-gray-700 dark:text-gray-300 hover:bg-indigo-100/50 dark:hover:bg-indigo-500/20' }}">

                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.4 15a7.97 7.97 0 01-1.4 2.4l1.4 1.4-1.4 1.4-1.4-1.4a7.97 7.97 0 01-2.4 1.4v2h-2v-2a7.97 7.97 0 01-2.4-1.4l-1.4 1.4-1.4-1.4 1.4-1.4a7.97 7.97 0 01-1.4-2.4h-2v-2h2a7.97 7.97 0 011.4-2.4l-1.4-1.4 1.4-1.4 1.4 1.4a7.97 7.97 0 012.4-1.4v-2h2v2a7.97 7.97 0 012.4 1.4l1.4-1.4 1.4 1.4-1.4 1.4a7.97 7.97 0 011.4 2.4h2v2h-2z" />
                    </svg>

                    <span class="ms-3 whitespace-nowrap">{{ __('Configuración') }}</span>

                    @if (request()->routeIs('doctor_schedule'))
                        <span class="ml-auto w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    @endif
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- Script para el toggle de dark/light mode -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Verificar el tema actual al cargar la página
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window
                .matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            themeToggleLightIcon.classList.remove('hidden');
            themeToggleDarkIcon.classList.add('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            themeToggleLightIcon.classList.add('hidden');
            themeToggleDarkIcon.classList.remove('hidden');
        }

        // Manejar el click en el botón de toggle
        themeToggleBtn.addEventListener('click', function() {
            // Alternar iconos
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Alternar clase dark en el html
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    });
</script>
