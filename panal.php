<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Abeja GO 🐝 | Aprender Álgebra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* =========================================
           VARIABLES Y BASE
           ========================================= */
        :root {
            --abeja-white: #ffffff;
            --abeja-yellow-dark: #E5B400;
            --abeja-gray: #F7F7F7;
            --abeja-gray-medium: #E5E5E5;
            --abeja-dark: #2C3E50;
            --abeja-text: #4A5568;
            --abeja-orange: #FF9600;
            --abeja-danger: #FF4B4B;
            --nav-width: 22%;
            --content-width: 78%;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: var(--abeja-gray); 
            font-family: 'Nunito', sans-serif;
            color: var(--abeja-text);
            overflow: hidden; 
        }

        /* =========================================
           RED DE PANAL ANIMADA (Fondo)
           ========================================= */
        #honeycomb-background {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 1; /* Se queda debajo de la app (z-index: 10) */
            pointer-events: none;
            /* SVG de panal suave estilo cartoon */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='60' height='105' viewBox='0 0 56 98'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='hexagons' fill='%23e5b400' fill-opacity='0.028' fill-rule='nonzero'%3E%3Cpath d='M27.98 18.5l26 15v30l-26 15L2 63.5v-30l25.98-15zM6 35.8v25.4l21.98 12.68 22-12.7V35.8l-22-12.68L6 35.8zM0 30l25.96-15V0h-4v12.7L0 25.38v4.6zm0 37L25.96 82v16h-4v-13.7L0 71.62v-4.6zM30 0v15l25.98 15H56v-4.62h-.02L34 12.7V0h-4zm0 98v-16l25.98-15H56v4.62h-.02L34 84.3V98h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            /* Animación suave y continua en diagonal */
            animation: honey-bg-scroll 40s linear infinite;
        }

        @keyframes honey-bg-scroll {
            0% { background-position: 0px 0px; }
            100% { background-position: 56px 98px; } /* Desplazamiento exacto de 1 patrón SVG */
        }

        /* =========================================
           EFECTOS VISUALES (Miel, Abejas y Rastros)
           ========================================= */
        #mouse-effect-container, #flying-bees-container {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            pointer-events: none; 
            z-index: 9998;
            overflow: hidden;
        }
        
        #flying-bees-container { z-index: 9997; }

        #cursor-illuminator {
            position: fixed;
            width: 150px; height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 238, 140, 0.4) 0%, rgba(255, 238, 140, 0) 70%);
            transform: translate(-50%, -50%);
            display: none;
            z-index: 201;
            pointer-events: none;
        }

        .honey-particle {
            position: fixed;
            width: 8px; height: 8px;
            background-color: #FFB300;
            border-radius: 50%;
            animation: particle-fade 1s forwards;
            z-index: 202;
            pointer-events: none;
        }

        .bee-trail-particle {
            position: fixed;
            width: 4.5px; height: 4.5px;
            background-color: rgba(255, 179, 0, 0.75);
            border-radius: 50%;
            animation: bee-trail-fade 1.5s forwards ease-out;
            z-index: 9996; 
            pointer-events: none;
            box-shadow: 0 0 5px rgba(255, 150, 0, 0.3);
        }

        @keyframes particle-fade {
            0% { opacity: 0.8; transform: translateY(0) scale(1); }
            100% { opacity: 0; transform: translateY(20px) scale(0); }
        }

        @keyframes bee-trail-fade {
            0% { opacity: 0.8; transform: scale(1) translateY(0); }
            100% { opacity: 0; transform: scale(0.3) translateY(12px); } 
        }

        .tiny-bee-wrapper {
            position: absolute;
            pointer-events: none;
            will-change: transform;
        }

        .tiny-bee-rotator {
            display: inline-block;
            transition: transform 0.15s ease-out;
            will-change: transform;
        }

        .tiny-bee-inner {
            font-size: 15px;
            filter: drop-shadow(0 2px 2px rgba(0, 0, 0, 0.2));
            animation: bee-fade var(--flight-duration) ease-in-out forwards, bee-wiggle 0.1s infinite alternate;
        }

        @keyframes bee-fade {
            0%, 100% { opacity: 0; transform: scale(0.3); }
            10%, 90% { opacity: 0.6; transform: scale(1); }
        }

        @keyframes bee-wiggle {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-3px); }
        }

        @keyframes fly-path-1 {
            0% { transform: translate(0, 0); }
            25% { transform: translate(300px, -200px); }
            50% { transform: translate(600px, 50px); }
            75% { transform: translate(900px, -100px); }
            100% { transform: translate(1200px, 200px); }
        }

        @keyframes fly-path-2 {
            0% { transform: translate(0, 0); }
            25% { transform: translate(-200px, 200px); }
            50% { transform: translate(-400px, 50px); }
            75% { transform: translate(-200px, -200px); }
            100% { transform: translate(200px, -400px); }
        }

        @keyframes fly-path-3 {
            0% { transform: translate(0, 0); }
            30% { transform: translate(250px, 250px); }
            50% { transform: translate(100px, 150px); }
            70% { transform: translate(400px, -100px); }
            100% { transform: translate(700px, 500px); }
        }

        @keyframes fly-path-4 {
            0% { transform: translate(0, 0); }
            33% { transform: translate(-300px, -300px); }
            66% { transform: translate(200px, -500px); }
            100% { transform: translate(-400px, -800px); }
        }

        /* =========================================
           LAYOUT PRINCIPAL (PC)
           ========================================= */
        #app-wrapper {
            display: flex;
            width: 100vw;
            height: 100vh;
            height: 100dvh; 
            overflow: hidden;
            position: relative;
            z-index: 10;
        }

        /* --- BARRA LATERAL (22%) --- */
        .sidebar {
            width: var(--nav-width);
            height: 100%;
            background-color: var(--abeja-white);
            border-right: 2px solid var(--abeja-gray);
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0; top: 0;
            z-index: 100;
        }

        .sidebar-brand {
            height: 11.11vh; 
            min-height: 60px;
            display: flex;
            align-items: center;
            padding: 0 40px;
            border-bottom: 2px solid var(--abeja-gray);
            font-size: clamp(1.2rem, 3.5vh, 1.8rem);
            font-weight: 900;
            color: var(--abeja-yellow-dark);
            text-decoration: none;
        }
        .sidebar-brand i { 
            margin-right: 15px; 
            font-size: clamp(1.5rem, 4vh, 2.2rem); 
        }

        .sidebar-nav {
            flex-grow: 1;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            overflow-y: auto;
        }

        .nav-btn {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--abeja-text);
            font-weight: 700;
            font-size: 1.1rem;
            padding: 15px 20px;
            border-radius: 16px;
            transition: all 0.2s ease;
        }
        .nav-btn:hover, .nav-btn.active {
            background-color: rgba(229, 180, 0, 0.1);
            color: var(--abeja-yellow-dark);
        }
        .nav-btn-icon-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            border-right: 2px solid var(--abeja-gray-medium);
            margin-right: 15px;
            padding-right: 15px;
            font-size: 1.3rem;
        }

        .sidebar-footer { padding: 20px; border-top: 2px solid var(--abeja-gray); }

        /* --- ZONA PRINCIPAL (78%) --- */
        .main-zone {
            width: var(--content-width);
            margin-left: var(--nav-width);
            height: 100%;
            display: flex;
            flex-direction: column;
            padding: 25px 40px 40px 40px; 
            box-sizing: border-box;
        }

        /* Fila de Widgets Superiores */
        .top-widgets-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 25px;
            flex-shrink: 0; 
        }

        /* Widget de Título de Página */
        .page-title-widget-desktop {
            background-color: var(--abeja-white);
            border-radius: 20px;
            padding: 0 25px 0 20px;
            height: 75px; 
            display: flex;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .page-title-icon {
            font-size: 1.4rem;
            color: var(--abeja-text);
            padding-right: 15px;
            border-right: 2px solid var(--abeja-gray-medium);
            margin-right: 15px;
            display: flex;
            align-items: center;
            height: 40px;
        }
        .page-title-text {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--abeja-yellow-dark);
            margin: 0;
            text-transform: capitalize;
        }

        /* Widget de Usuario */
        .user-widget-desktop {
            background-color: var(--abeja-white);
            border-radius: 20px;
            padding: 0 25px 0 10px;
            height: 75px; 
            display: flex;
            align-items: center;
            gap: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .user-profile-info { 
            display: flex; 
            align-items: center; 
            gap: 15px; 
            border-right: 2px solid var(--abeja-gray); 
            padding-right: 20px; 
            height: 50px;
        }
        .user-avatar { width: 50px; height: 50px; border-radius: 14px; object-fit: cover; }
        .user-stats { display: flex; align-items: center; gap: 20px; font-weight: 800; font-size: 1.1rem; }

        /* Contenedor Dinámico con Scroll Activo */
        .dynamic-container {
            flex-grow: 1; 
            min-height: 0; 
            background-color: var(--abeja-white);
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            overflow-y: auto; 
            overflow-x: hidden;
            padding: 40px;
            position: relative;
            -webkit-overflow-scrolling: touch; 
        }

        /* =========================================
           LAYOUT MÓVIL / TABLET (Hasta 991px)
           ========================================= */
        @media (max-width: 991px) {
            #app-wrapper { flex-direction: column; }
            
            .sidebar { display: none; }
            
            /* Ajustes en Zona Principal para móvil */
            .main-zone { 
                width: 100%; 
                margin-left: 0; 
                padding: 100px 15px 105px 15px; 
                height: 100%;
            }
            
            .top-widgets-row { display: none !important; }
            
            /* Topbar Móvil */
            .mobile-top-bar {
                position: fixed; top: 0; left: 0; width: 100%;
                background-color: var(--abeja-white);
                padding: 15px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                box-shadow: 0 4px 10px rgba(0,0,0,0.05);
                z-index: 100;
                height: 85px; 
            }
            .mobile-top-bar .user-avatar { width: 50px !important; height: 50px !important; }
            .mobile-top-bar h6 { font-size: 1.15rem; }
            
            .mobile-top-bar .user-stats { gap: 15px !important; }
            .mobile-top-bar .user-stats > div {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .mobile-top-bar .user-stats > div i {
                font-size: 1.5rem;
                margin: 0 0 3px 0 !important; 
            }
            .mobile-top-bar .user-stats > div span {
                font-size: 0.9rem;
                font-weight: 900;
                line-height: 1;
            }

            /* Contenedor Dinámico Móvil */
            .dynamic-container {
                margin: 0; 
                padding: 20px;
                border-radius: 20px;
                height: 100%; 
            }

            /* Navegación Inferior (Bottom Nav) */
            .mobile-bottom-nav {
                position: fixed; bottom: 0; left: 0; width: 100%;
                background-color: var(--abeja-white);
                border-top: 2px solid var(--abeja-gray);
                display: flex;
                justify-content: space-around;
                align-items: center;
                padding: 10px 5px; 
                z-index: 100;
                height: 90px; 
            }
            .mobile-nav-btn {
                display: flex; flex-direction: column; align-items: center;
                text-decoration: none; color: var(--abeja-text);
                font-size: 1.7rem; 
                gap: 8px; 
                width: 20%;
            }
            .mobile-nav-btn span { font-size: 0.75rem; font-weight: 800; }
            .mobile-nav-btn.active { color: var(--abeja-yellow-dark); }
        }
        .text-orange {
            color: var(--abeja-orange);
        }
    </style>
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
            <div class="user-profile-info border-0 p-0 sound-nav" style="cursor:pointer;">
                <img src="https://wallpapers.com/images/hd/xbox-360-profile-pictures-e2bpy4ip6cmbx6cr.jpg" alt="Axel" class="user-avatar" style="width: 50px; height: 50px;">
                <h6 class="m-0 fw-bold" style="color: var(--abeja-dark);">Axel</h6>
            </div>
            <div class="user-stats d-flex">
                <div class="text-orange sound-item" style="cursor:pointer;"><i class="fa-solid fa-fire"></i><span>14</span></div>
                <div class="text-warning sound-item" style="cursor:pointer;"><i class="fa-solid fa-droplet"></i><span>776</span></div>
                <div class="text-danger sound-item" style="cursor:pointer;"><i class="fa-solid fa-heart"></i><span>∞</span></div>
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
                    <div class="user-profile-info sound-nav" style="cursor:pointer;">
                        <img src="https://wallpapers.com/images/hd/xbox-360-profile-pictures-e2bpy4ip6cmbx6cr.jpg" alt="Axel" class="user-avatar">
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

            // Función global para reproducir sonido
            const playSound = (audioEl) => {
                if (audioEl) {
                    audioEl.currentTime = 0;
                    audioEl.play().catch(e => console.log('El navegador bloqueó el autoplay del audio.'));
                }
            };

            // Escuchar clics en TODO el documento (incluso en el contenido inyectado por fetch)
            document.addEventListener('click', (e) => {
                // Sonido de Navegación principal (Botones del menú)
                if (e.target.closest('.sound-nav') || e.target.closest('.nav-btn') || e.target.closest('.mobile-nav-btn') || e.target.closest('.path-node')) {
                    playSound(sfxNav);
                } 
                // Sonido de Acción/Botones fuertes (Comprar, Equipar, etc)
                else if (e.target.closest('.sound-action') || e.target.closest('.btn') || e.target.closest('.shop-item-card-hz')) {
                    playSound(sfxAction);
                } 
                // Sonido de Lista/Items suaves (Dropdowns, recompensas, stats)
                else if (e.target.closest('.sound-item') || e.target.closest('.dropdown-item') || e.target.closest('.rec-item')) {
                    playSound(sfxList);
                }
                // Sonido por defecto general (si quieres agregarlo a cualquier cosa que se llame .sound-default)
                else if (e.target.closest('.sound-default')) {
                    playSound(sfxNav);
                }
            });


            // =========================================
            // NAVEGACIÓN DINÁMICA (FETCH) Y MANEJO DE URL (?page=X)
            // =========================================
            const navLinks = document.querySelectorAll('.nav-btn, .mobile-nav-btn');
            const dynamicContent = document.getElementById('dynamic-content');
            const headerPageTitle = document.getElementById('header-page-title');
            const headerPageIcon = document.getElementById('header-page-icon');

            // Función centralizada para cargar páginas
            // Función centralizada para cargar páginas
            function loadPage(pageName, updateUrl = true) {
                if (!pageName) return;

                // 1. Sincronizar clases activas visualmente en el menú
                navLinks.forEach(n => n.classList.remove('active'));
                const activeNavs = document.querySelectorAll(`[data-page="${pageName}"]`);
                activeNavs.forEach(n => n.classList.add('active'));

                // 2. Actualizar el título y el ícono en la vista de PC
                if (activeNavs.length > 0) {
                    const pcNavNode = Array.from(activeNavs).find(el => el.classList.contains('nav-btn'));
                    if (pcNavNode) {
                        const iconHtml = pcNavNode.querySelector('i').outerHTML;
                        const pageText = pcNavNode.innerText.trim();
                        headerPageTitle.innerText = pageText;
                        headerPageIcon.innerHTML = iconHtml;
                    }
                }

                // 3. Actualizar la URL sin recargar la página (Magia del History API)
                if (updateUrl) {
                    const newUrl = new URL(window.location);
                    newUrl.searchParams.set('page', pageName);
                    window.history.pushState({ page: pageName }, '', newUrl);
                }

                // 4. Efecto visual de carga y FETCH REAL
                dynamicContent.style.opacity = '0.4';
                
                // Petición real al servidor para traer el archivo .php
                fetch(`pages/${pageName}.php`)
                    .then(res => {
                        if (!res.ok) throw new Error('Página no encontrada');
                        return res.text();
                    })
                    .then(html => {
                        dynamicContent.innerHTML = html;
                        dynamicContent.style.opacity = '1';
                        // Volver al scroll top interno al cambiar de página
                        dynamicContent.scrollTop = 0;

                        // 5. ¡VITAL! Forzar al navegador a ejecutar los <script> inyectados
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
                        // Pantalla de error si el archivo no existe en la carpeta pages/
                        dynamicContent.innerHTML = `
                            <div class="text-center mt-5 text-muted">
                                <i class="fa-solid fa-person-digging fs-1 text-warning mb-3"></i>
                                <h3>🚧 En construcción</h3>
                                <p>La sección <strong>pages/${pageName}.php</strong> aún no está lista o no existe.</p>
                            </div>`;
                        dynamicContent.style.opacity = '1';
                    });
            }

            // Al hacer clic en el menú
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const page = this.getAttribute('data-page');
                    loadPage(page, true);
                });
            });

            // Manejar la navegación con los botones de "Atrás/Adelante" del navegador
            window.addEventListener('popstate', (e) => {
                if (e.state && e.state.page) {
                    loadPage(e.state.page, false);
                } else {
                    loadPage('jugar', false);
                }
            });

            // Lógica inicial al cargar la página por primera vez
            const urlParams = new URLSearchParams(window.location.search);
            const pageFromUrl = urlParams.get('page');
            
            // Si hay un "?page=" en la URL, carga esa; si no, carga "jugar" por defecto
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
            }, { passive: true });

            document.addEventListener('mouseleave', () => { cursorIlluminator.style.display = 'none'; });
            document.addEventListener('touchend', () => { cursorIlluminator.style.display = 'none'; });

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

                            if (angle > -90 && angle < 90) { flip = 'scaleY(-1)'; }
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