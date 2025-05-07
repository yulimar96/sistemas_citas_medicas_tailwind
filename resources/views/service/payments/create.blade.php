   <div id="payments-modal" tabindex="-1" aria-hidden="true" data-dialog-backdrop="payments-modal"
       data-dialog-backdrop-close="false"
       class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
       <div class="relative p-4 w-full max-w-md max-h-full">
           <!-- Modal content -->
           <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               <!-- Modal header -->
               <div
                   class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                   <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                       Nuevo Pago
                   </h3>
                   <button type="button"
                       class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                       data-modal-hide="payments-modal">
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
                   <form class="space-y-4" action="{{ route('payment.store') }}" method="POST">
                       @csrf
                       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                           <div>
                               <label for="pacient_id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                   {{ __('Paciente') }}
                               </label>
                               <select name="pacient_id" id="pacient_id"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                   <option selected disabled>seleccione..</option>
                                   @foreach ($patients as $patient)
                                       <option value="{{ $patient->id }}">
                                           {{ $patient->person->name_1 }} {{ $patient->person->surname_1 }}
                                       </option>
                                   @endforeach
                               </select>
                           </div>
                           <div>
                               <label for="doctor_id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                   {{ __('Doctor') }}
                               </label>
                               <select name="doctor_id" id="doctor_id"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                   <option selected disabled>seleccione..</option>
                                   @foreach ($doctors as $doctor)
                                       <option value="{{ $doctor->id }}">
                                           {{ $doctor->person->name_1 }} {{ $doctor->person->surname_1 }}
                                       </option>
                                   @endforeach
                               </select>
                           </div>
                           <div class="flex-1">
                               <label for="pay_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                   {{ __('Fecha de Pago') }}:
                               </label>
                               <div>
                                   <label for="pay_date"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                       {{ __('Fecha de Pago') }}
                                   </label>
                                   <input type="date" name="pay_date" id="pay_date" value="<?php echo date('Y-m-d'); ?>"
                                       min="<?php echo date('Y-m-d'); ?>"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       required />
                               </div>
                           </div>
                           <div>
                                <label for="monto"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Monto') }}</label>
                                <input type="text" name="monto"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Nombre" required />
                            </div>
                           <div>
                               <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Descripción') }}</label>
                               <textarea name="description"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   rows="4" style="height: 100px;" required></textarea>
                           </div>
                       </div>
                       <button type="submit"
                           class="w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Submit') }}</button>
                       <div class="text-sm font-medium text-gray-500 dark:text-gray-300"></div>
                   </form>
               </div>
           </div>
       </div>
   </div>
