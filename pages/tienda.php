<style>
    /* =========================================
       ESTILOS EXCLUSIVOS DE TIENDA.PHP
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
        --pastel-purple: #A569BD;
        --pastel-purple-dark: #8E44AD;
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
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .mobile-page-title-icon {
        font-size: 1.5rem;
        color: var(--primary-yellow-dark);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .mobile-page-title-divider {
        width: 2px;
        height: 30px;
        background-color: var(--abeja-gray-medium);
        border-radius: 2px;
    }
    .mobile-page-title-text {
        font-size: 1.6rem;
        font-weight: 900;
        color: var(--abeja-dark);
        margin: 0;
        letter-spacing: -0.5px;
    }

    /* --- ENCABEZADOS DE SECCIÓN --- */
    .section-header-row {
        display: flex; justify-content: space-between; align-items: center;
        margin: 45px 0 20px 0; padding-bottom: 15px; border-bottom: 2px solid var(--abeja-gray-medium);
    }
    .section-title { font-size: 1.4rem; font-weight: 900; color: var(--abeja-dark); margin: 0; }

    /* =========================================
       1. CARRUSEL DE ANUNCIOS (SWIPE INFINITO)
       ========================================= */
    .shop-carousel {
        background-color: var(--primary-blue-light);
        border-radius: 28px;
        position: relative;
        overflow: hidden;
        height: 100%;
        min-height: 220px;
        box-shadow: 0 4px 15px rgba(93, 173, 226, 0.15);
        cursor: grab;
        user-select: none;
        touch-action: pan-y;
    }
    .shop-carousel:active { cursor: grabbing; }

    .carousel-track {
        display: flex; height: 100%; 
        width: 500%; /* Ahora son 5 slides (3 originales + 2 clones) */
        transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .carousel-slide { width: 20%; display: flex; align-items: stretch; pointer-events: none; }
    .carousel-slide * { pointer-events: auto; } 

    .slide-left { flex: 1.2; padding: 30px; display: flex; flex-direction: column; justify-content: center; }
    .slide-title { font-size: 1.8rem; font-weight: 900; line-height: 1.1; margin-bottom: 10px; }
    .slide-subtitle { font-size: 1rem; font-weight: 800; opacity: 0.85; margin: 0; }

    .slide-divider { width: 3px; background-color: rgba(0,0,0,0.05); margin: 20px 0; border-radius: 2px; }

    .slide-right { flex: 0.8; padding: 20px; display: flex; align-items: center; justify-content: center; }
    .slide-right img {
        width: 100%; height: 100%; max-height: 160px; object-fit: cover; border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1); transition: transform 0.3s;
        pointer-events: none; -webkit-user-drag: none; 
    }
    .shop-carousel:hover .slide-right img { transform: scale(1.05) rotate(2deg); }

    .carousel-indicators { position: absolute; bottom: 15px; left: 30px; display: flex; gap: 8px; margin: 0; padding: 0; }
    .dot { width: 10px; height: 10px; border-radius: 5px; background-color: rgba(0,0,0,0.2); cursor: pointer; transition: all 0.3s; }
    .dot.active { background-color: var(--abeja-dark); width: 25px; }

    .bg-blue-slide { background-color: var(--primary-blue-light); color: var(--primary-blue-dark); }
    .bg-yellow-slide { background-color: #FFF9E6; color: var(--primary-yellow-text); }
    .bg-purple-slide { background-color: var(--pastel-purple-light); color: var(--pastel-purple-dark); }

    /* =========================================
       2. HEXÁGONOS DESTACADOS E ÍTEMS
       ========================================= */
    .featured-item-box {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 24px; padding: 20px;
        display: flex; align-items: center; gap: 20px; height: 100%;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02); transition: transform 0.2s; cursor: pointer;
    }
    .featured-item-box:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
    .featured-item-box:active { transform: translateY(0); }

    .featured-info { display: flex; flex-direction: column; justify-content: center; }
    .featured-info h4 { font-size: 1.15rem; font-weight: 900; color: var(--abeja-dark); margin: 0 0 5px 0; line-height: 1.1; }
    .featured-info span { 
        font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px;
        padding: 4px 10px; border-radius: 8px; display: inline-block; width: fit-content;
    }
    
    .quality-legendary { background-color: #FFF9E6; color: var(--primary-yellow-dark); }
    .quality-epic { background-color: var(--pastel-purple-light); color: var(--pastel-purple); }
    .quality-rare { background-color: var(--primary-blue-light); color: var(--primary-blue); }
    .quality-common { background-color: var(--abeja-gray-light); color: var(--abeja-text-muted); }

    .item-price { font-size: 0.9rem; font-weight: 900; color: var(--primary-yellow-text); margin-top: 6px; display: flex; align-items: center; gap: 4px; }
    .item-price i { color: var(--primary-yellow-dark); }

    .hex-icon-container { width: 85px; height: 95px; position: relative; flex-shrink: 0; }
    .hex-icon {
        width: 100%; height: 100%;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        display: flex; justify-content: center; align-items: center;
        font-size: 2.5rem; position: relative; z-index: 2;
    }
    
    .rareza-legendario .hex-icon-container { filter: drop-shadow(0 6px 0px var(--primary-yellow-dark)); }
    .rareza-legendario .hex-icon { background-color: #FFF9E6; }
    .rareza-epico .hex-icon-container { filter: drop-shadow(0 6px 0px var(--pastel-purple)); }
    .rareza-epico .hex-icon { background-color: var(--pastel-purple-light); }
    .rareza-raro .hex-icon-container { filter: drop-shadow(0 6px 0px var(--primary-blue)); }
    .rareza-raro .hex-icon { background-color: var(--primary-blue-light); }
    .rareza-comun .hex-icon-container { filter: drop-shadow(0 6px 0px var(--abeja-gray-dark)); }
    .rareza-comun .hex-icon { background-color: var(--abeja-gray-light); }
    .rareza-bloqueado .hex-icon-container { filter: drop-shadow(0 6px 0px var(--abeja-gray-medium)); }
    .rareza-bloqueado .hex-icon { background-color: var(--abeja-gray-light); color: var(--abeja-text-muted); }
    
    .item-locked { opacity: 0.7; pointer-events: none; position: relative; }
    .item-locked .hex-icon { filter: grayscale(100%); }
    .lock-overlay {
        position: absolute; top: -5px; right: -5px; 
        background: var(--abeja-dark); color: white; 
        padding: 4px 8px; border-radius: 8px; font-size: 0.75rem; font-weight: 900; z-index: 10;
        display: flex; align-items: center; gap: 5px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* Modificador para aprovechar tamaño en PC (Corona Destacada) */
    @media (min-width: 992px) {
        .hero-item-box {
            padding: 30px 40px;
            gap: 35px;
        }
        .hero-item-box .hex-icon-container {
            width: 130px; height: 145px;
        }
        .hero-item-box .hex-icon {
            font-size: 4.5rem;
        }
        .hero-item-box .featured-info h4 {
            font-size: 1.6rem;
            margin-bottom: 12px;
        }
        .hero-item-box .quality-legendary {
            font-size: 0.85rem;
            padding: 6px 12px;
        }
        .hero-item-box .item-price {
            font-size: 1.2rem;
            margin-top: 15px;
        }
    }

    /* =========================================
       3. POTENCIADORES (EN UNA SOLA COLUMNA)
       ========================================= */
    .booster-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 20px; padding: 22px;
        display: flex; gap: 20px; margin-bottom: 20px;
        transition: border-color 0.2s, transform 0.2s;
        cursor: pointer;
    }
    .booster-card:hover { border-color: var(--primary-blue); transform: translateY(-3px); }
    
    .booster-hex { width: 75px; height: 85px; font-size: 2.2rem; flex-shrink: 0; }

    .booster-info-box { flex-grow: 1; display: flex; flex-direction: column; justify-content: center; }
    .booster-info-box h5 { font-size: 1.15rem; font-weight: 900; color: var(--abeja-dark); margin: 0 0 6px 0; }
    
    .booster-desc { font-size: 0.9rem; font-weight: 700; color: var(--abeja-text-muted); line-height: 1.4; margin-bottom: 10px; }

    .booster-price-tag {
        display: flex; align-items: center; gap: 6px; font-weight: 900; color: var(--primary-yellow-text);
        padding-top: 10px; border-top: 2px dashed var(--abeja-gray-medium); font-size: 0.95rem; width: fit-content;
    }
    .booster-price-tag i { color: var(--primary-yellow-dark); } 

    /* =========================================
       4. MEGA PANAL Y ANIMACIÓN DE MIEL (MÁS GRANDE Y MISMA ALTURA)
       ========================================= */
    .mega-panal-wrapper {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        background-color: var(--abeja-white); border: 2px solid var(--abeja-gray-medium);
        border-radius: 24px; padding: 40px 20px; height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .mega-panal-hex {
        width: 100%; max-width: 300px; 
        aspect-ratio: 1 / 1.15;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        background-color: #FFFDF5;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='51.96' viewBox='0 0 30 51.96'%3E%3Cpath d='M30 12.99L15 4.33L0 12.99v25.98l15 8.66l15-8.66V12.99z' fill='none' stroke='%23E5B400' stroke-width='1.2' stroke-opacity='0.25'/%3E%3C/svg%3E");
        position: relative; display: flex; flex-direction: column; justify-content: center; align-items: center;
        text-align: center; padding: 20px; margin-bottom: 30px; box-shadow: inset 0 0 25px rgba(0,0,0,0.06);
    }

    .honey-liquid {
        position: absolute; bottom: 0; left: 0; width: 100%; height: 0%;
        background: linear-gradient(to top, var(--primary-yellow-dark), var(--primary-yellow));
        z-index: 1; transition: height 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .honey-wave-back {
        position: absolute; top: -16px; left: 0; width: 200%; height: 20px;
        background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 800 50" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,25 C100,50 200,0 400,25 C600,50 700,0 800,25 L800,50 L0,50 Z" fill="%23E5B400"/></svg>');
        background-size: 50% 100%; animation: wave-anim 4s linear infinite reverse; opacity: 0.8;
    }

    .honey-wave-front {
        position: absolute; top: -10px; left: 0; width: 200%; height: 15px;
        background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 800 50" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg"><path d="M0,25 C100,50 200,0 400,25 C600,50 700,0 800,25 L800,50 L0,50 Z" fill="%23FFE066"/></svg>');
        background-size: 50% 100%; animation: wave-anim 3s linear infinite;
    }

    @keyframes wave-anim {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .panal-content { position: relative; z-index: 2; color: var(--primary-yellow-text); pointer-events: none; }
    .panal-content i { font-size: 3rem; margin-bottom: 5px; color: #FFF; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.2)); }
    .panal-content h2 { font-size: 1.8rem; font-weight: 900; margin: 0; line-height: 1; text-shadow: 0 1px 3px rgba(255,255,255,0.8); }
    .panal-content p { font-size: 0.8rem; font-weight: 800; margin-top: 8px; opacity: 0.95; text-shadow: 0 1px 3px rgba(255,255,255,0.8); line-height: 1.2; }

    .progress-bar-bg { width: 100%; height: 18px; background-color: var(--abeja-gray-medium); border-radius: 9px; overflow: hidden; margin-bottom: 10px; }
    .progress-bar-fill { height: 100%; background-color: var(--primary-yellow-dark); border-radius: 9px; transition: width 1s ease; }
    .progress-text { font-size: 0.9rem; font-weight: 900; color: var(--abeja-text-muted); text-align: center; }

    /* =========================================
       RESPONSIVE DESIGN
       ========================================= */
    @media (max-width: 991px) {
        .shop-carousel { min-height: 180px; margin-bottom: 20px; }
        .slide-left { padding: 20px; }
        .slide-title { font-size: 1.4rem; }
        .slide-right { padding: 10px; }
        .slide-divider { display: none; }
        
        .mega-panal-wrapper { padding: 30px 15px; }
        .mega-panal-hex { max-width: 250px; margin-bottom: 25px; } 
    }
</style>

<div class="mobile-page-title-card d-lg-none fade-in-section">
    <div class="mobile-page-title-icon">
        <i class="fa-solid fa-store"></i>
    </div>
    <div class="mobile-page-title-divider"></div>
    <h2 class="mobile-page-title-text">Tienda</h2>
</div>

<div class="row g-4 fade-in-section">
    <div class="col-12 col-lg-7">
        <div class="shop-carousel sound-action" id="shopCarousel">
            <div class="carousel-track" id="shopCarouselTrack">
                
                <div class="carousel-slide bg-yellow-slide clone" id="clone-last">
                    <div class="slide-left">
                        <h2 class="slide-title">Racha Protegida</h2>
                        <p class="slide-subtitle">No pierdas tu progreso 🔥</p>
                    </div>
                    <div class="slide-divider"></div>
                    <div class="slide-right">
                        <img src="https://img.freepik.com/vector-gratis/etapas-progreso-desarrollo-personal-personas-crecimiento-personal-que-alcanzan-objetivos-profesionales-exito_513217-190.jpg" alt="Fuego" loading="eager">
                    </div>
                </div>

                <div class="carousel-slide bg-blue-slide" data-index="0">
                    <div class="slide-left">
                        <h2 class="slide-title">Pack Estudioso</h2>
                        <p class="slide-subtitle">Vidas infinitas por 2h 🚀</p>
                    </div>
                    <div class="slide-divider"></div>
                    <div class="slide-right">
                        <img src="https://img.freepik.com/fotos-premium/retrato-estudiante-feliz-mientras-lee-libro-biblioteca-escuela-estudiando-lecciones-examen-trabajo-duro-concepto-persistencia_530697-85732.jpg" alt="Estudioso" loading="eager">
                    </div>
                </div>

                <div class="carousel-slide bg-purple-slide" data-index="1">
                    <div class="slide-left">
                        <h2 class="slide-title">Estilo Galaxia</h2>
                        <p class="slide-subtitle">Personaliza tu avatar ✨</p>
                    </div>
                    <div class="slide-divider"></div>
                    <div class="slide-right">
                        <img src="https://images.unsplash.com/photo-1618365908648-e71bd5716cba?auto=format&fit=crop&w=400&q=80" alt="Galaxia" loading="eager">
                    </div>
                </div>

                <div class="carousel-slide bg-yellow-slide" data-index="2">
                    <div class="slide-left">
                        <h2 class="slide-title">Racha Protegida</h2>
                        <p class="slide-subtitle">No pierdas tu progreso 🔥</p>
                    </div>
                    <div class="slide-divider"></div>
                    <div class="slide-right">
                        <img src="https://img.freepik.com/vector-gratis/etapas-progreso-desarrollo-personal-personas-crecimiento-personal-que-alcanzan-objetivos-profesionales-exito_513217-190.jpg" alt="Fuego" loading="eager">
                    </div>
                </div>

                <div class="carousel-slide bg-blue-slide clone" id="clone-first">
                    <div class="slide-left">
                        <h2 class="slide-title">Pack Estudioso</h2>
                        <p class="slide-subtitle">Vidas infinitas por 2h 🚀</p>
                    </div>
                    <div class="slide-divider"></div>
                    <div class="slide-right">
                        <img src="https://img.freepik.com/fotos-premium/retrato-estudiante-feliz-mientras-lee-libro-biblioteca-escuela-estudiando-lecciones-examen-trabajo-duro-concepto-persistencia_530697-85732.jpg" alt="Estudioso" loading="eager">
                    </div>
                </div>

            </div>
            
            <div class="carousel-indicators">
                <div class="dot active" data-dot="0"></div>
                <div class="dot" data-dot="1"></div>
                <div class="dot" data-dot="2"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="featured-item-box hero-item-box rareza-legendario sound-item">
            <div class="hex-icon-container">
                <div class="hex-icon">👑</div>
            </div>
            <div class="featured-info">
                <h4>Corona de Oro</h4>
                <span class="quality-legendary">Legendario</span>
                <div class="item-price"><i class="fa-solid fa-droplet"></i> 8,500 Miel</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mt-1 fade-in-section delay-1">
    <div class="col-12 col-md-4">
        <div class="featured-item-box rareza-epico sound-item">
            <div class="hex-icon-container">
                <div class="hex-icon">🎄</div>
            </div>
            <div class="featured-info">
                <h4>Gorro Nevado</h4>
                <span class="quality-epic">Épico</span>
                <div class="item-price"><i class="fa-solid fa-droplet"></i> 4,000 Miel</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="featured-item-box rareza-raro sound-item">
            <div class="hex-icon-container">
                <div class="hex-icon">🎀</div>
            </div>
            <div class="featured-info">
                <h4>Moño Lujoso</h4>
                <span class="quality-rare">Raro</span>
                <div class="item-price"><i class="fa-solid fa-droplet"></i> 2,500 Miel</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="featured-item-box rareza-comun item-locked sound-locked">
            <div class="lock-overlay"><i class="fa-solid fa-lock"></i> Nvl 5</div>
            <div class="hex-icon-container">
                <div class="hex-icon">🕶️</div>
            </div>
            <div class="featured-info">
                <h4>Lentes Cool</h4>
                <span class="quality-common">Común</span>
                <div class="item-price" style="color:var(--abeja-gray-dark);"><i class="fa-solid fa-droplet" style="color:var(--abeja-gray-dark);"></i> 500 Miel</div>
            </div>
        </div>
    </div>
</div>

<div class="row fade-in-section delay-2 mt-4">
    
    <div class="col-12 col-lg-6 order-2 order-lg-1 mt-4 mt-lg-0 d-flex flex-column">
        
        <div class="section-header-row mt-0 mb-4" style="border-bottom: 2px solid var(--abeja-gray-medium); padding-bottom: 15px;">
            <h3 class="section-title">Potenciadores</h3>
        </div>
        
        <div class="row pe-lg-4 flex-grow-1 align-content-start">
            
            <div class="col-12">
                <div class="booster-card sound-item rareza-raro">
                    <div class="hex-icon-container booster-hex">
                        <div class="hex-icon">❄️</div>
                    </div>
                    <div class="booster-info-box">
                        <h5>Congelador</h5>
                        <div class="booster-desc">
                            Congela tu racha por 1 día completo. Ideal si no podrás estudiar hoy y no quieres perder tu progreso actual.
                        </div>
                        <div class="booster-price-tag">
                            <i class="fa-solid fa-droplet"></i> 200 Miel
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="booster-card sound-item rareza-epico">
                    <div class="hex-icon-container booster-hex">
                        <div class="hex-icon">⏱️</div>
                    </div>
                    <div class="booster-info-box">
                        <h5>Doble EXP</h5>
                        <div class="booster-desc">
                            Obtén el doble de experiencia en todas las lecciones completadas durante los próximos 15 minutos.
                        </div>
                        <div class="booster-price-tag">
                            <i class="fa-solid fa-droplet"></i> 450 Miel
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="booster-card sound-item rareza-comun">
                    <div class="hex-icon-container booster-hex">
                        <div class="hex-icon">❤️</div>
                    </div>
                    <div class="booster-info-box">
                        <h5>Rellenar Vidas</h5>
                        <div class="booster-desc">
                            Recupera tus 5 vidas de inmediato para seguir intentando los retos sin tener que esperar.
                        </div>
                        <div class="booster-price-tag">
                            <i class="fa-solid fa-droplet"></i> 150 Miel
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="booster-card rareza-bloqueado item-locked sound-locked" style="margin-bottom: 0;">
                    <div class="lock-overlay"><i class="fa-solid fa-lock"></i> Nvl 10</div>
                    <div class="hex-icon-container booster-hex">
                        <div class="hex-icon">🛡️</div>
                    </div>
                    <div class="booster-info-box">
                        <h5>Escudo de Error</h5>
                        <div class="booster-desc">
                            Te protege de perder una vida si te equivocas en una pregunta de jefe final.
                        </div>
                        <div class="booster-price-tag" style="color:var(--abeja-text-muted);">
                            <i class="fa-solid fa-droplet" style="color:var(--abeja-gray-dark);"></i> ??? Miel
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-12 col-lg-6 order-1 order-lg-2 d-flex flex-column">
        
        <div class="section-header-row mt-0 mb-4" style="border-bottom: 2px solid var(--abeja-gray-medium); padding-bottom: 15px;">
            <h3 class="section-title">Evento Global</h3>
        </div>

        <div class="mega-panal-wrapper flex-grow-1">
            <div class="mega-panal-hex sound-action" style="cursor:pointer;" title="¡Toca para donar miel!">
                <div class="honey-liquid" id="honeyLiquidElement">
                    <div class="honey-wave-back"></div>
                    <div class="honey-wave-front"></div>
                </div>
                
                <div class="panal-content">
                    <i class="fa-solid fa-droplet"></i>
                    <h2>Miel</h2>
                    <p>Tus aportaciones rellenan la miel del panal global.</p>
                </div>
            </div>

            <div style="width: 100%; padding: 0 10px;">
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" id="honeyBarFill" style="width: 0%;"></div>
                </div>
                <div class="progress-text">
                    <span id="honeyCounter">0</span> / 10,000 Miel
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mt-2 mb-5 fade-in-section delay-3">
    <div class="col-12 col-md-4">
        <div class="featured-item-box rareza-bloqueado item-locked sound-locked">
             <div class="lock-overlay"><i class="fa-solid fa-lock"></i> Nvl 15</div>
            <div class="hex-icon-container">
                <div class="hex-icon">🚀</div>
            </div>
            <div class="featured-info">
                <h4>Salto de Nivel</h4>
                <span class="quality-common">Legendario</span>
                <div class="item-price" style="color:var(--abeja-gray-dark);"><i class="fa-solid fa-droplet" style="color:var(--abeja-gray-dark);"></i> ??? Miel</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="featured-item-box rareza-bloqueado item-locked sound-locked">
            <div class="lock-overlay"><i class="fa-solid fa-lock"></i> Nvl 20</div>
            <div class="hex-icon-container">
                <div class="hex-icon">🔮</div>
            </div>
            <div class="featured-info">
                <h4>Orbe de Visión</h4>
                <span class="quality-common">Épico</span>
                <div class="item-price" style="color:var(--abeja-gray-dark);"><i class="fa-solid fa-droplet" style="color:var(--abeja-gray-dark);"></i> ??? Miel</div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        // --- 1. Lógica del Carrusel Automático INFINITO ---
        const carousel = document.getElementById('shopCarousel');
        const track = document.getElementById('shopCarouselTrack');
        const dots = document.querySelectorAll('.carousel-indicators .dot');
        
        let currentIndex = 1; // 0 = Clon 3, 1 = Original 1, 2 = Original 2, 3 = Original 3, 4 = Clon 1
        const slidesCount = 3; 
        const totalTrackSlides = 5; 
        let slideInterval;
        let isTransitioning = false;
        
        let isDragging = false;
        let startX = 0;
        let movedByPx = 0;
        let prevTranslatePercent = 0;

        // Actualizamos la posición inicial al cargar (Sin animación)
        updateSlide(currentIndex, false);

        function updateSlide(index, animate = true) {
            currentIndex = index;
            if(track) {
                track.style.transition = animate ? 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)' : 'none';
                track.style.transform = `translateX(-${(currentIndex * 100) / totalTrackSlides}%)`;
            }
            
            // Lógica para iluminar el punto correcto ignorando los clones
            let realIndex = currentIndex - 1;
            if (realIndex === -1) realIndex = slidesCount - 1; // Si es el clon inicial, es el último real
            if (realIndex === slidesCount) realIndex = 0; // Si es el clon final, es el primer real
            
            dots.forEach(dot => dot.classList.remove('active'));
            if(dots[realIndex]) dots[realIndex].classList.add('active');
        }

        // Magia del Carrusel Infinito: Salto silencioso al terminar la transición
        track.addEventListener('transitionend', () => {
            isTransitioning = false;
            if (currentIndex === 0) {
                // Llegó al clon del final por la izquierda, saltamos silenciosamente al original del final
                updateSlide(slidesCount, false);
            } else if (currentIndex === totalTrackSlides - 1) {
                // Llegó al clon del inicio por la derecha, saltamos silenciosamente al original del inicio
                updateSlide(1, false);
            }
        });

        function nextSlide() {
            if (isTransitioning) return;
            isTransitioning = true;
            updateSlide(currentIndex + 1, true);
        }

        function prevSlide() {
            if (isTransitioning) return;
            isTransitioning = true;
            updateSlide(currentIndex - 1, true);
        }

        function startCarousel() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 4500); 
        }

        function stopCarousel() { clearInterval(slideInterval); }

        // Eventos de los Puntos (Dots)
        if(dots.length > 0) {
            dots.forEach((dot, idx) => {
                dot.addEventListener('click', () => {
                    if (isTransitioning) return;
                    stopCarousel();
                    updateSlide(idx + 1, true); // +1 porque el índice 0 es un clon
                    startCarousel(); 
                });
            });
        }

        // Lógica de Swiping/Drag Fluidos
        function getPositionX(e) {
            return e.type.includes('mouse') ? e.pageX : e.touches[0].clientX;
        }

        function touchStart(e) {
            if (isTransitioning) return; // Evita bugs si arrastras durante animación
            stopCarousel();
            isDragging = true;
            startX = getPositionX(e);
            movedByPx = 0;
            track.style.transition = 'none';
            prevTranslatePercent = -(currentIndex * 100) / totalTrackSlides;
        }

        function touchMove(e) {
            if (!isDragging) return;
            const currentPosition = getPositionX(e);
            movedByPx = currentPosition - startX;
            const movedByPercent = (movedByPx / carousel.clientWidth) * (100 / totalTrackSlides);
            track.style.transform = `translateX(${prevTranslatePercent + movedByPercent}%)`;
        }

        function touchEnd() {
            if (!isDragging) return;
            isDragging = false;
            
            // Decidimos hacia dónde animar según qué tanto arrastró
            if (movedByPx < -50) {
                nextSlide();
            } else if (movedByPx > 50) {
                prevSlide();
            } else {
                // Si no se movió lo suficiente, regresamos a donde estaba
                updateSlide(currentIndex, true);
            }
            startCarousel();
        }

        if(carousel) {
            carousel.addEventListener('mousedown', touchStart);
            carousel.addEventListener('mousemove', touchMove);
            carousel.addEventListener('mouseup', touchEnd);
            carousel.addEventListener('mouseleave', () => {
                if(isDragging) touchEnd();
                startCarousel();
            });
            carousel.addEventListener('mouseenter', stopCarousel);

            carousel.addEventListener('touchstart', touchStart, {passive: true});
            carousel.addEventListener('touchmove', touchMove, {passive: true});
            carousel.addEventListener('touchend', touchEnd);
        }
        
        startCarousel();

        // --- 2. Animación Inicial del Mega Panal de Miel ---
        setTimeout(() => {
            const targetPercentage = 68; // 68% de progreso
            const targetMiel = 6800; // Valor numérico

            const liquidElement = document.getElementById('honeyLiquidElement');
            const barFill = document.getElementById('honeyBarFill');
            const counter = document.getElementById('honeyCounter');

            if(liquidElement && barFill && counter) {
                liquidElement.style.height = `${targetPercentage}%`;
                barFill.style.width = `${targetPercentage}%`;

                let currentNum = 0;
                const increment = Math.ceil(targetMiel / 60); 
                const counterInterval = setInterval(() => {
                    currentNum += increment;
                    if(currentNum >= targetMiel) {
                        currentNum = targetMiel;
                        clearInterval(counterInterval);
                    }
                    counter.innerText = currentNum.toLocaleString();
                }, 16);
            }
        }, 300);

        // --- 3. Scroll al inicio al cargar mediante fetch ---
        const dynamicContent = document.getElementById('dynamic-content');
        if(dynamicContent) {
            dynamicContent.scrollTop = 0;
        }
    })();
</script>