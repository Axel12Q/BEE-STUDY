

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
                <div class="img-skeleton-wrapper">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=500&q=80" alt="Estudiantes estudiando" loading="eager" fetchpriority="high" onload="this.classList.add('loaded')">
                </div>
            </div>
            <div class="promo-divider"></div>
            <div class="promo-right">
                <h2 class="titulo-seccion">Asesorías</h2>
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