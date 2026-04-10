<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aprender Álgebra | Abeja GO 🐝</title>

    <link rel="icon" type="image/png" href="img/favicon-logo.png">
    <meta name="theme-color" content="#FFD700">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>

<body class="app-body">

    <div class="bg-pattern"></div>

    <div id="mouse-effect-container">
        <div id="cursor-illuminator"></div>
    </div>

    <div id="flying-bees-container"></div>

    <div class="app-layout">

        <aside class="app-sidebar d-none d-md-flex">
            <div class="sidebar-top-content">
                <a href="#" class="sidebar-brand">
                    <i class="fa-solid fa-bug"></i> <span>Abeja Go</span>
                </a>
                <nav class="sidebar-nav">
                    <a href="#" class="nav-item active" data-page="app">
                        <i class="fa-solid fa-house"></i> <span>Aprender</span>
                    </a>
                    <a href="#" class="nav-item" data-page="misiones">
                        <i class="fa-solid fa-crosshairs"></i> <span>Misiones</span>
                    </a>
                    <a href="#" class="nav-item" data-page="tienda">
                        <i class="fa-solid fa-store"></i> <span>Tienda</span>
                    </a>
                    <a href="#" class="nav-item" data-page="perfil">
                        <i class="fa-solid fa-user"></i> <span>Perfil</span>
                    </a>
                    <a href="#" class="nav-item" data-page="mas">
                        <i class="fa-solid fa-ellipsis"></i> <span>Más</span>
                    </a>
                </nav>
            </div>

            <div class="sidebar-help-card">
                <h6>¿Necesitas ayuda?</h6>
                <p>Contacta nuestros asesores para agendar una clase virtual personalizada.</p>
                <div class="help-img-container">
                    <img src="img/personas.png" alt="Ilustración Asesoría Abeja">
                </div>
                <button class="btn btn-contact w-100">
                    <i class="fa-solid fa-headset me-2"></i> Contactar Asesor
                </button>
            </div>
        </aside>

        <main class="app-main" id="main-content">
            <?php
                // Carga inicial por defecto usando PHP
                $pagina_inicial = 'pages/app.php';
                if (file_exists($pagina_inicial)) {
                    include $pagina_inicial;
                } else {
                    echo "<div class='text-center mt-5'><h3>👋 ¡Bienvenido a Abeja Go!</h3><p>Crea el archivo <strong>pages/app.php</strong> para ver el contenido inicial.</p></div>";
                }
            ?>
        </main>

        <aside class="right-sidebar d-none d-xl-flex">
            <div class="desktop-stats-bar">
                <div class="stat-item fs-4">
                    <div class="dropdown">
                        <button class="course-dropdown-btn" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" title="Cambiar Curso">
                            <i class="fa-solid fa-square-root-variable main-icon"></i>
                            <i class="fa-solid fa-chevron-down caret-icon"></i>
                        </button>
                        <ul class="dropdown-menu border-0 shadow rounded-4 mt-2 p-2"
                            style="min-width: 220px; z-index: 210;">
                            <li>
                                <h6 class="dropdown-header fw-bold text-uppercase"
                                    style="font-size: 0.8rem; letter-spacing: 1px;">Tus Cursos</h6>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold rounded-3 active d-flex align-items-center mb-1"
                                    href="#" style="background-color: #e5f6f9; color: var(--primary-blue);">
                                    <i class="fa-solid fa-square-root-variable me-3 fs-5"></i> Álgebra
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold rounded-3 text-muted d-flex align-items-center mb-2"
                                    href="#">
                                    <i class="fa-solid fa-atom me-3 fs-5"></i> Física
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item fw-bold text-primary rounded-3 d-flex align-items-center"
                                    href="#">
                                    <i class="fa-solid fa-circle-plus me-3 fs-5"></i> Añadir curso
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="stat-item text-orange fs-5 fw-bold" title="Racha: 14 días">
                    <i class="fa-solid fa-fire me-1"></i> 14
                </div>
                <div class="stat-item text-honey fs-5 fw-bold" title="Miel: 776 drops">
                    <i class="fa-solid fa-droplet me-1"></i> 776
                </div>
                <div class="stat-item text-danger fs-5 fw-bold" title="Vidas: Infinitas">
                    <i class="fa-solid fa-heart me-1"></i> ∞
                </div>
            </div>

            <div class="widget-card honey-theme">
                <div class="d-flex justify-content-between align-items-center mb-4"
                    style="border-bottom: 2px solid #F0F0F0; padding-bottom: 15px;">
                    <h5 class="m-0" style="font-weight: 900; font-size: 1.25rem; color: var(--abeja-dark);">Misiones
                        <span style="color: var(--secondary-orange);">del día</span>
                    </h5>
                    <a href="#" class="btn-ver-todas">Ver todas</a>
                </div>

                <div class="task-item">
                    <div class="task-icon text-warning"><i class="fa-solid fa-bolt"></i></div>
                    <div class="task-info">
                        <p class="m-0 fw-bold">Gana 50 EXP</p>
                        <div class="progress progress-miel">
                            <div class="progress-bar" role="progressbar" style="width: 40%"></div>
                        </div>
                        <small class="text-muted fw-bold">20 / 50</small>
                    </div>
                </div>

                <div class="task-item">
                    <div class="task-icon text-success"><i class="fa-solid fa-bullseye"></i></div>
                    <div class="task-info">
                        <p class="m-0 fw-bold">Despeja 3 variables perfectas</p>
                        <div class="progress progress-miel">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <small class="text-muted fw-bold">0 / 3</small>
                    </div>
                </div>

                <div class="task-item">
                    <div class="task-icon text-info"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div class="task-info">
                        <p class="m-0 fw-bold">Repasa 1 lección antigua</p>
                        <div class="progress progress-miel">
                            <div class="progress-bar" role="progressbar" style="width: 100%"></div>
                        </div>
                        <small class="text-muted fw-bold">1 / 1 (Completado)</small>
                    </div>
                </div>
            </div>

            <div class="widget-card push-to-bottom" style="border: 2px solid var(--abeja-gray-medium); border-bottom: 4px solid var(--abeja-gray-medium);">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar-circle">A</div>
                    <div>
                        <h6 class="fw-bold m-0 fs-5">Axel</h6>
                        <small class="text-muted fw-bold">Modo Ingeniería 🛠️</small>
                    </div>
                </div>
            </div>
        </aside>

    </div>

    <nav class="mobile-bottom-nav">
        <a href="#" class="nav-item active" data-page="app">
            <i class="fa-solid fa-house"></i>
            <span>Inicio</span>
        </a>
        <a href="#" class="nav-item" data-page="misiones">
            <i class="fa-solid fa-crosshairs"></i>
            <span>Misiones</span>
        </a>
        <a href="#" class="nav-item" data-page="tienda">
            <i class="fa-solid fa-store"></i>
            <span>Tienda</span>
        </a>
        <a href="#" class="nav-item" data-page="asesorias">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>Asesorías</span>
        </a>
        <a href="#" class="nav-item" data-page="perfil">
            <i class="fa-regular fa-face-smile"></i>
            <span>Perfil</span>
        </a>
    </nav>

    <audio id="node-click-sound" src="https://assets.mixkit.co/active_storage/sfx/2568/2568-preview.mp3"
        preload="auto"></audio>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // =========================================
            // SISTEMA DE NAVEGACIÓN DINÁMICA (FETCH)
            // =========================================
            const navItems = document.querySelectorAll('.nav-item');
            const mainContent = document.getElementById('main-content');

            navItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    const page = this.getAttribute('data-page');
                    
                    if (page) {
                        e.preventDefault(); 
                        navItems.forEach(nav => nav.classList.remove('active'));
                        
                        document.querySelectorAll(`.nav-item[data-page="${page}"]`).forEach(nav => {
                            nav.classList.add('active');
                        });

                        mainContent.style.opacity = 0.5;

                        fetch(`pages/${page}.php`)
                            .then(response => {
                                if (!response.ok) throw new Error('Página no encontrada');
                                return response.text();
                            })
                            .then(html => {
                                mainContent.innerHTML = html;
                                mainContent.style.opacity = 1;
                                
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                                
                                // ¡SOLUCIÓN AL MODAL! - Forzamos al navegador a ejecutar los <script> traídos por Fetch
                                const scripts = mainContent.querySelectorAll('script');
                                scripts.forEach(oldScript => {
                                    const newScript = document.createElement('script');
                                    Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                                    if (oldScript.innerHTML) {
                                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                                    }
                                    oldScript.parentNode.replaceChild(newScript, oldScript);
                                });

                                vincularNodos();
                            })
                            .catch(error => {
                                mainContent.innerHTML = `
                                    <div class="text-center mt-5">
                                        <i class="fa-solid fa-person-digging fs-1 text-warning mb-3"></i>
                                        <h3>🚧 En construcción</h3>
                                        <p class="text-muted">La sección <strong>${page}.php</strong> aún no está lista en la carpeta pages/.</p>
                                    </div>`;
                                mainContent.style.opacity = 1;
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                            });
                    }
                });
            });

            // Función para vincular sonidos
            const clickSound = document.getElementById('node-click-sound');
            function vincularNodos() {
                const pathNodes = document.querySelectorAll('.path-node');
                pathNodes.forEach(node => {
                    const nuevoNodo = node.cloneNode(true);
                    node.parentNode.replaceChild(nuevoNodo, node);
                    
                    nuevoNodo.addEventListener('click', () => {
                        if (!nuevoNodo.classList.contains('node-locked')) {
                            clickSound.currentTime = 0;
                            clickSound.play().catch(error => {
                                console.log("El navegador previno la reproducción del audio:", error);
                            });
                        }
                    });
                });
            }
            vincularNodos();

            // =========================================
            // EFECTOS DE MOUSE Y ABEJAS
            // =========================================
            const mouseEffectContainer = document.getElementById('mouse-effect-container');
            const cursorIlluminator = document.getElementById('cursor-illuminator');
            const mainZone = document.querySelector('.app-main');
            const floatingHexagons = document.querySelectorAll('.floating-hex');

            let particleInterval;

            document.addEventListener('mousemove', (e) => {
                const { clientX, clientY } = e;
                cursorIlluminator.style.left = `${clientX}px`;
                cursorIlluminator.style.top = `${clientY}px`;

                const mainRect = mainZone.getBoundingClientRect();
                const isInMain = (clientX >= mainRect.left && clientX <= mainRect.right);
                cursorIlluminator.style.display = isInMain ? 'block' : 'none';

                const centerX = window.innerWidth / 2;
                const centerY = window.innerHeight / 2;
                const moveX = (clientX - centerX) / centerX;
                const moveY = (clientY - centerY) / centerY;

                floatingHexagons.forEach((hex, index) => {
                    const depth = (index + 1) * 15;
                    hex.style.transform = `translate(${moveX * depth}px, ${moveY * depth}px)`;
                });

                if (!particleInterval) {
                    particleInterval = setTimeout(() => {
                        createHoneyParticle(clientX, clientY);
                        particleInterval = null;
                    }, 50);
                }
            });

            function createHoneyParticle(x, y) {
                const particle = document.createElement('div');
                particle.classList.add('honey-particle');
                const offset = 8;
                particle.style.left = `${x + (Math.random() - 0.5) * offset}px`;
                particle.style.top = `${y + (Math.random() - 0.5) * offset}px`;
                mouseEffectContainer.appendChild(particle);
                setTimeout(() => particle.remove(), 1000);
            }

            const activeBees = [];

            function spawnTinyBee() {
                const container = document.getElementById('flying-bees-container');
                if (!container) return;

                const wrapper = document.createElement('div');
                wrapper.className = 'tiny-bee-wrapper';

                const rotator = document.createElement('div');
                rotator.className = 'tiny-bee-rotator';

                const inner = document.createElement('div');
                inner.className = 'tiny-bee-inner';
                inner.innerText = '🐝'; 

                let startX, startY;
                if (Math.random() < 0.8) {
                    const edge = Math.floor(Math.random() * 4);
                    if (edge === 0) { startX = Math.random() * 100; startY = -10; } 
                    else if (edge === 1) { startX = 110; startY = Math.random() * 100; } 
                    else if (edge === 2) { startX = Math.random() * 100; startY = 110; } 
                    else { startX = -10; startY = Math.random() * 100; } 
                } else {
                    startX = 20 + Math.random() * 60;
                    startY = 20 + Math.random() * 60;
                }

                wrapper.style.left = `${startX}%`;
                wrapper.style.top = `${startY}%`;

                const paths = ['fly-path-1', 'fly-path-2', 'fly-path-3', 'fly-path-4'];
                const path = paths[Math.floor(Math.random() * paths.length)];
                const duration = 6 + Math.random() * 6; 

                wrapper.style.animation = `${path} ${duration}s linear forwards`;
                inner.style.setProperty('--flight-duration', `${duration}s`);

                rotator.appendChild(inner);
                wrapper.appendChild(rotator);
                container.appendChild(wrapper);

                const beeTracker = { wrapper, rotator, lastX: null, lastY: null };
                activeBees.push(beeTracker);

                setTimeout(() => {
                    wrapper.remove();
                    const index = activeBees.indexOf(beeTracker);
                    if (index > -1) activeBees.splice(index, 1);
                }, duration * 1000);
            }

            function updateBeeRotations() {
                activeBees.forEach(bee => {
                    const rect = bee.wrapper.getBoundingClientRect();
                    const currentX = rect.left;
                    const currentY = rect.top;

                    if (bee.lastX !== null && bee.lastY !== null) {
                        const dx = currentX - bee.lastX;
                        const dy = currentY - bee.lastY;

                        if (Math.abs(dx) > 0.2 || Math.abs(dy) > 0.2) {
                            const angle = Math.atan2(dy, dx) * (180 / Math.PI);
                            let rotation = angle - 180;
                            let flip = '';

                            if (angle > -90 && angle < 90) { flip = 'scaleY(-1)'; }
                            bee.rotator.style.transform = `rotate(${rotation}deg) ${flip}`;
                        }
                    }
                    bee.lastX = currentX;
                    bee.lastY = currentY;
                });
                requestAnimationFrame(updateBeeRotations);
            }

            requestAnimationFrame(updateBeeRotations);
            setInterval(spawnTinyBee, 1500);
            setTimeout(spawnTinyBee, 100);
        });
    </script>
</body>

</html>