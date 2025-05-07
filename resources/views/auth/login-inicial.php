<x-guest-layout>
    <style>
        body {
            background-image: url('{{ asset('img/fondo.png') }}'); /* Ruta de la imagen de fondo */
            background-size: cover; /* Ajusta la imagen para cubrir todo el fondo */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            height: 100vh; /* Asegura que el body ocupe toda la altura de la ventana */
            margin: 0; /* Elimina márgenes por defecto */
            display: flex; /* Usar flexbox para centrar el contenido */
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
        }
        .shadow-md {
    --tw-shadow: 10px 10px 10px -1px rgb(114 29 149 / 67%), 0 20px 40px -2px rgb(0 0 0) !important;
    /* --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 6px 4px -2px var(--tw-shadow-color); */
    box-shadow: var(--tw-ring-offset-shadow, 20 0 #4a0404), var(--tw-ring-shadow, 0 0 #000000f0), var(--tw-shadow);
}
        .form-container {
            background-color: rgba(226, 221, 221, 0.753); /* Fondo blanco semitransparente */
            border-radius: 8px; /* Bordes redondeados */
            padding: 20px; /* Espaciado interno */
            box-shadow: 0 4px 20px rgba(219, 7, 7, 0.836); /* Sombra para el contenedor */
        }

        .form-container {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15); /* Sombra semitransparente */
        }

        .input-label {
            color: #333; /* Color del texto de las etiquetas */
        }

        .input-error {
            color: red; /* Color del texto de error */
        }

        .text-input {
            color: #333; /* Color del texto de entrada */
            border-color: #ccc; /* Color del borde */
        }

        .text-input:focus {
            border-color: #69338d; /* Color del borde al enfocar */
        }

        .login-button {
            background-color: #007BFF; /* Color de fondo del botón */
            color: white; /* Color del texto del botón */
        }

        .login-button:hover {
            background-color: #0056b3; /* Color de fondo del botón al pasar el mouse */
        }
    </style>

    <div class="form-container">
        <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto">
            @csrf

            <!-- Email Address -->
            <div class="relative z-0 w-full mb-5">
                <x-text-input
                    type="email"
                    name="email"
                    id="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 text-input"
                    placeholder=" "
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 input-error" />
                <x-input-label for="email" class="absolute text-sm input-label transform -translate-y-8 scale-80 top-3">
                    Email address
                </x-input-label>
            </div>

            <!-- Password -->
            <div class="relative z-0 w-full mb-5">
                <x-text-input
                    type="password"
                    name="password"
                    id="password"
                    required
                    autocomplete="current-password"
                    class="block py-2.5 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 text-input"
                    placeholder=" "
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 input-error" />
                <x-input-label for="password" class="absolute text-sm input-label transform -translate-y-8 scale-80 top-3">
                    Password
                </x-input-label>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="login-button text-sm sm:w-auto px-5 py-2.5 text-center rounded-lg">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>