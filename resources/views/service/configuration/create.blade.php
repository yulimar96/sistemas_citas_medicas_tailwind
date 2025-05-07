   <div id="schedule-modal" tabindex="-1" aria-hidden="true" data-dialog-backdrop="schedule-modal"
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
                       data-modal-hide="schedule-modal">
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
                   <form class="space-y-4" action="{{ route('schedule.store') }}" method="POST">
                       @csrf
                       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                           <div>
                               <label for="day"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Día') }}</label>
                               <select name="day" id=""
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
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
                               <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Turno') }}</label>
                               <select name="name" id=""
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
                                   <option selected disabled>seleccione..</option>
                                   <option value="lunes">Mañana</option>
                                   <option value="martes">Diurno</option>
                                   <option value="miercoles">Tarde</option>
                                   <option value="jueves">Noche</option>
                               </select>
                           </div>
                           <div>
                               <label for="start-time"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> {{ __('Hora de Inicio') }}:</label>
                               <div class="relative">
                                   <div
                                       class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                       <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                           xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                           <path fill-rule="evenodd"
                                               d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                               clip-rule="evenodd" />
                                       </svg>
                                   </div>
                                   <input type="time" id="start-time" name="start_time" value="{{ old('hora de inicio') }}"
                                       class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       min="09:00" max="18:00" value="00:00" required />
                               </div>
                           </div>
                                      <div>
                               <label for="closing_time"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Hora de final') }}</label>
                               <div class="relative">
                                   <div
                                       class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                       <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                           xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                           <path fill-rule="evenodd"
                                               d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                               clip-rule="evenodd" />
                                       </svg>
                                   </div>
                                   <input type="time" id="closing_time" name="closing_time" value="{{ old('hora de inicio') }}"
                                       class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       min="09:00" max="18:00" value="00:00" required />
                               </div>
                           </div>
                       
                           {{-- <div>
                               <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Consultorio') }}</label>
                               <select name="organizational_unit_id" id=""
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
                                   <option selected disabled>seleccione..</option>
                                   @foreach ($ui as $u)
                                       <option value="{{ $u->id }}">{{ $u->name . ' ' . $u->location }}</option>
                                   @endforeach
                               </select>
                           </div> --}}

                           <button type="submit"
                               class="w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Submit') }}</button>
                           <div class="text-sm font-medium text-gray-500 dark:text-gray-300"></div>
                   </form>
               </div>
           </div>
       </div>
   </div>
