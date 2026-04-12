<style>
    /* =========================================
       ESTILOS EXCLUSIVOS DE JUGAR.PHP (ESTILO PASTEL/CLARO)
       ========================================= */

    :root {
        /* Paleta Pastel extraída de perfil.php y panal.php */
        --primary-yellow: #FFE066; 
        --primary-yellow-dark: #E5B400; 
        --primary-yellow-text: #7F6600;
        
        --primary-blue: #5DADE2; 
        --primary-blue-dark: #3498DB; 
        --primary-blue-light: #EBF5FB;
        
        --secondary-orange: #FFB373; 
        --secondary-orange-dark: #FF9600;
        
        --pastel-green: #48C9B0;
        --pastel-green-dark: #1ABC9C;
        --pastel-green-light: #E9F7EF;
        
        --pastel-purple: #A569BD;
        --pastel-purple-dark: #8E44AD;
        --pastel-purple-light: #F5EEF8;

        --abeja-gray-light: #F2F3F4; 
        --abeja-gray-dark: #D5D8DC; 
        --abeja-text-muted: #839192;
    }

    /* Animación de entrada suave genérica (Banners, títulos) */
    .fade-in-section {
        animation: fadeInSlide 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        opacity: 0; transform: translateY(20px);
    }
    
    @keyframes fadeInSlide { to { opacity: 1; transform: translateY(0); } }

    /* Animación exclusiva para los Nodos del Camino (Respeta la curva de serpiente) */
    .fade-in-node {
        animation: fadeInNodeAnim 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        opacity: 0; 
        transform: translate(var(--x-offset, 0px), 20px);
    }
    @keyframes fadeInNodeAnim { 
        to { opacity: 1; transform: translate(var(--x-offset, 0px), 0); } 
    }

    /* Retrasos progresivos cada 0.05 segundos para efecto dominó */
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.10s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.20s; }
    .delay-5 { animation-delay: 0.25s; }
    .delay-6 { animation-delay: 0.30s; }
    .delay-7 { animation-delay: 0.35s; }
    .delay-8 { animation-delay: 0.40s; }
    .delay-9 { animation-delay: 0.45s; }
    .delay-10 { animation-delay: 0.50s; }
    .delay-11 { animation-delay: 0.55s; }
    .delay-12 { animation-delay: 0.60s; }
    .delay-13 { animation-delay: 0.65s; }
    .delay-14 { animation-delay: 0.70s; }
    .delay-15 { animation-delay: 0.75s; }
    .delay-16 { animation-delay: 0.80s; }
    .delay-17 { animation-delay: 0.85s; }
    .delay-18 { animation-delay: 0.90s; }
    .delay-19 { animation-delay: 0.95s; }
    .delay-20 { animation-delay: 1.00s; }
    .delay-21 { animation-delay: 1.05s; }

    /* Animación exclusiva para las líneas conectoras del camino */
    .path-line-anim {
        opacity: 0;
        animation: fadeInLine 0.8s ease forwards;
        animation-delay: 0.15s;
    }
    @keyframes fadeInLine { to { opacity: 1; } }

    /* 0. Pantalla de Bloqueo por Rotación (Solo Móviles en Horizontal) */
    .landscape-warning {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        background-color: var(--abeja-gray);
        z-index: 99999;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 30px;
    }
    
    @media (max-width: 991px) and (orientation: landscape) and (max-height: 500px) {
        .landscape-warning { display: flex !important; }
    }
    
    .rotate-icon { 
        font-size: 5rem; 
        color: var(--primary-yellow-dark); 
        animation: rotate-phone 2s infinite ease-in-out; 
    }
    
    @keyframes rotate-phone {
        0% { transform: rotate(-90deg); }
        50% { transform: rotate(0deg); }
        100% { transform: rotate(-90deg); }
    }

    /* 1. Selector de Cursos (Sticky Móvil) */
    .sticky-course-mobile {
        position: sticky;
        top: -20px; 
        margin: -20px -20px 0 -20px; 
        padding: 20px 20px 10px 20px; 
        z-index: 105;
        background-color: var(--abeja-white);
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    .course-selector-btn {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-bottom: 4px solid var(--abeja-gray-medium);
        border-radius: 18px;
        padding: 8px 20px 8px 10px;
        display: flex;
        align-items: center;
        gap: 15px;
        cursor: pointer;
        transition: transform 0.1s, background-color 0.2s;
        width: 100%;
        max-width: 300px;
    }
    .course-selector-btn:active {
        transform: translateY(2px);
        border-bottom-width: 2px;
        margin-top: 2px;
    }
    .course-selector-btn:hover { background-color: var(--abeja-gray-light); }

    .course-icon-box {
        width: 45px; height: 45px;
        background-color: var(--primary-blue-light);
        color: var(--primary-blue);
        border-radius: 12px;
        display: flex; justify-content: center; align-items: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }
    
    /* Menú Desplegable */
    .custom-dropdown-menu { 
        display: block; 
        position: absolute; 
        margin-top: 8px; 
        visibility: hidden; 
        opacity: 0; 
        transform: translateY(-10px); 
        transition: all 0.2s ease-out; 
        pointer-events: none; 
    }
    .custom-dropdown-menu.show { 
        visibility: visible; 
        opacity: 1; 
        transform: translateY(0); 
        pointer-events: auto;
    }

    /* 2. Cabeceras Fijas (Efecto Sticky y Banners) */
    .section-sticky-header {
        position: sticky;
        top: 60px; /* Debajo del curso en móvil */
        padding: 15px 0 15px 0; 
        background-color: var(--abeja-white);
        z-index: 100;
    }
    .section-banner {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-dark));
        border-radius: 20px;
        display: flex;
        height: 105px; 
        box-shadow: 0 8px 20px rgba(93, 173, 226, 0.2);
        overflow: hidden; 
        position: relative;
    }
    
    /* Banners de otras secciones */
    .banner-green { 
        background: linear-gradient(135deg, var(--pastel-green), var(--pastel-green-dark)); 
        box-shadow: 0 8px 20px rgba(72, 201, 176, 0.2);
    }
    .banner-green .banner-img-col::before { background: linear-gradient(to right, var(--pastel-green), transparent) !important; }
    
    .banner-purple { 
        background: linear-gradient(135deg, var(--pastel-purple), var(--pastel-purple-dark)); 
        box-shadow: 0 8px 20px rgba(165, 105, 189, 0.2);
    }
    .dropdown-item.active, .dropdown-item:active{
        background-color: var(--primary-blue);
    }
    .banner-purple .banner-img-col::before { background: linear-gradient(to right, var(--pastel-purple), transparent) !important; }

    .banner-text-col {
        flex-grow: 1;
        padding: 15px 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        z-index: 2;
    }
    .banner-text-col h3 { font-size: 1.3rem; font-weight: 900; color: white; margin: 0; line-height: 1.1; }
    .banner-text-col span { font-size: 0.75rem; font-weight: 900; color: rgba(255,255,255,0.85); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
    .banner-img-col {
        height: 100%; width: 110px; flex-shrink: 0; position: relative;
    }
    .banner-img-col::before {
        content: ''; position: absolute; top: 0; left: -1px; bottom: 0; width: 40px;
        background: linear-gradient(to right, var(--primary-blue), transparent); z-index: 1;
    }
    .banner-img-col img { width: 100%; height: 100%; object-fit: cover; object-position: center; opacity: 0.85; }

    /* 3. Fondo de Hexágonos Flotantes Globales */
    .bg-floating-hexagons {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        overflow: hidden; z-index: 0; pointer-events: none;
    }
    .floating-hex-bg {
        position: absolute;
        background-color: var(--primary-yellow);
        opacity: 0.15;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        animation: float-hex-isometric infinite linear;
    }
    @keyframes float-hex-isometric {
        0% { transform: translateY(0) scaleY(0.5) rotateZ(0deg); }
        50% { transform: translateY(-80px) scaleY(0.5) rotateZ(180deg); }
        100% { transform: translateY(0) scaleY(0.5) rotateZ(360deg); }
    }

    /* 4. Camino y Nodos */
    .path-container {
        display: flex; flex-direction: column; align-items: center;
        padding: 10px 0 50px 0; position: relative; z-index: 1;
    }
    
    .path-bg-hexagons {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        overflow: hidden; z-index: -1; pointer-events: none;
    }
    .path-hex {
        position: absolute;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        animation: pulse-rotate-hex infinite ease-in-out;
    }
    .path-hex.blue { background-color: var(--primary-blue); opacity: 0.08; }
    .path-hex.yellow { background-color: var(--primary-yellow-dark); opacity: 0.08; }
    .path-hex.gray { background-color: var(--abeja-gray-dark); opacity: 0.08; }
    
    .path-hex.pastel-green { background-color: var(--pastel-green); opacity: 0.08; }
    .path-hex.pastel-purple { background-color: var(--pastel-purple); opacity: 0.08; }
    
    @keyframes pulse-rotate-hex {
        0% { transform: scaleY(0.5) rotateZ(0deg) scale(1); }
        50% { transform: scaleY(0.5) rotateZ(180deg) scale(1.15); }
        100% { transform: scaleY(0.5) rotateZ(360deg) scale(1); }
    }

    .path-nodes {
        display: flex; flex-direction: column; align-items: center;
        width: 100%; position: relative; z-index: 1;
        margin-bottom: 30px;
    }
    
    .path-line-svg-desktop { display: none; }
    .path-line-svg-mobile { display: block; }
    
    .node-wrapper {
        display: flex; justify-content: center; margin-bottom: 20px;
        position: relative; z-index: 2; height: 95px; width: 100%;
        --x-offset: 0px; /* Variable CSS para la serpiente */
    }

    /* Offsets Móvil usando Variables CSS */
    .offset-left-2 { --x-offset: -60px; }
    .offset-left-1 { --x-offset: -30px; }
    .offset-center { --x-offset: 0px; }
    .offset-right-1 { --x-offset: 30px; }
    .offset-right-2 { --x-offset: 60px; }

    /* 5. Mascotas Interactivas */
    .mascot-zone { position: absolute; pointer-events: none; z-index: 3; }
    .mascot-img { 
        width: 90px; height: auto; 
        filter: drop-shadow(0 8px 12px rgba(0,0,0,0.1)); 
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), filter 0.3s ease; 
        pointer-events: auto; cursor: pointer;
    }
    
    .mascot-locked { filter: grayscale(100%) opacity(0.5) brightness(1.2) drop-shadow(0 8px 12px rgba(0,0,0,0.05)); }

    .zone-right { left: 50%; margin-left: 85px; top: 10px; }
    .zone-left { right: 50%; margin-right: 85px; top: 10px; }

    .zone-right .mascot-img:hover {
        transform: translateY(-8px) rotate(5deg);
        filter: drop-shadow(0 12px 18px rgba(0,0,0,0.15));
    }
    .zone-left .mascot-img:hover {
        transform: translateY(-8px) rotate(-5deg);
        filter: drop-shadow(0 12px 18px rgba(0,0,0,0.15));
    }

    /* Responsive PC */
    @media (min-width: 992px) {
        .sticky-course-mobile { 
            position: sticky;
            top: -40px; 
            margin: -40px -40px 10px -40px;
            padding: 40px 40px 15px 40px;
            background-color: var(--abeja-white);
            z-index: 105;
        }
        .section-sticky-header { 
            top: 80px; 
            padding: 15px 0 20px 0; 
        }
        .section-banner { height: 120px; }
        .banner-text-col h3 { font-size: 1.5rem; }
        .banner-img-col { width: 140px; }

        /* Offsets PC usando Variables CSS */
        .offset-left-2 { --x-offset: -160px; }
        .offset-left-1 { --x-offset: -80px; }
        .offset-center { --x-offset: 0px; }
        .offset-right-1 { --x-offset: 80px; }
        .offset-right-2 { --x-offset: 160px; }

        .path-line-svg-desktop { display: block; }
        .path-line-svg-mobile { display: none; }

        .mascot-img { width: clamp(110px, 10vw, 140px); }
        .zone-right { margin-left: clamp(130px, 12vw, 180px); top: -10px; }
        .zone-left { margin-right: clamp(130px, 12vw, 180px); top: -10px; }
    }

    /* 6. Botones Hexagonales 3D */
    .btn-hex-wrapper {
        position: relative; display: inline-block;
        width: 85px; height: 95px; z-index: 3;
        transition: transform 0.4s ease-out, filter 0.4s ease-out;
    }

    .btn-hex-wrapper:not(.state-locked):hover { 
        transform: translateY(-4px) rotate(-4deg); 
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275), filter 0.2s ease;
    }

    .btn-hex-wrapper:not(.state-locked):active {
        transform: translateY(8px) rotate(0deg);
        transition: transform 0.05s ease-in, filter 0.05s ease-in;
    }
    
    .btn-hex {
        width: 100%; height: 100%;
        background-color: var(--btn-color, var(--primary-blue));
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        position: relative; display: flex; justify-content: center; align-items: center;
        font-size: 2.2rem; color: white; cursor: pointer; border: none; padding: 0; z-index: 2;
    }

    .state-completed { filter: drop-shadow(0 8px 0px var(--primary-blue-dark)); --btn-color: var(--primary-blue); }
    .state-completed:active { filter: drop-shadow(0 0px 0px var(--primary-blue-dark)); }

    .state-active { filter: drop-shadow(0 8px 0px var(--primary-yellow-dark)); --btn-color: var(--primary-yellow); color: var(--primary-yellow-text); z-index: 5; }
    .state-active:active { filter: drop-shadow(0 0px 0px var(--primary-yellow-dark)); }

    .state-chest { filter: drop-shadow(0 8px 0px var(--secondary-orange-dark)); --btn-color: var(--secondary-orange); }
    .state-chest:active { filter: drop-shadow(0 0px 0px var(--secondary-orange-dark)); }

    .state-locked { filter: drop-shadow(0 8px 0px var(--abeja-gray-dark)); --btn-color: var(--abeja-gray-light); color: var(--abeja-text-muted); cursor: not-allowed; }

    /* 7. Base de Aura 3D y Animaciones Dinámicas */
    .node-active-orbit {
        position: absolute; bottom: -15px; left: 50%;
        width: 110px; height: 45px; margin-left: -55px;
        z-index: 1; pointer-events: none;
    }
    
    .node-active-ring {
        width: 100%; height: 100%; border-radius: 50%;
        border: 3px solid rgba(229, 180, 0, 0.4);
        box-shadow: 0 0 15px rgba(229, 180, 0, 0.2) inset, 0 0 15px rgba(229, 180, 0, 0.2);
        animation: ring-pulse 1.5s infinite alternate ease-in-out;
    }
    @keyframes ring-pulse {
        0% { transform: scale(0.85); opacity: 0.5; }
        100% { transform: scale(1.05); opacity: 1; }
    }

    .orbit-hidden { display: none !important; }
    .orbit-appear { display: block !important; animation: orbit-appear-anim 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }
    @keyframes orbit-appear-anim {
        0% { opacity: 0; transform: translateY(25px) scale(0.6); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .click-ripple-3d {
        position: absolute; bottom: -15px; left: 50%;
        width: 110px; height: 45px; margin-left: -55px;
        border-radius: 50%; border: 4px solid transparent;
        z-index: 1; pointer-events: none;
        animation: ripple-out-ellipse 0.5s ease-out forwards;
    }
    @keyframes ripple-out-ellipse {
        0% { transform: scale(1); opacity: 0.8; border-width: 5px; }
        100% { transform: scale(2); opacity: 0; border-width: 1px; }
    }

    /* 8. Tooltip Flotante */
    .tooltip-start {
        position: absolute; top: -55px; left: 50%; transform: translateX(-50%); 
        background-color: var(--primary-yellow); color: var(--primary-yellow-text); 
        padding: 10px 18px; border-radius: 14px; font-weight: 900; letter-spacing: 1px; z-index: 10;
        animation: bounce-tooltip 2s infinite ease-in-out; white-space: nowrap; font-size: 0.95rem;
        box-shadow: 0 6px 15px rgba(229, 180, 0, 0.2);
    }
    .tooltip-start::after {
        content: ''; position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%);
        border-left: 8px solid transparent; border-right: 8px solid transparent; border-top: 8px solid var(--primary-yellow);
    }
    @keyframes bounce-tooltip {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-8px); }
    }

    .click-pulse {
        position: absolute; top: 50%; left: 50%; width: 100%; height: 100%; background-color: rgba(255,255,255,0.7);
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); transform: translate(-50%, -50%) scale(1);
        animation: pulse-out 0.5s ease-out forwards; pointer-events: none; z-index: 10;
    }
    @keyframes pulse-out {
        0% { transform: translate(-50%, -50%) scale(0.6); opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(1.6); opacity: 0; }
    }
</style>

<div class="landscape-warning">
    <i class="fa-solid fa-mobile-screen-button rotate-icon"></i>
    <h3 class="mt-4 fw-bold" style="color: var(--abeja-dark);">¡Gira tu teléfono!</h3>
    <p class="text-muted fw-bold">Abeja GO funciona mejor en vertical para que no te pierdas ningún detalle de tu ruta de aprendizaje.</p>
</div>

<div class="bg-floating-hexagons">
    <div class="floating-hex-bg" style="width:100px; height:100px; top: 2%; left: 10%; animation-duration: 20s;"></div><div class="floating-hex-bg" style="width:70px; height:70px; top: 10%; right: 15%; animation-duration: 15s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:130px; height:130px; top: 35%; left: 15%; animation-duration: 28s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:110px; height:110px; top: 52%; left: 35%; animation-duration: 19s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:140px; height:140px; top: 68%; left: 20%; animation-duration: 26s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:65px; height:65px; top: 76%; right: 30%; animation-duration: 16s;"></div>
    <div class="floating-hex-bg" style="width:105px; height:105px; top: 95%; right: 18%; animation-duration: 20s;"></div>
</div>

<div class="sticky-course-mobile">
    <div style="position: relative; display: inline-block; width: 100%;" class="fade-in-section">
        <button class="course-selector-btn sound-nav" type="button" id="customCourseBtn">
            <div class="course-icon-box"><i class="fa-solid fa-square-root-variable"></i></div>
            <div class="text-start">
                <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1px;">CURSO ACTUAL</span>
                <span class="d-block fw-bold" style="font-size: 1.15rem; color: var(--abeja-dark); line-height: 1;">Álgebra</span>
            </div>
            <i class="fa-solid fa-chevron-down ms-auto text-muted"></i>
        </button>
        
        <ul class="dropdown-menu custom-dropdown-menu border-0 shadow-lg rounded-4 p-2 w-100" id="customCourseMenu" style="z-index: 200;">
            <li>
                <a class="dropdown-item sound-nav d-flex align-items-center p-2 rounded-3 active" href="#">
                    <div class="course-icon-box me-3" style="width: 35px; height: 35px; font-size: 1rem;"><i class="fa-solid fa-square-root-variable"></i></div>
                    <span class="fw-bold">Álgebra</span>
                    <i class="fa-solid fa-circle-check ms-auto"></i>
                </a>
            </li>
            <li>
                <a class="dropdown-item sound-nav d-flex align-items-center p-2 rounded-3 mt-1" href="#">
                    <div class="course-icon-box me-3 bg-light text-muted border border-light" style="width: 35px; height: 35px; font-size: 1rem; background-color: var(--abeja-gray-light) !important;"><i class="fa-solid fa-atom"></i></div>
                    <span class="fw-bold text-muted" style="color: var(--abeja-dark);">Física</span>
                </a>
            </li>
            <li><hr class="dropdown-divider my-2"></li>
            <li>
                <a class="dropdown-item sound-nav d-flex align-items-center p-2 rounded-3 text-primary" href="#">
                    <div class="course-icon-box me-3 bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25" style="width: 35px; height: 35px; font-size: 1rem;"><i class="fa-solid fa-plus"></i></div>
                    <span class="fw-bold" style="color: #0d6efd;">Añadir curso</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="section-sticky-header">
    <div class="section-banner fade-in-section delay-1">
        <div class="banner-text-col">
            <span>SECCIÓN 1, ÁLGEBRA FUNDAMENTAL</span>
            <h3>Introducción a Ecuaciones</h3>
        </div>
        <div class="banner-img-col">
            <img src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?auto=format&fit=crop&w=300&q=80" alt="Algebra">
        </div>
    </div>
</div>

<div class="path-container">
    <div class="path-bg-hexagons">
        <div class="path-hex blue" style="width: 140px; height: 140px; top: 10%; left: 5%; animation-duration: 20s;"></div>
        <div class="path-hex yellow" style="width: 90px; height: 90px; top: 40%; right: 10%; animation-duration: 15s; animation-direction: reverse;"></div>
        <div class="path-hex gray" style="width: 180px; height: 180px; top: 75%; left: 15%; animation-duration: 25s;"></div>
        <div class="path-hex blue" style="width: 110px; height: 110px; top: 85%; right: 20%; animation-duration: 18s; animation-direction: reverse;"></div>
    </div>

    <div class="path-nodes">
        
        <svg class="path-line-svg-desktop path-line-anim" style="position: absolute; top: 42px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M -160 0 L -80 115 L 0 230 L 80 345 L 160 460 L 80 575" stroke="var(--abeja-gray-dark)" stroke-width="22" fill="none" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M -160 0 L -80 115 L 0 230 L 80 345" stroke="var(--primary-blue)" stroke-width="22" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <svg class="path-line-svg-mobile path-line-anim" style="position: absolute; top: 37px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M -60 0 L -30 115 L 0 230 L 30 345 L 60 460 L 30 575" stroke="var(--abeja-gray-dark)" stroke-width="18" fill="none" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M -60 0 L -30 115 L 0 230 L 30 345" stroke="var(--primary-blue)" stroke-width="18" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div class="node-wrapper offset-left-2 fade-in-node delay-2">
            <div class="mascot-zone zone-right">
                <img src="webp_animations/1.webp" class="mascot-img sound-nav" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-completed sound-nav">
                <button class="btn-hex"><i class="fa-solid fa-check"></i></button>
            </div>
        </div>
        
        <div class="node-wrapper offset-left-1 fade-in-node delay-3">
            <div class="btn-hex-wrapper state-completed sound-nav">
                <button class="btn-hex"><i class="fa-solid fa-check"></i></button>
            </div>
        </div>

        <div class="node-wrapper offset-center fade-in-node delay-4">
            <div class="btn-hex-wrapper state-chest sound-nav">
                <button class="btn-hex"><i class="fa-solid fa-box-open"></i></button>
            </div>
        </div>

        <div class="node-wrapper offset-right-1 fade-in-node delay-5">
            <div class="btn-hex-wrapper state-active sound-nav">
                <div class="tooltip-start">EMPEZAR</div>
                <div class="node-active-orbit">
                    <div class="node-active-ring"></div>
                </div>
                <button class="btn-hex"><i class="fa-solid fa-star"></i></button>
            </div>
        </div>

        <div class="node-wrapper offset-right-2 fade-in-node delay-6">
            <div class="mascot-zone zone-left">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-crown"></i></button>
            </div>
        </div>
        
        <div class="node-wrapper offset-right-1 fade-in-node delay-7">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-dumbbell"></i></button>
            </div>
        </div>

    </div>
</div>

<div class="section-sticky-header">
    <div class="section-banner banner-green fade-in-section delay-8">
        <div class="banner-text-col">
            <span>SECCIÓN 2, ÁLGEBRA AVANZADA</span>
            <h3>Sistemas de Ecuaciones</h3>
        </div>
        <div class="banner-img-col">
            <img src="https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=300&q=80" alt="Ciencia">
        </div>
    </div>
</div>

<div class="path-container">
    <div class="path-bg-hexagons">
        <div class="path-hex pastel-green" style="width: 150px; height: 150px; top: 15%; right: -20px; animation-duration: 22s;"></div>
        <div class="path-hex blue" style="width: 80px; height: 80px; top: 50%; left: 8%; animation-duration: 16s; animation-direction: reverse;"></div>
        <div class="path-hex pastel-green" style="width: 130px; height: 130px; top: 80%; right: 25%; animation-duration: 24s;"></div>
    </div>

    <div class="path-nodes">
        
        <svg class="path-line-svg-desktop path-line-anim" style="position: absolute; top: 42px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M 0 0 L -80 115 L -160 230 L -80 345 L 0 460 L 80 575" stroke="var(--abeja-gray-dark)" stroke-width="22" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <svg class="path-line-svg-mobile path-line-anim" style="position: absolute; top: 37px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M 0 0 L -30 115 L -60 230 L -30 345 L 0 460 L 30 575" stroke="var(--abeja-gray-dark)" stroke-width="18" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div class="node-wrapper offset-center fade-in-node delay-9">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-forward-step"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-left-1 fade-in-node delay-10">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-book-open"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-left-2 fade-in-node delay-11">
            <div class="mascot-zone zone-right">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-shield-halved"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-left-1 fade-in-node delay-12">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-bolt"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-center fade-in-node delay-13">
            <div class="mascot-zone zone-left">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-brain"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-right-1 fade-in-node delay-14">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-medal"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="section-sticky-header">
    <div class="section-banner banner-purple fade-in-section delay-15">
        <div class="banner-text-col">
            <span>SECCIÓN 3, GEOMETRÍA</span>
            <h3>Planos y Rectas</h3>
        </div>
        <div class="banner-img-col">
            <img src="https://images.unsplash.com/photo-1543286386-2e659306cd6c?auto=format&fit=crop&w=300&q=80" alt="Geometria">
        </div>
    </div>
</div>

<div class="path-container">
    <div class="path-bg-hexagons">
        <div class="path-hex blue" style="width: 100px; height: 100px; top: 12%; left: 15%; animation-duration: 19s; animation-direction: reverse;"></div>
        <div class="path-hex pastel-purple" style="width: 170px; height: 170px; top: 45%; right: 5%; animation-duration: 28s;"></div>
        <div class="path-hex blue" style="width: 120px; height: 120px; top: 85%; left: 20%; animation-duration: 21s; animation-direction: reverse;"></div>
    </div>

    <div class="path-nodes">
        
        <svg class="path-line-svg-desktop path-line-anim" style="position: absolute; top: 42px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M 0 0 L 80 115 L 160 230 L 80 345 L 0 460 L -80 575" stroke="var(--abeja-gray-dark)" stroke-width="22" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <svg class="path-line-svg-mobile path-line-anim" style="position: absolute; top: 37px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M 0 0 L 30 115 L 60 230 L 30 345 L 0 460 L -30 575" stroke="var(--abeja-gray-dark)" stroke-width="18" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div class="node-wrapper offset-center fade-in-node delay-16">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-shapes"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-right-1 fade-in-node delay-17">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-ruler-combined"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-right-2 fade-in-node delay-18">
            <div class="mascot-zone zone-left">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-compass"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-right-1 fade-in-node delay-19">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-calculator"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-center fade-in-node delay-20">
            <div class="mascot-zone zone-right">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-trophy"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-left-1 fade-in-node delay-21">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-flag-checkered"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const customCourseBtn = document.getElementById('customCourseBtn');
        const customCourseMenu = document.getElementById('customCourseMenu');

        if (customCourseBtn && customCourseMenu) {
            customCourseBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                customCourseMenu.classList.toggle('show');
            });

            if (!window.courseDropdownListenerAdded) {
                document.addEventListener('click', (e) => {
                    const currentBtn = document.getElementById('customCourseBtn');
                    const currentMenu = document.getElementById('customCourseMenu');
                    
                    if (currentBtn && currentMenu && !currentBtn.contains(e.target) && !currentMenu.contains(e.target)) {
                        currentMenu.classList.remove('show');
                    }
                });
                window.courseDropdownListenerAdded = true;
            }
        }

        document.querySelectorAll('.btn-hex-wrapper:not(.state-locked)').forEach(btn => {
            btn.addEventListener('click', function(e) {
                
                const hexBtn = this.querySelector('.btn-hex');
                const pulse = document.createElement('div');
                pulse.classList.add('click-pulse');
                hexBtn.appendChild(pulse);
                setTimeout(() => pulse.remove(), 500);

                const ripple = document.createElement('div');
                ripple.classList.add('click-ripple-3d');
                
                let activeOrbit = null;
                if(this.classList.contains('state-active')) {
                    ripple.style.borderColor = 'var(--primary-yellow-dark)';
                    
                    activeOrbit = this.querySelector('.node-active-orbit');
                    if (activeOrbit) {
                        activeOrbit.classList.remove('orbit-appear');
                        activeOrbit.classList.add('orbit-hidden');
                    }
                } else if (this.classList.contains('state-completed')) {
                    ripple.style.borderColor = 'var(--primary-blue)';
                } else if (this.classList.contains('state-chest')) {
                    ripple.style.borderColor = 'var(--secondary-orange-dark)';
                }
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                    if (activeOrbit) {
                        activeOrbit.classList.remove('orbit-hidden');
                        void activeOrbit.offsetWidth;
                        activeOrbit.classList.add('orbit-appear');
                    }
                }, 600);
                
            });
        });
    })();
</script>