@extends('layouts.app')
@push('css')
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">

@endpush
@section('title', 'laravel')
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
             @if(session('success'))
             <div class="alert fixed top-16 right-4 bg-green-500 text-white p-4 rounded shadow-lg" role="alert">
                 <div class="ms-3 text-sm font-medium">
                     {{ session('success') }}
                 </div>
             </div>
         @endif
         
         @if(session('error'))
             <div class="alert fixed top-16 right-4 bg-red-500 text-white p-4 rounded shadow-lg" role="alert">
                 <div class="ms-3 text-sm font-medium">
                     {{ session('error') }}
                 </div>
             </div>
         @endif
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded  dark:bg-gray-800">{{--bg-gray-50--}}
                    <h1 class="text-3xl font-bold dark:text-white">Listado de usuarios</h1>
                </div>
                <div class="flex items-center justify-center h-24 rounded ">
                    {{--  <box-icon type='solid' name='user-plus'></box-icon>--}}
                </div>
                    <div class="flex justify-center mt-4">
                        <button data-modal-target="user-modal" data-modal-toggle="user-modal"
                            class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 focus:ring-4 focus:outline-none 
                            focus:ring-blue-300 text-white font-medium rounded-full text-sm px-4 py-2 transition duration-200 ease-in-out shadow-lg 
                            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <box-icon name='user-plus' class='w-5 h-5 transition-transform duration-200 ease-in-out  dark:text-white group-hover:scale-125'></box-icon>
                            <span class="ml-2">Nuevo Usuario</span> <!-- Texto adicional para el botón -->
                        </button>
                    </div>
                </div>
            </div>

               <div class="max-w-5xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <table id="export-table" class="w-full">
                    <thead>
                        <tr>
                            <th>
                                <span class="flex items-center">
                                    {{__('Id')}}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    {{__('Name')}}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                            <th data-type="date" data-format="YYYY/DD/MM">
                                <span class="flex items-center">
                                    Release Date
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" width="24"
                                     height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                    NPM Downloads
                                    <svg class="w-4 h-4 ms-1"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                            <th>
                                <span class="flex items-center">
                                   {{ __('Actions')}}
                                    <svg class="w-4 h-4 ms-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                                    </svg>
                                </span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user) <!-- Asegúrate de que $users esté definido en tu controlador -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                            <td class="font-medium whitespace-nowrap ">{{ $user->id }}</td>
                            <td class="font-medium whitespace-nowrap ">{{ $user->name }}</td>
                            <td class="whitespace-nowrap ">{{ $user->email }}</td> <!-- Asegúrate de que este campo exista -->
                            <td class="whitespace-nowrap">{{ $user->npm_downloads }}</td> <!-- Asegúrate de que este campo exista -->
                            <td class="whitespace-nowrap flex items-center space-x-2"> <!-- Usar flex para alinear los botones -->
                                <!-- Botón de editar -->
                                <button data-modal-target="edit-modal" data-modal-toggle="edit-modal" 
                                    class="text-blue-700 hover:text-blue-800 focus:outline-none"
                                    type="button" onclick="editarUsuario({{ $user->id }})">
                                    <box-icon name='edit-alt' type='solid' color='#e8e405'></box-icon>
                                </button>
                            
                                <!-- Botón de eliminar -->
                                <form method="POST" action="{{ route('user.destroy', ['id' => $user->id ]) }}" class="form-eliminar" id="form-eliminar-{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" style="background: none; border: none;" onclick="confirmDelete({{ $user->id }})">
                                        <box-icon name='trash-alt' type='solid' color='#e80505'></box-icon>
                                    </button>
                                </form>
                            
                                <!-- Botón de reiniciar -->
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
         @include('management.user.create')
         @include('management.user.edit_reset')
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Selecciona todas las alertas
        const alerts = document.querySelectorAll('.alert');

        alerts.forEach(alert => {
            // Función para desvanecer la alerta
            const fadeOutAlert = () => {
                alert.classList.add('opacity-0'); // Añade clase para desvanecer
                setTimeout(() => {
                    alert.remove(); // Elimina el elemento después de desvanecer
                }, 500); // Tiempo de duración del desvanecimiento
            };

            // Espera 2 segundos antes de comenzar a desvanecer
            setTimeout(fadeOutAlert, 2000); // Tiempo antes de que comience a desvanecerse

            // Opción para cerrar la alerta al hacer clic
            alert.addEventListener('click', fadeOutAlert);
        });
    });
    </script>
<script>
    function editarUsuario(userId) {
        fetch(`/user/${userId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Ruta: ' + userId + data['name']);
            $('#editConceptoModalTitle').text('Editando usuario ' + data['name']);
            $('input[name="name"]').val(data.name);
            $('input[name="email"]').val(data.email);
            // Asegúrate de que el ID se esté pasando al formulario
            $('form.form_edit').attr('action', `/user/actualizar/${data.id}`);
        })
        .catch(error => {
            console.error('Error fetching user data:', error);
        });
    }
    </script>
 <script>
    function confirmDelete(userId) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Una vez eliminado, no podrás recuperar este usuario.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar el formulario
                document.getElementById('form-eliminar-' + userId).submit();
            }
        });
    }
    </script>
   
@endpush
