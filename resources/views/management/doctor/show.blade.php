<!-- Modal para show un usuario -->
<div id="secretariat_show" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 id="secretariat_showModalTitle"  class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{$secretariat->name}}
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 
                hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" 
                data-modal-hide="secretariat_show">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cerrar modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                           {{$secretariat->name}}
                        </div>
                        <div>
                            {{$secretariat->last_name}} 
                        </div>
                        <div>
                            {{$secretariat->address}} 
                        </div>
                        <div>
                           {{$secretariat->email}}
                        </div>
                        <div>
                            {{$secretariat->birthdate}}
                        </div>
                        <div>
                            {{$secretariat->nacionality}}
                        </div>
                        <div>
                            {{$secretariat->identification_number}}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                          {{$secretariat->password}}
                        </div>
                        <div>
                            {{$secretariat->password_confirmation}}
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                         {{$secretariat->code_area}}
                        <div>
                            <p>{{$secretariat->phone}}</p>
                               
                               
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


