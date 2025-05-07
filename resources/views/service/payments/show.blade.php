<!-- Modal para mostrar detalles -->
<div id="show-payment-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Detalles del Pago #<span id="payment-id"></span>
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="show-payment-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4 modal-body">
                <!-- Contenido se carga dinámicamente aquí -->
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="show-payment-modal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function loadPaymentData(paymentId) {
    const modal = document.getElementById('show-payment-modal');
    const modalBody = modal.querySelector('.modal-body');
    
    // Mostrar loader
    modalBody.innerHTML = `
        <div class="flex justify-center items-center h-32">
            <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
        </div>
    `;

    // Mostrar el modal
    modal.classList.remove('hidden');

    fetch(`/payment/mostrar/${paymentId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || 'Error al obtener datos');
            }
            renderPaymentData(data.data);
        })
        .catch(error => {
            console.error('Error:', error);
            modalBody.innerHTML = `
                <div class="bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">${error.message}</p>
                        </div>
                    </div>
                </div>
            `;
        });
}

function renderPaymentData(data) {
    const modalBody = document.getElementById('show-payment-modal').querySelector('.modal-body');
    
    // Formatear fecha
    const payDate = new Date(data.pay_date).toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    // Formatear monto
    const amount = new Intl.NumberFormat('es-ES', {
        style: 'currency',
        currency: 'USD'
    }).format(data.monto);
    
    // Estado con colores
    let statusClass, statusText;
    switch(data.status) {
        case 'completed':
            statusClass = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
            statusText = 'Completado';
            break;
        case 'pending':
            statusClass = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
            statusText = 'Pendiente';
            break;
        case 'failed':
            statusClass = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
            statusText = 'Fallido';
            break;
        case 'refunded':
            statusClass = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
            statusText = 'Reembolsado';
            break;
    }

    modalBody.innerHTML = `
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Paciente</h4>
                <p class="text-gray-600 dark:text-gray-300">${data.patient?.person?.name_1 || 'N/A'} ${data.patient?.person?.surname_1 || ''}</p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Doctor</h4>
                <p class="text-gray-600 dark:text-gray-300">${data.doctor?.person?.name_1 || 'N/A'} ${data.doctor?.person?.surname_1 || ''}</p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Especialidad</h4>
                <p class="text-gray-600 dark:text-gray-300">${data.doctor?.speciality?.name || 'No especificada'}</p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Monto</h4>
                <p class="text-gray-600 dark:text-gray-300">${amount}</p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Fecha</h4>
                <p class="text-gray-600 dark:text-gray-300">${payDate}</p>
            </div>
            <div>
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Estado</h4>
                <span class="${statusClass} text-xs font-medium px-2.5 py-0.5 rounded-full">${statusText}</span>
            </div>
            <div class="col-span-2">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Descripción</h4>
                <p class="text-gray-600 dark:text-gray-300">${data.description || 'No hay descripción'}</p>
            </div>
        </div>
    `;
}
</script>
