<style>
    /* =========================================
       ESTILOS EXCLUSIVOS DE MISIONES.PHP
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
        --pastel-purple: #A569BD;
        --pastel-purple-light: #F5EEF8;

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

    /* Título Móvil Superior (Estilo Tarjeta) */
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
        color: var(--primary-yellow-dark);
        display: flex; align-items: center; justify-content: center;
    }
    .mobile-page-title-divider {
        width: 2px; height: 30px; background-color: var(--abeja-gray-medium); border-radius: 2px;
    }
    .mobile-page-title-text {
        font-size: 1.6rem; font-weight: 900; color: var(--abeja-dark); margin: 0; letter-spacing: -0.5px;
    }

    /* --- ENCABEZADOS DE SECCIÓN --- */
    .section-header-row {
        display: flex; justify-content: space-between; align-items: center;
        margin: 0 0 20px 0; padding-bottom: 15px; border-bottom: 2px solid var(--abeja-gray-medium);
    }
    .section-title { font-size: 1.4rem; font-weight: 900; color: var(--abeja-dark); margin: 0; }

    /* =========================================
       1. CABECERA DE MISIONES DIARIAS
       ========================================= */
    .daily-header-card {
        background-color: #FFFDF5;
        border: 2px solid var(--primary-yellow-dark);
        border-radius: 24px;
        padding: 25px;
        margin-bottom: 20px; 
        box-shadow: 0 8px 20px rgba(229, 180, 0, 0.1);
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
    }
    .daily-header-title { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
    .daily-header-icon {
        width: 50px; height: 50px; border-radius: 14px;
        background-color: var(--primary-yellow); color: var(--primary-yellow-text);
        display: flex; justify-content: center; align-items: center; font-size: 1.6rem;
    }
    .daily-header-title h3 { font-size: 1.6rem; font-weight: 900; color: var(--primary-yellow-text); margin: 0; }

    .daily-header-progress-bg { width: 100%; height: 12px; background-color: rgba(229, 180, 0, 0.2); border-radius: 6px; overflow: hidden; margin-bottom: 8px; }
    /* Ancho inicial en 0% para que la animación fluya desde el principio */
    .daily-header-progress-fill { width: 0%; height: 100%; background-color: var(--primary-yellow-dark); border-radius: 6px; transition: width 1s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    .daily-header-text { font-size: 0.9rem; font-weight: 900; color: var(--primary-yellow-text); text-align: right; }

    /* =========================================
       2. TARJETAS DE MISIONES
       ========================================= */
    .mission-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 20px;
        position: relative;
        overflow: hidden; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        margin-bottom: 0; 
    }
    .mission-card:hover:not(.mission-completed) { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.06); border-color: var(--primary-blue); }

    .mission-content {
        display: flex;
        align-items: center;
        padding: 20px;
        gap: 15px;
        flex-grow: 1;
    }

    .mission-icon-box {
        width: 55px; height: 55px; border-radius: 16px;
        background-color: var(--primary-blue-light); color: var(--primary-blue);
        display: flex; justify-content: center; align-items: center; font-size: 1.5rem; flex-shrink: 0;
    }

    .mission-divider {
        width: 2px; align-self: stretch; background-color: var(--abeja-gray-medium); border-radius: 2px;
    }

    .mission-info { flex-grow: 1; }
    .mission-info h4 { font-size: 1.1rem; font-weight: 900; color: var(--abeja-dark); margin: 0 0 4px 0; line-height: 1.2; }
    .mission-info p { font-size: 0.85rem; font-weight: 700; color: var(--abeja-text-muted); margin: 0; line-height: 1.3; }

    .mission-reward {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        background-color: #FFF9E6; padding: 8px 12px; border-radius: 12px; flex-shrink: 0;
    }
    .mission-reward span { font-size: 0.85rem; font-weight: 900; color: var(--primary-yellow-text); }
    .mission-reward i { font-size: 1rem; color: var(--primary-yellow-dark); margin-top: 2px; }

    .mission-bottom-bar-bg { width: 100%; height: 6px; background-color: var(--abeja-gray-medium); flex-shrink: 0; }
    /* Ancho inicial en 0% */
    .mission-bottom-bar-fill { width: 0%; height: 100%; background-color: var(--primary-blue); transition: width 1s ease; }

    /* Estado Completado */
    .mission-completed {
        background-color: var(--abeja-gray-light);
        border-color: var(--abeja-gray-medium);
        opacity: 0.65;
    }
    .mission-completed .mission-icon-box { background-color: var(--abeja-gray-medium); color: var(--abeja-text-muted); }
    .mission-completed .mission-info h4, .mission-completed .mission-info p { color: var(--abeja-text-muted); }
    .mission-completed .mission-reward { background-color: var(--abeja-gray-medium); filter: grayscale(100%); }
    .mission-completed .mission-reward span { color: var(--abeja-text-muted); }
    .mission-completed .mission-bottom-bar-fill { background-color: var(--abeja-text-muted); }

    /* Variante Misiones Grupales */
    .group-mission:hover:not(.mission-completed) { border-color: var(--pastel-green); }
    .group-mission .mission-icon-box { background-color: var(--pastel-green-light); color: var(--pastel-green); }
    .group-mission .mission-bottom-bar-fill { background-color: var(--pastel-green); }

    /* =========================================
       3. TARJETAS DE RECOMPENSAS
       ========================================= */
    .reward-header-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 20px;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        flex-shrink: 0;
    }
    .reward-header-icon {
        font-size: 1.5rem;
        color: var(--pastel-purple);
        display: flex; align-items: center; justify-content: center;
    }
    .reward-header-divider {
        width: 2px; height: 30px; background-color: var(--abeja-gray-medium); border-radius: 2px;
    }
    .reward-header-text {
        font-size: 1.4rem; font-weight: 900; color: var(--abeja-dark); margin: 0; letter-spacing: -0.5px;
    }

    .reward-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 20px; padding: 15px 20px;
        display: flex; align-items: center; gap: 15px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: transform 0.2s, border-color 0.2s, box-shadow 0.2s; cursor: pointer;
    }
    .reward-card:hover { transform: translateY(-3px); border-color: var(--pastel-purple); box-shadow: 0 8px 20px rgba(0,0,0,0.06); }

    .reward-hex-container { 
        width: 65px; height: 75px; position: relative; flex-shrink: 0;
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
    }
    .reward-card:hover .reward-hex-container { transform: scale(1.05) translateY(-2px); }

    .reward-hex {
        width: 100%; height: 100%;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        display: flex; justify-content: center; align-items: center;
        font-size: 1.8rem; position: relative; z-index: 2;
    }

    /* Animación flotante para los emojis */
    @keyframes float-emoji {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }
    .animated-emoji { animation: float-emoji 3s ease-in-out infinite; }

    /* Efecto 3D Fuerte (Corrección de Selector Aplicada) */
    .reward-card .reward-hex-container.rareza-epico { filter: drop-shadow(0 8px 0px var(--pastel-purple)); }
    .reward-card .reward-hex-container.rareza-epico .reward-hex { background-color: var(--pastel-purple-light); }
    
    .reward-card .reward-hex-container.rareza-legendario { filter: drop-shadow(0 8px 0px var(--primary-yellow-dark)); }
    .reward-card .reward-hex-container.rareza-legendario .reward-hex { background-color: #FFF9E6; }

    .reward-card .reward-hex-container.rareza-comun { filter: drop-shadow(0 8px 0px var(--abeja-gray-dark)); }
    .reward-card .reward-hex-container.rareza-comun .reward-hex { background-color: var(--abeja-gray-light); }

    .reward-info { flex-grow: 1; }
    .reward-info h4 { font-size: 1.05rem; font-weight: 900; color: var(--abeja-dark); margin: 0 0 2px 0; }
    .reward-info p { font-size: 0.8rem; font-weight: 700; color: var(--abeja-text-muted); margin: 0; line-height: 1.2; }

    .reward-action { flex-shrink: 0; }
    .btn-claim {
        background-color: var(--pastel-purple-light); color: var(--pastel-purple-dark);
        border: 2px solid var(--pastel-purple); border-radius: 12px;
        padding: 6px 12px; font-weight: 900; font-size: 0.85rem; transition: all 0.2s; white-space: nowrap;
    }
    .btn-claim:hover { background-color: var(--pastel-purple); color: white; }
    
    .btn-locked {
        background-color: var(--abeja-gray-light); color: var(--abeja-text-muted);
        border: 2px solid var(--abeja-gray-medium); border-radius: 12px;
        padding: 6px 12px; font-weight: 900; font-size: 0.85rem; pointer-events: none; white-space: nowrap;
    }

    /* =========================================
       RESPONSIVE DESIGN Y AJUSTES PC/TABLET
       ========================================= */
    @media (min-width: 992px) {
        .mission-content { padding: 25px 25px; }
        .mission-icon-box { width: 65px; height: 65px; font-size: 1.8rem; }
        .mission-info h4 { font-size: 1.25rem; margin-bottom: 6px; }
        .mission-info p { font-size: 0.95rem; }

        .reward-card {
            padding: 25px 25px;
            gap: 20px;
        }
        .reward-hex-container { width: 85px; height: 95px; }
        .reward-hex { font-size: 2.5rem; }
        .reward-info h4 { font-size: 1.3rem; margin-bottom: 5px; }
        .reward-info p { font-size: 0.95rem; }
        .btn-claim, .btn-locked { padding: 10px 18px; font-size: 1rem; border-radius: 14px; }
    }

    /* Solución para pantallas de PC medianas (Evita que los botones colisionen) */
    @media (min-width: 992px) and (max-width: 1250px) {
        .reward-card {
            flex-direction: column;
            text-align: center;
            justify-content: center;
            gap: 15px;
            padding: 20px;
        }
        .reward-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .reward-action {
            margin-top: 5px;
        }
    }

    /* Solución para Misiones Grupales en pantallas medias (Tablet/Medias) */
    @media (min-width: 768px) and (max-width: 1199px) {
        .group-mission .mission-content {
            flex-direction: column;
            text-align: center;
            justify-content: center;
            gap: 10px;
            padding: 20px 15px;
        }
        .group-mission .mission-divider {
            width: 80%;
            height: 2px;
            margin: 5px 0;
        }
        .group-mission .mission-info h4 { font-size: 1.05rem; }
        .group-mission .mission-info p { font-size: 0.8rem; }
    }

    @media (max-width: 991px) {
        .daily-header-card { padding: 20px; }
        .daily-header-title h3 { font-size: 1.4rem; }
        .mission-content { padding: 15px; gap: 10px; }
        .mission-divider { margin: 0 5px; }
        .reward-header-card { margin-top: 15px; }
    }
</style>

<div class="mobile-page-title-card d-lg-none fade-in-section">
    <div class="mobile-page-title-icon">
        <i class="fa-solid fa-crosshairs"></i>
    </div>
    <div class="mobile-page-title-divider"></div>
    <h2 class="mobile-page-title-text">Misiones</h2>
</div>

<div class="row g-4 fade-in-section align-items-stretch">
    
    <div class="col-12 col-lg-7">
        <div class="d-flex flex-column h-100">
            
            <div class="daily-header-card sound-item">
                <div class="daily-header-title">
                    <div class="daily-header-icon"><i class="fa-solid fa-calendar-day"></i></div>
                    <h3>Misiones Diarias</h3>
                </div>
                <div class="daily-header-progress-bg">
                    <div class="daily-header-progress-fill progress-anim" data-target="33%"></div>
                </div>
                <div class="daily-header-text">1 / 3 Completadas</div>
            </div>

            <div class="d-flex flex-column flex-grow-1 gap-3">
                
                <div class="mission-card mission-completed sound-item flex-grow-1">
                    <div class="mission-content">
                        <div class="mission-icon-box"><i class="fa-solid fa-check-double"></i></div>
                        <div class="mission-divider"></div>
                        <div class="mission-info">
                            <h4>Inicia sesión hoy</h4>
                            <p>Entra a Abeja GO para mantener tu racha activa.</p>
                        </div>
                        <div class="mission-reward">
                            <span>+10</span> <i class="fa-solid fa-droplet text-warning"></i>
                        </div>
                    </div>
                    <div class="mission-bottom-bar-bg">
                        <div class="mission-bottom-bar-fill progress-anim" data-target="100%"></div>
                    </div>
                </div>

                <div class="mission-card sound-item flex-grow-1">
                    <div class="mission-content">
                        <div class="mission-icon-box"><i class="fa-solid fa-book-open"></i></div>
                        <div class="mission-divider"></div>
                        <div class="mission-info">
                            <h4>Completa 2 Lecciones</h4>
                            <p>Avanza en tu ruta de Álgebra Fundamental.</p>
                        </div>
                        <div class="mission-reward">
                            <span>+50</span> <i class="fa-solid fa-droplet text-warning"></i>
                        </div>
                    </div>
                    <div class="mission-bottom-bar-bg">
                        <div class="mission-bottom-bar-fill progress-anim" data-target="50%"></div>
                    </div>
                </div>

                <div class="mission-card sound-item flex-grow-1">
                    <div class="mission-content">
                        <div class="mission-icon-box"><i class="fa-solid fa-star"></i></div>
                        <div class="mission-divider"></div>
                        <div class="mission-info">
                            <h4>Logra racha perfecta</h4>
                            <p>Responde 10 preguntas seguidas sin equivocarte.</p>
                        </div>
                        <div class="mission-reward">
                            <span>+100</span> <i class="fa-solid fa-droplet text-warning"></i>
                        </div>
                    </div>
                    <div class="mission-bottom-bar-bg">
                        <div class="mission-bottom-bar-fill progress-anim" data-target="20%"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="d-flex flex-column h-100">
            
            <div class="reward-header-card sound-item">
                <div class="reward-header-icon">
                    <i class="fa-solid fa-gift"></i>
                </div>
                <div class="reward-header-divider"></div>
                <h3 class="reward-header-text">Recompensas</h3>
            </div>

            <div class="d-flex flex-column flex-grow-1 gap-3">
                
                <div class="reward-card sound-action flex-grow-1">
                    <div class="reward-hex-container rareza-epico">
                        <div class="reward-hex"><span class="animated-emoji">🎁</span></div>
                    </div>
                    <div class="reward-info">
                        <h4>Cofre Semanal</h4>
                        <p>Completa 10 diarias.</p>
                    </div>
                    <div class="reward-action">
                        <button class="btn-locked"><i class="fa-solid fa-lock"></i> 3/10</button>
                    </div>
                </div>

                <div class="reward-card sound-action flex-grow-1">
                    <div class="reward-hex-container rareza-legendario">
                        <div class="reward-hex"><span class="animated-emoji">🍯</span></div>
                    </div>
                    <div class="reward-info">
                        <h4>Tarro de Miel</h4>
                        <p>Juega 7 días seguidos.</p>
                    </div>
                    <div class="reward-action">
                        <button class="btn-claim">Reclamar</button>
                    </div>
                </div>

                <div class="reward-card sound-action flex-grow-1">
                    <div class="reward-hex-container rareza-comun">
                        <div class="reward-hex"><span class="animated-emoji">👔</span></div>
                    </div>
                    <div class="reward-info">
                        <h4>Estilo Elegante</h4>
                        <p>Llega a Nivel 10.</p>
                    </div>
                    <div class="reward-action">
                        <button class="btn-locked"><i class="fa-solid fa-lock"></i> Nvl 5</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="section-header-row mt-5 mb-4 fade-in-section delay-2">
    <h3 class="section-title">Misiones Grupales</h3>
</div>

<div class="row g-4 mb-5 fade-in-section delay-3">
    
    <div class="col-12 col-md-6 col-lg-4">
        <div class="mission-card group-mission sound-item h-100">
            <div class="mission-content">
                <div class="mission-icon-box"><i class="fa-solid fa-users"></i></div>
                <div class="mission-divider"></div>
                <div class="mission-info">
                    <h4>Esfuerzo de Aula</h4>
                    <p>Logren 500 lecciones entre todo el grupo.</p>
                </div>
            </div>
            <div class="mission-bottom-bar-bg">
                <div class="mission-bottom-bar-fill progress-anim" data-target="75%"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="mission-card group-mission sound-item h-100">
            <div class="mission-content">
                <div class="mission-icon-box"><i class="fa-solid fa-bullseye"></i></div>
                <div class="mission-divider"></div>
                <div class="mission-info">
                    <h4>Precisión Grupal</h4>
                    <p>Mantengan 80% de aciertos grupales hoy.</p>
                </div>
            </div>
            <div class="mission-bottom-bar-bg">
                <div class="mission-bottom-bar-fill progress-anim" data-target="40%"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="mission-card group-mission sound-item h-100">
            <div class="mission-content">
                <div class="mission-icon-box"><i class="fa-solid fa-ranking-star"></i></div>
                <div class="mission-divider"></div>
                <div class="mission-info">
                    <h4>Top 3 Escolar</h4>
                    <p>Ubiquen a su grupo en el Top 3 de la escuela.</p>
                </div>
            </div>
            <div class="mission-bottom-bar-bg">
                <div class="mission-bottom-bar-fill progress-anim" data-target="90%"></div>
            </div>
        </div>
    </div>

</div>

<script>
    (function() {
        // --- 1. Animación fluida de las Barras de Progreso ---
        // Se espera un instante para que el navegador procese el ancho 0 inicial y anime hacia el target
        setTimeout(() => {
            const progressBars = document.querySelectorAll('.progress-anim');
            progressBars.forEach(bar => {
                const targetWidth = bar.getAttribute('data-target');
                if (targetWidth) {
                    bar.style.width = targetWidth;
                }
            });
        }, 150);

        // --- 2. Scroll al inicio al cargar mediante fetch ---
        const dynamicContent = document.getElementById('dynamic-content');
        if(dynamicContent) {
            dynamicContent.scrollTop = 0;
        }
    })();
</script>