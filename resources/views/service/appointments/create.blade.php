   <div id="registar_cita" tabindex="-1" aria-hidden="true" data-dialog-backdrop="registar_cita"
       data-dialog-backdrop-close="false"
       class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
       <div class="relative p-4 w-full max-w-md max-h-full">
           <!-- Modal content -->
           <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               <!-- Modal header -->
               <div
                   class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                   <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                       Nuevo Horario
                   </h3>
                   <button type="button"
                       class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                       data-modal-hide="registar_cita">
                       <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                           viewBox="0 0 14 14">
                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                       </svg>
                       <span class="sr-only">Close modal</span>
                   </button>
               </div>
               <!-- Modal body -->
               <div class="p-4 md:p-5">
                   <form class="space-y-4" action="{{ route('appointments.event') }}" method="POST">
                       @csrf
                       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                           <div class="mb-4">
                               <label for="doctor_id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                   <i class="fas fa-user-md mr-1"></i> {{ __('Seleccione médico') }}
                               </label>
                               <select name="doctor_id" required
                                   class="doctor-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                   <option value="" disabled selected>-- Seleccione un médico --</option>
                                   @foreach ($doctors as $doctor)
                                       <option value="{{ is_array($doctor) ? $doctor['id'] : $doctor->id }}"
                                           data-speciality="{{ is_array($doctor) ? $doctor['speciality'] ?? '' : $doctor->speciality->name ?? '' }}">

                                           {{ is_array($doctor) ? $doctor['name'] : $doctor->person->full_name }}

                                           @if (is_array($doctor))
                                               | {{ $doctor['speciality'] ?? 'Sin especialidad' }}
                                           @else
                                               | {{ $doctor->speciality->name ?? 'Sin especialidad' }}
                                           @endif
                                       </option>
                                   @endforeach
                               </select>
                               <div id="doctor-speciality-display"
                                   class="mt-2 text-sm text-blue-600 dark:text-blue-400 hidden">
                                   <span class="font-medium">Especialidad:</span>
                                   <span id="selected-speciality"></span>
                               </div>
                           </div>
                           <div class="flex-1">
                               <label for="time"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                   {{ __('Hora de Reserva') }}:
                               </label>
                               <div class="relative">
                                   <input type="time" name="time" id="hora_reserva"
                                       value="{{ old('hora_reserva') }}"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-3 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 transition duration-200 ease-in-out transform hover:scale-105"
                                       required />

                                   <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                       <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                           xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                           <path fill-rule="evenodd"
                                               d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                               clip-rule="evenodd" />
                                       </svg>
                                   </div>
                               </div>
                           </div>

                           <script>
                               document.addEventListener('DOMContentLoaded', function() {
                                   const horaReserva = document.getElementById('hora_reserva');

                                   horaReserva.addEventListener('change', function() {
                                       let selectTime = this.value; // Obtener el valor de la hora

                                       if (selectTime) {
                                           // Forzar minutos a '00' manteniendo la hora seleccionada
                                           selectTime = selectTime.split(':')[0] + ':00';
                                           this.value = selectTime; // Establecer la hora modificada en el campo de entrada

                                           // Verificar si la hora seleccionada está fuera de rango
                                           if (selectTime < '08:00' || selectTime > '20:00') {
                                               this.value = '';
                                               alert('Por favor seleccione una hora entre las 08:00 y las 20:00');
                                           }
                                       }
                                   });
                               });
                           </script>
                           <div>
                               <label for="start_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Fecha de Reserva de citas') }}
                               </label>
                               <input type="date" name="start_date" id="start_date" value="<?php echo date('Y-m-d'); ?>"
                                   min="<?php echo date('Y-m-d'); ?>"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   required />
                           </div>

                           {{-- <script>
                               document.addEventListener('DOMContentLoaded', function() {
                                   const fechaReserva = document.getElementById('start_date');

                                   // Configurar el atributo min con la fecha actual (alternativa al script)
                                   fechaReserva.min = new Date().toISOString().split('T')[0];

                                   fechaReserva.addEventListener('change', function() {
                                       const selectedDate = this.value;
                                       const today = new Date().toISOString().split('T')[0];

                                       if (selectedDate < today) {
                                           this.value = today; // Establecer la fecha actual en lugar de null
                                           alert('No se puede seleccionar una fecha pasada');
                                       }
                                   });
                               });
                           </script> --}}
                           <div>
                               <label for="color"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Color') }}</label>
                               <input type="color" name="color"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   required />
                           </div>
                           <div>
                               <label for="note"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Nota') }}</label>
                               <textarea name="note"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   rows="4" style="height: 100px;" required></textarea>
                           </div>
                           <button type="submit"
                               class="w-20 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Submit') }}</button>
                           <div class="text-sm font-medium text-gray-500 dark:text-gray-300"></div>
                   </form>
               </div>
           </div>
       </div>
   </div>
