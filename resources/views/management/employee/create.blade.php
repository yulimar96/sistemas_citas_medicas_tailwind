<div id="employee-modal" tabindex="-1" aria-hidden="true" data-dialog-backdrop="employee-modal"
    data-dialog-backdrop-close="false"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Crear un nuevo employee
                </h3>
                <button type="button"
                    class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="employee-modal">
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
                <div class="tabs">
                    <button class="tablinks" onclick="openTab(event, 'PersonalData')"> Personales</button>
                    <button class="tablinks" onclick="openTab(event, 'WorkData')">Laborales</button>
                    <button class="tablinks" onclick="openTab(event, 'EducationData')">Educación</button>
                    <button class="tablinks" onclick="openTab(event, 'Address')">Dirección</button>
                    <button class="tablinks" onclick="openTab(event, 'ContactData')">Contactos</button>
                </div>

                <form class="space-y-4" action="{{ route('secretariat.store') }}" method="POST">
                    @csrf

                    <div id="PersonalData" class="tabcontent">
                        <h3>Datos Personales</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Nombre de Usuario') }}</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Nombre de usuario" required />
                            </div>

                            <div>
                                <label for="name_1"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Nombre') }}</label>
                                <input type="text" name="name_1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Nombre" required />
                            </div>
                            <div>
                                <label for="name_2"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Segundo Nombre') }}</label>
                                <input type="text" name="name_2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Nombre" required />
                            </div>
                            <div>
                                <label for="surname_1"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Apellido Paterno') }}</label>
                                <input type="text" name="surname_1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Apellido Paterno" required />
                            </div>
                            <div>
                                <label for="surname_2"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Apellido Materno') }}</label>
                                <input type="text" name="surname_2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Apellido Paterno" required />
                            </div>
                            <div>
                                <label for="birthdate"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Fecha de Nacimiento') }}</label>
                                <input type="date" name="birthdate" id="birthdate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required />
                            </div>
                            <div>
                                <label for="sex"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="blood_type"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                        {{ __('Tipo de Sangre') }}</label>
                                    <select name="blood_type" id="blood_type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option selected disabled>Selecciona...</option>
                                        <option value="A+">A+</option>
                                        <option value="A-">A-</option>
                                        <option value="O-">O-</option>
                                        <option value="0+">0+</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="nacionality"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                        {{ __('Nacionalidad') }}</label>
                                    <select name="nacionality" id="nacionality"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option selected disabled>Selecciona...</option>
                                        <option value="V">V</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="identification_number"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                            {{ __('Número de Cedula') }}</label>
                                        <input type="text" name="identification_number" required
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>
                                </div>
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
                        </div>
                    </div>
                    <div id="WorkData" class="tabcontent" style="display:none;">
                        <h3>Datos Laborales</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="employee_contract_types"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('tipos_de_contrato_empleado') }}</label>
                                <select name="employee_contract_types_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option selected disabled>seleccione..</option>
                                    @foreach ($employee_contract as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="organizational_unit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Tipos_unidad_organizacional') }}</label>
                                <select name="organizational_unit_types_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
                                    <option selected disabled>seleccione..</option>
                                    @foreach ($organizational_unit as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="position"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Posicion') }}</label>
                                <select name="employee_position_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">>
                                    <option selected disabled>seleccione..</option>
                                    @foreach ($position as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label for="hire_date"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Fecha de Contratación') }}</label>
                                <input type="date" name="hire_date" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                            </div>
                             <div>
                                <label for="schedule"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Horario de trabajo') }}</label>
                                <select name="schedule_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option selected disabled>seleccione..</option>
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->id }}">{{ $schedule->day.' '.$schedule->start_time.' '.$schedule->closing_time }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                    </div>

                    <div id="EducationData" class="tabcontent" style="display:none;">
                        <h3>Educación</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                        </div>
                    </div>
                    <div id="Address" class="tabcontent" style="display:none;">
                        <h3>Dirección</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="federalstate"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Estado') }}</label>
                                <select name="federals_state_id" id="federalstate"
                                    onchange="updateMunicipalities()"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
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
                                <select name="municipalities_id" id="municipality"
                                    onchange="updateParishes()"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option selected disabled>seleccione..</option>
                                </select>
                            </div>

                            <div>
                                <label for="parish"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Parroquia') }}</label>
                                <select name="parish_id" id="parish"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    <option selected disabled>seleccione..</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="ContactData" class="tabcontent" style="display:none;">

                        <h3>Contactos</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                    {{ __('Email') }}</label>
                                <input type="email" name="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="name@company.com" required />
                            </div>
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
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="code_area"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                        {{ __('Código Móvil') }}</label>
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
                                    <label for="cellphone_number"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                        {{ __('Número Móvil') }}</label>
                                    <input type="text" name="cellphone_number" placeholder="07-98-645"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="code_area"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">*
                                        {{ __('Código de Área') }}</label>
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
                                        {{ __('Teléfono de Casa') }}</label>
                                    <input type="text" name="phone" placeholder="07-98-645"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                        required />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('Enviar') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

<style>
    .hidden-field {
    transition: all 0.3s ease;
    overflow: hidden;
}
    .tabs {
        display: flex;
        border-bottom: 2px solid #e5e7eb;
        margin-bottom: 1rem;
    }

    .tablinks {
        background-color: transparent;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-weight: bold;
        color: #4a5568;
    }

    .tablinks:hover {
        background-color: #e2e8f0;
    }

    .tablinks.active {
        border-bottom: 2px solid #3182ce;
        color: #3182ce;
    }

    .tabcontent {
        display: none;
    }
</style>
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

    $(document).ready(function() {
        // Función para mostrar/ocultar campos según el tipo de empleado
        function toggleFields() {
            const employeeType = $('#employee_type').val();

            // Si es doctor
            if (employeeType === 'doctor') {
                $('.medical_license_field').show(); // Mostrar licencia médica
                $('.speciality_field').show(); // Mostrar especialidad
                $('.schedule_field').hide(); // Ocultar horario (lo manejas en doctorSchedule)
            } else {
                // Para otros tipos de empleado
                $('.medical_license_field').hide(); // Ocultar licencia médica
                $('.speciality_field').hide(); // Ocultar especialidad
                $('.schedule_field').show(); // Mostrar horario
            }
        }

        // Ejecutar al cargar la página
        toggleFields();

        // Ejecutar cuando cambie el tipo de empleado
        $('#employee_type').change(toggleFields);
    });
</script>
