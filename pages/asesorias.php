<style>
    /* =========================================
       ESTILOS EXCLUSIVOS DE ASESORIAS.PHP
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
        margin: 0 0 20px 0; padding-bottom: 12px; border-bottom: 2px solid var(--abeja-gray-medium);
    }
    .section-title { font-size: 1.3rem; font-weight: 900; color: var(--abeja-dark); margin: 0; }

    /* =========================================
       1. TARJETA PROMOCIONAL
       ========================================= */
    .promo-card {
        background-color: var(--primary-blue-light);
        border-radius: 24px;
        display: flex;
        align-items: stretch;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(93, 173, 226, 0.15);
    }
    .promo-left {
        flex: 0.8; display: flex; align-items: center; justify-content: center;
    }
    .promo-left img {
        width: 100%; height: 100%; max-height: 180px; object-fit: cover;
        border-radius: 16px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .promo-card:hover .promo-left img { transform: scale(1.03) rotate(-2deg); }

    .promo-divider {
        width: 3px; background-color: rgba(0,0,0,0.06);
        margin: 0 20px; border-radius: 2px;
    }

    .promo-right {
        flex: 1.2; display: flex; flex-direction: column; justify-content: center;
    }
    .promo-right h2 { font-size: 1.7rem; font-weight: 900; color: var(--primary-blue-dark); margin-bottom: 8px; line-height: 1.1; }
    .promo-right p { font-size: 0.9rem; font-weight: 800; color: var(--abeja-dark); opacity: 0.85; margin-bottom: 12px; line-height: 1.3; }
    
    .promo-price-box {
        background-color: #FFF9E6; border: 2px dashed var(--primary-yellow-dark);
        border-radius: 14px; padding: 10px 15px;
    }
    .badge-free {
        display: inline-block; background-color: var(--primary-yellow-dark); color: #FFF;
        font-weight: 900; font-size: 0.8rem; text-transform: uppercase;
        padding: 4px 10px; border-radius: 8px; margin-bottom: 5px; box-shadow: 0 4px 10px rgba(229, 180, 0, 0.3);
    }
    .promo-price-box small { display: block; font-size: 0.75rem; font-weight: 800; color: var(--primary-yellow-text); line-height: 1.2; }

    /* =========================================
       2. TARJETA SOLICITUD
       ========================================= */
    .request-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 24px; padding: 20px 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .alert-abeja {
        background-color: var(--primary-blue-light); border: 2px dashed var(--primary-blue);
        border-radius: 16px; padding: 12px; font-size: 0.8rem; font-weight: 800;
        color: var(--primary-blue-dark); margin-bottom: 18px; display: flex; gap: 10px; align-items: flex-start;
    }
    .alert-abeja i { font-size: 1.1rem; margin-top: 2px; }
    
    .form-abeja .form-label { font-weight: 900; color: var(--abeja-dark); font-size: 0.9rem; margin-bottom: 6px; }
    .form-abeja .form-control, .form-abeja .form-select {
        border: 2px solid var(--abeja-gray-medium); border-radius: 12px;
        padding: 10px 15px; font-weight: 700; font-size: 0.9rem; color: var(--abeja-text);
        background-color: var(--abeja-gray-light); transition: all 0.2s; box-shadow: none;
    }
    .form-abeja .form-control:focus, .form-abeja .form-select:focus {
        border-color: var(--primary-blue); background-color: var(--abeja-white);
    }

    .price-summary {
        display: flex; align-items: center; justify-content: space-between;
        background-color: var(--pastel-green-light);
        border-radius: 16px; padding: 12px 18px; margin: 18px 0;
    }
    .price-summary-text { display: flex; flex-direction: column; }
    .price-summary-text strong { font-size: 1.2rem; font-weight: 900; color: var(--pastel-green-dark); }
    .price-summary-text span { font-size: 0.75rem; font-weight: 800; color: var(--pastel-green); }
    
    .btn-submit-request {
        width: 100%; background-color: var(--primary-blue); color: #FFF;
        border: none; border-radius: 14px; padding: 12px; font-size: 1rem; font-weight: 900;
        transition: all 0.2s; box-shadow: 0 6px 15px rgba(93, 173, 226, 0.3);
    }
    .btn-submit-request:hover { background-color: var(--primary-blue-dark); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(93, 173, 226, 0.4); }
    .btn-submit-request:active { transform: translateY(2px); box-shadow: 0 2px 10px rgba(93, 173, 226, 0.3); }

    /* =========================================
       3. LISTA DE SESIONES
       ========================================= */
    .sessions-list-container {
        display: flex;
        flex-direction: column;
        gap: 15px; 
        padding-right: 10px;
        padding-bottom: 5px;
    }
    .sessions-list-container::-webkit-scrollbar { width: 6px; }
    .sessions-list-container::-webkit-scrollbar-track { background: var(--abeja-gray-light); border-radius: 10px; }
    .sessions-list-container::-webkit-scrollbar-thumb { background: var(--abeja-gray-dark); border-radius: 10px; }

    .session-card {
        border-radius: 20px; display: flex; flex-direction: column;
        box-shadow: 0 4px 10px rgba(0,0,0,0.02); transition: transform 0.2s, border-color 0.2s; 
        cursor: pointer; overflow: hidden;
    }
    .session-card:hover { transform: translateY(-3px); }
    
    .stretch-card { flex: 1 0 auto; min-height: 120px; }

    /* Cabecera Superior de Propuesta del Asesor */
    .proposal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 18px; background-color: rgba(255, 255, 255, 0.4); /* Transparente para heredar color de fondo */
        border-bottom: 2px solid rgba(0,0,0,0.05);
        flex-wrap: wrap; gap: 12px;
    }
    .proposal-text {
        font-size: 0.85rem; color: var(--primary-yellow-text);
        font-weight: 800; display: flex; align-items: center; gap: 8px;
    }
    /* Botones 50-50 */
    .proposal-actions { display: flex; gap: 10px; width: 100%; flex: 1; }
    .btn-proposal {
        flex: 1; /* Esto garantiza que midan 50% y 50% */
        padding: 8px 12px; border-radius: 12px; border: none;
        font-weight: 900; font-size: 0.85rem; transition: all 0.2s; 
        display: flex; justify-content: center; align-items: center;
    }
    .btn-accept { background-color: var(--pastel-green-light); color: var(--pastel-green-dark); border: 1px solid var(--pastel-green); }
    .btn-accept:hover { background-color: var(--pastel-green-dark); color: #FFF; }
    .btn-reschedule { background-color: var(--abeja-white); color: var(--abeja-text-muted); border: 1px solid var(--abeja-gray-dark); }
    .btn-reschedule:hover { background-color: var(--abeja-gray-medium); color: var(--abeja-dark); }

    .session-card-body {
        padding: 15px 18px; display: flex; align-items: center; gap: 15px; flex-grow: 1;
    }

    .session-icon-box {
        width: 50px; height: 50px; border-radius: 14px;
        display: flex; justify-content: center; align-items: center; font-size: 1.3rem; flex-shrink: 0;
    }
    .session-divider { width: 2px; align-self: stretch; border-radius: 2px; background-color: rgba(0,0,0,0.05); }

    .session-info { flex-grow: 1; }
    .session-info h4 { font-size: 1.05rem; font-weight: 900; color: var(--abeja-dark); margin: 0 0 4px 0; line-height: 1.1; }
    .session-info p { font-size: 0.8rem; font-weight: 700; color: var(--abeja-text-muted); margin: 0 0 2px 0; display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .session-info p i { opacity: 0.7; }

    .students-joined { display: flex; gap: 4px; flex-wrap: wrap; margin-top: 8px; }
    .student-tag {
        background-color: var(--primary-blue-light); color: var(--primary-blue-dark);
        font-size: 0.65rem; font-weight: 900; padding: 3px 8px; border-radius: 8px; white-space: nowrap;
    }
    .student-tag.empty { background-color: var(--abeja-white); color: var(--abeja-text-muted); border: 1px dashed var(--abeja-gray-dark); }

    .session-badge {
        padding: 6px 12px; border-radius: 10px; font-size: 0.7rem; font-weight: 900; 
        text-transform: uppercase; letter-spacing: 1px; flex-shrink: 0; text-align: center;
    }

    /* Botones Inferiores */
    .session-actions { display: flex; border-top: 2px solid rgba(0,0,0,0.05); margin-top: auto; }
    .btn-session { flex: 1; padding: 10px; border: none; background: transparent; font-weight: 900; font-size: 0.85rem; transition: background-color 0.2s, color 0.2s; }
    
    .btn-aviso { color: var(--primary-yellow-text); background-color: rgba(255, 255, 255, 0.4); border-right: 2px solid rgba(0,0,0,0.05); }
    .btn-aviso:hover { background-color: var(--primary-yellow-dark); color: #FFF; }
    .btn-cancel { color: var(--pastel-red-dark); background-color: rgba(253, 237, 236, 0.5); }
    .btn-cancel:hover { background-color: var(--pastel-red-dark); color: #FFF; }
    .btn-join { background-color: var(--pastel-green-light); color: var(--pastel-green-dark); }
    .btn-join:hover { background-color: var(--pastel-green-dark); color: #FFF; }

    /* =========================================
       ESTADOS DE LAS SESIONES (COLORES DE FONDO)
       ========================================= */
    .status-pending { background-color: #FFFDF5; border: 2px solid #FDEBB4; }
    .status-pending:hover { border-color: var(--primary-yellow-dark); }
    .status-pending .session-icon-box { background-color: #FFF9E6; color: var(--primary-yellow-dark); border: 1px solid #FDEBB4; }
    .status-pending .session-badge { background-color: var(--primary-yellow-dark); color: #FFF; }

    .status-accepted { background-color: #F4FAFE; border: 2px solid #D6EAF8; }
    .status-accepted:hover { border-color: var(--primary-blue); }
    .status-accepted .session-icon-box { background-color: var(--primary-blue-light); color: var(--primary-blue); border: 1px solid #D6EAF8; }
    .status-accepted .session-badge { background-color: var(--primary-blue-light); color: var(--primary-blue-dark); border: 1px solid var(--primary-blue); }

    .status-completed { background-color: #F4FDF8; border: 2px solid #D1F2EB; }
    .status-completed:hover { border-color: var(--pastel-green); }
    .status-completed .session-icon-box { background-color: var(--pastel-green-light); color: var(--pastel-green); border: 1px solid #D1F2EB; }
    .status-completed .session-badge { background-color: var(--pastel-green-light); color: var(--pastel-green-dark); border: 1px solid var(--pastel-green); }

    .status-missed { background-color: #FEF5F4; border: 2px solid #FADBD8; opacity: 0.95; }
    .status-missed:hover { border-color: var(--pastel-red-dark); opacity: 1; }
    .status-missed .session-icon-box { background-color: var(--pastel-red-light); color: var(--pastel-red-dark); border: 1px solid #FADBD8; }
    .status-missed .session-badge { background-color: var(--abeja-white); color: var(--pastel-red-dark); border: 1px solid var(--pastel-red-dark); }

    .open-session { background-color: var(--abeja-white); border: 2px solid var(--abeja-gray-medium); }
    .open-session:hover { border-color: var(--primary-blue); }
    .open-session .session-icon-box { background-color: var(--primary-blue-light); color: var(--primary-blue); }


    /* =========================================
       RESPONSIVE DESIGN & LAYOUT FIXES
       ========================================= */
       
    /* PC Y TABLETS GRANDES */
    @media (min-width: 992px) {
        .sessions-list-container {
            flex: 1 1 0; 
            min-height: 0;
            overflow-y: auto;
        }
        /* En pantallas anchas, la propuesta puede ir en una fila si hay espacio */
        .proposal-actions { width: auto; flex: 1; }
    }

    /* GRID PARA EVITAR CHOQUES EN VISTAS MEDIAS Y MÓVILES */
    @media (max-width: 1199px) {
        .session-card-body {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 12px;
            padding: 18px 15px;
        }
        .session-icon-box { grid-column: 1; grid-row: 1; align-self: start; }
        .session-info { grid-column: 2; grid-row: 1; }
        
        /* El Badge baja a la segunda fila, ocupando el ancho completo sin chocar con info */
        .session-badge { 
            grid-column: 1 / span 2; 
            grid-row: 2; 
            justify-self: start; 
            margin-top: 4px;
            width: 100%;
        }
        .session-divider { display: none; }
    }

    /* MÓVILES (Scroll vertical amplio) */
    @media (max-width: 991px) {
        .promo-card { flex-direction: column; text-align: center; padding: 20px; }
        .promo-left { margin-bottom: 15px; }
        .promo-divider { width: 100%; height: 2px; margin: 0 0 15px 0; }
        .promo-right h2 { font-size: 1.5rem; }
        
        .request-card { padding: 20px; }
        
        .sessions-list-container {
            max-height: 70vh;
            overflow-y: auto;
            padding-right: 5px;
        }
        
        .proposal-header { flex-direction: column; align-items: flex-start; }
        .proposal-actions { width: 100%; }
    }
</style>

<div class="mobile-page-title-card d-lg-none fade-in-section">
    <div class="mobile-page-title-icon">
        <i class="fa-solid fa-chalkboard-user"></i>
    </div>
    <div class="mobile-page-title-divider"></div>
    <h2 class="mobile-page-title-text">Asesorías</h2>
</div>

<div class="row g-4 fade-in-section align-items-stretch">
    
    <div class="col-12 col-lg-7 d-flex flex-column gap-4">
        
        <div class="promo-card sound-item">
            <div class="promo-left">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=500&q=80" alt="Estudiantes estudiando">
            </div>
            <div class="promo-divider"></div>
            <div class="promo-right">
                <h2>Asesorías</h2>
                <p>Resuelve tus dudas con estudiantes de semestres superiores.</p>
                <div class="promo-price-box">
                    <span class="badge-free">¡1ra sesión GRATIS!</span>
                    <small>Grupos de tu curso en la Biblioteca ENMS.</small>
                </div>
            </div>
        </div>

        <div class="request-card sound-item flex-grow-1">
            <div class="section-header-row mt-0 mb-3" style="padding-bottom: 10px;">
                <h3 class="section-title">Solicitar Asesoría</h3>
            </div>

            <div class="alert-abeja">
                <i class="fa-solid fa-circle-info"></i>
                <div>
                    <strong>Individual:</strong> El asesor revisa y aprueba.<br>
                    <strong>Grupal:</strong> Se publica en abiertas para más alumnos. (Mínimo 3 estudiantes)
                </div>
            </div>
            
            <form class="form-abeja" onsubmit="event.preventDefault();">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Modalidad</label>
                        <select class="form-select sound-nav">
                            <option value="indiv" selected>Individual</option>
                            <option value="grupal">Grupal</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Curso</label>
                        <select class="form-select sound-nav">
                            <option selected disabled>Elige materia...</option>
                            <option value="1">Álgebra Fundamental</option>
                            <option value="2">Física y Movimiento</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Día y Hora preferida</label>
                        <input type="datetime-local" class="form-control sound-nav">
                    </div>
                </div>

                <div class="price-summary">
                    <div class="price-summary-text">
                        <strong>$90.00 MXN</strong>
                        <span>Pago al finalizar</span>
                    </div>
                    <div class="price-summary-text text-end">
                        <strong style="color: var(--abeja-dark);"><i class="fa-solid fa-hourglass-half"></i> 1 Hora</strong>
                        <span style="color: var(--abeja-text-muted);">Fija</span>
                    </div>
                </div>

                <button class="btn-submit-request sound-action">
                    <i class="fa-solid fa-paper-plane me-2"></i> Enviar Solicitud
                </button>
            </form>
        </div>

    </div>

    <div class="col-12 col-lg-5">
        <div class="d-flex flex-column h-100 mt-4 mt-lg-0">
            
            <div class="section-header-row mt-0 mb-3" style="border-bottom: 2px solid var(--abeja-gray-medium); padding-bottom: 10px;">
                <h3 class="section-title">Tus Sesiones</h3>
            </div>

            <div class="sessions-list-container">
                
                <div class="session-card status-pending sound-action stretch-card">
                    <div class="proposal-header">
                        <div class="proposal-text"><i class="fa-solid fa-bell"></i> Propuesta: <strong>18 Oct, 17:30 hrs</strong></div>
                        <div class="proposal-actions">
                            <button class="btn-proposal btn-accept sound-action">Aceptar</button>
                            <button class="btn-proposal btn-reschedule sound-nav">Otra</button>
                        </div>
                    </div>
                    <div class="session-card-body">
                        <div class="session-icon-box"><i class="fa-solid fa-clock"></i></div>
                        <div class="session-divider d-none d-lg-block"></div>
                        <div class="session-info">
                            <h4>Álgebra Fundamental</h4>
                            <p><i class="fa-solid fa-user-graduate"></i> Asesor: Valeria M.</p>
                            <p><i class="fa-solid fa-location-dot"></i> Por definir</p>
                            <p style="font-size: 0.7rem; color: var(--pastel-red-dark); margin-top:4px;"><i class="fa-solid fa-circle-exclamation"></i> El asesor puede cancelar</p>
                        </div>
                        <div class="session-badge">Por validar</div>
                    </div>
                    <div class="session-actions">
                        <button class="btn-session btn-aviso sound-nav">Enviar Aviso</button>
                        <button class="btn-session btn-cancel sound-nav">Cancelar</button>
                    </div>
                </div>

                <div class="session-card status-accepted sound-action stretch-card">
                    <div class="session-card-body">
                        <div class="session-icon-box"><i class="fa-solid fa-check-to-slot"></i></div>
                        <div class="session-divider d-none d-lg-block"></div>
                        <div class="session-info">
                            <h4>Física y Movimiento</h4>
                            <p><i class="fa-solid fa-user-graduate"></i> Mateo G. &bull; <i class="fa-solid fa-location-dot"></i> Biblio</p>
                            <p><i class="fa-solid fa-calendar-day"></i> Viernes, 10:00 hrs</p>
                        </div>
                        <div class="session-badge">Aceptada por asesor</div>
                    </div>
                </div>

                <div class="session-card status-completed sound-action stretch-card">
                    <div class="session-card-body">
                        <div class="session-icon-box"><i class="fa-solid fa-check"></i></div>
                        <div class="session-divider d-none d-lg-block"></div>
                        <div class="session-info">
                            <h4>Física Básica</h4>
                            <p><i class="fa-solid fa-user-graduate"></i> Luis R. &bull; <i class="fa-solid fa-location-dot"></i> Aula 5</p>
                            <p><i class="fa-solid fa-calendar-day"></i> 12 Oct, 14:00 hrs</p>
                        </div>
                        <div class="session-badge">Completada (Gratis)</div>
                    </div>
                </div>

                <div class="session-card status-missed sound-action stretch-card">
                    <div class="session-card-body">
                        <div class="session-icon-box"><i class="fa-solid fa-xmark"></i></div>
                        <div class="session-divider d-none d-lg-block"></div>
                        <div class="session-info">
                            <h4>Geometría</h4>
                            <p><i class="fa-solid fa-user-graduate"></i> Carlos T. &bull; <i class="fa-solid fa-location-dot"></i> Biblio</p>
                            <p><i class="fa-solid fa-calendar-day"></i> 05 Oct, 10:00 hrs</p>
                        </div>
                        <div class="session-badge">No Asistió</div>
                    </div>
                </div>
                
                <div class="session-card status-pending sound-action stretch-card">
                    <div class="session-card-body">
                        <div class="session-icon-box"><i class="fa-solid fa-clock"></i></div>
                        <div class="session-divider d-none d-lg-block"></div>
                        <div class="session-info">
                            <h4>Álgebra Avanzada</h4>
                            <p><i class="fa-solid fa-user-graduate"></i> Asesor: Pendiente</p>
                            <p><i class="fa-solid fa-calendar-day"></i> Lunes, 09:00 hrs</p>
                            <p style="font-size: 0.7rem; color: var(--pastel-red-dark); margin-top:4px;"><i class="fa-solid fa-circle-exclamation"></i> El asesor puede cancelar</p>
                        </div>
                        <div class="session-badge">Por validar</div>
                    </div>
                    <div class="session-actions">
                        <button class="btn-session btn-aviso sound-nav">Enviar Aviso</button>
                        <button class="btn-session btn-cancel sound-nav">Cancelar</button>
                    </div>
                </div>

                <div class="session-card status-completed sound-action stretch-card">
                    <div class="session-card-body">
                        <div class="session-icon-box"><i class="fa-solid fa-check"></i></div>
                        <div class="session-divider d-none d-lg-block"></div>
                        <div class="session-info">
                            <h4>Álgebra Fundamental</h4>
                            <p><i class="fa-solid fa-user-graduate"></i> Valeria M. &bull; <i class="fa-solid fa-location-dot"></i> Café</p>
                            <p><i class="fa-solid fa-calendar-day"></i> 28 Sep, 15:30 hrs</p>
                        </div>
                        <div class="session-badge">Completada</div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<div class="section-header-row mt-5 mb-3 fade-in-section delay-2">
    <h3 class="section-title">Asesorías Abiertas</h3>
</div>

<div class="row g-4 mb-5 fade-in-section delay-3">
    
    <div class="col-12 col-md-6 col-lg-4">
        <div class="session-card open-session sound-item h-100">
            <div class="session-card-body">
                <div class="session-icon-box"><i class="fa-solid fa-users"></i></div>
                <div class="session-info">
                    <h4>Geometría Plana</h4>
                    <p><i class="fa-solid fa-user"></i> Creada por el estudiante: Martín P.</p>
                    <p><i class="fa-solid fa-chalkboard-user"></i> Asesor: Luis R.</p>
                    <p><i class="fa-solid fa-calendar-day"></i> Hoy, 17:00 hrs</p>
                    
                    <div class="students-joined">
                        <span class="student-tag">Martín P.</span>
                        <span class="student-tag">Ana G.</span>
                        <span class="student-tag empty">Libre</span>
                    </div>
                </div>
            </div>
            <div class="session-actions">
                <button class="btn-session btn-join sound-action">Unirse a la sesión</button>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="session-card open-session sound-item h-100">
            <div class="session-card-body">
                <div class="session-icon-box"><i class="fa-solid fa-users"></i></div>
                <div class="session-info">
                    <h4>Física Básica</h4>
                    <p><i class="fa-solid fa-user"></i> Creada por el estudiante: Andrea L.</p>
                    <p><i class="fa-solid fa-chalkboard-user"></i> Asesor: Pendiente</p>
                    <p><i class="fa-solid fa-calendar-day"></i> Lunes, 13:00 hrs</p>
                    
                    <div class="students-joined">
                        <span class="student-tag">Andrea L.</span>
                        <span class="student-tag empty">Libre</span>
                        <span class="student-tag empty">Libre</span>
                    </div>
                </div>
            </div>
            <div class="session-actions">
                <button class="btn-session btn-join sound-action">Unirse a la sesión</button>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 col-lg-4">
        <div class="session-card open-session sound-item h-100">
            <div class="session-card-body">
                <div class="session-icon-box"><i class="fa-solid fa-users"></i></div>
                <div class="session-info">
                    <h4>Álgebra Avanzada</h4>
                    <p><i class="fa-solid fa-user"></i> Creada por el estudiante: Jorge V.</p>
                    <p><i class="fa-solid fa-chalkboard-user"></i> Asesor: Valeria M.</p>
                    <p><i class="fa-solid fa-calendar-day"></i> Miércoles, 11:30 hrs</p>
                    
                    <div class="students-joined">
                        <span class="student-tag">Jorge V.</span>
                        <span class="student-tag">Daniela T.</span>
                        <span class="student-tag">Pedro S.</span>
                        <span class="student-tag">Luisa P.</span>
                        <span class="student-tag empty">Libre</span>
                    </div>
                </div>
            </div>
            <div class="session-actions">
                <button class="btn-session btn-join sound-action">Unirse a la sesión</button>
            </div>
        </div>
    </div>

</div>

<script>
    (function() {
        // Aseguramos que el scroll inicie arriba al cargar la página mediante fetch
        const dynamicContent = document.getElementById('dynamic-content');
        if(dynamicContent) {
            dynamicContent.scrollTop = 0;
        }
    })();
</script>