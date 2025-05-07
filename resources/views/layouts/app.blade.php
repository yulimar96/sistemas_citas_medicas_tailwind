<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Título de la página -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fuentes y Estilos -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- <script src="{{ asset('js/dark.js') }}"></script> --}}
    <link href="{{ asset('css/flowbite.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tailwind.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/fonts.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
     <link href="{{ asset('web/img/favicon.png') }}" rel="icon">
    <!-- Iconos -->
    <script src="{{ asset('icons/boxicons.js') }}"></script>
    
    <!-- Estilos CSS personalizados -->
    @stack('css')
    <style>
        /* Estilo principal del contenido */
        .main-content {
            margin-left: 16rem; /* Ancho del sidebar */
            padding-top: 4rem; /* Altura del navbar */
            width: calc(100% - 16rem);
            min-height: calc(100vh - 4rem);
        }

        /* Sombra personalizada para elementos */
        .shadow-md {
            --tw-shadow: 10px 10px 10px -1px rgb(114 29 149 / 67%), 0 20px 40px -2px rgb(0 0 0) !important;
            --tw-shadow: 10px 10px 10px -1px rgb(87 129 137 / 67%), 0 10px 10px -2px rgb(0 0 0) !important;
            box-shadow: var(--tw-ring-offset-shadow, 20 0 #746f6f), var(--tw-ring-shadow, 0 0 #d3cdcdf0), var(--tw-shadow);
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Barra de navegación -->
    @include('layouts.navbar')
    
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Contenido principal -->
    <div class="main-content bg-gray-50 dark:bg-gray-900 p-4">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    
    <!-- Script para confirmación de eliminación -->
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Una vez eliminado, no podrás recuperar.",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminarlo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-eliminar-' + userId).submit();
                }
            });
        }
    </script>

        <script>
        // Cerrar automáticamente las alertas después de 5 segundos
        setTimeout(function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
            if (errorAlert) {
                errorAlert.style.display = 'none';
            }
        }, 5000); // 5000 ms = 5 seconds
    </script>

    <!-- Script para tiempo de inactividad -->
    <script>
        // Tiempo en milisegundos (15 minutos)
        const timeoutDuration = 15 * 60 * 1000;
        
        // Función para redirigir al usuario a la página de inicio de sesión
        function redirectToLogin() {
            window.location.href = "{{ route('login') }}";
        }
        
        // Establecer un temporizador
        let timeout;
        
        function resetTimer() {
            clearTimeout(timeout);
            timeout = setTimeout(redirectToLogin, timeoutDuration);
        }
        
        // Reiniciar el temporizador en eventos de actividad
        window.onload = resetTimer;
        window.onmousemove = resetTimer;
        window.onkeypress = resetTimer;
    </script>
    <svg class="icon">
    <use xlink:href="{{ asset('icons/logo_clinic1.jpeg') }}#user"></use>
</svg>
    @stack('js')
</body>
</html>