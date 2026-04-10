<style>
    @media (min-width: 1200px) {
        .path-container{
            margin-top: 0 !important;
        }
    }
    .path-container{
        padding-top: 15px;
    }
</style>
<div class="bg-floating-hexagons">
    <div class="floating-hex hex-1"></div>
    <div class="floating-hex hex-2"></div>
    <div class="floating-hex hex-3"></div>
    <div class="floating-hex hex-4"></div>
    <div class="floating-hex hex-5"></div>
    <div class="floating-hex hex-6"></div>
    <div class="floating-hex hex-7"></div>
    <div class="floating-hex hex-8"></div>
    <div class="floating-hex hex-9"></div>
</div>

<div class="sticky-header-area">
    <div class="sticky-header-content">

        <div class="top-stats-bar d-xl-none">
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
            <div class="d-flex gap-3">
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
        </div>

        <header class="section-header mb-4">
            <div class="header-info">
                <span class="step-title">SECCIÓN 1, ÁLGEBRA FUNDAMENTAL</span>
                <h2 class="section-title">Introducción a Ecuaciones</h2>
            </div>
            <div class="algebra-header-image">
                <img src="https://img.freepik.com/vector-gratis/pequenos-estudiantes-gran-signo-pi-ilustracion-vectorial-plana-nino-nina-estudiando-matematicas-algebra-escuela-o-universidad-sosteniendo-regla-usando-computadora-portatil-figuras-geometricas-segundo-plano-concepto-educacion_74855-23227.jpg"
                    alt="Fondo de Álgebra" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </header>
    </div>
</div>

<div class="path-container">
    <div class="path-nodes">

        <svg class="path-line-svg-desktop"
            style="position: absolute; top: 42px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M -110 0 L -55 115 L 0 230 L 55 345 L 110 470 L 55 585 L 0 760"
                stroke="var(--abeja-gray-medium)" stroke-width="22" fill="none" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M -110 0 L -55 115 L 0 230 L 55 345" stroke="var(--primary-blue)" stroke-width="22"
                fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <svg class="path-line-svg-mobile"
            style="position: absolute; top: 37px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M -70 0 L -35 105 L 0 210 L 35 315 L 70 430 L 35 535 L 0 680"
                stroke="var(--abeja-gray-medium)" stroke-width="18" fill="none" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M -70 0 L -35 105 L 0 210 L 35 315" stroke="var(--primary-blue)" stroke-width="18"
                fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <svg class="path-line-svg-mini"
            style="position: absolute; top: 37px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M -40 0 L -20 105 L 0 210 L 20 315 L 40 430 L 20 535 L 0 680"
                stroke="var(--abeja-gray-medium)" stroke-width="18" fill="none" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M -40 0 L -20 105 L 0 210 L 20 315" stroke="var(--primary-blue)" stroke-width="18"
                fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div class="node-wrapper offset-left-2">
            <div class="mascot-zone mascot-large zone-1-top-right">
                <img src="webp_animations/1.webp" class="mascot-img" alt="Abeja Estudiando">
            </div>
            <button class="path-node node-completed">
                <div class="hex-inner"><i class="fa-solid fa-check"></i></div>
            </button>
        </div>

        <div class="node-wrapper offset-left-1">
            <button class="path-node node-completed">
                <div class="hex-inner"><i class="fa-solid fa-check"></i></div>
            </button>
        </div>

        <div class="node-wrapper offset-center">
            <button class="path-node node-chest">
                <div class="hex-inner"><i class="fa-solid fa-box-open"></i></div>
            </button>
        </div>

        <div class="node-wrapper tall-wrapper offset-right-1">
            <div class="active-node-group">
                <div class="tooltip-start">EMPEZAR</div>
                <button class="path-node node-active">
                    <div class="hex-inner"><i class="fa-solid fa-star"></i></div>
                </button>
            </div>
        </div>

        <div class="node-wrapper offset-right-2">
            <div class="mascot-zone mascot-large zone-3-bot-left">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked"
                    alt="Abeja Estudiando Bloqueada">
            </div>
            <button class="path-node node-locked">
                <div class="hex-inner"><i class="fa-solid fa-crown"></i></div>
            </button>
        </div>

        <div class="node-wrapper offset-right-1">
            <button class="path-node node-locked">
                <div class="hex-inner"><i class="fa-solid fa-dumbbell"></i></div>
            </button>
        </div>

        <div class="section-divider my-4 text-center w-100"
            style="border-top: 2px solid #E5E5E5; position: relative; z-index: 2;">
            <span
                style="background: var(--abeja-body-bg); padding: 0 15px; position: relative; top: -12px; color: #AAA; font-weight: 800; text-transform: uppercase;">Ecuaciones
                de 1er Grado</span>
        </div>

        <div class="node-wrapper offset-center">
            <button class="path-node node-purple">
                <div class="hex-inner"><i class="fa-solid fa-forward-step"></i></div>
            </button>
        </div>

    </div>
</div>