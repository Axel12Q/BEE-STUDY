<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Tu perfil - AbejaGO 🐝</title>
    
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">

    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">

    <link rel="manifest" href="img/site.webmanifest">
    <meta name="theme-color" content="#FFD700">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="app-layout">
        <?php require_once 'components/nav.php'; ?>

        <main class="main-content">

            <button class="menu-toggle-cylinder mb-5" id="menuToggle" aria-label="Abrir menú">
                <div class="cylinder-face"></div>
                <i class="bi bi-list"></i>
                <span class="ms-2 d-none d-md-inline">Menú</span>
            </button>
            <div class="animate-fade-up" style="margin-top: 110px; margin-bottom: 10px;">
                <h1 class="fw-bold display-5 mb-2" style="font-size: 2.8rem;
        line-height: 1.1;">Tu Perfil</h1>
                <p class="text-secondary fs-5">Aquí puedes ver y gestionar tu información personal.</p>
            </div>

            <style>
                #perfil-top {
                    margin-top: 70px;
                }

                @media (max-width: 769px) {
                    #perfil-top {
                        margin-top: 40px;
                    }
                }
            </style>

            <section class="mb-5 pb-lg-3 animate-fade-up" id="perfil-top">
                <div class="bento-card position-relative overflow-hidden p-4 p-lg-5">
                    <div class="decoration-circle"
                        style="right: -50px; top: -50px; background: var(--bg-secondary); width: 300px; height: 300px; z-index: 0;">
                    </div>

                    <div class="row align-items-center position-relative z-1">

                        <div class="col-lg-5 text-center text-lg-start mb-5 mb-lg-0 pe-lg-5">
                            <div class="d-flex flex-column align-items-center align-items-lg-start">
                                <div class="profile-avatar position-relative mb-4"
                                    style="width: 110px; height: 110px; border-radius: 50%; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; font-size: 4rem; border: 4px solid white; box-shadow: var(--shadow-soft);">
                                    🧑🏻‍💻
                                    <span
                                        class="position-absolute bottom-0 end-0 p-2 bg-success border border-3 border-white rounded-circle"></span>
                                </div>

                                <h2 class="fw-bold mb-2" style="letter-spacing: -0.5px;">Axel Jesús Quintero Salazar
                                </h2>
                                <p class="text-secondary fw-bold fs-6 mb-4">17 años • 6to Semestre (Ingenierías)</p>
                                <div class="d-flex gap-2 flex-wrap justify-content-center justify-content-lg-start">
                                    <span class="badge bg-dark text-white rounded-pill px-3 py-2 fw-bold"
                                        style="font-size: 0.8rem;"><i class="bi bi-building"></i> ENMS Silao (UG)</span>
                                    <span
                                        class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold"
                                        style="font-size: 0.8rem;"><i class="bi bi-rocket-takeoff-fill"></i> Ing.
                                        Mecatrónica</span>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-7 ps-lg-5">
                            <div class="row g-4">

                                <!-- 1 -->
                                <div class="col-6 col-sm-6">
                                    <div class="p-4 rounded-4 bg-light text-center h-100 d-flex flex-column justify-content-center"
                                        style="border: 1px solid var(--border-light);">
                                        <div class="text-primary fs-3 mb-2">📐</div>
                                        <h3 class="fw-bold mb-1 text-primary display-6">92%</h3>
                                        <p class="text-muted small fw-bold mb-0">Precisión en Física</p>
                                    </div>
                                </div>

                                <!-- 2 -->
                                <div class="col-6 col-sm-6">
                                    <div class="p-4 rounded-4 bg-light text-center h-100 d-flex flex-column justify-content-center"
                                        style="border: 1px solid var(--border-light);">
                                        <div class="text-danger fs-3 mb-2">🔥</div>
                                        <h3 class="fw-bold mb-1 display-6">24</h3>
                                        <p class="text-muted small fw-bold mb-0">Racha de días</p>
                                    </div>
                                </div>

                                <!-- 3 (100% en móvil) -->
                                <div class="col-12 col-sm-6">
                                    <div class="p-4 rounded-4 text-center h-100 d-flex flex-column justify-content-center position-relative overflow-hidden"
                                        style="background: linear-gradient(135deg, #22f995, #7597de); color: white; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                        <div class="fs-3 mb-2" style="text-shadow: 0 2px 5px rgba(255, 255, 255, 0.3);">
                                            👑</div>
                                        <h3 class="fw-bold mb-1 fs-2">Nivel 15</h3>
                                        <p class="small fw-bold mb-0" style="color: white;">Rango: Erudito</p>
                                    </div>
                                </div>

                                <!-- botones -->
                                <div class="col-12 col-sm-6 d-flex flex-column gap-3 justify-content-center">
                                    <button class="btn btn-outline-custom rounded-pill fw-bold w-100 py-3"
                                        style="font-size: 0.9rem;">Editar Perfil</button>
                                    <button class="btn btn-primary-custom rounded-pill fw-bold w-100 py-3"
                                        style="font-size: 0.9rem;">Unirme a un grupo</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <section class="mb-5 pb-lg-3">
                <div class="d-flex justify-content-between align-items-end mb-4 px-2">
                    <div>
                        <h4 class="small-caps text-muted mb-2">HOJA DE PERSONAJE</h4>
                        <h3 class="fw-bold mb-0">Tus Habilidades</h3>
                    </div>
                </div>

                <div class="bento-grid-3">
                    <div class="bento-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-sq bg-blue-soft text-primary fs-4" style="width: 50px; height: 50px;">⚡
                                </div>
                                <h5 class="fw-bold mb-0 fs-4">Física</h5>
                            </div>
                            <span class="badge bg-dark text-white rounded-pill px-3 py-2">Nvl. 12</span>
                        </div>
                        <p class="text-muted small fw-bold mb-4">Clase: Mago de la Dinámica</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between mb-2 small fw-bold text-secondary">
                                <span>XP: 234 / 500</span>
                                <span>Próximo nivel</span>
                            </div>
                            <div class="progress" style="height: 12px; border-radius: 12px; background-color: #E7F1FF;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    role="progressbar" style="width: 46%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bento-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-sq bg-dark text-white fs-4" style="width: 50px; height: 50px;">💻</div>
                                <h5 class="fw-bold mb-0 fs-4">Programación</h5>
                            </div>
                            <span class="badge bg-dark text-white rounded-pill px-3 py-2">Nvl. 8</span>
                        </div>
                        <p class="text-muted small fw-bold mb-4">Clase: C++ Hacker (Iniciado)</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between mb-2 small fw-bold text-secondary">
                                <span>XP: 850 / 1000</span>
                                <span>¡Casi subes!</span>
                            </div>
                            <div class="progress" style="height: 12px; border-radius: 12px; background-color: #E9ECEF;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark"
                                    role="progressbar" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bento-card p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-sq bg-green-soft text-success fs-4" style="width: 50px; height: 50px;">
                                    🧪</div>
                                <h5 class="fw-bold mb-0 fs-4">Química</h5>
                            </div>
                            <span class="badge bg-dark text-white rounded-pill px-3 py-2">Nvl. 5</span>
                        </div>
                        <p class="text-muted small fw-bold mb-4">Clase: Alquimista de Laboratorio</p>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between mb-2 small fw-bold text-secondary">
                                <span>XP: 120 / 300</span>
                                <span>Próximo nivel</span>
                            </div>
                            <div class="progress" style="height: 12px; border-radius: 12px; background-color: #E6F8F0;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!--<section class="mb-5 pb-lg-3">
                <div class="d-flex justify-content-between align-items-end mb-4 px-2">
                    <div>
                        <h4 class="small-caps text-danger mb-2"><i class="bi bi-exclamation-triangle-fill"></i> EN
                            PROGRESO</h4>
                        <h3 class="fw-bold mb-0">Misiones Activas</h3>
                    </div>
                </div>

                <div class="bento-card p-0 overflow-hidden">
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item p-4 p-lg-5 d-flex align-items-md-center flex-column flex-md-row gap-4 hover-bg-light transition-all">
                            <div class="icon-sq bg-warning bg-opacity-10 text-warning fs-1 rounded-circle"
                                style="width: 80px; height: 80px; flex-shrink: 0;">🏛️</div>
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-2">Misión Principal: Ingreso a la UG</h4>
                                <p class="text-muted mb-3 fs-6">Prepárate para el examen de admisión de Agosto 2026.
                                    Objetivo: Superar los módulos de razonamiento matemático.</p>
                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge bg-danger px-3 py-2">Épica</span>
                                    <span class="badge border text-dark px-3 py-2">Recompensa: +5000 XP</span>
                                </div>
                            </div>
                            <div class="text-md-end mt-3 mt-md-0">
                                <button class="btn btn-outline-dark rounded-pill fw-bold px-4 py-2">Ver
                                    Detalles</button>
                            </div>
                        </li>

                        <li
                            class="list-group-item p-4 p-lg-5 d-flex align-items-md-center flex-column flex-md-row gap-4 hover-bg-light transition-all">
                            <div class="icon-sq bg-info bg-opacity-10 text-info fs-1 rounded-circle"
                                style="width: 80px; height: 80px; flex-shrink: 0;">📄</div>
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-2">Side Quest: Programa de Equidad Urbana</h4>
                                <p class="text-muted mb-3 fs-6">Redactar la carta de intención y solicitar tu constancia
                                    de estudios en la ENMS Silao.</p>
                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge bg-info text-dark px-3 py-2">Importante</span>
                                    <span class="badge border text-dark px-3 py-2">Recompensa: Beca + Oro</span>
                                </div>
                            </div>
                            <div class="text-md-end mt-3 mt-md-0">
                                <button class="btn btn-dark rounded-pill fw-bold px-4 py-2">Continuar</button>
                            </div>
                        </li>

                        <li
                            class="list-group-item p-4 p-lg-5 d-flex align-items-md-center flex-column flex-md-row gap-4 hover-bg-light transition-all">
                            <div class="icon-sq bg-success bg-opacity-10 text-success fs-1 rounded-circle"
                                style="width: 80px; height: 80px; flex-shrink: 0;">⚖️</div>
                            <div class="flex-grow-1">
                                <h4 class="fw-bold mb-2">Misión Diaria: Reporte de Laboratorio</h4>
                                <p class="text-muted mb-3 fs-6">Termina los cálculos de exactitud y precisión de la
                                    Práctica 3 con el uso de la balanza.</p>
                                <div class="d-flex gap-2 flex-wrap">
                                    <span class="badge bg-success px-3 py-2">Común</span>
                                    <span class="badge border text-dark px-3 py-2">Recompensa: +150 XP</span>
                                </div>
                            </div>
                            <div class="text-md-end mt-3 mt-md-0">
                                <button class="btn btn-dark rounded-pill fw-bold px-4 py-2">Completar</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>-->

            <section class="bg-soft-gray rounded-3xl mb-5 p-4 p-lg-5">
                <div class="container-fluid p-0">
                    <div class="d-flex justify-content-between align-items-end mb-5">
                        <div>
                            <h4 class="small-caps text-muted mb-2">SISTEMA DE TROFEOS</h4>
                            <h2 class="fw-bold mb-0">Mis Logros</h2>
                        </div>
                        <a href="#" class="text-decoration-none fw-bold text-primary d-none d-sm-block">Ver todos <i
                                class="bi bi-arrow-right"></i></a>
                    </div>

                    <div class="bento-grid-3">

                        <div class="bento-card position-relative p-4" style="border: 2px solid var(--accent-color);">
                            <div class="position-absolute top-0 end-0 p-3">
                                <i class="bi bi-unlock-fill fs-5" style="color: var(--accent-color);"></i>
                            </div>
                            <div class="step-icon-bg bg-blue-soft mb-4" style="width: 60px; height: 60px;">
                                <span class="fs-2">🌊</span>
                            </div>
                            <h4 class="fw-bold fs-5 mb-3">Dominio de Ondas</h4>
                            <p class="text-muted small mb-4">Completaste el módulo avanzado de óptica y ondas con
                                calificación perfecta en los simuladores.</p>
                            <div class="mt-auto">
                                <span class="badge bg-primary bg-opacity-10 text-primary w-100 py-2 fs-6">Desbloqueado:
                                    14 Feb 2026</span>
                            </div>
                        </div>

                        <div class="bento-card position-relative p-4" style="border: 2px solid #198754;">
                            <div class="position-absolute top-0 end-0 p-3">
                                <i class="bi bi-unlock-fill fs-5 text-success"></i>
                            </div>
                            <div class="step-icon-bg bg-green-soft mb-4" style="width: 60px; height: 60px;">
                                <span class="fs-2">🗣️</span>
                            </div>
                            <h4 class="fw-bold fs-5 mb-3">Maestro del Ensayo</h4>
                            <p class="text-muted small mb-4">Entregaste el ensayo perfecto para Tutoría V. ¡El profe
                                Víctor está orgulloso!</p>
                            <div class="mt-auto">
                                <span class="badge bg-success bg-opacity-10 text-success w-100 py-2 fs-6">Desbloqueado:
                                    Nov 2025</span>
                            </div>
                        </div>

                        <div class="bento-card position-relative bg-light p-4"
                            style="border: 1px dashed var(--border-light); opacity: 0.85;">
                            <div class="position-absolute top-0 end-0 p-3">
                                <i class="bi bi-lock-fill fs-5 text-secondary"></i>
                            </div>
                            <div class="step-icon-bg bg-secondary bg-opacity-10 mb-4"
                                style="width: 60px; height: 60px; filter: grayscale(1);">
                                <span class="fs-2">🏍️</span>
                            </div>
                            <h4 class="fw-bold fs-5 mb-3 text-muted">Velocidad Nitrox</h4>
                            <p class="text-muted small mb-4">Termina 5 lecciones de cinemática (MRU y MRUA) en menos de
                                10 minutos de tiempo activo.</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between mb-2 small fw-bold text-muted">
                                    <span>Progreso</span>
                                    <span>80%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 80%"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-4 text-center d-block d-sm-none">
                        <a href="#" class="text-decoration-none fw-bold text-primary">Ver todos los logros <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </section>

            <?php require_once 'components/footer.php'; ?>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>