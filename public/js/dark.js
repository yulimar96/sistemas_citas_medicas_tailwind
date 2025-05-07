
// Verifica el tema actual y aplica la clase correspondiente
if (localStorage.getItem('color-theme') === 'dark' || 
    (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}

// Obtiene los elementos de los íconos de cambio de tema
var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Cambia los íconos dentro del botón según la configuración anterior
if (localStorage.getItem('color-theme') === 'dark' || 
    (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden'); // Muestra el ícono de luz
    themeToggleDarkIcon.classList.add('hidden'); // Oculta el ícono de oscuridad
} else {
    themeToggleDarkIcon.classList.remove('hidden'); // Muestra el ícono de oscuridad
    themeToggleLightIcon.classList.add('hidden'); // Oculta el ícono de luz
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {

// toggle icons inside button
themeToggleDarkIcon.classList.toggle('hidden');
themeToggleLightIcon.classList.toggle('hidden');

// if set via local storage previously
if (localStorage.getItem('color-theme')) {
    if (localStorage.getItem('color-theme') === 'light') {
        document.documentElement.classList.add('dark');
        localStorage.setItem('color-theme', 'dark');
    } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('color-theme', 'light');
    }

// if NOT set via local storage previously
} else {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('color-theme', 'light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('color-theme', 'dark');
    }
}

});
