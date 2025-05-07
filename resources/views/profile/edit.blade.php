@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Información del Perfil -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Actualización de Contraseña -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Eliminar Cuenta -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection