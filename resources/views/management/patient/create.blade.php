   <div id="patient-modal" tabindex="-1" aria-hidden="true" data-dialog-backdrop="patient-modal"
       data-dialog-backdrop-close="false"
       class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
       <div class="relative p-4 w-full max-w-md max-h-full">
           <!-- Modal content -->
           <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
               <!-- Modal header -->
               <div
                   class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                   <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                       Crear un nuevo registro de paciente
                   </h3>
                   <button type="button"
                       class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                       data-modal-hide="patient-modal">
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
                   <form class="space-y-4" action="{{ route('patient.store') }}" method="POST">
                       @csrf
                       <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                           <div>
                               <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Nombre de usuario') }}</label>
                               <input type="text" name="name" id="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   placeholder="name@company.com" required />
                           </div>
                           <div>
                               <label for="name_1"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Nombre') }}</label>
                               <input type="text" name="name_1"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   placeholder="name@company.com" required />
                           </div>
                           <div>
                               <label for="name_2"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Segundo Nombre') }}</label>
                               <input type="text" name="name_2"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   placeholder="name@company.com" required />
                           </div>
                           <div>
                               <label for="surname_1"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Apellido Paterno') }}</label>
                               <input type="text" name="surname_1"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   placeholder="name@company.com" required />
                           </div>
                           <div>
                               <label for="surname_2"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Apellido Materno') }}</label>
                               <input type="text" name="surname_2"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   placeholder="name@company.com" required />
                           </div>
                           <div>
                               <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Sexo') }}</label>
                               <div class="flex items-center">
                                   <input type="radio" id="male" name="sex" value="1" class="mr-2"
                                       required />
                                   <label for="male" class="mr-4">Hombre</label>

                                   <input type="radio" id="female" name="sex" value="0" class="mr-2"
                                       required />
                                   <label for="female">Mujer</label>
                               </div>
                           </div>
                           <div>
                               <label for="birthdate"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Birthdate') }}</label>
                               <input type="date" name="birthdate" id="birthdate"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   required />
                           </div>
                           <div>
                               <label for="blood_type"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('blood_type') }}</label>
                               <select name="blood_type" id="">
                                   <option selected disabled>seleccione..</option>
                                   <option value="A+">A+</option>
                                   <option value="A-">A-</option>
                                   <option value="O-">O-</option>
                                   <option value="0+">0+</option>
                               </select>
                           </div>

                           <div>
                               <label for="federalstate"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Estado') }}</label>
                               <select name="federals_state_id" id="federalstate" onchange="updateMunicipalities()">
                                   <option selected disabled>seleccione..</option>
                                   @foreach ($states as $state)
                                       <option value="{{ $state->id }}">{{ $state->name }}</option>
                                   @endforeach
                               </select>
                           </div>

                           <div>
                               <label for="municipality"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Municipio') }}</label>
                               <select name="municipalities_id" id="municipality" onchange="updateParishes()">
                                   <option selected disabled>seleccione..</option>
                               </select>
                           </div>

                           <div>
                               <label for="parish"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Parroquia') }}</label>
                               <select name="parish_id" id="parish">
                                   <option selected disabled>seleccione..</option>
                               </select>
                           </div>
                           <div>
                               <label for="nacionality"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Nacionality') }}</label>
                               <select name="nacionality"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                   <option selected disabled>Selecciona...</option>
                                   <option value="V">V</option>
                                   <option value="E">E</option>
                               </select>
                           </div>
                           <div>
                               <label for="identification_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('identification_number') }}</label>
                               <input type="text" name="identification_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   required />
                           </div>
                           <div>
                               <label for="room_type"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Tipo de Vivienda') }}</label>
                               <select name="room_type" id="room_type"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                   <option selected disabled>Selecciona...</option>
                                   <option value="apartamento">Apartamento</option>
                                   <option value="casa">Casa</option>
                                   <option value="duplex">Dúplex</option>
                                   <option value="townhouse">Townhouse</option>
                                   <option value="estudio">Estudio</option>
                                   <option value="casa_rural">Casa Rural</option>
                                   <option value="condominio">Condominio</option>
                                   <option value="otra">Otra</option>
                               </select>
                           </div>
                           <div>
                               <label for="level_of_education"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Nivel de Educación') }}</label>
                               <select name="level_of_education" id="level_of_education"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                   <option selected disabled>Selecciona...</option>
                                   <option value="ninguno">Ninguno</option>
                                   <option value="primaria">Primaria</option>
                                   <option value="secundaria">Secundaria</option>
                                   <option value="bachillerato">Bachillerato</option>
                                   <option value="tecnico">Técnico</option>
                                   <option value="universitario">Universitario</option>
                                   <option value="postgrado">Postgrado</option>
                                   <option value="doctorado">Doctorado</option>
                                   <option value="otra">Otra</option>
                               </select>
                           </div>
                           <div>
                               <label for="email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('Email') }}</label>
                               <input type="email" name="email"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                   placeholder="name@company.com" required />
                           </div>
                           <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                               <div>
                                   <label for="password"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                       {{ __('Password') }}</label>
                                   <input type="password" name="password"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       required />
                               </div>
                               <div>
                                   <label for="password_confirmation"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                       {{ __('Confirm Password') }}</label>
                                   <input type="password" name="password_confirmation"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       required />
                               </div>
                           </div>

                           <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                               <div>
                                   <label for="code_area"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                       {{ __('Code movil') }}</label>
                                   <select name="cell_phone_area_codes"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                       <option selected disabled>Selecciona...</option>
                                       <option value="0412">0412</option>
                                       <option value="0414">0414</option>
                                       <option value="0424">0424</option>
                                       <option value="0416">0416</option>
                                   </select>
                               </div>
                               <div>
                                   <label for="phone"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                       {{ __('numero movil') }}</label>
                                   <input type="text" name="cellphone_number" placeholder="07-98-645"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       required />
                               </div>
                           </div>
                           <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                               <div>
                                   <label for="code_area"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                       {{ __('Code area') }}</label>
                                   <select name="code_area"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                       <option selected disabled>Selecciona...</option>
                                       <option value="0212">0212</option>
                                       <option value="0234">0234</option>
                                       <option value="0241">0241</option>
                                       <option value="0251">0251</option>
                                       <option value="0261">0261</option>
                                       <option value="0273">0273</option>
                                       <option value="0281">0281</option>
                                       <option value="0292">0292</option>
                                       <option value="0293">0293</option>
                                       <option value="0294">0294</option>
                                       <option value="0295">0295</option>
                                       <option value="0296">0296</option>
                                       <option value="0297">0297</option>
                                       <option value="0298">0298</option>
                                       <option value="0299">0299</option>
                                   </select>
                               </div>
                               <div>
                                   <label for="phone"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                       {{ __('Phone de casa') }}</label>
                                   <input type="text" name="phone" placeholder="07-98-645"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                       required />
                               </div>
                           </div>
                           <div>
                               <label for="has_allergies"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                   * {{ __('has_allergies') }}
                               </label>
                               <div class="flex items-center mb-4">
                                   <input type="radio" id="has_allergies_yes" name="has_allergies" value="1"
                                       class="mr-2" required>
                                   <label for="has_allergies_yes"
                                       class="text-sm text-gray-900 dark:text-white">Sí</label>
                               </div>
                               <div class="flex items-center mb-4">
                                   <input type="radio" id="has_allergies_no" name="has_allergies" value="0"
                                       class="mr-2" required>
                                   <label for="has_allergies_no"
                                       class="text-sm text-gray-900 dark:text-white">No</label>
                               </div>
                           </div>
                           <div>
                               <label for="allergy_type"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('allergy_type') }}</label>
                               <select name="allergy_type" id="">
                              <option selected disabled>seleccione..</option>
                                   @foreach ($allergies as $type)
                                       <option value="{{ $type->id }}">{{ $type->allergy_type }}</option>
                                   @endforeach
                               </select>
                           </div>
                             <div>
                               <label for="medical_history"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('medical_history') }}</label>
                               <input type="text" name="medical_history" required>
                           </div>
                             <div>
                               <label for="registration_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('registration_date') }}</label>
                               <input type="date" name="registration_date" required>
                           </div>
                           <div>
                               <label for="observation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                   {{ __('observation') }}</label>
                               <textarea name="observation" id="" cols="10" rows="5"></textarea>
                           </div>

                           <button type="submit"
                               class="w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Submit') }}</button>
                           <div class="text-sm font-medium text-gray-500 dark:text-gray-300"></div>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <script>
       const statesData = @json($states);

       function updateMunicipalities() {
           const stateSelect = document.getElementById('federalstate');
           const municipalitySelect = document.getElementById('municipality');
           const parishSelect = document.getElementById('parish');

           // Limpiar las selecciones anteriores
           municipalitySelect.innerHTML = '<option selected disabled>seleccione..</option>';
           parishSelect.innerHTML = '<option selected disabled>seleccione..</option>';

           const selectedStateId = stateSelect.value;
           const selectedState = statesData.find(state => state.id == selectedStateId);

           if (selectedState) {
               selectedState.municipalities.forEach(municipality => {
                   const option = document.createElement('option');
                   option.value = municipality.id;
                   option.textContent = municipality.name;
                   municipalitySelect.appendChild(option);
               });
           }
       }

       function updateParishes() {
           const municipalitySelect = document.getElementById('municipality');
           const parishSelect = document.getElementById('parish');

           // Limpiar la selección anterior
           parishSelect.innerHTML = '<option selected disabled>seleccione..</option>';

           const selectedMunicipalityId = municipalitySelect.value;
           const selectedStateId = document.getElementById('federalstate').value;
           const selectedState = statesData.find(state => state.id == selectedStateId);

           if (selectedMunicipalityId && selectedState) {
               const selectedMunicipality = selectedState.municipalities.find(municipality => municipality.id ==
                   selectedMunicipalityId);
               if (selectedMunicipality) {
                   // Agregar parroquias
                   selectedMunicipality.parishes.forEach(parish => {
                       const option = document.createElement('option');
                       option.value = parish.id;
                       option.textContent = parish.name;
                       parishSelect.appendChild(option);
                   });
               }
           }
       }
   </script>
