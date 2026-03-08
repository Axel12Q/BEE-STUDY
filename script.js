document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const body = document.body;

    // ✅ Seguridad: si falta algo, no explota
    if (!menuToggle || !sidebar || !overlay) return;

    menuToggle.addEventListener('click', () => {
        const isMobile = window.innerWidth < 768;

        if (isMobile) {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('active');
            document.body.classList.toggle('mobile-menu-active');

            // ✅ CLAVE: en móvil, cuando está abierto, NO debe estar collapsed
            if (sidebar.classList.contains('mobile-open')) {
                sidebar.classList.remove('collapsed');
            } else {
                sidebar.classList.add('collapsed'); 
            }
        }
        else {
            sidebar.classList.toggle('collapsed');
            body.classList.toggle('sidebar-expanded', !sidebar.classList.contains('collapsed'));
        }
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
        document.body.classList.remove('mobile-menu-active');
        sidebar.classList.add('collapsed'); 
    });

    // Scroll suave para los botones que agreguemos en el futuro
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            // Solo aplicamos si el href no es solo "#" (para evitar conflictos con el menú)
            if(this.getAttribute('href') !== '#') {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    // --- ANIMACIÓN FOOTER REBOTE ---
    const footer = document.querySelector('footer');
    
    // Configuramos el observador
    const footerObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            // Si el footer entra en pantalla un 10%...
            if (entry.isIntersecting) {
                footer.classList.add('visible');
                // Opcional: Dejar de observar para que no se anime cada vez que bajas/subes
                // footerObserver.unobserve(footer); 
            }
        });
    }, {
        threshold: 0.1 // Se activa apenas se asoma un poquito
    });

    if(footer) {
        footerObserver.observe(footer);
    }
});