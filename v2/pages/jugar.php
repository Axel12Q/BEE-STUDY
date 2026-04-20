<?php
session_start();
require '../conexion.php'; // Conectamos a la BD

if (!isset($_SESSION['user_id'])) exit;
$user_id = $_SESSION['user_id'];

// =========================================================================
// 🚀 BACKEND: MANEJADOR AJAX DE LA RULETA Y COFRES
// =========================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'abrir_cofre') {
    header('Content-Type: application/json');
    $nodo_id = (int)$_POST['nodo_id'];
    $curso_id = (int)$_POST['curso_id'];

    // 1. Validar que el cofre siga "activo"
    $stmtCheck = $pdo->prepare("SELECT estado FROM progreso_usuario WHERE usuario_id = ? AND nodo_id = ?");
    $stmtCheck->execute([$user_id, $nodo_id]);
    if ($stmtCheck->fetchColumn() !== 'activo') {
        echo json_encode(['status' => 'error', 'msg' => 'Cofre ya reclamado o no disponible']);
        exit;
    }

    // 2. Determinar Rareza al Azar (Probabilidades)
    $rand = mt_rand(1, 100);
    if ($rand <= 5) $rareza = 'legendario';      // 5%
    elseif ($rand <= 20) $rareza = 'epico';      // 15%
    elseif ($rand <= 50) $rareza = 'raro';       // 30%
    else $rareza = 'comun';                      // 50%

    $color_map = ['legendario' => 'hex-color-gold', 'epico' => 'hex-color-purple', 'raro' => 'hex-color-blue', 'comun' => 'hex-color-comun'];
    $is_miel = (mt_rand(1, 100) <= 25); // 25% de probabilidad de que solo de Miel
    $premio = [];

    // 3. Generar Premio
    if ($is_miel) {
        $miel = ($rareza == 'legendario') ? 500 : (($rareza == 'epico') ? 250 : (($rareza == 'raro') ? 100 : 50));
        $pdo->prepare("UPDATE usuarios SET miel = miel + ? WHERE id = ?")->execute([$miel, $user_id]);
        $premio = [
            'tipo' => 'miel',
            'nombre' => "+$miel Gotas de Miel",
            'desc' => '¡Deliciosa miel añadida directamente a tu reserva actual!',
            'icono' => 'fa-droplet',
            'rareza' => $rareza,
            'color' => 'hex-color-gold'
        ];
    } else {
        $stmtItem = $pdo->prepare("SELECT * FROM inventario_cat WHERE rareza = ? ORDER BY RAND() LIMIT 1");
        $stmtItem->execute([$rareza]);
        $item = $stmtItem->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            $stmtInv = $pdo->prepare("SELECT id FROM usuario_inventario WHERE usuario_id = ? AND inventario_id = ?");
            $stmtInv->execute([$user_id, $item['id']]);
            if ($stmtInv->rowCount() > 0) {
                $pdo->prepare("UPDATE usuario_inventario SET cantidad = cantidad + 1 WHERE usuario_id = ? AND inventario_id = ?")->execute([$user_id, $item['id']]);
            } else {
                $pdo->prepare("INSERT INTO usuario_inventario (usuario_id, inventario_id, cantidad) VALUES (?, ?, 1)")->execute([$user_id, $item['id']]);
            }
            $premio = [
                'tipo' => 'item',
                'nombre' => $item['nombre'],
                'desc' => '¡Increíble! Este objeto se ha añadido a tu página de coleccionables en el Perfil.',
                'icono' => $item['icono_css'],
                'rareza' => $rareza,
                'color' => $color_map[$rareza]
            ];
        } else {
            // Fallback en caso de que no haya items de esa rareza
            $pdo->prepare("UPDATE usuarios SET miel = miel + 100 WHERE id = ?")->execute([$user_id]);
            $premio = ['tipo' => 'miel', 'nombre' => "+100 Gotas de Miel", 'desc' => '¡Deliciosa miel añadida a tu reserva!', 'icono' => 'fa-droplet', 'rareza' => 'raro', 'color' => 'hex-color-gold'];
        }
    }

    // 4. Actualizar Progreso (Avanzar al siguiente nodo)
    $pdo->prepare("UPDATE progreso_usuario SET estado = 'completado' WHERE usuario_id = ? AND nodo_id = ?")->execute([$user_id, $nodo_id]);

    $stmtNext = $pdo->prepare("
        SELECT n2.id 
        FROM nodos n1
        JOIN secciones s1 ON n1.seccion_id = s1.id
        JOIN secciones s2 ON s1.curso_id = s2.curso_id
        JOIN nodos n2 ON n2.seccion_id = s2.id
        WHERE n1.id = ? AND (s2.id > s1.id OR (s2.id = s1.id AND n2.orden > n1.orden))
        ORDER BY s2.id ASC, n2.orden ASC LIMIT 1
    ");
    $stmtNext->execute([$nodo_id]);
    $next_nodo = $stmtNext->fetchColumn();

    if ($next_nodo) {
        $max_nodo = ($curso_id == 1) ? 23 : 41; // Límites del curso
        if ($next_nodo <= $max_nodo) {
            $stmtCheckNext = $pdo->prepare("SELECT id FROM progreso_usuario WHERE usuario_id = ? AND nodo_id = ?");
            $stmtCheckNext->execute([$user_id, $next_nodo]);
            if ($stmtCheckNext->rowCount() == 0) {
                $pdo->prepare("INSERT INTO progreso_usuario (usuario_id, nodo_id, estado) VALUES (?, ?, 'activo')")->execute([$user_id, $next_nodo]);
            }
        }
    }

    // 5. Generar Rellenos (Dummies) asegurando que SIEMPRE haya 25 espacios
    $stmtAll = $pdo->query("SELECT icono_css, rareza FROM inventario_cat");
    $all_items = [];
    while ($row = $stmtAll->fetch(PDO::FETCH_ASSOC)) {
        $all_items[] = ['icono' => $row['icono_css'], 'color' => $color_map[$row['rareza']]];
    }

    $dummies = [];
    for ($i = 0; $i < 25; $i++) {
        if (count($all_items) > 0) {
            $dummies[] = $all_items[array_rand($all_items)]; // Escoge uno al azar para rellenar
        } else {
            $dummies[] = ['icono' => 'fa-gift', 'color' => 'hex-color-comun'];
        }
    }

    // Forzamos al ganador exactamente en la posición 22
    $dummies[22] = ['icono' => $premio['icono'], 'color' => $premio['color']];

    echo json_encode(['status' => 'success', 'premio' => $premio, 'dummies' => $dummies]);
    exit;
}

// 1. Procesar la inscripción si el usuario le dio clic al botón "Inscribirme"
if (isset($_GET['inscribir_curso_id'])) {
    $curso_inscribir = intval($_GET['inscribir_curso_id']);

    $stmtIns = $pdo->prepare("INSERT IGNORE INTO usuario_cursos (usuario_id, curso_id) VALUES (?, ?)");
    $stmtIns->execute([$user_id, $curso_inscribir]);

    $stmtPrimerNodo = $pdo->prepare("
        SELECT n.id 
        FROM nodos n
        INNER JOIN secciones s ON n.seccion_id = s.id
        WHERE s.curso_id = ?
        ORDER BY s.id ASC, n.orden ASC
        LIMIT 1
    ");
    $stmtPrimerNodo->execute([$curso_inscribir]);
    $primerNodo = $stmtPrimerNodo->fetch(PDO::FETCH_ASSOC);

    if ($primerNodo) {
        $stmtCheck = $pdo->prepare("SELECT id FROM progreso_usuario WHERE usuario_id = ? AND nodo_id = ?");
        $stmtCheck->execute([$user_id, $primerNodo['id']]);

        if ($stmtCheck->rowCount() == 0) {
            $stmtActivar = $pdo->prepare("INSERT INTO progreso_usuario (usuario_id, nodo_id, estado) VALUES (?, ?, 'activo')");
            $stmtActivar->execute([$user_id, $primerNodo['id']]);
        }
    }
}

// 2. Determinar qué curso estamos viendo
if (isset($_GET['curso'])) {
    $curso_actual_id = intval($_GET['curso']);
    $stmtUpdate = $pdo->prepare("UPDATE usuarios SET ultimo_curso_id = ? WHERE id = ?");
    $stmtUpdate->execute([$curso_actual_id, $user_id]);
} else {
    $stmtLastCourse = $pdo->prepare("SELECT ultimo_curso_id FROM usuarios WHERE id = ?");
    $stmtLastCourse->execute([$user_id]);
    $row = $stmtLastCourse->fetch(PDO::FETCH_ASSOC);
    $curso_actual_id = ($row && !empty($row['ultimo_curso_id'])) ? $row['ultimo_curso_id'] : 1;
}

// 3. Traer todos los cursos e inscripciones
$stmtCursos = $pdo->prepare("
    SELECT c.*, 
           (SELECT COUNT(*) FROM usuario_cursos uc WHERE uc.curso_id = c.id AND uc.usuario_id = ?) as inscrito
    FROM cursos c
");
$stmtCursos->execute([$user_id]);
$cursos = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);

$curso_actual = null;
$esta_inscrito = false;
foreach ($cursos as $c) {
    if ($c['id'] == $curso_actual_id) {
        $curso_actual = $c;
        $esta_inscrito = ($c['inscrito'] > 0);
    }
}
if (!$curso_actual && count($cursos) > 0) {
    $curso_actual = $cursos[0];
    $curso_actual_id = $curso_actual['id'];
    $esta_inscrito = ($curso_actual['inscrito'] > 0);
}

$stmtSecciones = $pdo->prepare("SELECT * FROM secciones WHERE curso_id = ? ORDER BY id ASC");
$stmtSecciones->execute([$curso_actual_id]);
$secciones = $stmtSecciones->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    /* Estilos del Modal y Ruleta de Cofres */
    .modal-abeja-custom {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 999999;
        background-color: rgba(44, 62, 80, 0.7);
        backdrop-filter: blur(5px);
        opacity: 0;
        transition: opacity 0.3s;
        align-items: center;
        justify-content: center;
    }

    .modal-abeja-custom.show {
        display: flex !important;
        opacity: 1;
    }

    .modal-dialog-custom {
        position: relative;
        width: 90%;
        max-width: 450px;
        transform: scale(0.95);
        transition: transform 0.3s;
    }

    .modal-abeja-custom.show .modal-dialog-custom {
        transform: scale(1);
    }

    .modal-content-abeja {
        border-radius: 24px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        background-color: var(--abeja-white);
        overflow: hidden;
        border: 2px solid var(--abeja-gray-medium);
        padding: 25px;
        text-align: center;
    }

    .btn-submit-request {
        background-color: var(--primary-blue);
        color: white;
        border: none;
        border-radius: 14px;
        padding: 12px;
        font-weight: 900;
        transition: all 0.2s;
        box-shadow: 0 6px 15px rgba(93, 173, 226, 0.3);
    }

    .btn-submit-request:hover {
        background-color: var(--primary-blue-dark);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(93, 173, 226, 0.4);
    }

    .btn-stay {
        background-color: var(--pastel-green-dark);
        color: white;
        border: none;
        border-radius: 14px;
        padding: 12px 25px;
        font-weight: 900;
        transition: all 0.2s;
        box-shadow: 0 6px 15px rgba(26, 188, 156, 0.3);
    }

    .btn-stay:hover {
        background-color: #117A65;
        transform: translateY(-2px);
    }

    /* Cofres grises sólidos (Sin transparencia, full 3D apagado) */
    .state-chest-locked {
        filter: grayscale(100%);
        opacity: 1;
        cursor: not-allowed;
    }

    .btn-hex-wrapper.state-chest-locked .btn-hex {
        background-color: var(--abeja-gray-medium) !important;
        border-bottom: 6px solid var(--abeja-gray-dark) !important;
        color: var(--abeja-text-muted) !important;
        box-shadow: none !important;
    }

    /* Hexágonos de perfil adaptados para Ruleta con EFECTO 3D (Sombra Opaca) */
    /* Hexágonos de la Ruleta con Colores VIBRANTES y 3D Suave */
    .perfil-hex-container {
        width: 70px;
        height: 80px;
        position: relative;
        flex-shrink: 0;
    }

    .perfil-hex-inner {
        width: 100%;
        height: 100%;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2.2rem;
        color: white;
    }

    .perfil-hex-inner i {
        text-shadow: none !important;
        filter: drop-shadow(0px 0px 0px rgba(0, 0, 0, 0)) !important;
        opacity: 1 !important;
        color: #FFF;
    }

    /* Efecto 3D con colores vivos y sombras semi-transparentes */
    .hex-color-orange {
        filter: drop-shadow(0 5px 0px rgba(255, 149, 0, 0.99));
    }

    .hex-color-orange .perfil-hex-inner {
        background-color: var(--secondary-orange-dark);
    }

    .hex-color-green {
        filter: drop-shadow(0 5px 0px rgba(26, 188, 156, 0.4));
    }

    .hex-color-green .perfil-hex-inner {
        background-color: var(--pastel-green-dark);
    }

    .hex-color-blue {
        filter: drop-shadow(0 5px 0px rgba(52, 152, 219, 0.4));
    }

    .hex-color-blue .perfil-hex-inner {
        background-color: var(--primary-blue);
    }

    .hex-color-purple {
        filter: drop-shadow(0 5px 0px rgba(142, 68, 173, 0.4));
    }

    .hex-color-purple .perfil-hex-inner {
        background-color: var(--pastel-purple);
    }

    .hex-color-gold {
        filter: drop-shadow(0 5px 0px rgba(229, 180, 0, 0.4));
    }

    .hex-color-gold .perfil-hex-inner {
        background-color: var(--primary-yellow-dark);
    }

    .hex-color-comun {
        filter: drop-shadow(0 5px 0px rgba(131, 145, 146, 0.4));
    }

    .hex-color-comun .perfil-hex-inner {
        background-color: var(--abeja-text-muted);
    }

    .badge-dinamico {
        padding: 6px 16px;
        border-radius: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
    }

    .badge-dinamico.legendario {
        background-color: #FFF9E6;
        color: var(--primary-yellow-dark);
        border: 2px solid var(--primary-yellow-dark);
    }

    .badge-dinamico.epico {
        background-color: var(--pastel-purple-light);
        color: var(--pastel-purple-dark);
        border: 2px solid var(--pastel-purple);
    }

    .badge-dinamico.raro {
        background-color: var(--primary-blue-light);
        color: var(--primary-blue-dark);
        border: 2px solid var(--primary-blue);
    }

    .badge-dinamico.comun {
        background-color: var(--abeja-gray-light);
        color: var(--abeja-text-muted);
        border: 2px solid var(--abeja-gray-medium);
    }
</style>

<div class="landscape-warning">
    <i class="fa-solid fa-mobile-screen-button rotate-icon"></i>
    <h3 class="mt-4 fw-bold" style="color: var(--abeja-dark);">¡Gira tu teléfono!</h3>
    <p class="text-muted fw-bold">Abeja GO funciona mejor en vertical para que no te pierdas ningún detalle de tu ruta de aprendizaje.</p>
</div>
<div class="scroll-mask-top"></div>

<div class="bg-floating-hexagons">
    <div class="floating-hex-bg" style="width:100px; height:100px; top: 2%; left: 10%; animation-duration: 20s;"></div>
    <div class="floating-hex-bg" style="width:70px; height:70px; top: 10%; right: 15%; animation-duration: 15s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:130px; height:130px; top: 35%; left: 15%; animation-duration: 28s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:110px; height:110px; top: 52%; left: 35%; animation-duration: 19s; animation-direction: reverse;"></div>
</div>

<div class="sticky-course-mobile">
    <div style="position: relative; display: inline-block; width: 100%;" class="fade-in-section">
        <button class="course-selector-btn sound-nav" type="button" id="customCourseBtn">
            <div class="course-icon-box"><i class="fa-solid <?= htmlspecialchars($curso_actual['icono']) ?>"></i></div>
            <div class="text-start">
                <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1px;">CURSO ACTUAL</span>
                <span class="d-block fw-bold" style="font-size: 1.15rem; color: var(--abeja-dark); line-height: 1;"><?= htmlspecialchars($curso_actual['nombre']) ?></span>
            </div>
            <i class="fa-solid fa-chevron-down ms-auto text-muted"></i>
        </button>

        <ul class="dropdown-menu custom-dropdown-menu border-0 shadow-lg rounded-4 p-2 w-100" id="customCourseMenu" style="z-index: 2000 !important;">
            <?php foreach ($cursos as $c):
                $is_active = ($c['id'] == $curso_actual_id);
                $is_enrolled = ($c['inscrito'] > 0);
                $is_physics = ($c['id'] == 2); // Identificador del curso de Física
            ?>
                <li>
                    <?php if ($is_physics): ?>
                        <a class="dropdown-item d-flex align-items-center p-2 rounded-3 course-not-enrolled"
                            href="#" style="cursor: pointer; opacity: 0.8;"
                            onclick="abrirModalFisica(); return false;">
                            <div class="course-icon-box me-3 bg-light text-muted border border-light" style="width: 35px; height: 35px; font-size: 1rem;">
                                <i class="fa-solid <?= htmlspecialchars($c['icono']) ?>"></i>
                            </div>
                            <div class="text-start">
                                <span class="fw-bold text-muted d-block" style="line-height: 1.2;"><?= htmlspecialchars($c['nombre']) ?></span>
                                <small class="text-danger fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">APRUEBA ÁLGEBRA</small>
                            </div>
                            <i class="fa-solid fa-lock ms-auto text-muted"></i>
                        </a>
                    <?php else: ?>
                        <a class="dropdown-item sound-nav d-flex align-items-center p-2 rounded-3 <?= $is_active ? 'active' : '' ?> <?= !$is_enrolled ? 'course-not-enrolled' : '' ?>"
                            href="#" onclick="changeCourse(<?= $c['id'] ?>); return false;">
                            <div class="course-icon-box me-3 <?= !$is_active ? 'bg-light text-muted border border-light' : '' ?>" style="width: 35px; height: 35px; font-size: 1rem;">
                                <i class="fa-solid <?= htmlspecialchars($c['icono']) ?>"></i>
                            </div>
                            <span class="fw-bold <?= !$is_active ? 'text-muted' : '' ?>"><?= htmlspecialchars($c['nombre']) ?></span>
                            <?php if ($is_active): ?>
                                <i class="fa-solid fa-circle-check ms-auto"></i>
                            <?php elseif (!$is_enrolled): ?>
                                <i class="fa-solid fa-lock ms-auto text-muted"></i>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="modal-abeja-custom" id="modalFisicaBloqueado">
            <div class="modal-dialog-custom">
                <div class="modal-content-abeja">
                    <div style="font-size: 4.5rem; color: var(--pastel-red-dark); margin-bottom: 10px; filter: drop-shadow(0 10px 15px rgba(231,76,60,0.3));">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <h3 style="color: var(--abeja-dark); font-weight: 900;">¡Curso Bloqueado!</h3>
                    <p class="text-muted fw-bold mb-4">Para descubrir los misterios de <strong>Física</strong>, primero debes completar todo tu entrenamiento en <strong>Álgebra</strong>. ¡Sigue esforzándote!</p>
                    <button class="btn-submit-request w-100 fs-5" style="background-color: var(--pastel-red-dark); box-shadow: 0 6px 15px rgba(231,76,60,0.3);" onclick="cerrarModalFisica()">
                        <i class="fa-solid fa-check me-2"></i>¡Entendido!
                    </button>
                </div>
            </div>
        </div>

        <script>
            // Limpieza previa (por si se recarga la vista dinámica varias veces)
            document.querySelectorAll('body > #modalFisicaBloqueado').forEach(el => el.remove());

            function abrirModalFisica() {
                const modal = document.getElementById('modalFisicaBloqueado');
                if (modal) {
                    document.body.appendChild(modal); // Lo mandamos al root para evitar conflictos de z-index
                    modal.style.display = 'flex';
                    void modal.offsetWidth; // Forzamos reflow para la animación
                    modal.classList.add('show');

                    // Cerramos el menú desplegable automáticamente
                    const menu = document.getElementById('customCourseMenu');
                    if (menu) menu.classList.remove('show');
                }
            }

            function cerrarModalFisica() {
                const modal = document.getElementById('modalFisicaBloqueado');
                if (modal) {
                    modal.classList.remove('show');
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 300);
                }
            }
        </script>
    </div>
</div>

<div style="position: relative; min-height: 600px;">
    <?php if (!$esta_inscrito): ?>
        <div class="enroll-overlay fade-in-section">
            <div class="enroll-card">
                <i class="fa-solid fa-lock mb-3" style="font-size: 3rem; color: var(--abeja-gray-dark);"></i>
                <h4 class="fw-bold" style="color: var(--abeja-dark);">Curso Bloqueado</h4>
                <p class="text-muted fw-bold mb-4">Aún no estás inscrito en el curso de <?= htmlspecialchars($curso_actual['nombre']) ?>.</p>
                <button class="btn-duo-form sound-action" onclick="enrollCourse(<?= $curso_actual_id ?>)">¡Inscribirme Ahora!</button>
            </div>
        </div>
    <?php endif; ?>

    <div class="<?= !$esta_inscrito ? 'content-blurred' : '' ?>">
        <?php
        $lesson_counter = 1;

        foreach ($secciones as $sec_index => $seccion):
        ?>
            <div class="section-sticky-header">
                <div class="section-banner <?= htmlspecialchars($seccion['estilo_css']) ?> fade-in-section delay-1">
                    <div class="banner-text-col">
                        <span><?= htmlspecialchars($seccion['subtitulo']) ?></span>
                        <h3><?= htmlspecialchars($seccion['titulo']) ?></h3>
                    </div>
                    <div class="banner-img-col">
                        <img src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?auto=format&fit=crop&w=300&q=80" alt="Banner">
                    </div>
                </div>
            </div>

            <div class="path-container">
                <?php
                $stmtNodos = $pdo->prepare("
                    SELECT n.*, COALESCE(
                        (SELECT estado FROM progreso_usuario pu 
                         WHERE pu.nodo_id = n.id AND pu.usuario_id = ? 
                         ORDER BY id ASC LIMIT 1), 
                        'bloqueado'
                    ) as estado_usuario
                    FROM nodos n
                    WHERE n.seccion_id = ?
                    ORDER BY n.orden ASC
                ");
                $stmtNodos->execute([$user_id, $seccion['id']]);
                $nodos = $stmtNodos->fetchAll(PDO::FETCH_ASSOC);

                $seccion_activa = false;
                foreach ($nodos as $n) {
                    if ($n['estado_usuario'] === 'completado' || $n['estado_usuario'] === 'activo') {
                        $seccion_activa = true;
                        break;
                    }
                }

                $mapa_colores = ['banner-blue' => 'blue', 'banner-green' => 'pastel-green', 'banner-purple' => 'pastel-purple', 'banner-orange' => 'orange'];
                $color_fondo = $seccion_activa ? ($mapa_colores[$seccion['estilo_css']] ?? 'blue') : 'gray';

                $hex_decorativos = [
                    ['w' => 140, 'top' => 10, 'left' => 5,  'dur' => 20, 'dir' => 'normal'],
                    ['w' => 90,  'top' => 45, 'right' => 10, 'dur' => 15, 'dir' => 'reverse'],
                    ['w' => 120, 'top' => 80, 'left' => 20, 'dur' => 25, 'dir' => 'normal']
                ];
                ?>

                <div class="path-bg-hexagons">
                    <?php foreach ($hex_decorativos as $bg): ?>
                        <div class="path-hex <?= $color_fondo ?>"
                            style="width: <?= $bg['w'] ?>px; height: <?= $bg['w'] ?>px; top: <?= $bg['top'] ?>%; 
                                    <?= isset($bg['left']) ? 'left: ' . $bg['left'] . '%;' : 'right: ' . $bg['right'] . '%;' ?> 
                                    animation-duration: <?= $bg['dur'] ?>s; <?= $bg['dir'] === 'reverse' ? 'animation-direction: reverse;' : '' ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php
                $es_ultima_seccion = ($sec_index === count($secciones) - 1);
                $primer_nodo_activo = (isset($nodos[0]) && $nodos[0]['estado_usuario'] === 'activo');
                $svg_top_desk = $primer_nodo_activo ? 97 : 42;
                $svg_top_mob  = $primer_nodo_activo ? 92 : 37;
                $y_start_link = $primer_nodo_activo ? -115 : -60;

                $x_map_desktop = ['offset-left-2' => -160, 'offset-left-1' => -80, 'offset-center' => 0, 'offset-right-1' => 80, 'offset-right-2' => 160];
                $x_map_mobile = ['offset-left-2' => -60, 'offset-left-1' => -30, 'offset-center' => 0, 'offset-right-1' => 30, 'offset-right-2' => 60];

                $path_desk = "";
                $path_mob = "";
                $path_act_desk = "";
                $path_act_mob = "";
                $y = 0;
                $stop_active = false;

                if ($sec_index > 0) {
                    $path_desk .= "M 0 {$y_start_link} ";
                    $path_mob .= "M 0 {$y_start_link} ";
                    if (isset($nodos[0]) && ($nodos[0]['estado_usuario'] === 'completado' || $nodos[0]['estado_usuario'] === 'activo')) {
                        $path_act_desk .= "M 0 {$y_start_link} ";
                        $path_act_mob .= "M 0 {$y_start_link} ";
                    }
                }

                foreach ($nodos as $i => $nodo) {
                    $x_d = $x_map_desktop[$nodo['posicion_css']] ?? 0;
                    $x_m = $x_map_mobile[$nodo['posicion_css']] ?? 0;
                    $cmd = ($i === 0 && $sec_index === 0) ? "M" : "L";
                    $path_desk .= "$cmd $x_d $y ";
                    $path_mob .= "$cmd $x_m $y ";
                    if (!$stop_active && ($nodo['estado_usuario'] === 'completado' || $nodo['estado_usuario'] === 'activo')) {
                        if ($i === 0 && $sec_index === 0) {
                            $path_act_desk .= "M $x_d $y ";
                            $path_act_mob .= "M $x_m $y ";
                        } else {
                            $path_act_desk .= "L $x_d $y ";
                            $path_act_mob .= "L $x_m $y ";
                        }
                        if ($nodo['estado_usuario'] === 'activo') $stop_active = true;
                    }
                    $y += 115;
                }

                if (!$es_ultima_seccion) {
                    $path_desk .= "L 0 " . ($y + 60);
                    $path_mob .= "L 0 " . ($y + 60);
                    if (!$stop_active && strlen($path_act_desk) > 0) {
                        $path_act_desk .= "L 0 " . ($y + 60);
                        $path_act_mob .= "L 0 " . ($y + 60);
                    }
                }
                ?>

                <svg class="path-line-svg-desktop path-line-anim" style="position: absolute; top: <?= $svg_top_desk ?>px; left: 50%; width: 320px; margin-left: -160px; height: 100%; z-index: 0; overflow: visible;">
                    <g transform="translate(160, 0)">
                        <path d="<?= trim($path_desk) ?>" stroke="var(--abeja-gray-dark)" stroke-width="14" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                        <?php if (strlen($path_act_desk) > 0): ?>
                            <path d="<?= trim($path_act_desk) ?>" stroke="var(--primary-blue)" stroke-width="14" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                        <?php endif; ?>
                    </g>
                </svg>

                <svg class="path-line-svg-mobile path-line-anim" style="position: absolute; top: <?= $svg_top_mob ?>px; left: 50%; width: 120px; margin-left: -60px; height: 100%; z-index: 0; overflow: visible;">
                    <g transform="translate(60, 0)">
                        <path d="<?= trim($path_mob) ?>" stroke="var(--abeja-gray-dark)" stroke-width="12" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                        <?php if (strlen($path_act_mob) > 0): ?>
                            <path d="<?= trim($path_act_mob) ?>" stroke="var(--primary-blue)" stroke-width="12" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                        <?php endif; ?>
                    </g>
                </svg>

                <div class="path-nodes" <?= $primer_nodo_activo ? 'style="padding-top: 55px;"' : '' ?>>
                    <?php foreach ($nodos as $nodo):
                        $estado = $nodo['estado_usuario'];
                        $clase_css = 'state-locked sound-locked';
                        $etiqueta = 'button';
                        $link = '';
                        $data_chest = '';

                        if ($nodo['tipo'] === 'cofre') {
                            $etiqueta = 'a'; // <- ESTE ERA EL FIX VITAL
                            if ($estado === 'completado') {
                                $clase_css = 'state-chest-locked sound-locked'; // Gris sólido
                                $link = "href='#' style='text-decoration:none; cursor:not-allowed;' onclick='return false;'";
                            } else if ($estado === 'activo') {
                                $clase_css = 'state-active sound-nav'; // Adquiere la animación y color amarillo de nivel activo
                                $link = "href='#' style='text-decoration:none;'";
                                $data_chest = "data-is-chest='true' data-nodo-id='{$nodo['id']}' data-curso-id='{$curso_actual_id}'";
                            } else {
                                $etiqueta = 'button';
                            }
                        } else {
                            if ($estado === 'completado' || $estado === 'activo') {
                                $etiqueta = 'a';
                                $clase_css = ($estado === 'completado') ? 'state-completed sound-nav' : 'state-active sound-nav';
                                $url_prefix = ($curso_actual_id == 1) ? 'curso.php?curso=algebra&num=' : 'curso.php?curso=fisica&num=';
                                $url = $url_prefix . $lesson_counter;
                                if ($estado === 'completado') $url .= "&estado=completado";
                                $link = "href='" . $url . "' style='text-decoration:none;'";
                            }
                            $lesson_counter++;
                        }
                    ?>
                        <div class="node-wrapper <?= $nodo['posicion_css'] ?> fade-in-node">
                            <?php if (!empty($nodo['mascota_animada']) && !empty($nodo['mascota_posicion'])):
                                $img_src = ($estado === 'bloqueado') ? $nodo['mascota_estatica'] : $nodo['mascota_animada'];
                                $locked_class = ($estado === 'bloqueado') ? 'mascot-locked sound-locked' : 'sound-nav';
                            ?>
                                <div class="mascot-zone <?= htmlspecialchars($nodo['mascota_posicion']) ?>">
                                    <img src="<?= htmlspecialchars($img_src) ?>" class="mascot-img <?= $locked_class ?>" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
                                </div>
                            <?php endif; ?>

                            <div class="btn-hex-wrapper <?= $clase_css ?>">
                                <?php if ($estado === 'activo'): ?>
                                    <div class="tooltip-start"><?= $nodo['tipo'] === 'cofre' ? '¡ABRIR!' : 'EMPEZAR' ?></div>
                                    <div class="node-active-orbit">
                                        <div class="node-active-ring"></div>
                                    </div>
                                <?php endif; ?>
                                <<?= $etiqueta ?> <?= $link ?> <?= $data_chest ?> class="btn-hex text-decoration-none">
                                    <i class="fa-solid <?= $nodo['icono'] ?>"></i>
                                </<?= $etiqueta ?>>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal-abeja-custom" id="modalCofreSorpresa">
    <div class="modal-dialog-custom">
        <div class="modal-content-abeja">
            <div id="cofre-initial-view">
                <img src="webp_animations/1.webp" alt="Abeja" style="width:110px; animation: float 3s infinite; margin-bottom: 10px;">
                <h4 style="color: var(--abeja-dark); font-weight: 900;">¡Has encontrado un cofre!</h4>
                <p class="text-muted fw-bold mb-4">La calidad del premio es un misterio... ¿Estás listo para descubrir qué esconde?</p>
                <button class="btn-submit-request w-100 fs-5" id="btn-abrir-cofre">
                    <i class="fa-solid fa-unlock me-2"></i>¡Quiero mi premio!
                </button>
                <button class="btn btn-link text-muted fw-bold mt-2" onclick="cerrarModalCofre()">Mejor después</button>
            </div>

            <div id="cofre-roulette-view" style="display:none; width: 100%;">
                <h5 class="fw-bold mb-3" style="color: var(--primary-blue-dark);">¡Girando Ruleta!</h5>
                <div style="width: 100%; height: 110px; overflow: hidden; border: 3px solid var(--abeja-gray-medium); border-radius: 18px; padding: 15px 0; position: relative; background: var(--abeja-gray-light); box-shadow: inset 0 5px 15px rgba(0,0,0,0.05);">

                    <div id="roulette-strip" style="display: flex; gap: 15px; transition: transform 4.5s cubic-bezier(0.1, 0.8, 0.1, 1); padding-left: 50%; align-items: center; height: 100%;">
                    </div>

                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 78px; height: 88px; border: 4px solid var(--primary-yellow-dark); border-radius: 12px; z-index: 10; box-shadow: 0 0 15px rgba(229, 180, 0, 0.6), inset 0 0 10px rgba(229, 180, 0, 0.4); pointer-events: none;"></div>
                    <div style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 12px solid transparent; border-right: 12px solid transparent; border-top: 15px solid var(--primary-yellow-dark); z-index: 10;"></div>
                    <div style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 12px solid transparent; border-right: 12px solid transparent; border-bottom: 15px solid var(--primary-yellow-dark); z-index: 10;"></div>
                </div>
            </div>

            <div id="cofre-result-view" style="display:none; width: 100%; margin-top: 10px;">
                <span class="badge-dinamico" id="premio-badge" style="margin-bottom: 15px; display: inline-block;"></span>
                <h3 id="premio-titulo" style="color: var(--abeja-dark); font-weight: 900;"></h3>
                <div id="premio-hex" class="my-4 d-flex justify-content-center" style="transform: scale(1.3);"></div>
                <p id="premio-desc" class="text-muted fw-bold fs-6 mb-4 px-3"></p>
                <button class="btn-stay w-100 fs-5" onclick="window.location.reload();">¡Genial!</button>
            </div>
        </div>
    </div>
</div>

<script>
    // --- LIMPIEZA DE MODALES HUÉRFANOS ---
    document.querySelectorAll('body > #modalCofreSorpresa').forEach(el => el.remove());

    // --- LÓGICA DE ACTUALIZACIÓN DINÁMICA ---
    function changeCourse(cursoId) {
        const dynamicContent = document.getElementById('dynamic-content');
        dynamicContent.style.opacity = '0.2';
        fetch(`pages/jugar.php?curso=${cursoId}`)
            .then(res => res.text())
            .then(html => {
                dynamicContent.innerHTML = html;
                executeScripts(dynamicContent);
            });
    }

    function enrollCourse(cursoId) {
        const dynamicContent = document.getElementById('dynamic-content');
        dynamicContent.style.opacity = '0.2';
        fetch(`pages/jugar.php?curso=${cursoId}&inscribir_curso_id=${cursoId}`)
            .then(res => res.text())
            .then(html => {
                dynamicContent.innerHTML = html;
                executeScripts(dynamicContent);
            });
    }

    function executeScripts(element) {
        const scripts = element.querySelectorAll('script');
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
            if (oldScript.innerHTML) {
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
            }
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
    }

    // --- MAGIA DE LOS COFRES Y LA RULETA ---
    var currentCofreNode = null;
    var currentCofreCurso = null;

    function abrirModalCofre() {
        const modal = document.getElementById('modalCofreSorpresa');
        if (!modal) return;

        document.getElementById('cofre-initial-view').style.display = 'block';
        document.getElementById('cofre-roulette-view').style.display = 'none';
        document.getElementById('cofre-result-view').style.display = 'none';

        const btn = document.getElementById('btn-abrir-cofre');
        if (btn) {
            btn.innerHTML = '<i class="fa-solid fa-unlock me-2"></i>¡Quiero mi premio!';
            btn.disabled = false;
        }

        document.body.appendChild(modal);
        modal.style.display = 'flex';
        void modal.offsetWidth;
        modal.classList.add('show');
    }

    function cerrarModalCofre() {
        const modal = document.getElementById('modalCofreSorpresa');
        if (!modal) return;
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    const btnAbrirCofre = document.getElementById('btn-abrir-cofre');
    if (btnAbrirCofre) {
        btnAbrirCofre.onclick = function() {
            const btn = this;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Abriendo...';
            btn.disabled = true;

            fetch('pages/jugar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `action=abrir_cofre&nodo_id=${currentCofreNode}&curso_id=${currentCofreCurso}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        iniciarRuleta(data);
                    } else {
                        alert(data.msg);
                        cerrarModalCofre();
                    }
                })
                .catch(err => {
                    console.error("Error: ", err);
                    cerrarModalCofre();
                });
        };
    }

    function iniciarRuleta(data) {
        document.getElementById('cofre-initial-view').style.display = 'none';
        document.getElementById('cofre-roulette-view').style.display = 'block';

        const modal = document.getElementById('modalCofreSorpresa');
        const strip = modal.querySelector('#roulette-strip');
        strip.style.transform = 'translateX(0px)';
        strip.style.transition = 'none';
        strip.innerHTML = '';

        data.dummies.forEach(d => {
            const iconHtml = d.icono.startsWith('fa-') ? `<i class="fa-solid ${d.icono}"></i>` : d.icono;
            strip.innerHTML += `
                <div class="perfil-hex-container ${d.color} roulette-item" style="flex-shrink: 0; width: 70px;">
                    <div class="perfil-hex-inner">${iconHtml}</div>
                </div>
            `;
        });

        void strip.offsetWidth;

        setTimeout(() => {
            const targetIndex = 22;
            const itemWidth = 70;
            const gap = 15;

            // Cálculo matemático perfecto para centrar el ítem 22
            const moveX = -((itemWidth + gap) * targetIndex + (itemWidth / 2));

            strip.style.transition = 'transform 4.5s cubic-bezier(0.1, 0.8, 0.1, 1)';
            strip.style.transform = `translateX(${moveX}px)`;

            setTimeout(() => {
                mostrarResultadoPremio(data.premio);
            }, 4800);

        }, 100);
    }

    function mostrarResultadoPremio(premio) {
        document.getElementById('cofre-roulette-view').style.display = 'none';
        const resultView = document.getElementById('cofre-result-view');

        document.getElementById('premio-titulo').innerText = premio.nombre;
        document.getElementById('premio-desc').innerText = premio.desc;

        const badge = document.getElementById('premio-badge');
        badge.innerText = premio.rareza;
        badge.className = `badge-dinamico ${premio.rareza}`;

        const iconHtml = premio.icono.startsWith('fa-') ? `<i class="fa-solid ${premio.icono}"></i>` : premio.icono;
        document.getElementById('premio-hex').innerHTML = `
            <div class="perfil-hex-container ${premio.color}">
                <div class="perfil-hex-inner">${iconHtml}</div>
            </div>
        `;

        resultView.style.display = 'block';
    }

    (function() {
        const customCourseBtn = document.getElementById('customCourseBtn');
        const customCourseMenu = document.getElementById('customCourseMenu');
        const dynamicContent = document.getElementById('dynamic-content');

        if (customCourseBtn && customCourseMenu) {
            customCourseBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                customCourseMenu.classList.toggle('show');
            });
            document.addEventListener('click', (e) => {
                if (customCourseMenu && !customCourseBtn.contains(e.target)) {
                    customCourseMenu.classList.remove('show');
                }
            });
        }

        // --- MANEJADOR GLOBAL DE CLICS A HEXÁGONOS ---
        document.querySelectorAll('.btn-hex-wrapper:not(.state-locked)').forEach(btn => {
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);

            newBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (this.classList.contains('state-chest-locked')) return;

                const anchor = this.querySelector('a') || this.querySelector('button');
                const targetUrl = anchor ? anchor.getAttribute('href') : null;
                const isChest = anchor ? anchor.getAttribute('data-is-chest') : null;
                const hexBtn = this.querySelector('.btn-hex');

                const pulse = document.createElement('div');
                pulse.classList.add('click-pulse');
                hexBtn.appendChild(pulse);
                setTimeout(() => pulse.remove(), 500);

                const ripple = document.createElement('div');
                ripple.classList.add('click-ripple-3d');
                if (this.classList.contains('state-active')) ripple.style.borderColor = 'var(--primary-yellow-dark)';
                else if (this.classList.contains('state-completed')) ripple.style.borderColor = 'var(--primary-blue)';

                this.appendChild(ripple);
                setTimeout(() => {
                    ripple.remove();
                    if (isChest === 'true') {
                        currentCofreNode = anchor.getAttribute('data-nodo-id');
                        currentCofreCurso = anchor.getAttribute('data-curso-id');
                        abrirModalCofre();
                    } else if (targetUrl && targetUrl !== '#') {
                        window.location.href = targetUrl;
                    }
                }, 350);
            });
        });

        // 🚀 SYNC SCROLL INSTANTÁNEO
        function syncScroll() {
            let targetNode = document.querySelector('.btn-hex-wrapper.state-active');

            if (!targetNode) {
                const completedNodes = document.querySelectorAll('.btn-hex-wrapper.state-completed');
                if (completedNodes.length > 0) targetNode = completedNodes[completedNodes.length - 1];
            }

            if (targetNode) targetNode.scrollIntoView({
                behavior: 'auto',
                block: 'center'
            });
            else if (dynamicContent) dynamicContent.scrollTo({
                top: 0,
                behavior: 'auto'
            });

            if (dynamicContent) dynamicContent.style.opacity = '1';
        }
        syncScroll();

    })();
</script>