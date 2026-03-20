<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Práctica Activa - AbejaGO 🐝</title>
    
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

    <style>
        /* --- BLOQUEO DE SCROLL GLOBAL --- */
        body {
            height: 100vh !important;
            max-height: 100vh !important;
            overflow: hidden !important; /* Bloquea el deslizamiento de toda la página */
        }

        .app-layout {
            height: 100vh;
            overflow: hidden;
        }

        /* --- ESTILOS ESPECÍFICOS PARA LA VISTA DE PRÁCTICA --- */
        
        /* Ajuste estricto para que main-content mida exactamente 100vh */
        .main-content {
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 20px 40px !important; /* Padding ajustado para PC */
            overflow: hidden; 
        }

        /* Contenedor superior más compacto para subir el contenido */
        .practice-header-container {
            margin-top: 10px; /* Subimos la barra de progreso */
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        /* Capsulitas de progreso */
        .progress-capsules {
            display: flex;
            gap: 8px;
            width: 100%;
        }

        .capsule {
            height: 12px;
            border-radius: 20px;
            flex-grow: 1;
            transition: all 0.3s ease;
        }

        .capsule.active {
            background-color: var(--accent-color);
            box-shadow: 0 0 10px rgba(13, 110, 253, 0.4);
        }

        .capsule.completed {
            background-color: var(--accent-color);
            opacity: 0.8;
        }

        .capsule.pending {
            background-color: var(--border-light);
        }

        /* Lienzo blanco central (Ocupa exactamente el espacio sobrante) */
        .practice-workspace {
            background-color: white;
            border-radius: var(--radius-xl);
            border: 2px dashed var(--border-light);
            flex-grow: 1; /* Esto lo hace estirarse mágicamente */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            box-shadow: var(--shadow-soft);
            overflow-y: auto; /* Solo si la práctica en sí es muy larga, hace scroll internamente, no en la página */
        }

        /* Barra flotante inferior para Móvil (Anclada absoluta) */
        .mobile-practice-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            border-top: 1px solid var(--border-light);
            padding: 15px 20px;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.05);
            z-index: 1030;
            display: flex;
            align-items: center;
            gap: 15px;
            transform: translateY(100%);
            animation: slideUp 0.5s cubic-bezier(0.25, 0.8, 0.25, 1) forwards 1s;
        }

        @keyframes slideUp {
            to { transform: translateY(0); }
        }

        /* --- ADAPTACIÓN PERFECTA PARA MÓVILES --- */
        @media (max-width: 767px) {
            .main-content {
                /* Dejamos un relleno inferior equivalente a la barra para que no la tape */
                padding: 25px 25px 95px 25px !important; 
            }
            #bar-progress {
                margin-top: 25px; margin-bottom: 10px;
            }
            .practice-header-container {
                margin-top: 50px; /* Espacio para el botón de menú en móvil */
                flex-direction: column;
            }
            /* Posicionamos el botón menú flotando arriba a la izquierda para ahorrar espacio */
            #menuToggle {
                position: absolute;
                top: 25px;
                left: 25px;
                margin: 0 !important;
                z-index: 100;
            }
            .practice-workspace {
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>

    <div class="app-layout">
        <?php require_once 'components/nav.php'; ?>

        <main class="main-content">

            <button class="menu-toggle-cylinder d-md-none mb-3" id="menuToggle" aria-label="Abrir menú">
                <div class="cylinder-face"></div>
                <i class="bi bi-list"></i>
            </button>

            <div class="practice-header-container animate-fade-up">
                
                <button class="menu-toggle-cylinder d-none d-md-inline-flex me-4 flex-shrink-0" id="menuToggleDesktop" aria-label="Abrir menú" onclick="document.getElementById('menuToggle').click()">
                    <div class="cylinder-face"></div>
                    <i class="bi bi-list"></i>
                    <span class="ms-2">Menú</span>
                </button>

                <div class="d-flex align-items-center justify-content-between w-100">
                    
                    <div class="d-none d-md-flex flex-column align-items-start" style="width: 250px; flex-shrink: 0;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="step-icon-bg bg-blue-soft mb-0 shadow-sm" style="width: 50px; height: 50px; border-radius: 50%;">
                                <span class="fs-5 fw-bold text-primary">3</span>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-truncate" style="max-width: 200px; font-size: 1.2rem;">Leyes de Newton</h4>
                                <p class="text-muted small mb-0 fw-bold text-uppercase" style="letter-spacing: 1px;">Práctica Activa</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex-grow-1 ms-md-4" id="bar-progress">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-bold text-secondary small d-md-none">Tu Progreso</span>
                            <span class="fw-bold text-primary small ms-auto">3 de 5 completados</span>
                        </div>
                        <div class="progress-capsules">
                            <div class="capsule completed"></div>
                            <div class="capsule completed"></div>
                            <div class="capsule active"></div>
                            <div class="capsule pending"></div>
                            <div class="capsule pending"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="practice-workspace animate-fade-up" style="animation-delay: 0.1s;">
                <div class="text-center p-4">
                    <span class="display-1 opacity-25 mb-3 d-block">🛠️</span>
                    <h2 class="fw-bold text-muted mb-2">Lienzo de Práctica</h2>
                    <p class="text-secondary fw-bold">No podrás hacer scroll en la página, este cuadro se adapta al espacio perfecto.</p>
                </div>
            </div>

        </main>

        <div class="mobile-practice-bar d-md-none">
            <div class="step-icon-bg bg-blue-soft mb-0 flex-shrink-0 shadow-sm" style="width: 45px; height: 45px; border-radius: 50%;">
                <span class="fs-5 fw-bold text-primary">3</span>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <h6 class="fw-bold mb-0 text-truncate" style="font-size: 1rem;">Leyes de Newton</h6>
                <p class="text-muted mb-0" style="font-size: 0.75rem; font-weight: 800;">PRÁCTICA ACTIVA</p>
            </div>
            <button class="btn btn-light rounded-circle flex-shrink-0" style="width: 40px; height: 40px;">
                <i class="bi bi-pause-fill text-secondary"></i>
            </button>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>