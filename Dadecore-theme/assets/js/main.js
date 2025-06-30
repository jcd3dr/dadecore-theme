/**
 * DadeCore Theme - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log('DadeCore Theme Scripts Loaded!');

    // Ejemplo básico: Toggle para menú responsive
    const menuToggle = document.querySelector('.menu-toggle');
    const primaryMenuContainer = document.querySelector('.primary-menu-container');

    if (menuToggle && primaryMenuContainer) {
        menuToggle.addEventListener('click', () => {
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            menuToggle.setAttribute('aria-expanded', !expanded);
            primaryMenuContainer.classList.toggle('active'); // Añade/quita una clase para mostrar/ocultar el menú
        });
    }
    // Puedes añadir más interacciones aquí en futuras fases.
    // Por ejemplo, desplazamiento suave a las secciones, efectos de scroll, etc.
});
