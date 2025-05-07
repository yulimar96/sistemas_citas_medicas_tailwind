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
        @foreach ($times as $time)
            @php
                [$start_time, $closing_time] = explode(' - ', $time);
            @endphp
            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-200">
                <td class="py-2 px-4 border-b border-gray-300">{{ $time }}</td>
                @foreach ($day_week as $day)
                    @php
                        $name_doctor = '';
                        foreach ($schedules as $schedule) {
                            if (
                                strtolower($schedule->day) == strtolower($day) &&
                                $start_time < $schedule->closing_time &&
                                $closing_time > $schedule->start_time
                            ) {
                                $name_doctor = $schedule->doctor->person->name_1;
                                break;
                            }
                        }
                    @endphp
                    <td class="py-2 px-4 border-b border-gray-300 text-center {{ $name_doctor ? 'bg-green-100' : 'bg-red-100' }} relative group">
                        {{ $name_doctor ?: ' ' }}
                        <div class="absolute left-1/2 transform -translate-x-1/2 mt-2 w-32 bg-gray-800 text-white text-sm rounded-lg p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            {{ $name_doctor ? 'Doctor disponible' : 'Sin disponibilidad' }}
                        </div>
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>