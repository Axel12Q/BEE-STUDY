

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