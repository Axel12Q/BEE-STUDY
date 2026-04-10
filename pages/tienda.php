<style>
    /* =========================================
       ESTILOS EXCLUSIVOS DE LA TIENDA (V3)
       ========================================= */
       
    /* Carrusel y Anuncios */
    .shop-banner-card {
        border-radius: 24px;
        overflow: hidden;
        border: 2px solid var(--abeja-gray-medium);
        border-bottom: 5px solid var(--abeja-gray-medium);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: var(--abeja-white);
    }

    .shop-banner-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .banner-layout {
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 380px;
    }

    .banner-text-zone {
        padding: 30px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .banner-img-zone {
        width: 100%;
        height: 180px;
        background-size: cover;
        background-position: center;
    }

    .bg-blue-banner { background-color: var(--primary-blue); }
    .bg-yellow-banner { background-color: var(--primary-yellow); }
    .bg-orange-banner { background-color: var(--secondary-orange); }

    .banner-text-light { color: #ffffff; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); }
    .banner-text-dark { color: var(--abeja-dark); }

    @media (min-width: 768px) {
        .banner-layout { flex-direction: row; min-height: 280px; }
        .banner-text-zone { width: 55%; padding: 40px; align-items: flex-start; text-align: left; }
        .banner-img-zone { width: 45%; height: auto; clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%); }
        
    }
    @media (min-width: 768px) and (max-width: 991px) {
        .text-md-start {
            padding-left: 50px !important;
        }
    }

    .carousel-indicators [data-bs-target] {
        width: 12px; height: 12px; border-radius: 50%;
        background-color: rgba(0,0,0,0.3); border: none; margin: 0 6px;
    }
    .carousel-indicators .active {
        background-color: white; box-shadow: 0 0 5px rgba(0,0,0,0.5);
    }

    /* Tarjetas Horizontales - Efecto Premium Gamificado */
    .shop-item-card-hz {
        display: flex; flex-direction: row; align-items: center;
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-bottom: 5px solid var(--abeja-gray-medium);
        border-radius: 20px; padding: 15px 20px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        gap: 15px; height: 100%;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    /* Efecto de Brillo al pasar el mouse (Shine) */
    .shop-item-card-hz::before {
        content: ''; position: absolute; top: 0; left: -100%; width: 50%; height: 100%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
        transform: skewX(-25deg); transition: all 0.6s ease; z-index: 1;
    }

    .shop-item-card-hz:hover {
        transform: translateY(-5px); 
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: var(--primary-yellow);
        border-bottom-color: var(--secondary-orange);
    }
    
    .shop-item-card-hz:hover::before {
        left: 200%;
    }

    .item-icon-wrapper-hz {
        width: 65px; height: 65px; border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 2.2rem; flex-shrink: 0; border: 2px solid #E5E5E5;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative; z-index: 2;
    }
    
    .shop-item-card-hz:hover .item-icon-wrapper-hz {
        transform: scale(1.15) rotate(5deg); 
        border-color: var(--primary-yellow);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
    }

    .item-details-hz { flex-grow: 1; text-align: left; position: relative; z-index: 2; }
    .item-action-hz { flex-shrink: 0; text-align: right; display: flex; flex-direction: column; align-items: flex-end; position: relative; z-index: 2; }

    /* Modal Styles - Efecto Latido */
    @keyframes pulse-glow {
        0% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.6); }
        70% { box-shadow: 0 0 0 25px rgba(255, 193, 7, 0); }
        100% { box-shadow: 0 0 0 0 rgba(255, 193, 7, 0); }
    }

    .modal-cosmetic-icon {
        width: 120px; height: 120px; border-radius: 30px;
        display: flex; align-items: center; justify-content: center;
        font-size: 4rem; background-color: #F7F9FA;
        border: 4px solid var(--primary-yellow); 
        margin: 0 auto;
        animation: pulse-glow 2s infinite;
    }
    @media (min-width: 768px) {
        .modal-cosmetic-icon { width: 180px; height: 180px; font-size: 6rem; }
    }

    .btn-buy-modal {
        background: linear-gradient(135deg, var(--primary-blue), #1A5F7A); 
        color: white; font-weight: 900; font-size: 1.1rem;
        border: none; border-bottom: 5px solid #114256;
        border-radius: 16px; padding: 14px 25px; width: 100%;
        transition: all 0.2s ease;
        text-transform: uppercase; letter-spacing: 1px;
    }
    .btn-buy-modal:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(26, 95, 122, 0.3);
    }
    .btn-buy-modal:active { transform: translateY(3px); border-bottom-width: 2px; margin-bottom: 3px; box-shadow: none; }

    .rec-item {
        width: 60px; height: 60px; border-radius: 15px;
        background: #F0F0F0; display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; cursor: pointer; transition: all 0.2s; border: 2px solid transparent;
    }
    .rec-item:hover { transform: scale(1.15) translateY(-5px); border-color: var(--primary-blue); background: #e5f6f9; }

    /* =========================================
       EL GRAN PANAL (Bucle Perfecto de Miel)
       ========================================= */
    .big-honeycomb-wrapper {
        display: flex; justify-content: center; padding: 20px 0;
        perspective: 1000px;
    }

    .honey-hex-container {
        position: relative; width: 280px; height: 320px;
        background-color: #fceecb;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        overflow: hidden; 
        box-shadow: inset 0 0 30px rgba(255, 150, 0, 0.2);
        transition: transform 0.1s ease-out; 
        will-change: transform;
    }

    /* Solución a la Animación de la Miel: Uso de background-position-x en lugar de Transform */
    .honey-wave {
        position: absolute; bottom: 0; left: 0; width: 100%; height: 150px;
        background-repeat: repeat-x; background-position: 0 bottom;
    }

    .wave-back {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 150'%3E%3Cpath fill='%23FFD700' opacity='0.7' d='M0 75 Q 100 25, 200 75 T 400 75 L 400 150 L 0 150 Z'/%3E%3C/svg%3E");
        background-size: 400px 150px; 
        animation: wave-bg-seamless 5s infinite linear; 
        z-index: 1; margin-bottom: 5px;
    }

    .wave-front {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 150'%3E%3Cpath fill='%23FF9600' d='M0 90 Q 100 50, 200 90 T 400 90 L 400 150 L 0 150 Z'/%3E%3C/svg%3E");
        background-size: 400px 150px; 
        animation: wave-bg-seamless 3.5s infinite linear; 
        z-index: 2;
    }

    @keyframes wave-bg-seamless { 
        0% { background-position-x: 0; } 
        100% { background-position-x: -400px; } 
    }

    .honeycomb-grid-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 3;
        background-image: url("data:image/svg+xml,%3Csvg width='56' height='96' viewBox='0 0 56 96' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M28 66L0 50L0 16L28 0L56 16L56 50L28 66L28 98' fill='none' stroke='%23ffffff' stroke-width='4' stroke-opacity='0.7'/%3E%3C/svg%3E");
        background-size: 46px; pointer-events: none;
    }

    .community-info-hex {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 4;
        text-align: center; width: 85%; background: rgba(255, 255, 255, 0.95);
        padding: 18px 10px; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        pointer-events: none; border: 2px solid rgba(255, 193, 7, 0.3);
    }
</style>

<div class="sticky-header-area d-xl-none">
    <div class="top-stats-bar">
        <div class="stat-item fs-4">
            <div class="dropdown">
                <button class="course-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-square-root-variable main-icon"></i>
                    <i class="fa-solid fa-chevron-down caret-icon"></i>
                </button>
                <ul class="dropdown-menu border-0 shadow rounded-4 mt-2 p-2" style="min-width: 220px; z-index: 210;">
                    <li><h6 class="dropdown-header fw-bold text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Tus Cursos</h6></li>
                    <li><a class="dropdown-item fw-bold rounded-3 active d-flex align-items-center mb-1" href="#" style="background-color: #e5f6f9; color: var(--primary-blue);"><i class="fa-solid fa-square-root-variable me-3 fs-5"></i> Álgebra</a></li>
                </ul>
            </div>
        </div>
        <div class="d-flex gap-3">
            <div class="stat-item text-orange fs-5 fw-bold"><i class="fa-solid fa-fire me-1"></i> 14</div>
            <div class="stat-item text-honey fs-5 fw-bold"><i class="fa-solid fa-droplet me-1"></i> 776</div>
            <div class="stat-item text-danger fs-5 fw-bold"><i class="fa-solid fa-heart me-1"></i> ∞</div>
        </div>
    </div>
</div>

<div class="profile-container">
    <div class="profile-master-wrapper">

        <h2 class="fw-bold mb-4 ms-2 header-title-mobile text-bozal" style="color: var(--abeja-dark);">
            Tienda <span style="color: var(--secondary-orange);">Abeja</span> 🐝
        </h2>

        <div id="tiendaCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-touch="true">
            <div class="carousel-indicators mb-2">
                <button type="button" data-bs-target="#tiendaCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                <button type="button" data-bs-target="#tiendaCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#tiendaCarousel" data-bs-slide-to="2"></button>
            </div>
            
            <div class="carousel-inner shop-banner-card">
                <div class="carousel-item active">
                    <div class="banner-layout">
                        <div class="banner-text-zone bg-blue-banner">
                            <span class="badge bg-white text-primary mb-2 fw-bold px-3 py-2 rounded-pill shadow-sm">NUEVO LOTE</span>
                            <h3 class="fw-bold m-0 banner-text-light" style="font-size: 2.2rem;">Estilo Ingeniero</h3>
                            <p class="mt-2 mb-0 fw-bold banner-text-light opacity-75 fs-5">Cascos y gafas para el taller.</p>
                        </div>
                        <div class="banner-img-zone" style="background-image: url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=800&q=80');"></div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="banner-layout">
                        <div class="banner-text-zone bg-yellow-banner">
                            <span class="badge bg-danger text-white mb-2 fw-bold px-3 py-2 rounded-pill shadow-sm"><i class="fa-solid fa-clock"></i> FIN DE SEMANA</span>
                            <h3 class="fw-bold m-0 banner-text-dark" style="font-size: 2.2rem;">Miel x2</h3>
                            <p class="mt-2 mb-0 fw-bold banner-text-dark opacity-75 fs-5">Gana el doble de gotas este finde.</p>
                        </div>
                        <div class="banner-img-zone" style="background-image: url('https://www.mexicodesconocido.com.mx/wp-content/uploads/2011/05/miel-abeja.jpg');"></div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="banner-layout">
                        <div class="banner-text-zone bg-orange-banner">
                            <span class="badge bg-dark text-white mb-2 fw-bold px-3 py-2 rounded-pill shadow-sm">EXCLUSIVO</span>
                            <h3 class="fw-bold m-0 banner-text-light" style="font-size: 2.2rem;">Motoquera</h3>
                            <p class="mt-2 mb-0 fw-bold banner-text-light opacity-75 fs-5">Chaqueta de cuero para tu avatar.</p>
                        </div>
                        <div class="banner-img-zone" style="background-image: url('https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&w=800&q=80');"></div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-bold m-0 text-bozal ms-2 mb-3" style="color: var(--abeja-dark);">Viste a tu Avatar</h4>
        
        <div class="row g-3 mb-5">
            <div class="col-12 col-xl-6">
                <div class="shop-item-card-hz" onclick="openShopModal('🎓', 'Birrete de la ENMS', 'Demuestra que eres un estudiante aplicado de Ingeniería.', '150', 'Común', 'bg-light text-muted border')">
                    <div class="item-icon-wrapper-hz bg-light">🎓</div>
                    <div class="item-details-hz">
                        <h6 class="mb-1 fw-bold text-bozal fs-5">Birrete de la ENMS</h6>
                        <span class="badge bg-light text-muted border mb-1">Común</span>
                    </div>
                    <div class="item-action-hz">
                        <div class="text-orange fw-bold mb-0 fs-5">150 <i class="fa-solid fa-droplet text-honey"></i></div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-xl-6">
                <div class="shop-item-card-hz" onclick="openShopModal('🧣', 'Bufanda Invernal', 'Perfecta para esos días fríos esperando el camión a Silao.', '300', 'Raro', 'bg-info bg-opacity-10 text-primary border border-info')">
                    <div class="item-icon-wrapper-hz bg-info bg-opacity-10 text-info border-info">🧣</div>
                    <div class="item-details-hz">
                        <h6 class="mb-1 fw-bold text-bozal fs-5">Bufanda Invernal</h6>
                        <span class="badge bg-info bg-opacity-10 text-primary border border-info mb-1">Raro</span>
                    </div>
                    <div class="item-action-hz">
                        <div class="text-orange fw-bold mb-0 fs-5">300 <i class="fa-solid fa-droplet text-honey"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <div class="shop-item-card-hz" onclick="openShopModal('🎧', 'Cascos Gamer', 'Aíslate del ruido y concéntrate en tus despejes perfectos.', '850', 'Épico', 'bg-purple bg-opacity-10 text-purple border border-purple')">
                    <div class="item-icon-wrapper-hz" style="background-color: #f3e5f5; color: #8e24aa; border-color: #e1bee7;">🎧</div>
                    <div class="item-details-hz">
                        <h6 class="mb-1 fw-bold text-bozal fs-5">Cascos Gamer</h6>
                        <span class="badge mb-1" style="background-color: #f3e5f5; color: #8e24aa; border: 1px solid #e1bee7;">Épico</span>
                    </div>
                    <div class="item-action-hz">
                        <div class="text-orange fw-bold mb-0 fs-5">850 <i class="fa-solid fa-droplet text-honey"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <div class="shop-item-card-hz" onclick="openShopModal('👑', 'Corona de Reina', 'Solo para los que dominan el álgebra a la perfección.', '2500', 'Legendario', 'bg-warning bg-opacity-10 text-warning border border-warning')">
                    <div class="item-icon-wrapper-hz" style="background-color: #fff3e0; color: #e65100; border-color: #ffe0b2;">👑</div>
                    <div class="item-details-hz">
                        <h6 class="mb-1 fw-bold text-bozal fs-5">Corona de Reina</h6>
                        <span class="badge mb-1 shadow-sm" style="background-color: #fff3e0; color: #e65100; border: 1px solid #ffe0b2;">Legendario</span>
                    </div>
                    <div class="item-action-hz">
                        <div class="text-orange fw-bold mb-0 fs-5">2500 <i class="fa-solid fa-droplet text-honey"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-bold mb-3 ms-2 text-bozal" style="color: var(--abeja-dark);">Potenciadores</h4>
        <div class="row g-3 mb-5">
            <div class="col-12 col-xl-6">
                <div class="shop-item-card-hz" onclick="openShopModal('🛡️', 'Protector de Racha', 'Mantiene tu fuego vivo aunque olvides entrar un día.', '200', 'Utilidad', 'bg-secondary bg-opacity-10 text-secondary border border-secondary')">
                    <div class="item-icon-wrapper-hz bg-opacity-10 bg-warning border-warning border-opacity-25">🛡️</div>
                    <div class="item-details-hz">
                        <h6 class="mb-1 fw-bold text-bozal fs-5">Protector de Racha</h6>
                        <p class="text-muted small fw-bold mb-0">Salva tu racha si un día no entras.</p>
                    </div>
                    <div class="item-action-hz">
                        <div class="text-orange fw-bold mb-0 fs-5">200 <i class="fa-solid fa-droplet text-honey"></i></div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <div class="shop-item-card-hz" onclick="openShopModal('❤️', 'Recarga de Vidas', 'Recupera tus corazones al instante para seguir practicando.', '50', 'Utilidad', 'bg-secondary bg-opacity-10 text-secondary border border-secondary')">
                    <div class="item-icon-wrapper-hz bg-opacity-10 bg-danger border-danger border-opacity-25">❤️</div>
                    <div class="item-details-hz">
                        <h6 class="mb-1 fw-bold text-bozal fs-5">Recarga de Vidas</h6>
                        <p class="text-muted small fw-bold mb-0">Restaura todas tus vidas al instante.</p>
                    </div>
                    <div class="item-action-hz">
                        <div class="text-orange fw-bold mb-0 fs-5">50 <i class="fa-solid fa-droplet text-honey"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center my-5 d-flex align-items-center justify-content-center gap-3 px-3">
            <div style="height: 3px; flex-grow: 1; background: var(--abeja-gray-medium); border-radius: 2px;"></div>
            <i class="fa-solid fa-seedling text-muted fs-4" style="opacity: 0.4; color: var(--abeja-gray-dark) !important;"></i>
            <div style="height: 3px; flex-grow: 1; background: var(--abeja-gray-medium); border-radius: 2px;"></div>
        </div>

        <div class="row align-items-center mb-5">
            <div class="col-12 col-lg-5 order-1 mb-4 mb-lg-0 d-flex justify-content-center">
                <div class="big-honeycomb-wrapper w-100" id="interactive-honeycomb-area">
                    <div class="honey-hex-container" id="honey-hex">
                        <div class="honey-wave wave-back"></div>
                        <div class="honey-wave wave-front"></div>
                        <div class="honeycomb-grid-overlay"></div>
                        <div class="community-info-hex">
                            <h6 class="fw-bold text-uppercase text-muted mb-1" style="font-size: 0.8rem; letter-spacing: 1px;">Meta Semanal</h6>
                            <p class="fw-bold mb-2" style="font-size: 2.5rem; color: var(--secondary-orange); line-height: 1; text-shadow: 1px 1px 0px #fff;">68%</p>
                            <div class="progress progress-miel-simple mx-auto mb-2 shadow-sm" style="max-width: 150px; height: 14px; border-radius: 10px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 68%; background-color: var(--secondary-orange);"></div>
                            </div>
                            <small class="fw-bold text-bozal d-block lh-sm" style="color: var(--abeja-dark); font-size: 0.85rem;">Faltan 15,200 gotas en la colmena</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-lg-7 order-2 text-center text-lg-start ps-lg-5">
                <h2 class="fw-bold text-bozal mb-3" style="font-size: 2.8rem; color: var(--abeja-dark); line-height: 1.1;">Apoyo Colaborativo</h2>
                <p class="text-muted fw-bold text-bozal fs-5 lh-base mb-4">
                    Una parte de todas tus compras llena este panal colectivo. ¡Al llenarlo, toda la comunidad desbloquea premios misteriosos y vidas extra!
                </p>
                <div class="d-inline-block px-4 py-2 rounded-pill bg-warning bg-opacity-10 text-warning fw-bold border border-warning border-opacity-50 shadow-sm transition-all hover-scale" style="cursor: pointer;">
                    <i class="fa-solid fa-unlock me-2"></i> Recompensa #1 casi lista...
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="shopItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 28px; background-color: var(--abeja-white);">
            <div class="modal-body p-4 p-md-5">
                
                <div id="modal-state-view">
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-md-5 text-center mb-4 mb-md-0">
                            <div class="modal-cosmetic-icon" id="modal-icon">🎓</div>
                        </div>
                        <div class="col-12 col-md-7 text-center text-md-start px-md-4">
                            <span id="modal-type" class="badge bg-light text-muted border mb-2 px-3 py-2 rounded-pill">Común</span>
                            <h2 id="modal-title" class="fw-bold mb-3" style="color: var(--abeja-dark); font-size: 2.2rem;">Birrete</h2>
                            <p id="modal-desc" class="text-muted fw-bold mb-4 fs-5 lh-sm">Descripción del objeto va aquí.</p>
                            
                            <button class="btn-buy-modal" onclick="transitionToConfirm()">
                                Adquirir por <span id="modal-price">150</span> <i class="fa-solid fa-droplet ms-1 text-warning"></i>
                            </button>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: var(--abeja-gray-medium); opacity: 1;">

                    <h6 class="fw-bold text-muted mb-3">Más recomendaciones</h6>
                    <div class="d-flex gap-3 justify-content-center justify-content-md-start flex-wrap">
                        <div class="rec-item shadow-sm" onclick="openShopModal('🧥', 'Chaqueta de Cuero', 'Ideal para lucir tu estilo de motorista.', '1200', 'Épico', 'bg-purple bg-opacity-10 text-purple border border-purple')">🧥</div>
                        <div class="rec-item shadow-sm" onclick="openShopModal('🥽', 'Gafas de Soldar', 'Protección visual nivel ingeniería.', '600', 'Raro', 'bg-info bg-opacity-10 text-primary border border-info')">🥽</div>
                        <div class="rec-item shadow-sm" onclick="openShopModal('🧢', 'Gorra Abeja', 'Sencilla, clásica, inconfundible.', '100', 'Común', 'bg-light text-muted border')">🧢</div>
                    </div>
                </div>

                <div id="modal-state-confirm" style="display: none;" class="text-center py-4">
                    <h3 class="fw-bold mb-4" style="color: var(--abeja-dark);">¿Seguro que quieres comprar esto?</h3>
                    <div class="modal-cosmetic-icon mx-auto mb-4" id="modal-icon-confirm" style="width: 100px; height: 100px; font-size: 3rem; animation: none;">🎓</div>
                    <p class="fs-5 fw-bold text-muted mb-4">Se descontarán <strong id="modal-price-confirm" class="text-orange fs-4">150</strong> gotas de miel de tu cuenta.</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <button class="btn btn-light fw-bold px-4 py-3 rounded-pill" onclick="backToView()" style="border: 2px solid var(--abeja-gray-medium); width: 45%;">Cancelar</button>
                        <button class="btn btn-success fw-bold px-4 py-3 rounded-pill shadow-sm" onclick="transitionToSuccess()" style="width: 45%; border-bottom: 4px solid #146c43;">¡Sí, comprar!</button>
                    </div>
                </div>

                <div id="modal-state-success" style="display: none;" class="text-center py-5">
                    <div class="text-success mb-3" style="font-size: 5rem; text-shadow: 0 10px 20px rgba(25, 135, 84, 0.2);"><i class="fa-solid fa-circle-check"></i></div>
                    <h2 class="fw-bold mb-2" style="color: var(--abeja-dark);">¡Compra Exitosa!</h2>
                    <p class="fs-5 fw-bold text-muted mb-4">Tu nuevo objeto ya está disponible en tu colección de perfil.</p>
                    <button class="btn btn-primary fw-bold px-5 py-3 rounded-pill" data-bs-dismiss="modal" style="border-bottom: 4px solid #0a58ca;">Equipar ahora</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Variables globales para el modal
    let currentItem = {};

    function openShopModal(icon, title, desc, price, type, typeClass) {
        currentItem = { icon, title, desc, price, type, typeClass };
        
        document.getElementById('modal-icon').innerText = icon;
        document.getElementById('modal-title').innerText = title;
        document.getElementById('modal-desc').innerText = desc;
        document.getElementById('modal-price').innerText = price;
        
        const typeBadge = document.getElementById('modal-type');
        typeBadge.innerText = type;
        typeBadge.className = "badge mb-2 px-3 py-2 rounded-pill shadow-sm " + typeClass;

        document.getElementById('modal-state-view').style.display = 'block';
        document.getElementById('modal-state-confirm').style.display = 'none';
        document.getElementById('modal-state-success').style.display = 'none';

        if (typeof bootstrap !== 'undefined') {
            const modalEl = document.getElementById('shopItemModal');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
    }

    function transitionToConfirm() {
        document.getElementById('modal-icon-confirm').innerText = currentItem.icon;
        document.getElementById('modal-price-confirm').innerText = currentItem.price;
        
        document.getElementById('modal-state-view').style.display = 'none';
        document.getElementById('modal-state-confirm').style.display = 'block';
    }

    function backToView() {
        document.getElementById('modal-state-confirm').style.display = 'none';
        document.getElementById('modal-state-view').style.display = 'block';
    }

    function transitionToSuccess() {
        document.getElementById('modal-state-confirm').style.display = 'none';
        document.getElementById('modal-state-success').style.display = 'block';
    }

    // Inicialización de Eventos Sensoriales y de Mouse
    function initTiendaEvents() {
        const hex = document.getElementById('honey-hex');
        const wrapper = document.getElementById('interactive-honeycomb-area');

        if (!hex || !wrapper) return;

        wrapper.addEventListener('mousemove', (e) => {
            const rect = wrapper.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            const rotateX = Math.max(-15, Math.min(15, -y / 10));
            const rotateY = Math.max(-15, Math.min(15, x / 10));
            
            hex.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        wrapper.addEventListener('mouseleave', () => {
            hex.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg)`;
        });

        if (window.DeviceOrientationEvent) {
            window.addEventListener('deviceorientation', (e) => {
                if (!e.beta || !e.gamma) return; 
                
                let tiltX = Math.max(-20, Math.min(20, e.beta - 45)); 
                let tiltY = Math.max(-20, Math.min(20, e.gamma));

                if (window.innerWidth < 1024) {
                    hex.style.transform = `perspective(1000px) rotateX(${-tiltX}deg) rotateY(${tiltY}deg)`;
                }
            });
        }
    }

    // Ejecutamos inmediatamente para que el script active el JS interno
    initTiendaEvents();
</script>