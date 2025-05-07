import './bootstrap';
import 'flowbite';
import './dataTable';
import './dark.js';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// resources/js/dashboard.js
document.addEventListener('DOMContentLoaded', function() {
    // Efecto hover mejorado para tarjetas
    const cards = document.querySelectorAll('.dashboard-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('click', function() {
            if(this.dataset.permission && !hasPermission(this.dataset.permission)) {
                showPermissionAlert();
                return;
            }
            // Navegación normal
        });
    });
    
    // Carga progresiva de imágenes
    const lazyLoad = () => {
        const lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
        
        if ("IntersectionObserver" in window) {
            let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove("lazy");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });
            
            lazyImages.forEach(function(lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        }
    };
    
    // Verificar permisos
    function hasPermission(permission) {
        // Implementar lógica de permisos
        return true;
    }
    
    function showPermissionAlert() {
        Swal.fire({
            icon: 'warning',
            title: 'Acceso restringido',
            text: 'No tienes permiso para acceder a esta sección',
            confirmButtonColor: '#3B82F6',
        });
    }
    
    // Inicializar
    lazyLoad();
});
