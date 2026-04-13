<style>
    /* =========================================
       ESTILOS EXCLUSIVOS DE CONFIGURACION.PHP
       ========================================= */

    :root {
        --primary-yellow: #FFE066; 
        --primary-yellow-dark: #E5B400; 
        --primary-yellow-text: #7F6600;
        
        --primary-blue: #5DADE2; 
        --primary-blue-dark: #3498DB; 
        --primary-blue-light: #EBF5FB;
        
        --secondary-orange: #FFB373; 
        --secondary-orange-dark: #FF9600;
        
        --pastel-green: #48C9B0;
        --pastel-green-light: #E9F7EF;
        --pastel-green-dark: #1ABC9C;

        --pastel-purple: #A569BD;
        --pastel-purple-light: #F5EEF8;

        --pastel-red: #F5B7B1;
        --pastel-red-light: #FDEDEC;
        --pastel-red-dark: #E74C3C;

        --abeja-gray-light: #F2F3F4; 
        --abeja-gray-medium: #E5E5E5; 
        --abeja-gray-dark: #D5D8DC; 
        --abeja-text-muted: #839192;
        --abeja-dark: #2C3E50;
    }

    .fade-in-section {
        animation: fadeInSlide 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        opacity: 0; transform: translateY(20px);
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    @keyframes fadeInSlide { to { opacity: 1; transform: translateY(0); } }

    /* Título Móvil Superior */
    .mobile-page-title-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 20px;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .mobile-page-title-icon {
        font-size: 1.5rem;
        color: var(--primary-blue-dark);
        display: flex; align-items: center; justify-content: center;
    }
    .mobile-page-title-divider {
        width: 2px; height: 30px; background-color: var(--abeja-gray-medium); border-radius: 2px;
    }
    .mobile-page-title-text {
        font-size: 1.6rem; font-weight: 900; color: var(--abeja-dark); margin: 0; letter-spacing: -0.5px;
    }

    /* --- MENÚ DE NAVEGACIÓN (Solo PC) --- */
    .config-nav-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 24px;
        padding: 25px 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        position: sticky;
        top: 20px;
    }
    
    .config-nav { display: flex; flex-direction: column; gap: 8px; }
    
    .config-nav-link {
        display: flex; align-items: center; gap: 15px;
        padding: 12px 18px; border-radius: 16px;
        color: var(--abeja-dark); font-weight: 800; font-size: 1.05rem;
        text-decoration: none; border: 2px solid transparent;
        transition: all 0.2s; cursor: pointer;
    }
    .config-nav-link i { font-size: 1.2rem; width: 25px; text-align: center; color: var(--abeja-text-muted); transition: color 0.2s; }
    
    .config-nav-link:hover { background-color: var(--abeja-gray-light); border-color: var(--abeja-gray-medium); }
    .config-nav-link.active { background-color: var(--primary-blue-light); border-color: var(--primary-blue); color: var(--primary-blue-dark); }
    .config-nav-link.active i { color: var(--primary-blue-dark); }

    /* --- TARJETAS DE CONTENIDO --- */
    .config-pane {
        display: none; /* Oculto por defecto en PC, manejado por JS */
        animation: fadeInSlide 0.3s ease forwards;
    }
    .config-pane.active { display: block; }

    .config-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 24px; padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    
    .config-card-header {
        display: flex; align-items: center; gap: 15px;
        margin-bottom: 25px; padding-bottom: 15px;
        border-bottom: 2px solid var(--abeja-gray-medium);
    }
    .config-card-header i { font-size: 1.8rem; color: var(--primary-blue); }
    .config-card-header h3 { font-size: 1.5rem; font-weight: 900; color: var(--abeja-dark); margin: 0; }

    /* --- ELEMENTOS DE AJUSTE (LISTA) --- */
    .setting-item {
        display: flex; justify-content: space-between; align-items: center;
        padding: 18px 0; border-bottom: 2px solid var(--abeja-gray-light); gap: 20px;
    }
    .setting-item:last-child { border-bottom: none; padding-bottom: 0; }
    
    .setting-info { flex-grow: 1; }
    .setting-info h5 { font-size: 1.05rem; font-weight: 900; color: var(--abeja-dark); margin: 0 0 4px 0; line-height: 1.2; display: flex; align-items: center; gap: 8px;}
    .setting-info p { font-size: 0.85rem; font-weight: 700; color: var(--abeja-text-muted); margin: 0; line-height: 1.3; }

    /* Interruptores (Switches Custom) */
    .custom-switch {
        appearance: none; -webkit-appearance: none;
        width: 54px; height: 28px; background-color: var(--abeja-gray-dark);
        border-radius: 14px; position: relative; cursor: pointer; outline: none;
        transition: background-color 0.3s, box-shadow 0.3s;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1); flex-shrink: 0;
    }
    .custom-switch::after {
        content: ''; position: absolute; top: 2px; left: 2px;
        width: 24px; height: 24px; background-color: white; border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .custom-switch:checked { background-color: var(--pastel-green-dark); box-shadow: inset 0 2px 4px rgba(0,0,0,0.1), 0 0 10px rgba(26, 188, 156, 0.3); }
    .custom-switch:checked::after { transform: translateX(26px); }

    /* Switch Especial (Modo Oscuro) */
    .switch-dark:checked { background-color: var(--abeja-dark); box-shadow: inset 0 2px 4px rgba(0,0,0,0.5); }

    /* --- FORMULARIOS (CUENTA) --- */
    .form-abeja .form-label { font-weight: 900; color: var(--abeja-dark); font-size: 0.95rem; margin-bottom: 8px; }
    .form-abeja .form-control {
        border: 2px solid var(--abeja-gray-medium); border-radius: 14px;
        padding: 12px 15px; font-weight: 700; color: var(--abeja-dark);
        background-color: var(--abeja-gray-light); transition: all 0.2s; box-shadow: none;
    }
    .form-abeja .form-control:focus { border-color: var(--primary-blue); background-color: var(--abeja-white); }
    
    .btn-save {
        background-color: var(--primary-blue-light); color: var(--primary-blue-dark);
        border: 2px solid var(--primary-blue); border-radius: 14px;
        padding: 10px 20px; font-weight: 900; font-size: 0.95rem; transition: all 0.2s; margin-top: 10px;
    }
    .btn-save:hover { background-color: var(--primary-blue); color: white; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(93, 173, 226, 0.3); }

    /* --- BOTONES DE SOPORTE --- */
    .btn-support {
        width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px;
        padding: 14px; border-radius: 16px; font-weight: 900; font-size: 1.05rem;
        transition: all 0.2s; border: none; margin-bottom: 15px;
    }
    .btn-report { background-color: var(--primary-blue); color: white; box-shadow: 0 6px 15px rgba(93, 173, 226, 0.3); }
    .btn-report:hover { background-color: var(--primary-blue-dark); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(93, 173, 226, 0.4); }
    
    .btn-logout { background-color: var(--pastel-red-light); color: var(--pastel-red-dark); border: 2px solid var(--pastel-red); }
    .btn-logout:hover { background-color: var(--pastel-red-dark); color: white; border-color: var(--pastel-red-dark); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(231, 76, 60, 0.2); }

    /* =========================================
       RESPONSIVE DESIGN (MÓVIL)
       ========================================= */
    @media (max-width: 991px) {
        /* En móvil forzamos a que todas las tarjetas se muestren apiladas (Bloques) */
        .config-pane {
            display: block !important;
            margin-bottom: 25px;
            animation: none; /* Quitamos animación lateral */
        }
        .config-card { padding: 20px; }
        .config-card-header { margin-bottom: 15px; padding-bottom: 10px; }
        .config-card-header h3 { font-size: 1.3rem; }
    }
</style>

<div class="mobile-page-title-card d-lg-none fade-in-section">
    <div class="mobile-page-title-icon">
        <i class="fa-solid fa-gear"></i>
    </div>
    <div class="mobile-page-title-divider"></div>
    <h2 class="mobile-page-title-text">Configuración</h2>
</div>

<div class="row g-4 align-items-start">
    
    <div class="col-12 col-lg-4 d-none d-lg-block fade-in-section">
        <div class="config-nav-card">
            <h3 class="section-title mb-3" style="font-size: 1.2rem; margin-left: 5px;">Ajustes</h3>
            <nav class="config-nav" id="configNavPC">
                <a href="#pane-audio" class="config-nav-link active sound-nav">
                    <i class="fa-solid fa-volume-high"></i> Audio y Visuales
                </a>
                <a href="#pane-notif" class="config-nav-link sound-nav">
                    <i class="fa-solid fa-bell"></i> Notificaciones
                </a>
                <a href="#pane-cuenta" class="config-nav-link sound-nav">
                    <i class="fa-solid fa-user-shield"></i> Cuenta y Privacidad
                </a>
                <a href="#pane-soporte" class="config-nav-link sound-nav">
                    <i class="fa-solid fa-circle-question"></i> Soporte y Salida
                </a>
            </nav>
        </div>
    </div>

    <div class="col-12 col-lg-8 fade-in-section delay-1">
        
        <div id="pane-audio" class="config-pane active">
            <div class="config-card">
                <div class="config-card-header">
                    <i class="fa-solid fa-volume-high"></i>
                    <h3>Audio y Visuales</h3>
                </div>
                
                <div class="setting-item sound-action">
                    <div class="setting-info">
                        <h5>Efectos de Sonido (SFX)</h5>
                        <p>Sonidos al hacer clic en botones y menús.</p>
                    </div>
                    <input type="checkbox" class="custom-switch" checked>
                </div>
                
                <div class="setting-item sound-action">
                    <div class="setting-info">
                        <h5>Música de Fondo</h5>
                        <p>Música Lo-Fi relajante mientras estudias.</p>
                    </div>
                    <input type="checkbox" class="custom-switch">
                </div>

                <div class="setting-item sound-action">
                    <div class="setting-info">
                        <h5>Animaciones de Fondo <i class="fa-solid fa-leaf text-success fs-6" title="Ahorro de batería"></i></h5>
                        <p>Hexágonos flotantes. Apágalo para ahorrar batería.</p>
                    </div>
                    <input type="checkbox" class="custom-switch" checked>
                </div>

                <div class="setting-item sound-action">
                    <div class="setting-info">
                        <h5>Abejas Voladoras</h5>
                        <p>Desactiva las abejitas interactivas que cruzan la pantalla.</p>
                    </div>
                    <input type="checkbox" class="custom-switch" checked>
                </div>

                <div class="setting-item sound-action" style="background-color: var(--abeja-gray-light); padding: 15px; border-radius: 16px; margin-top: 15px; border-bottom: none;">
                    <div class="setting-info">
                        <h5>Modo Oscuro (BETA) <i class="fa-solid fa-moon text-dark fs-6"></i></h5>
                        <p>Protege tu vista estudiando de noche.</p>
                    </div>
                    <input type="checkbox" class="custom-switch switch-dark">
                </div>
            </div>
        </div>

        <div id="pane-notif" class="config-pane">
            <div class="config-card">
                <div class="config-card-header" style="border-bottom-color: var(--primary-yellow-dark);">
                    <i class="fa-solid fa-bell" style="color: var(--primary-yellow-dark);"></i>
                    <h3>Notificaciones</h3>
                </div>

                <div class="setting-item sound-action">
                    <div class="setting-info">
                        <h5>Recordatorio de Racha <i class="fa-solid fa-fire text-orange fs-6"></i></h5>
                        <p>Avisarme a las 8:00 PM si no he completado mi lección.</p>
                    </div>
                    <input type="checkbox" class="custom-switch" checked>
                </div>

                <div class="setting-item sound-action">
                    <div class="setting-info">
                        <h5>Asesorías: Aceptadas</h5>
                        <p>Avisarme cuando un asesor acepte mi solicitud individual.</p>
                    </div>
                    <input type="checkbox" class="custom-switch" checked>
                </div>

                <div class="setting-item sound-action">
                    <div class="setting-info">
                        <h5>Asesorías: Recordatorio</h5>
                        <p>Notificarme 30 minutos antes de que empiece mi sesión.</p>
                    </div>
                    <input type="checkbox" class="custom-switch" checked>
                </div>

                <div class="setting-item sound-action">
                    <div class="setting-info">
                        <h5>Vidas Llenas <i class="fa-solid fa-heart text-danger fs-6"></i></h5>
                        <p>Avisarme cuando mis 5 corazones se hayan recargado.</p>
                    </div>
                    <input type="checkbox" class="custom-switch">
                </div>
            </div>
        </div>

        <div id="pane-cuenta" class="config-pane">
            <div class="config-card form-abeja">
                <div class="config-card-header" style="border-bottom-color: var(--pastel-green-dark);">
                    <i class="fa-solid fa-user-shield" style="color: var(--pastel-green-dark);"></i>
                    <h3>Cuenta y Privacidad</h3>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" value="Axel">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" value="axel.quintero@ugto.mx">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" value="********">
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn-save sound-action"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
                    </div>
                </div>

                <div class="setting-item sound-action" style="border-top: 2px solid var(--abeja-gray-medium); padding-top: 25px;">
                    <div class="setting-info">
                        <h5>Perfil Público</h5>
                        <p>Mostrar mi nombre y avatar en Misiones Grupales y Top Escolar.</p>
                    </div>
                    <input type="checkbox" class="custom-switch" checked>
                </div>
            </div>
        </div>

        <div id="pane-soporte" class="config-pane">
            <div class="config-card">
                <div class="config-card-header" style="border-bottom-color: var(--pastel-purple);">
                    <i class="fa-solid fa-circle-question" style="color: var(--pastel-purple);"></i>
                    <h3>Soporte</h3>
                </div>

                <p class="mb-4" style="font-weight: 700; color: var(--abeja-text-muted); font-size: 0.95rem;">
                    ¿Encontraste un error en una pregunta o en la aplicación? Déjanos saber para que el equipo de abejas obreras lo repare.
                </p>

                <button class="btn-support btn-report sound-action">
                    <i class="fa-solid fa-bug"></i> Reportar un problema
                </button>

                <div style="height: 2px; background-color: var(--abeja-gray-medium); margin: 25px 0;"></div>

                <button class="btn-support btn-logout sound-action">
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                </button>
                
                <div class="text-center mt-3">
                    <small style="color: var(--abeja-gray-dark); font-weight: 800;">Abeja GO v1.0.5</small>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    (function() {
        // --- 1. Lógica de Pestañas (Tabs) Exclusiva para PC ---
        // En móvil, CSS fuerza a que todas las pestañas (.config-pane) sean visibles siempre (display: block)
        const navLinks = document.querySelectorAll('#configNavPC .config-nav-link');
        const panes = document.querySelectorAll('.config-pane');

        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Solo ejecutar lógica de pestañas si estamos en PC (menú lateral visible)
                if (window.innerWidth >= 992) {
                    // Quitar active de todos
                    navLinks.forEach(l => l.classList.remove('active'));
                    panes.forEach(p => p.classList.remove('active'));

                    // Poner active al seleccionado
                    link.classList.add('active');
                    const targetPaneId = link.getAttribute('href');
                    const targetPane = document.querySelector(targetPaneId);
                    
                    if (targetPane) {
                        targetPane.classList.add('active');
                    }
                }
            });
        });

        // --- 2. Scroll al inicio al cargar mediante fetch ---
        const dynamicContent = document.getElementById('dynamic-content');
        if(dynamicContent) {
            dynamicContent.scrollTop = 0;
        }
    })();
</script>