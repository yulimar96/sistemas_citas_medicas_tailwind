<nav class="bg-white border-gray-200 dark:bg-gray-900">
     <button id="theme-toggle" type="button"
            class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 " fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                    fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </button>
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('img/logo_clinic1.jpeg') }}" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Clinic Hub</span>
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            <a href="tel:5541251234" class="text-sm  text-gray-500 dark:text-white hover:underline">(412) 094-15-08</a>
            <a href="{{ route('login') }}" class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Login</a>
        </div>
       
    </div>
</nav>
{{-- <nav class="bg-gray-50 dark:bg-gray-700"> --}}
<nav class="flex items-center space-x-6 rtl:space-x-reverse bg-gray-50 dark:bg-gray-700">
    <div class="max-w-screen-xl px-4 py-3 mx-auto">
        <div class="flex items-center">
            <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-2xl">
                <li>
                    <a href="#" class="text-gray-900 dark:text-white hover:underline hover:text-blue-500 hover:bg-red-500"
                        aria-current="page">Inicio</a>
                </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white hover:underline">Compañia</a>
                </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white hover:underline">Equipo</a>
                </li>
                <li>
                    <a href="#" class="text-gray-900 dark:text-white hover:underline">Caracteristica</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
