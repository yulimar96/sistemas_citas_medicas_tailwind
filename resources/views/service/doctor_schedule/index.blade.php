@extends('layouts.app')
@push('css')

@endpush
@section('title', 'schedule')
@section('content')
    <style>
        .alert {
            opacity: 1;
            transition: opacity 0.5s ease;
        }
    </style>
    <div class="container mx-auto">
        <div class="p-4 ">
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Cronograma</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="p-4 border-0 border-gray-200 border-dashed rounded-lg dark:border-gray-700 ">
                @if (session('success'))
                    <div class="alert fixed top-16 right-4 bg-green-500 text-white p-4 rounded shadow-lg" role="alert"
                        id="success-alert">
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert fixed top-16 right-4 bg-red-500 text-white p-4 rounded shadow-lg" role="alert"
                        id="error-alert">
                        <div class="ms-3 text-sm font-medium">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert fixed top-16 right-4 bg-yellow-500 text-white p-4 rounded shadow-lg" role="alert"
                        id="warning-alert">
                        <div class="ms-3 text-sm font-medium">
                            {{ session('warning') }}
                        </div>
                    </div>
                @endif
            </div>


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
            {{-- <div class="flex space-x-4 p-6">
                <h2 class="mb-2 text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
                    Cronograma
                </h2>
            </div> --}}
            <div
                class="max-w-7xl p-6 bg-blue-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div class="flex items-center justify-center h-24 rounded bg-blue-200 dark:bg-blue-700">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Horarios Activos de los Doctores</h1>
                    </div>
                    <div class="flex items-center justify-center h-24 rounded">
                        <i class="fas fa-calendar-alt text-4xl text-gray-800 dark:text-white"></i>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button data-modal-target="doctor_schedule" data-modal-toggle="doctor_schedule"
                            class="flex items-center justify-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none 
                focus:ring-4 focus:ring-blue-300 text-white font-semibold rounded-lg text-sm px-6 py-3 transition duration-300 ease-in-out shadow-lg 
                transform hover:scale-105 active:scale-95"
                            type="button">
                            <i class="fas fa-plus mr-2"></i>
                            Crear Horario
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="data-table min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="py-3 px-4 text-left">{{ __('Id') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Doctor') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Especialidad') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Consultorio') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Turno') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Día') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Hora de inicio') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Hora de salida') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $schedule)
                                <tr
                                    class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200 {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $schedule->id }}</td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $schedule->employee->person->name_1 . ' ' . $schedule->employee->person->surname_1 }}
                                    </td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $schedule->employee->speciality ? $schedule->employee->speciality->name : 'Sin especialidad' }}
                                    </td>
                                    <td class="font-medium text-blue-900 whitespace-nowrap">
                                        {{ $schedule->organizationalUnit ? $schedule->organizationalUnit->name : 'Sin organización' }}
                                    </td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $schedule->shift }}</td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $schedule->day }}</td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $schedule->start_time }}</td>
                                    <td
                                        class="font-medium text-blue-900 whitespace-nowrap py-2 px-4 border-b border-gray-300">
                                        {{ $schedule->closing_time }}</td>

                                    <td
                                        class="whitespace-nowrap flex items-center space-x-2 py-2 px-4 border-b border-gray-300">
                                        <button data-modal-target="doctor_schedule_id"
                                            data-modal-toggle="doctor_schedule_id"
                                            class="text-blue-700 hover:text-blue-800 focus:outline-none" type="button"
                                            onclick="editarHorario({{ $schedule->id }})">
                                            <box-icon name='edit-alt' type='solid' color='#e8e405'></box-icon>
                                        </button>
                                        <form method="POST"
                                            action="{{ route('doctor_schedule.destroy', ['id' => $schedule->id]) }}"
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
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- **************************************** --}}
            <div
                class="mt-5 max-w-7xl p-6 bg-blue-100 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center justify-center h-24 rounded bg-blue-200 dark:bg-blue-700">
                        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Calendario</h1>
                    </div>
                    <div class="flex justify-center mt-4">
                        <select name="consultory_id" id="consultory_dropdown" required class="form-select">
                            <option value="" disabled selected>-- Seleccione una unidad --</option>
                            @foreach ($organizational_unit as $unit)
                                <option value="{{ $unit->id }}">
                                    {{ $unit->name }} - {{ $unit->location }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <script>
                    document.getElementById('consultory_dropdown').onchange = function() {
                        let selectedValue = this.value;
                        let url = "{{ route('upload', ':id') }}";
                        url = url.replace(':id', selectedValue);

                        console.log('Valor seleccionado:', selectedValue);
                        console.log('URL generada:', url);

                        if (selectedValue) {
                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(data) {
                                    console.log('Datos recibidos:', data);
                                    $('#consultorio_info').html(data);
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                                    alert('Error al obtener los datos del consultorio');
                                }
                            });
                        } else {
                            $('#consultorio_info').html('');
                        }
                    };
                </script>
            <div id="consultorio_info">
                {{-- <div class="overflow-x-auto"> --}}
                <div class="">
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="py-3 px-4 text-left">{{ __('Hora') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Lunes') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Martes') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Miércoles') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Jueves') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Viernes') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Sábado') }}</th>
                                <th class="py-3 px-4 text-left">{{ __('Domingo') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $times = [
                                    '08:00:00 - 09:00:00',
                                    '09:00:00 - 10:00:00',
                                    '10:00:00 - 11:00:00',
                                    '11:00:00 - 12:00:00',
                                    '12:00:00 - 13:00:00',
                                    '13:00:00 - 14:00:00',
                                    '14:00:00 - 15:00:00',
                                    '15:00:00 - 16:00:00',
                                    '16:00:00 - 17:00:00',
                                    '17:00:00 - 18:00:00',
                                    '18:00:00 - 19:00:00',
                                ];
                                $day_week = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
                            @endphp
                            @foreach ($times as $time)
                                @php
                                    [$start_time, $closing_time] = explode(' - ', $time);
                                @endphp
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                                    <td class="py-2 px-4 border-b border-gray-300">{{ $time }}</td>
                                    @foreach ($day_week as $day)
                                        @php
                                            $doctor_info = '';
                                            foreach ($schedules as $schedule) {
                                                if (
                                                    strtolower($schedule->day) == strtolower($day) &&
                                                    $start_time < $schedule->closing_time &&
                                                    $closing_time > $schedule->start_time
                                                ) {
                                                    // Acceder a los datos del doctor y especialidad
                                                    $doctor_info =
                                                        optional($schedule->employee)->person->name_1 .
                                                            ' ' .
                                                            optional($schedule->employee)->person->surname_1 .
                                                            ' - ' .
                                                            optional($schedule->employee->speciality)->name ??
                                                        'Sin especialidad';
                                                    break; // Si solo quieres mostrar un doctor por celda
                                                }
                                            }
                                        @endphp
                                        <td
                                            class="py-2 px-4 border-b border-gray-300 text-center {{ $doctor_info ? 'bg-green-100' : 'bg-red-100' }} relative group">
                                            {{ $doctor_info ?: ' ' }}
                                            <div
                                                class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-gray-800 text-white text-sm rounded-lg p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                {{ $doctor_info ? 'Doctor disponible' : 'Sin doctor' }}
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- **************************************** --}}
            <!-- Modal para editar un horario médico -->
            <div id="doctor_schedule_id" tabindex="-1" aria-hidden="true" data-dialog-backdrop="doctor_schedule"
                data-dialog-backdrop-close="false"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Editar Horario
                            </h3>
                            <button type="button"
                                class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="doctor_schedule_id">
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
                            <form class="space-y-4" action="" method="POST" id="editScheduleForm">
                                @method('PATCH')
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="day"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Día') }}</label>
                                        <select name="day" id=""
                                            class="day bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
                                            <option selected disabled>seleccione..</option>
                                            <option value="lunes">Lunes</option>
                                            <option value="martes">Martes</option>
                                            <option value="miercoles">Miercoles</option>
                                            <option value="jueves">Jueves</option>
                                            <option value="viernes">Viernes</option>
                                            <option value="sabado">Sábado</option>
                                            <option value="domingo">Domingo</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="shift"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Turno') }}</label>
                                        <select name="shift" id=""
                                            class="shift bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
                                            <option selected disabled>seleccione..</option>
                                            <option value="morning">Mañana</option>
                                            <option value="evening">Diurno</option>
                                            <option value="afternoon">Tarde</option>
                                            <option value="night">Noche</option>
                                        </select>
                                    </div>

                                    <div class="flex-1">
                                        <label for="start-time"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Hora de Inicio') }}:
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="time" id="start-time" name="start_time"
                                                value="{{ old('start_time') }}"
                                                class="start_time bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition duration-200 ease-in-out transform hover:scale-105"
                                                required />
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <label for="closing_time"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            {{ __('Hora de final') }}:
                                        </label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd"
                                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="time" id="closing_time" name="closing_time"
                                                value="{{ old('closing_time') }}"
                                                class="closing_time bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition duration-200 ease-in-out transform hover:scale-105"
                                                required />
                                        </div>
                                    </div>

                                    <div>
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('doctor') }}</label>
                                        <select name="doctor_id" id=""
                                            class="doctor_id bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
                                            <option selected disabled>seleccione..</option>
                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">
                                                    {{ $doctor->person->id . ' ' . $doctor->person->name_1 . ' ' . $doctor->person->surname_1 . ' | ' . ($doctor->specialitys ? $doctor->specialitys->name : 'Sin especialidad') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Consultorio') }}</label>
                                        <select name="organization_unit_id" id=""
                                            class="organization_unit_id bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
                                            <option selected disabled>seleccione..</option>
                                            @foreach ($organizational_unit as $u)
                                                <option value="{{ $u->id }}">
                                                    {{ $u->id . ' ' . $u->name . ' ' . $u->location }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit"
                                        class="w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Guardar Cambios') }}</button>
                                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- **************************************** --}}
        </div>
    </div>
    @include('service.doctor_schedule.create')
    {{-- @include('service.doctor_schedule.edit') --}}
@endsection
@push('js')
    
    <script src="{{ asset('js/dataTable.js') }}"></script>
    <script>
        // function formatTimeForInput(time) {
        //     const [hours, minutes, seconds] = time.split(':');
        //     return `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}:${seconds ? seconds.padStart(2, '0') : '00'}`;
        // }
        function formatTimeForInput(timeString) {
            const date = new Date(timeString);
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');
            return `${hours}:${minutes}:${seconds}`;
        }

        function editarHorario(scheduleId) {
            fetch(`/schedules/${scheduleId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    $('.day').val(data.day);
                    $('.shift').val(data.shift);
                    $('.start_time').val(formatTimeForInput(data.start_time));
                    $('.closing_time').val(formatTimeForInput(data.closing_time));
                    $('.doctor_id').val(data.doctor_id);
                    $('.organization_unit_id').val(data.organization_unit_id);
                    $('.status').val(data.status);

                    // Update the form action
                    $('#editScheduleForm').attr('action', `/schedules/actualizar/${data.id}`);
                })
                .catch(error => {
                    console.error('Error fetching schedule data:', error);
                });
        }
    </script>
@endpush
