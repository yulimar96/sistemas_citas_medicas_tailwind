@extends('layouts.app')
@push('css')
   <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

@endpush
@section('title', 'secretaria')
@section('content')
    <style>
        /* Asegúrate de que la transición de opacidad esté definida */
        .alert {
            opacity: 1;
            transition: opacity 0.5s ease;
        }
    </style>

    <div class="container mx-auto">
        <div class="p-4 sm:ml-64">
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

                <div class="flex space-x-4 p-6">
                    <div
                        class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg transition-transform transform hover:scale-105 dark:bg-gray-800 dark:border-gray-700">
                        <div
                            class="absolute -top-10 left-1/2 transform -translate-x-1/2 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-[38px] h-[38px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </div>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Total de
                            Secretarias</h5>
                        {{-- <p class="mb-3 font-normal text-gray-600 dark:text-gray-400">Aquí puedes ver el total de usuarios
                            registrados y más información sobre ellos.</p> --}}
                        <div class="flex  items-center mb-3">
                            <span class="font-bold text-gray-800 dark:text-gray-200 "> {{ $users }}</span>

                        </div>
                        <a href="{{ route('user.index') }}"
                            class="text-blue-600 hover:underline transition-colors duration-200">Ver más
                            información</a>
                    </div>

                    {{-- <div
                        class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <div
                            class="absolute -top-10 left-1/2 transform -translate-x-1/2 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10 10-4.48 10-10S15.52 0 10 0zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" />
                            </svg>
                        </div>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Total de
                            Usuarios</h5>
                        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Aquí puedes ver el total de usuarios
                            registrados y más información sobre ellos.</p>
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-bold text-gray-800 dark:text-gray-200">Total: 150</span>
                            <a href="#" class="text-blue-600 hover:underline">Ver más información</a>
                        </div>
                    </div> --}}

                    <!-- Main modal -->
                    <div id="authentication-modal" tabindex="-1" aria-hidden="true" data-dialog-backdrop="authentication-modal" data-dialog-backdrop-close="false"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Crear una nueva secretaria
                                    </h3>
                                    <button type="button"
                                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="authentication-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form class="space-y-4" action="{{ route('secretariat.store') }}" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Name') }}</label>
                                            <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                                        </div>
                                        <div>
                                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Last name') }}</label>
                                            <input type="text" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                                        </div>
                                        <div>
                                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Address') }}</label>
                                            <input type="text" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                                        </div>
                                        <div>
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Email') }}</label>
                                            <input type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                                        </div>
                                        <div>
                                            <label for="birthdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Birthdate') }}</label>
                                            <input type="date" name="birthdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                        </div>
                                        <div>
                                            <label for="nacionality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Nacionality') }}</label>
                                            <select name="nacionality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                <option selected disabled>Selecciona...</option>
                                                <option value="0414">V</option>
                                                <option value="0424">E</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="identification_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Identification Number') }}</label>
                                            <input type="text" name="identification_number" placeholder="335267" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Password') }}</label>
                                            <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                        </div>
                                        <div>
                                            <label for="confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Confirm Password') }}</label>
                                            <input type="password" name="confirm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="code_area" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Code area') }}</label>
                                            <select name="code_area" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                <option selected disabled>Selecciona...</option>
                                                <option value="0412">0412</option>
                                                <option value="0414">0414</option>
                                                <option value="0424">0424</option>
                                                <option value="0416">0416</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">* {{ __('Phone') }}</label>
                                            <input type="text" name="phone" placeholder="07-98-645" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                        </div>
                                    </div>
                                    <button type="submit" class="w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Submit') }}</button>
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300"></div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="max-w-5xl p-6 bg-white  border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="flex items-center justify-center h-24 rounded dark:bg-gray-800">{{-- bg-gray-50 --}}
                        <h1 class="text-3xl font-bold">Listado de usuarios</h1>
                    </div>
                    <div class="flex items-center justify-center h-24 rounded ">
                        {{-- <box-icon type='solid' name='user-plus'></box-icon> --}}
                    </div>
                    <div class="flex justify-center mt-4">
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                            class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 focus:ring-4 focus:outline-none 
                            focus:ring-blue-300 text-white font-medium rounded-full text-sm px-4 py-2 transition duration-200 ease-in-out shadow-lg 
                            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <box-icon type='solid' name='user-plus'
                                class='w-5 h-5 transition-transform duration-200 ease-in-out 
                            group-hover:text-blue-300 group-hover:scale-125'></box-icon>
                            <span class="ml-2">Crear Usuario</span>
                        </button>
                    </div>
                </div>

                <table id="export-table" class="w-full">
                    <thead>
                        <tr>
                            <th>
                                <span class="flex items-center">
                                    {{ __('Id') }}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    {{ __('Name') }}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                             <th>
                                <span class="flex items-center">
                                    {{ __('Last name') }}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                           
                            <th data-type="date" data-format="YYYY/DD/MM">
                                <span class="flex items-center">
                                    {{__('Birthdate')}}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                     {{__('Email')}}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    {{ __('Actions') }}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                    </svg>
                                </span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($secretariats as $secretariat)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                            <td class="font-medium text-blue-900 whitespace-nowrap ">{{ $secretariat->id }}</td>
                            <td class="font-medium text-blue-900 whitespace-nowrap ">{{ $secretariat->name }}</td>
                            <td class="whitespace-nowrap"></td> 
                            <td class="whitespace-nowrap"></td> 
                            <td class="whitespace-nowrap flex items-center space-x-2">
                                <button data-modal-target="edit-modal" data-modal-toggle="edit-modal" 
                                    class="text-blue-700 hover:text-blue-800 focus:outline-none"
                                    type="button" onclick="editarUsuario({{ $secretariat->id }})">
                                    <box-icon name='edit-alt' type='solid' color='#e8e405'></box-icon>
                                </button>
                                <form method="POST" action="{{ route('user.destroy', ['id' => $secretariat->id ]) }}" class="form-eliminar" id="form-eliminar-{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" style="background: none; border: none;" onclick="confirmDelete({{ $secretariat->id }})">
                                        <box-icon name='trash-alt' type='solid' color='#e80505'></box-icon>
                                    </button>
                                </form>
                                <button type="button" class="text-pink-500 hover:text-pink-600 focus:outline-none">
                                    <box-icon name='reset' color='#e805cb'></box-icon>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        
    </script>
    @include('management.user.create')
    {{--    @include('management.user.edit_reset') --}}
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    
     <script src="{{ asset('js/dataTable.js') }}"></script>
@endpush
