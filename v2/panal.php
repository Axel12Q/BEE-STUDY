<?php
session_start();
// Si intentan entrar a panal.php sin iniciar sesión, los regresamos
if (!isset($_SESSION['user_id'])) {
    header("Location: sesion.php");
    exit;
}

require 'conexion.php';

// Obtener todos los datos del usuario logueado, incluyendo su foto de perfil dinámica
$stmt = $pdo->prepare("
    SELECT u.*, p.ruta AS foto_ruta 
    FROM usuarios u 
    LEFT JOIN perfiles_fotos_cat p ON u.perfil_foto_id = p.id 
    WHERE u.id = ?
");
$stmt->execute([$_SESSION['user_id']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    // Si por algo el usuario se borró de la BD, cerramos sesión
    session_destroy();
    header("Location: sesion.php");
    exit;
}

// =========================================================================
// 🚀 LÓGICA DE RECARGA AUTOMÁTICA DE VIDAS (20 MINUTOS POR VIDA)
// =========================================================================
$max_vidas_base = 6;
$tiempo_por_vida = 1200; // 1200 segundos = 20 minutos exactos

$vidas_actuales = (int)$usuario['vidas'];
$ultima_recarga = strtotime($usuario['ultima_recarga_vidas']);
$ahora = time();

if ($vidas_actuales < $max_vidas_base) {
    $segundos_pasados = $ahora - $ultima_recarga;

    if ($segundos_pasados >= $tiempo_por_vida) {
        $vidas_ganadas = floor($segundos_pasados / $tiempo_por_vida);
        $nuevas_vidas = $vidas_actuales + $vidas_ganadas;

        if ($nuevas_vidas >= $max_vidas_base) {
            $nuevas_vidas = $max_vidas_base;
            $nueva_fecha_recarga = date('Y-m-d H:i:s', $ahora);
        } else {
            $segundos_sobrantes = $segundos_pasados % $tiempo_por_vida;
            $nueva_fecha_recarga = date('Y-m-d H:i:s', $ahora - $segundos_sobrantes);
        }

        $stmtUpdate = $pdo->prepare("UPDATE usuarios SET vidas = ?, ultima_recarga_vidas = ? WHERE id = ?");
        $stmtUpdate->execute([$nuevas_vidas, $nueva_fecha_recarga, $usuario['id']]);

        $usuario['vidas'] = $nuevas_vidas;
        $usuario['ultima_recarga_vidas'] = $nueva_fecha_recarga;
    }
} else {
    $stmtUpdate = $pdo->prepare("UPDATE usuarios SET ultima_recarga_vidas = NOW() WHERE id = ?");
    $stmtUpdate->execute([$usuario['id']]);
    $usuario['ultima_recarga_vidas'] = date('Y-m-d H:i:s', $ahora);
}

// Calcular tiempo restante para el reloj visual
$vidas_mostrar = (int)$usuario['vidas'];
$ultima_recarga_mostrar = strtotime($usuario['ultima_recarga_vidas']);
$segundos_para_siguiente_vida = 0;

if ($vidas_mostrar < $max_vidas_base) {
    $segundos_pasados_mostrar = $ahora - $ultima_recarga_mostrar;
    $segundos_para_siguiente_vida = $tiempo_por_vida - $segundos_pasados_mostrar;
    if ($segundos_para_siguiente_vida < 0) $segundos_para_siguiente_vida = 0;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Abeja GO 🐝 | Aprender Álgebra</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style_panal.css">

    <style>
        /* ===================================================
           ESTILOS DEL BOTÓN DE VIDAS Y LA TARJETA FLOTANTE (FIXED)
        =================================================== */
        .vidas-btn-clickable {
            background: var(--pastel-red-light);
            padding: 4px 14px !important;
            border-radius: 20px;
            border: 2px solid rgba(231, 76, 60, 0.2);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            user-select: none;
        }

        .vidas-btn-clickable:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(231, 76, 60, 0.15);
            border-color: var(--pastel-red);
        }

        .vidas-btn-clickable:active {
            transform: translateY(1px);
        }

        /* Usamos fixed para sacar la tarjeta de las peleas de contenedores */
        .lives-dropdown {
            position: fixed !important;
            background: var(--abeja-white);
            min-width: 270px;
            border: 2px solid var(--abeja-gray-light);
            border-radius: 24px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
            z-index: 9999999 !important;
            /* Más alto imposible */
            cursor: default;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
        }

        /* Clase para mostrarlo suavemente */
        .lives-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Flechita apuntando hacia arriba */
        .lives-dropdown::before {
            content: '';
            position: absolute;
            top: -9px;
            right: 40px;
            /* Alineado para PC por defecto */
            width: 16px;
            height: 16px;
            background: var(--abeja-white);
            border-top: 2px solid var(--abeja-gray-light);
            border-left: 2px solid var(--abeja-gray-light);
            transform: rotate(45deg);
        }

        /* Alineación de la flechita para el móvil */
        @media (max-width: 991px) {
            .lives-dropdown::before {
                right: 30px;
            }
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

    <div id="global-lives-dropdown" class="lives-dropdown">
        <div class="d-flex align-items-center justify-content-start mb-1">
            <div class="d-flex align-items-center justify-content-center me-3" style="background-color: var(--pastel-red-light); color: var(--pastel-red-dark); width: 48px; height: 48px; border-radius: 14px; font-size: 1.3rem;">
                <i class="fa-solid fa-heart"></i>
            </div>
            <div class="text-start">
                <h5 class="m-0 fw-bold" style="color: var(--abeja-dark); font-size: 1.15rem;">Tus Vidas</h5>
                <span class="text-muted fw-bold" style="font-size: 0.9rem;"><?= $usuario['vidas'] ?> / <?= $max_vidas_base ?> llenas</span>
            </div>
        </div>

        <div style="height: 3px; background: var(--abeja-gray-light); margin: 15px 0; border-radius: 2px;"></div>

        <div class="lives-timer-container">
            <?php if ($usuario['vidas'] < $max_vidas_base): ?>
                <p class="text-muted fw-bold mb-2" style="font-size: 0.8rem; letter-spacing: 0.5px; text-transform: uppercase;">Siguiente vida en:</p>

                <div class="d-flex align-items-center justify-content-center text-primary fw-bold mb-3 mx-auto" style="font-size: 1.8rem; letter-spacing: 2px; background: var(--primary-blue-light); padding: 8px 15px; border-radius: 16px; border: 2px solid rgba(52, 152, 219, 0.2); width: fit-content;">
                    <i class="fa-regular fa-clock me-2" style="font-size: 1.4rem; color: var(--primary-blue);"></i>
                    <span class="lives-countdown" data-seconds="<?= $segundos_para_siguiente_vida ?>" style="color: var(--primary-blue-dark);">
                        <?= sprintf('%02d:%02d', floor($segundos_para_siguiente_vida / 60), $segundos_para_siguiente_vida % 60) ?>
                    </span>
                </div>

                <div class="d-inline-flex align-items-center justify-content-center" style="background: var(--pastel-green-light); color: var(--pastel-green-dark); padding: 8px 16px; border-radius: 14px; font-weight: 800; font-size: 0.95rem; border: 2px solid rgba(26, 188, 156, 0.2);">
                    <i class="fa-solid fa-heart-circle-plus me-2 fs-5"></i> +1 Vida
                </div>
            <?php else: ?>
                <div class="p-3 rounded-4 mt-2" style="background: rgba(229, 180, 0, 0.1); border: 2px solid rgba(229, 180, 0, 0.2);">
                    <i class="fa-solid fa-face-grin-stars text-warning mb-2" style="font-size: 2.5rem;"></i>
                    <p class="mb-0 fw-bold" style="color: var(--primary-yellow-text); font-size: 0.95rem;">¡Tienes tus vidas al máximo!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div id="app-wrapper">

        <header class="mobile-top-bar d-lg-none">
            <div class="user-profile-info border-0 p-0 sound-nav" style="cursor:pointer;" data-page="perfil">
                <img src="<?= htmlspecialchars($usuario['foto_ruta'] ?? 'perfil-imgs/1.png') ?>" alt="Avatar" class="user-avatar" style="width: 50px; height: 50px; object-fit: cover;">
                <h6 class="m-0 fw-bold" style="color: var(--abeja-dark);">
                    <?= htmlspecialchars(strtok(trim($usuario['nombre']), ' ')) ?>
                </h6>
            </div>
            <div class="user-stats d-flex align-items-center">
                <div class="text-orange sound-item" style="cursor:pointer;" title="Racha">
                    <i class="fa-solid fa-fire"></i><span><?= $usuario['racha_dias'] ?></span>
                </div>
                <div class="text-warning sound-item" style="cursor:pointer;" title="Miel">
                    <i class="fa-solid fa-droplet"></i><span><?= number_format($usuario['miel']) ?></span>
                </div>

                <div id="btn-vidas-mobile" class="text-danger sound-item vidas-btn-toggle vidas-btn-clickable sound-action" title="Vidas">
                    <i class="fa-solid fa-heart"></i><span class="fw-bold" style="font-size: 1rem;"><?= $usuario['vidas'] ?></span>
                </div>

                <div class="top-config-divider"></div>
                <div class="top-config-btn sound-nav" data-page="configuracion" style="cursor:pointer;" title="Configuración">
                    <i class="fa-solid fa-gear"></i>
                </div>
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
                    <div class="user-profile-info sound-nav" style="cursor:pointer;" data-page="perfil">
                        <img src="<?= htmlspecialchars($usuario['foto_ruta'] ?? 'perfil-imgs/1.png') ?>" alt="Avatar" class="user-avatar" style="object-fit: cover;">
                        <h5 class="m-0 fw-bold" style="color: var(--abeja-dark);">
                            <?= htmlspecialchars(strtok(trim($usuario['nombre']), ' ')) ?>
                        </h5>
                    </div>
                    <div class="user-stats align-items-center">
                        <div class="text-orange sound-item" title="Racha" style="cursor:pointer;">
                            <i class="fa-solid fa-fire me-1"></i> <?= $usuario['racha_dias'] ?>
                        </div>
                        <div class="text-warning sound-item" title="Miel" style="cursor:pointer;">
                            <i class="fa-solid fa-droplet me-1" style="color: #FFC107;"></i> <?= number_format($usuario['miel']) ?>
                        </div>

                        <div id="btn-vidas-pc" class="text-danger sound-item vidas-btn-toggle vidas-btn-clickable sound-action" title="Vidas">
                            <i class="fa-solid fa-heart me-1"></i> <span class="fw-bold" style="font-size: 1.05rem;"><?= $usuario['vidas'] ?></span>
                        </div>
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

    <script src="js/script_nav_dinamica.js"></script>
    <script src="js/script_sonido_por_clases.js"></script>
    <script src="js/script_abejas_efectos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // =========================================
            // LÓGICA DEL RELOJ DE VIDAS
            // =========================================
            function startLivesTimer() {
                const timerElement = document.querySelector('.lives-countdown');
                if (!timerElement) return;

                let remainingSeconds = parseInt(timerElement.getAttribute('data-seconds'));
                if (isNaN(remainingSeconds) || remainingSeconds <= 0) return;

                const countdownInterval = setInterval(() => {
                    remainingSeconds--;

                    if (remainingSeconds < 0) {
                        clearInterval(countdownInterval);
                        window.location.reload();
                    } else {
                        const minutes = Math.floor(remainingSeconds / 60);
                        const seconds = remainingSeconds % 60;
                        timerElement.innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }
                }, 1000);
            }
            startLivesTimer();

            // =========================================
            // LÓGICA DE LA TARJETA FLOTANTE DE VIDAS (CORREGIDA)
            // =========================================
            const vidasBtns = document.querySelectorAll('.vidas-btn-toggle');
            const globalDropdown = document.getElementById('global-lives-dropdown');
            let dropdownOpen = false;

            // Función para posicionar el dropdown exactamente debajo del botón clickeado
            function positionDropdown(button) {
                const rect = button.getBoundingClientRect();
                // Ajustamos la posición top para que quede justo debajo del botón
                globalDropdown.style.top = `${rect.bottom + 15}px`;

                // Alineación horizontal: en PC lo alineamos por la derecha, en móvil intentamos centrarlo un poco
                if (window.innerWidth >= 992) {
                    globalDropdown.style.right = `${window.innerWidth - rect.right - 10}px`;
                    globalDropdown.style.left = 'auto';
                } else {
                    globalDropdown.style.right = '10px';
                    globalDropdown.style.left = 'auto';
                }
            }

            vidasBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();

                    if (dropdownOpen) {
                        globalDropdown.classList.remove('show');
                        dropdownOpen = false;
                    } else {
                        positionDropdown(btn);
                        globalDropdown.classList.add('show');
                        dropdownOpen = true;
                    }
                });
            });

            // Evitar que el clic dentro de la tarjeta la cierre
            globalDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
            });

            // Cerrar al hacer clic fuera o hacer scroll
            document.addEventListener('click', () => {
                if (dropdownOpen) {
                    globalDropdown.classList.remove('show');
                    dropdownOpen = false;
                }
            });

            // Si el usuario hace scroll en el panel central, ocultamos la tarjeta flotante
            const mainZone = document.querySelector('.main-zone');
            if (mainZone) {
                mainZone.addEventListener('scroll', () => {
                    if (dropdownOpen) {
                        globalDropdown.classList.remove('show');
                        dropdownOpen = false;
                    }
                }, {
                    passive: true
                });
            }

        });
    </script>
</body>

</html>