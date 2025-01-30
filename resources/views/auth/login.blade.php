<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="max-w-md mx-auto">
        @csrf

        <!-- Email Address -->
        <div class="relative z-0 w-full mb-5 group">
            <x-text-input
                type="email"
                name="email"
                id="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent
                       border-0 border-b-2 border-gray-300 appearance-none dark:text-white
                       dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none
                       focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <x-input-label for="email"
                class="peer-focus:font-medium absolute text-sm text-gray-500
                       dark:text-gray-400 duration-300 transform -translate-y-6 scale-75
                       top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4
                       rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500
                       peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0
                       peer-focus:scale-75 peer-focus:-translate-y-6">
                {{-- <box-icon name='envelope' type='solid' color='#1d84b9'></box-icon> --}}
                Email address
            </x-input-label>
        </div>

        <!-- Password -->
        <div class="relative z-0 w-full mb-5 group">
            <x-text-input
                type="password"
                name="password"
                id="password"
                required
                autocomplete="current-password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent
                       border-0 border-b-2 border-gray-300 appearance-none dark:text-white
                       dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none
                       focus:ring-0 focus:border-blue-600 peer"
                placeholder=" "
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <x-input-label for="password"
                class="peer-focus:font-medium absolute text-sm text-gray-500
                       dark:text-gray-400 duration-300 transform -translate-y-6
                       scale-75 top-3 -z-10 origin-[0] peer-focus:start-0
                       rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600
                       peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100
                       peer-placeholder-shown:translate-y-0 peer-focus:scale-75
                       peer-focus:-translate-y-6">
                {{-- <box-icon name='key' color='#1d84b9'></box-icon> --}}
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
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                       focus:outline-none focus:ring-blue-300 font-medium rounded-lg
                       text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600
                       dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
