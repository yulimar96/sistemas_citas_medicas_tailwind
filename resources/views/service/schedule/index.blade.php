@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
@endpush
@section('title', 'doctor_schedule')
@section('content')
    <style>
        .alert {
            opacity: 1;
            transition: opacity 0.5s ease;
        }
    </style>
    <div class="container mx-auto">
        <div class=" sm:ml-64">
            <div class="p-4 border-0 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
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
            <div class="flex space-x-4 p-6">
                <h2 class="mb-2 text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                    Cronograma
                </h2>
            </div>
            <div
                class="max-w-7xl p-6 bg-blue-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="flex items-center justify-center h-24 rounded dark:bg-gray-800">
                        <h1 class="text-2xl font-bold">Horarios Activos</h1>
                    </div>
                    <div class="flex items-center justify-center h-24 rounded ">
                    </div>
                    <div class="flex justify-center mt-4">
                        <button data-modal-target="schedule-modal" data-modal-toggle="schedule-modal"
                        class="flex items-center justify-center bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 focus:ring-4 focus:outline-none 
                        focus:ring-blue-300 text-white font-medium rounded-full text-sm px-4 py-2 transition duration-200 ease-in-out shadow-lg 
                        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                            <span class="ml-2">Crear </span>
                        </button>
                    </div>
                </div>
                <table class="w-full data-table">
                    <thead>
                        <tr>
                            <th>{{ __('Id') }}</th>
                            <th>{{ __('Tipo de horario') }}</th>
                            <th>{{ __('Día') }}</th>
                            <th>{{ __('Hora de inicio') }}</th>
                            <th>{{ __('Hora de salida') }}</th>
                            <th>{{ __('Acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            @foreach ($schedule->scheduleDetails as $detail)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer">
                                    <td class="font-medium text-blue-900 whitespace-nowrap">{{ $schedule->id }}</td>
                                    <td class="font-medium text-blue-900 whitespace-nowrap">{{ $schedule->name }}</td>
                                    <td class="font-medium text-blue-900 whitespace-nowrap">{{ $detail->day }}</td>
                                    <td class="font-medium text-blue-900 whitespace-nowrap">{{ $detail->start_time }}</td>
                                    <td class="font-medium text-blue-900 whitespace-nowrap">{{ $detail->closing_time }}
                                    </td>
                                    <td class="whitespace-nowrap flex items-center space-x-2">
                                        <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                            class="text-blue-700 hover:text-blue-800 focus:outline-none" type="button"
                                            onclick="editarUsuario({{ $schedule->id }})">
                                            <box-icon name='edit-alt' type='solid' color='#e8e405'></box-icon>
                                        </button>
                                        <form method="POST" action="{{ route('user.destroy', ['id' => $schedule->id]) }}"
                                            class="form-eliminar" id="form-eliminar-{{ $schedule->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" style="background: none; border: none;"
                                                onclick="confirmDelete({{ $schedule->id }})">
                                                <box-icon name='trash-alt' type='solid' color='#e80505'></box-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('service.schedule.create')
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/dataTable.js') }}"></script>
@endpush
