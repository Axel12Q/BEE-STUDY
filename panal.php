<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Abeja GO 🐝 | Aprender Álgebra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style_panal.css">
</head>

<body>

    <audio id="sfx-nav" src="https://assets.mixkit.co/active_storage/sfx/2568/2568-preview.mp3" preload="auto"></audio>
    <audio id="sfx-action" src="https://assets.mixkit.co/active_storage/sfx/2571/2571-preview.mp3" preload="auto"></audio>
    <audio id="sfx-list" src="https://assets.mixkit.co/active_storage/sfx/2570/2570-preview.mp3" preload="auto"></audio>

    <div id="honeycomb-background"></div>

    <div id="mouse-effect-container">
        <div id="cursor-illuminator"></div>
    </div>
    <div id="flying-bees-container"></div>

    <div id="app-wrapper">

        <header class="mobile-top-bar d-lg-none">
            <div class="user-profile-info border-0 p-0 sound-nav" style="cursor:pointer;" data-page="perfil">
                <img src="perfil-imgs/9.jpg" alt="Axel" class="user-avatar" style="width: 50px; height: 50px;">
                <h6 class="m-0 fw-bold" style="color: var(--abeja-dark);">Axel</h6>
            </div>
            <div class="user-stats d-flex">
                <div class="text-orange sound-item" style="cursor:pointer;"><i class="fa-solid fa-fire"></i><span>14</span></div>
                <div class="text-warning sound-item" style="cursor:pointer;"><i class="fa-solid fa-droplet"></i><span>776</span></div>
                <div class="text-danger sound-item" style="cursor:pointer;"><i class="fa-solid fa-heart"></i><span>∞</span></div>

                <div class="top-config-divider"></div>
                <div class="top-config-btn sound-nav" data-page="configuracion" style="cursor:pointer;" title="Configuración">
                    <i class="fa-solid fa-gear"></i>
                </div>
            </div>
        </header>

        <aside class="sidebar d-none d-lg-flex">
            <a href="#" class="sidebar-brand sound-nav">
                <i class="fa-solid fa-bug"></i> Abeja GO
            </a>

            <nav class="sidebar-nav">
                <a href="#" class="nav-btn active sound-nav" data-page="jugar">
                    <div class="nav-btn-icon-box"><i class="fa-solid fa-house"></i></div>
                    Jugar
                </a>
                <a href="#" class="nav-btn sound-nav" data-page="misiones">
                    <div class="nav-btn-icon-box"><i class="fa-solid fa-crosshairs"></i></div>
                    Misiones
                </a>
                <a href="#" class="nav-btn sound-nav" data-page="tienda">
                    <div class="nav-btn-icon-box"><i class="fa-solid fa-store"></i></div>
                    Tienda
                </a>
                <a href="#" class="nav-btn sound-nav" data-page="asesorias">
                    <div class="nav-btn-icon-box"><i class="fa-solid fa-chalkboard-user"></i></div>
                    Asesorías
                </a>
                <a href="#" class="nav-btn sound-nav" data-page="perfil">
                    <div class="nav-btn-icon-box"><i class="fa-solid fa-user"></i></div>
                    Perfil
                </a>
            </nav>

            <div class="sidebar-footer">
                <a href="#" class="nav-btn text-muted sound-nav" data-page="configuracion">
                    <div class="nav-btn-icon-box border-0"><i class="fa-solid fa-gear"></i></div>
                    Configuración
                </a>
            </div>
        </aside>

        <main class="main-zone">

            <div class="top-widgets-row d-none d-lg-flex">

                <div class="page-title-widget-desktop sound-nav" style="cursor:pointer;">
                    <div class="page-title-icon" id="header-page-icon">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <h4 class="page-title-text" id="header-page-title">Jugar</h4>
                </div>

                <div class="user-widget-desktop">
                    <div class="user-profile-info sound-nav" style="cursor:pointer;" data-page="perfil">
                        <img src="perfil-imgs/9.jpg" alt="Axel" class="user-avatar">
                        <h5 class="m-0 fw-bold" style="color: var(--abeja-dark);">Axel</h5>
                    </div>
                    <div class="user-stats">
                        <div class="text-orange sound-item" title="Racha" style="cursor:pointer;"><i class="fa-solid fa-fire me-1"></i> 14</div>
                        <div class="text-warning sound-item" title="Miel" style="cursor:pointer;"><i class="fa-solid fa-droplet me-1" style="color: #FFC107;"></i> 776</div>
                        <div class="text-danger sound-item" title="Vidas" style="cursor:pointer;"><i class="fa-solid fa-heart me-1"></i> ∞</div>
                    </div>
                </div>

            </div>

            <div class="dynamic-container" id="dynamic-content">
                <div class="text-center mt-5 text-muted">
                    <h2>👋 Cargando...</h2>
                </div>
            </div>

        </main>

        <nav class="mobile-bottom-nav d-lg-none">
            <a href="#" class="mobile-nav-btn active sound-nav" data-page="jugar">
                <i class="fa-solid fa-house"></i>
                <span>Jugar</span>
            </a>
            <a href="#" class="mobile-nav-btn sound-nav" data-page="misiones">
                <i class="fa-solid fa-crosshairs"></i>
                <span>Misiones</span>
            </a>
            <a href="#" class="mobile-nav-btn sound-nav" data-page="tienda">
                <i class="fa-solid fa-store"></i>
                <span>Tienda</span>
            </a>
            <a href="#" class="mobile-nav-btn sound-nav" data-page="asesorias">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Asesorías</span>
            </a>
            <a href="#" class="mobile-nav-btn sound-nav" data-page="perfil">
                <i class="fa-solid fa-user"></i>
                <span>Perfil</span>
            </a>
        </nav>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // =========================================
            // SISTEMA DE SONIDOS POR CLASES (Event Delegation)
            // =========================================
            const sfxNav = document.getElementById('sfx-nav');
            const sfxAction = document.getElementById('sfx-action');
            const sfxList = document.getElementById('sfx-list');

            const playSound = (audioEl) => {
                if (audioEl) {
                    audioEl.currentTime = 0;
                    audioEl.play().catch(e => console.log('El navegador bloqueó el autoplay del audio.'));
                }
            };

            document.addEventListener('click', (e) => {
                if (e.target.closest('.sound-nav') || e.target.closest('.nav-btn') || e.target.closest('.mobile-nav-btn') || e.target.closest('.path-node')) {
                    playSound(sfxNav);
                } else if (e.target.closest('.sound-action') || e.target.closest('.btn') || e.target.closest('.shop-item-card-hz')) {
                    playSound(sfxAction);
                } else if (e.target.closest('.sound-item') || e.target.closest('.dropdown-item') || e.target.closest('.rec-item')) {
                    playSound(sfxList);
                } else if (e.target.closest('.sound-default')) {
                    playSound(sfxNav);
                }
            });


            // =========================================
            // NAVEGACIÓN DINÁMICA (FETCH) Y MANEJO DE URL
            // =========================================
            // Actualizado para escuchar también el nuevo botón de configuración en móvil
            const navLinks = document.querySelectorAll('.nav-btn, .mobile-nav-btn, .top-config-btn, .user-profile-info');
            const dynamicContent = document.getElementById('dynamic-content');
            const headerPageTitle = document.getElementById('header-page-title');
            const headerPageIcon = document.getElementById('header-page-icon');

            function loadPage(pageName, updateUrl = true) {
                if (!pageName) return;

                navLinks.forEach(n => {
                    // Solo removemos 'active' de los botones de navegación reales, no de elementos extra
                    if (n.classList.contains('nav-btn') || n.classList.contains('mobile-nav-btn')) {
                        n.classList.remove('active');
                    }
                });

                const activeNavs = document.querySelectorAll(`[data-page="${pageName}"]`);
                activeNavs.forEach(n => {
                    if (n.classList.contains('nav-btn') || n.classList.contains('mobile-nav-btn')) {
                        n.classList.add('active');
                    }
                });

                if (activeNavs.length > 0) {
                    const pcNavNode = Array.from(activeNavs).find(el => el.classList.contains('nav-btn'));
                    if (pcNavNode) {
                        const iconNode = pcNavNode.querySelector('i');
                        const iconHtml = iconNode ? iconNode.outerHTML : '<i class="fa-solid fa-cube"></i>';
                        const pageText = pcNavNode.innerText.trim();
                        if (headerPageTitle && headerPageIcon) {
                            headerPageTitle.innerText = pageText;
                            headerPageIcon.innerHTML = iconHtml;
                        }
                    }
                }

                if (updateUrl) {
                    const newUrl = new URL(window.location);
                    newUrl.searchParams.set('page', pageName);
                    window.history.pushState({
                        page: pageName
                    }, '', newUrl);
                }

                dynamicContent.style.opacity = '0.4';

                fetch(`pages/${pageName}.php`)
                    .then(res => {
                        if (!res.ok) throw new Error('Página no encontrada');
                        return res.text();
                    })
                    .then(html => {
                        dynamicContent.innerHTML = html;
                        dynamicContent.style.opacity = '1';
                        dynamicContent.scrollTop = 0;

                        const scripts = dynamicContent.querySelectorAll('script');
                        scripts.forEach(oldScript => {
                            const newScript = document.createElement('script');
                            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                            if (oldScript.innerHTML) {
                                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                            }
                            oldScript.parentNode.replaceChild(newScript, oldScript);
                        });
                    })
                    .catch(error => {
                        dynamicContent.innerHTML = `
                            <div class="text-center mt-5 text-muted">
                                <i class="fa-solid fa-person-digging fs-1 text-warning mb-3"></i>
                                <h3>🚧 En construcción</h3>
                                <p>La sección <strong>pages/${pageName}.php</strong> aún no está lista o no existe.</p>
                            </div>`;
                        dynamicContent.style.opacity = '1';
                    });
            }

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Prevenir default solo si es un ancla
                    if (this.tagName === 'A') e.preventDefault();

                    const page = this.getAttribute('data-page');
                    if (page) loadPage(page, true);
                });
            });

            window.addEventListener('popstate', (e) => {
                if (e.state && e.state.page) {
                    loadPage(e.state.page, false);
                } else {
                    loadPage('jugar', false);
                }
            });

            const urlParams = new URLSearchParams(window.location.search);
            const pageFromUrl = urlParams.get('page');

            if (pageFromUrl) {
                loadPage(pageFromUrl, false);
            } else {
                loadPage('jugar', true);
            }


            // =========================================
            // EFECTOS DE MOUSE Y MIEL TÁCTIL
            // =========================================
            const mouseEffectContainer = document.getElementById('mouse-effect-container');
            const cursorIlluminator = document.getElementById('cursor-illuminator');
            let particleInterval;

            function handlePointerMove(clientX, clientY) {
                cursorIlluminator.style.left = `${clientX}px`;
                cursorIlluminator.style.top = `${clientY}px`;
                cursorIlluminator.style.display = 'block';

                if (!particleInterval) {
                    particleInterval = setTimeout(() => {
                        createHoneyParticle(clientX, clientY);
                        particleInterval = null;
                    }, 40);
                }
            }

            document.addEventListener('mousemove', (e) => {
                handlePointerMove(e.clientX, e.clientY);
            });

            document.addEventListener('touchmove', (e) => {
                if (e.touches.length > 0) {
                    handlePointerMove(e.touches[0].clientX, e.touches[0].clientY);
                }
            }, {
                passive: true
            });

            document.addEventListener('mouseleave', () => {
                cursorIlluminator.style.display = 'none';
            });
            document.addEventListener('touchend', () => {
                cursorIlluminator.style.display = 'none';
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

            // =========================================
            // SISTEMA DE ABEJAS VOLADORAS CON RASTRO
            // =========================================
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
                    if (edge === 0) {
                        startX = Math.random() * 100;
                        startY = -10;
                    } else if (edge === 1) {
                        startX = 110;
                        startY = Math.random() * 100;
                    } else if (edge === 2) {
                        startX = Math.random() * 100;
                        startY = 110;
                    } else {
                        startX = -10;
                        startY = Math.random() * 100;
                    }
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

                const beeTracker = {
                    wrapper,
                    rotator,
                    lastX: null,
                    lastY: null
                };
                activeBees.push(beeTracker);

                setTimeout(() => {
                    wrapper.remove();
                    const index = activeBees.indexOf(beeTracker);
                    if (index > -1) activeBees.splice(index, 1);
                }, duration * 1000);
            }

            function createBeeTrailParticle(x, y) {
                const container = document.getElementById('flying-bees-container');
                if (!container) return;

                const particle = document.createElement('div');
                particle.classList.add('bee-trail-particle');

                const offset = 10;
                particle.style.left = `${x + (Math.random() - 0.5) * offset}px`;
                particle.style.top = `${y + (Math.random() - 0.5) * offset}px`;

                container.appendChild(particle);

                setTimeout(() => particle.remove(), 1500);
            }

            function updateBeeRotations() {
                activeBees.forEach(bee => {
                    const rect = bee.wrapper.getBoundingClientRect();
                    const currentX = rect.left + (rect.width / 2);
                    const currentY = rect.top + (rect.height / 2);

                    if (bee.lastX !== null && bee.lastY !== null) {
                        const dx = currentX - bee.lastX;
                        const dy = currentY - bee.lastY;

                        if (Math.abs(dx) > 0.2 || Math.abs(dy) > 0.2) {
                            const angle = Math.atan2(dy, dx) * (180 / Math.PI);
                            let rotation = angle - 180;
                            let flip = '';

                            if (angle > -90 && angle < 90) {
                                flip = 'scaleY(-1)';
                            }
                            bee.rotator.style.transform = `rotate(${rotation}deg) ${flip}`;

                            if (Math.random() < 0.15) {
                                createBeeTrailParticle(currentX, currentY);
                            }
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