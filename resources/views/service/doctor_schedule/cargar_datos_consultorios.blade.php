@if($schedules->isEmpty())
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-lg shadow-sm">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">
                    No hay horarios programados
                </h3>
                <div class="mt-2 text-sm text-yellow-700">
                    <p>
                        No se encontraron turnos médicos activos para esta unidad. 
                        Por favor, verifica con el administrador del sistema.
                    </p>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="overflow-x-auto shadow-lg rounded-lg">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">{{ __('Hora') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">{{ __('Lunes') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">{{ __('Martes') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">{{ __('Miércoles') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">{{ __('Jueves') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">{{ __('Viernes') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">{{ __('Sábado') }}</th>
                    <th class="py-3 px-4 text-left text-sm font-semibold uppercase tracking-wider">{{ __('Domingo') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
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
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="py-3 px-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $time }}</td>
                        
                        @foreach ($day_week as $day)
                            @php
                                $doctor_info = '';
                                $doctor_schedule = null;
                                
                                foreach ($schedules as $schedule) {
                                    if (strtolower($schedule->day) == strtolower($day) &&
                                        $start_time < $schedule->closing_time &&
                                        $closing_time > $schedule->start_time) {
                                        $doctor_info = 
                                            optional($schedule->employee)->person->name_1 . ' ' .
                                            optional($schedule->employee)->person->surname_1 . ' - ' .
                                            (optional($schedule->employee->speciality)->name ?? 'Sin especialidad');
                                        $doctor_schedule = $schedule;
                                        break;
                                    }
                                }
                                
                                $cell_class = $doctor_info ? 'bg-green-50' : 'bg-red-50';
                                $tooltip_text = $doctor_info ? 'Doctor disponible' : 'Sin doctor asignado';
                            @endphp
                            
                            <td class="py-3 px-4 text-center text-sm {{ $cell_class }} relative group">
                                <span class="{{ $doctor_info ? 'text-green-800 font-medium' : 'text-red-800' }}">
                                    {{ $doctor_info ?: 'N/D' }}
                                </span>
                                
                                @if($doctor_schedule)
                                <div class="absolute z-10 left-1/2 transform -translate-x-1/2 mt-2 w-48 bg-gray-900 text-white text-xs rounded-lg p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-200 shadow-xl">
                                    <div class="font-bold mb-1">{{ $tooltip_text }}</div>
                                    <div class="grid grid-cols-2 gap-1">
                                        <span class="text-gray-300">Inicio:</span>
                                        <span>{{ $doctor_schedule->start_time }}</span>
                                        <span class="text-gray-300">Fin:</span>
                                        <span>{{ $doctor_schedule->closing_time }}</span>
                                        <span class="text-gray-300">Turno:</span>
                                        <span>{{ ucfirst($doctor_schedule->shift) }}</span>
                                        @if($doctor_schedule->organizationalUnit)
                                        <span class="text-gray-300">Ubicación:</span>
                                        <span>{{ $doctor_schedule->organizationalUnit->location }}</span>
                                        @endif
                                    </div>
                                </div>
                                @else
                                <div class="absolute z-10 left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-gray-900 text-white text-xs rounded-lg p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 shadow-xl">
                                    {{ $tooltip_text }}
                                </div>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif