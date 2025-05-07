  
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar el calendario
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                height: 'auto',
                events: @json($events),
                eventContent: renderEventContent,
                eventClick: handleEventClick,
                dateClick: handleDateClick,
                eventDidMount: function(info) {
                    // Aplicar el color personalizado del paciente en TODAS las vistas
                    if (info.event.extendedProps.color) {
                        // Establecer el color como variable CSS
                        info.el.style.setProperty('--fc-event-bg-color', info.event.extendedProps
                            .color);
                        info.el.style.setProperty('--fc-event-border-color', info.event.extendedProps
                            .color);

                        // Aplicar directamente también por si las variables no funcionan
                        info.el.style.backgroundColor = info.event.extendedProps.color;
                        info.el.style.borderColor = info.event.extendedProps.color;

                        // Asegurar que el texto sea legible (color blanco o negro según el fondo)
                        const textEl = info.el.querySelector('.fc-event-main');
                        if (textEl) {
                            const bgColor = info.event.extendedProps.color;
                            const r = parseInt(bgColor.substr(1, 2), 16);
                            const g = parseInt(bgColor.substr(3, 2), 16);
                            const b = parseInt(bgColor.substr(5, 2), 16);
                            const brightness = (r * 299 + g * 587 + b * 114) / 1000;
                            textEl.style.color = brightness > 128 ? '#000' : '#fff';
                        }
                    }
                }
            });

            calendar.render();

            // Función para renderizar el contenido del evento
            function renderEventContent(info) {
                const {
                    event
                } = info;
                const startTime = event.start ? formatTime(event.start) : '';
                const endTime = event.end ? formatTime(event.end) : '';
                const speciality = event.extendedProps?.speciality || 'Sin especialidad';
                const doctor = event.extendedProps?.doctor || 'Sin doctor asignado';

                return {
                    html: `
                        <div class="fc-event-content">
                            <div class="fc-event-title">${event.title}</div>
                            <div class="fc-event-time">${startTime} - ${endTime}</div>
                            <div class="fc-event-speciality">${doctor} (${speciality})</div>
                        </div>
                    `
                };
            }

            // Manejar clic en evento
            function handleEventClick(info) {
                const {
                    event
                } = info;
                const startTime = event.start ? formatDateTime(event.start) : '';
                const endTime = event.end ? formatDateTime(event.end) : '';
                const speciality = event.extendedProps?.speciality || 'Sin especialidad';
                const doctor = event.extendedProps?.doctor || 'Sin doctor asignado';
                const notes = event.extendedProps?.notes || 'Sin notas adicionales';

                Swal.fire({
                    title: 'Detalles de la cita',
                    html: `
                        <div class="text-left">
                            <p><strong>Paciente:</strong> ${event.title}</p>
                            <p><strong>Doctor:</strong> ${doctor}</p>
                            <p><strong>Especialidad:</strong> ${speciality}</p>
                            <p><strong>Inicio:</strong> ${startTime}</p>
                            <p><strong>Fin:</strong> ${endTime}</p>
                            <p><strong>Notas:</strong> ${notes}</p>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Cerrar'
                });
            }

            // Manejar clic en fecha
            function handleDateClick(info) {
                const dateInput = document.getElementById('appointment_date');
                if (dateInput) {
                    dateInput.value = info.dateStr;
                }
            }

            // Formatear hora
            function formatTime(date) {
                return date.toLocaleTimeString('es-ES', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            // Formatear fecha y hora
            function formatDateTime(date) {
                return date.toLocaleString('es-ES', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }
        });
