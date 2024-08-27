document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('a'); // Selecciona todos los enlaces de navegación
  
    // Revisa si hay un enlace previamente seleccionado en el localStorage y lo marca como activo
    const activeLink = localStorage.getItem('activeLink');
    if (activeLink) {
      navLinks.forEach(link => {
        if (link.getAttribute('href') === activeLink) {
          link.classList.add('active');
        }
      });
    }
  
    // Agrega un event listener para cada enlace de navegación
    navLinks.forEach(link => {
      link.addEventListener('click', function (event) {
        // Guarda el href del enlace en localStorage
        localStorage.setItem('activeLink', this.getAttribute('href'));
        
        // Remueve la clase 'active' de todos los enlaces
        navLinks.forEach(link => link.classList.remove('active'));
  
        // Agrega la clase 'active' al enlace seleccionado
        this.classList.add('active');
      });
    });
  });
  