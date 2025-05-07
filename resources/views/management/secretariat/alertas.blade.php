  <div class="p-4 border-0 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
                <!-- Mensajes de éxito y error -->
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
    </div>



      <style>
        /* Asegúrate de que la transición de opacidad esté definida */
        .alert {
            opacity: 1;
            transition: opacity 0.5s ease;
        }
    </style>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>