<?php
// perfil.php - Abeja GO Perfil Unificado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Búsqueda a prueba de fallos para la conexión
require_once file_exists('../conexion.php') ? '../conexion.php' : 'conexion.php';

if (!isset($_SESSION['user_id'])) {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo json_encode(['status' => 'error', 'msg' => 'Sesión expirada']);
    }
    exit;
}

$user_id = $_SESSION['user_id'];

/* =====================================================
   POST EDITAR PERFIL (AJAX)
===================================================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_profile') {
    $nombre_nuevo = trim($_POST['nombre']);
    $foto_id_nueva = (int) $_POST['foto_id'];

    if ($nombre_nuevo !== '' && $foto_id_nueva > 0) {
        $stmtUpd = $pdo->prepare("UPDATE usuarios SET nombre = ?, perfil_foto_id = ? WHERE id = ?");
        $stmtUpd->execute([$nombre_nuevo, $foto_id_nueva, $user_id]);

        $stmtRuta = $pdo->prepare("SELECT ruta FROM perfiles_fotos_cat WHERE id = ?");
        $stmtRuta->execute([$foto_id_nueva]);
        $ruta_nueva = $stmtRuta->fetchColumn();

        echo json_encode([
            'status' => 'success',
            'nuevo_nombre' => $nombre_nuevo,
            'nueva_foto' => $ruta_nueva 
        ]);
        exit;
    }
    
    echo json_encode(['status' => 'error', 'msg' => 'Datos inválidos.']);
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    echo json_encode(['status' => 'success']);
    exit;
}

/* =====================================================
   DATOS USUARIO
===================================================== */
$stmtUsr = $pdo->prepare("
    SELECT u.*, p.ruta AS foto_ruta, p.nombre AS foto_nombre, g.nombre AS grupo_nombre
    FROM usuarios u
    JOIN perfiles_fotos_cat p ON p.id = u.perfil_foto_id
    LEFT JOIN grupos g ON g.id = u.grupo_id
    WHERE u.id = ?
");
$stmtUsr->execute([$user_id]);
$user = $stmtUsr->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_destroy();
    exit('Usuario no encontrado.');
}

/* =====================================================
   TEXTOS DINÁMICOS DE LA DB (EJ. RACHA)
===================================================== */
$stmtTextos = $pdo->query("SELECT clave, titulo, descripcion, icono FROM textos_perfil");
$textos_perfil = [];
if($stmtTextos) {
    while ($row = $stmtTextos->fetch(PDO::FETCH_ASSOC)) {
        $textos_perfil[$row['clave']] = $row;
    }
}

$titulo_racha = $textos_perfil['racha']['titulo'] ?? 'Racha de Fuego';
$desc_racha   = $textos_perfil['racha']['descripcion'] ?? '¡Mantén tu racha viva completando lecciones todos los días!';
$icono_racha  = $textos_perfil['racha']['icono'] ?? 'fa-fire';

/* =====================================================
   RACHA Y NIVEL (CON CÁLCULO DE PROGRESO DE XP)
===================================================== */
$racha_activa = ($user['racha_dias'] > 0);
$color_racha = $racha_activa ? 'hex-color-orange' : 'hex-color-green';
$texto_racha = $racha_activa ? $user['racha_dias'] . ' días' : 'Sin racha';

$xp_usuario = (int)$user['nivel_actual_xp'];

$stmtLvl = $pdo->prepare("SELECT * FROM niveles_cat WHERE xp_requerida <= ? ORDER BY nivel DESC LIMIT 1");
$stmtLvl->execute([$xp_usuario]);
$nivelActual = $stmtLvl->fetch(PDO::FETCH_ASSOC);

$nivel_num     = $nivelActual ? (int)$nivelActual['nivel'] : 1;
$nombre_nivel  = $nivelActual ? $nivelActual['nombre_nivel'] : 'Abeja Larva';
$icono_nivel   = $nivelActual ? $nivelActual['icono'] : 'fa-baby';
$color_nivel   = $nivelActual ? ($nivelActual['color_css'] ?? 'icon-comun') : 'icon-comun';
$hex_color_nivel = str_replace('icon-', 'hex-color-', $color_nivel);
$bg_nivel_class  = str_replace('icon-', 'bg-tint-', $color_nivel); 
$xp_base_nivel = $nivelActual ? (int)$nivelActual['xp_requerida'] : 0;
$desc_nivel    = isset($nivelActual['descripcion']) && $nivelActual['descripcion'] ? $nivelActual['descripcion'] : 'Sigue acumulando experiencia completando lecciones.';

$stmtNextLvl = $pdo->prepare("SELECT xp_requerida FROM niveles_cat WHERE nivel = ?");
$stmtNextLvl->execute([$nivel_num + 1]);
$nivelSiguiente = $stmtNextLvl->fetch(PDO::FETCH_ASSOC);

if ($nivelSiguiente) {
    $xp_siguiente = (int)$nivelSiguiente['xp_requerida'];
    $xp_rango = $xp_siguiente - $xp_base_nivel;
    $xp_progreso = $xp_usuario - $xp_base_nivel;
    $porcentaje_xp = ($xp_rango > 0) ? min(100, round(($xp_progreso / $xp_rango) * 100)) : 100;
    $texto_xp = "{$xp_usuario} / {$xp_siguiente} XP";
} else {
    $porcentaje_xp = 100;
    $texto_xp = "Nivel Máximo";
}

/* =====================================================
   LOGROS E INVENTARIO
===================================================== */
$stmtLogrosAll = $pdo->query("SELECT * FROM logros_cat ORDER BY id ASC");
$logros_all = $stmtLogrosAll->fetchAll(PDO::FETCH_ASSOC);

$stmtLogrosObt = $pdo->prepare("SELECT logro_id FROM usuario_logros WHERE usuario_id = ?");
$stmtLogrosObt->execute([$user_id]);
$logros_obtenidos_ids = $stmtLogrosObt->fetchAll(PDO::FETCH_COLUMN);

$stmtInvAll = $pdo->query("SELECT * FROM inventario_cat ORDER BY id ASC");
$inventario_all = $stmtInvAll->fetchAll(PDO::FETCH_ASSOC);

$stmtInvObt = $pdo->prepare("SELECT inventario_id, cantidad FROM usuario_inventario WHERE usuario_id = ?");
$stmtInvObt->execute([$user_id]);
$inventario_obtenido = $stmtInvObt->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC);

$fotos_cat = $pdo->query("SELECT * FROM perfiles_fotos_cat ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);

function rarezaClase($rareza){
    switch (mb_strtolower($rareza)) {
        case 'legendario': return 'rareza-legendario';
        case 'epico': return 'rareza-epico';
        case 'raro': return 'rareza-raro';
        default: return 'rareza-comun';
    }
}
function hexColorRareza($rareza) {
    switch(mb_strtolower($rareza)) {
        case 'legendario': return 'hex-color-gold';
        case 'epico': return 'hex-color-purple';
        case 'raro': return 'hex-color-blue';
        default: return 'hex-color-comun';
    }
}

// Función mágica para renderizar iconos o emojis
function renderIcon($icono) {
    if (str_starts_with($icono, 'fa-')) {
        return '<i class="fa-solid ' . htmlspecialchars($icono) . '"></i>';
    }
    return htmlspecialchars($icono);
}
?>

<style>
.panal-content { pointer-events: auto !important; padding-bottom: 60px;}
.btn-perfil { cursor: pointer; position: relative; z-index: 10; }
.btn-perfil i { font-size: 1rem !important; margin-right: 5px; color: var(--primary-blue);}

/* --- TARJETAS DINÁMICAS (FONDO BLANCO POR DEFECTO) --- */
.stat-card { transition: all 0.3s ease; border-width: 2.5px !important; border-style: solid !important; height: 100%; display: flex; flex-direction: column; justify-content: center; background-color: var(--abeja-white) !important; cursor: pointer;}
.stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); }

.card-comun  { border-color: var(--abeja-gray-medium) !important; }
.card-blue   { border-color: var(--primary-blue) !important; }
.card-green  { border-color: var(--pastel-green) !important; }
.card-purple { border-color: var(--pastel-purple) !important; }
.card-orange { border-color: var(--secondary-orange-dark) !important; } 
.card-gold   { border-color: var(--primary-yellow-dark) !important; }

/* TINTES ESPECIALES SOLO PARA LA TARJETA DE NIVEL */
.bg-tint-comun  { background-color: var(--abeja-gray-light) !important; }
.bg-tint-blue   { background-color: var(--primary-blue-light) !important; }
.bg-tint-green  { background-color: var(--pastel-green-light) !important; }
.bg-tint-purple { background-color: var(--pastel-purple-light) !important; }
.bg-tint-orange { background-color: #FFF0E5 !important; }
.bg-tint-gold   { background-color: #FFF9E6 !important; }

.item-card { border-width: 3px !important; cursor: pointer; transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.item-card:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(0,0,0,0.06); }
.mobile-page-title-card i {font-weight: 900; font-size: 1.5rem; color: var(--primary-yellow-dark);}

/* --- LIMPIEZA DE ICONOS SUPERIORES --- */
.perfil-badges { color: var(--abeja-dark); }
.perfil-badges i.badge-icon { font-size: 1.2rem; text-shadow: none !important; filter: none !important; opacity: 1 !important; }

/* --- HEXAGONOS 3D DE ALTO CONTRASTE (Fondo Sólido + Icono Blanco) --- */
.perfil-hex-container { width: 65px; height: 75px; position: relative; flex-shrink: 0; }
.perfil-hex-inner { 
    width: 100%; height: 100%; 
    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); 
    display: flex; justify-content: center; align-items: center; 
    font-size: 3rem; /* Padding ideal */
    position: relative; z-index: 2; 
}
.perfil-hex-inner i, .item-hex i { text-shadow: none !important; filter: drop-shadow(0px 0px 0px rgba(0,0,0,0)) !important; opacity: 1 !important; }

/* Invertimos colores para contraste espectacular */
.hex-color-orange { filter: drop-shadow(0 6px 0px rgba(255, 150, 0, 0.3)); }
.hex-color-orange .perfil-hex-inner { background-color: var(--secondary-orange-dark); color: #FFF; }

.hex-color-green { filter: drop-shadow(0 6px 0px rgba(26, 188, 156, 0.3)); }
.hex-color-green .perfil-hex-inner { background-color: var(--pastel-green-dark); color: #FFF; }

.hex-color-blue { filter: drop-shadow(0 6px 0px rgba(52, 152, 219, 0.3)); }
.hex-color-blue .perfil-hex-inner { background-color: var(--primary-blue); color: #FFF; }

.hex-color-purple { filter: drop-shadow(0 6px 0px rgba(142, 68, 173, 0.3)); }
.hex-color-purple .perfil-hex-inner { background-color: var(--pastel-purple); color: #FFF; }

.hex-color-yellow, .hex-color-gold { filter: drop-shadow(0 6px 0px rgba(229, 180, 0, 0.3)); }
.hex-color-yellow .perfil-hex-inner, .hex-color-gold .perfil-hex-inner { background-color: var(--primary-yellow-dark); color: #FFF; }

.hex-color-comun { filter: drop-shadow(0 6px 0px rgba(131, 145, 146, 0.3)); }
.hex-color-comun .perfil-hex-inner { background-color: var(--abeja-text-muted); color: #FFF; }

.rareza-bloqueado .perfil-hex-inner, .rareza-bloqueado .item-hex { background-color: var(--abeja-gray-light) !important; color: var(--abeja-text-muted) !important; filter: grayscale(100%); }

/* --- MODALES CUSTOM --- */
.modal-abeja-custom { display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 999999; overflow: hidden; outline: 0; background-color: rgba(44, 62, 80, 0.7); backdrop-filter: blur(5px); opacity: 0; transition: opacity 0.3s ease; align-items: center; justify-content: center; }
.modal-abeja-custom.show { display: flex !important; opacity: 1; }
.modal-dialog-custom { position: relative; width: 90%; max-width: 450px; margin: 0; transform: translateY(-50px) scale(0.95); opacity: 0; transition: transform 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease; }
.modal-abeja-custom.show .modal-dialog-custom { transform: translateY(0) scale(1); opacity: 1; }
.modal-content-abeja { border: 2px solid var(--abeja-gray-medium); border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); overflow: hidden; background-color: var(--abeja-white); }
.modal-header-abeja { border-bottom: 2px solid var(--abeja-gray-medium); padding: 20px 25px; background-color: var(--abeja-white); display: flex; justify-content: space-between; align-items: center; }

/* NUEVO: Espaciado interno perfecto para el Modal Body */
.modal-body-abeja { 
    padding: 35px 25px; /* Más aire en la parte superior e inferior */
    background-color: var(--abeja-gray); 
    max-height: 80vh; 
    overflow-y: auto;
    display: flex; 
    flex-direction: column;
    align-items: center;
    gap: 15px; /* <--- Esta es la regla maestra que separa todo parejo */
}

/* NUEVO: Margen extra para el hexágono gigante para compensar la ilusión de tamaño */
#mdlInfoHexContainer {
    margin-top: 15px;
    margin-bottom: 25px !important;
}

/* NUEVO: Espaciado de línea para que la descripción sea fácil de leer */
#mdlInfoDesc {
    line-height: 1.6 !important;
    padding: 0 10px;
}

.modal-title-abeja { font-weight: 900; color: var(--abeja-dark); font-size: 1.25rem; margin:0;}
.btn-close-abeja { background: none; border: none; font-size: 1.5rem; color: var(--abeja-text-muted); cursor: pointer; transition: color 0.2s;}
.btn-close-abeja:hover { color: var(--pastel-red-dark); }

.preview-avatar-container { text-align: center; margin-bottom: 20px; }
.preview-avatar-img { width: 130px; height: 130px; object-fit: cover; border-radius: 30px; border: 4px solid var(--primary-yellow-dark); box-shadow: 0 8px 20px rgba(229, 180, 0, 0.3); transition: transform 0.3s; }
.foto-selector { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; max-height: 220px; overflow-y: auto; padding: 15px; background: var(--abeja-white); border-radius: 18px; border: 2px solid var(--abeja-gray-medium); }
.foto-option { width: 65px; height: 65px; border-radius: 16px; cursor: pointer; border: 3px solid transparent; transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
.foto-option:hover { transform: scale(1.1); }
.foto-option.selected { border-color: var(--primary-blue); box-shadow: 0 4px 12px rgba(93, 173, 226, 0.4); transform: scale(1.05); }

.btn-submit-request { background-color: var(--primary-blue); color: white; border: none; border-radius: 14px; padding: 12px; font-weight: 900; transition: all 0.2s; box-shadow: 0 6px 15px rgba(93, 173, 226, 0.3);}
.btn-submit-request:hover { background-color: var(--primary-blue-dark); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(93, 173, 226, 0.4); }
.btn-submit-request.success-state { background-color: var(--pastel-green-dark) !important; box-shadow: 0 6px 15px rgba(26, 188, 156, 0.3) !important; }

.btn-stay { background-color: var(--abeja-white); color: var(--abeja-text-muted); border: 2px solid var(--abeja-gray-dark); border-radius: 14px; padding: 10px 20px; font-weight: 900; transition: all 0.2s; }
.btn-stay:hover { background-color: var(--abeja-gray-light); color: var(--abeja-dark); transform: translateY(-2px); }
.btn-exit-red { background-color: var(--pastel-red-light); color: var(--pastel-red-dark); border: 2px solid var(--pastel-red); border-radius: 14px; padding: 10px 20px; font-weight: 900; transition: all 0.2s; }
.btn-exit-red:hover { background-color: var(--pastel-red-dark); color: white; border-color: var(--pastel-red-dark); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(231, 76, 60, 0.3); }

/* Custom Badge de Rarezas en Modal Dinamico */
.badge-dinamico.legendario { background-color: #FFF9E6; color: var(--primary-yellow-dark); border: 2px solid var(--primary-yellow-dark); }
.badge-dinamico.epico { background-color: var(--pastel-purple-light); color: var(--pastel-purple-dark); border: 2px solid var(--pastel-purple); }
.badge-dinamico.raro { background-color: var(--primary-blue-light); color: var(--primary-blue-dark); border: 2px solid var(--primary-blue); }
.badge-dinamico.comun { background-color: var(--abeja-gray-light); color: var(--abeja-text-muted); border: 2px solid var(--abeja-gray-medium); }
</style>

<div class="panal-content" id="dynamic-content-perfil">

    <div class="mobile-page-title-card d-lg-none fade-in-section">
        <div class="mobile-page-title-icon"><i class="fa-solid fa-user"></i></div>
        <div class="mobile-page-title-divider"></div>
        <h2 class="mobile-page-title-text">Perfil</h2>
    </div>

    <div class="perfil-header fade-in-section mb-5">
        <div class="hex-avatar-wrapper">
            <img src="<?= htmlspecialchars($user['foto_ruta'] ?? 'perfil-imgs/1.png') ?>" class="hex-avatar" alt="Avatar">
        </div>
        <div class="perfil-main-divider"></div>
        <div class="perfil-info-box">
            <h1 class="perfil-name"><?= htmlspecialchars($user['nombre']) ?></h1>
            <div class="perfil-badges">
                <span title="Grupo">
                    <i class="fa-solid fa-users badge-icon" style="color: var(--primary-blue);"></i>
                    <?= $user['grupo_nombre'] ? htmlspecialchars($user['grupo_nombre']) : 'Sin colmena' ?>
                </span>
                <div class="badge-divider"></div>
                <span title="Miel">
                    <i class="fa-solid fa-droplet badge-icon" style="color: var(--primary-yellow-dark);"></i>
                    <?= number_format($user['miel']) ?> Gotas
                </span>
            </div>
        </div>
        <div class="perfil-actions">
            <button type="button" class="btn-perfil btn-edit sound-action" onclick="abrirModalAbeja('modalEditarPerfil')">
                <i class="fa-solid fa-pen"></i> Editar
            </button>
            <button type="button" class="btn-perfil btn-logout sound-action" onclick="abrirModalAbeja('modalCerrarSesion')">
                <i class="fa-solid fa-right-from-bracket"></i> Salir
            </button>
            <button type="button" class="btn-perfil btn-group-view sound-action" onclick="irAMisiones()">
                <i class="fa-solid fa-users"></i> Ver grupo
            </button>
        </div>
    </div>

    <div class="row g-5 mb-5 fade-in-section delay-1 align-items-stretch">
        <div class="col-12 col-lg-6">
            <?php $card_racha_class = $racha_activa ? 'card-orange' : 'card-green'; ?>
            
            <div class="stat-card <?= $card_racha_class ?> w-100 sound-item" 
                 data-tipo="racha"
                 data-titulo="<?= htmlspecialchars($titulo_racha) ?>"
                 data-sub="<?= $texto_racha ?>"
                 data-desc="<?= htmlspecialchars($desc_racha) ?>"
                 data-icono="<?= htmlspecialchars($icono_racha) ?>"
                 data-color="<?= $color_racha ?>"
                 data-estado="activo"
                 onclick="abrirModalInfoDinamico(this)">
                
                <div class="d-flex align-items-center gap-3 w-100">
                    <div class="perfil-hex-container <?= $color_racha ?>">
                        <div class="perfil-hex-inner">
                            <?= renderIcon($icono_racha) ?>
                        </div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-text-box">
                        <span class="stat-label">Tiempo de racha</span>
                        <span class="stat-value"><?= $texto_racha ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <?php $card_nivel_class = str_replace('icon-', 'card-', $color_nivel); ?>
            
            <div class="stat-card <?= $card_nivel_class ?> <?= $bg_nivel_class ?> w-100 sound-item" 
                 style="gap: 15px; padding-top: 15px; padding-bottom: 15px;"
                 data-tipo="nivel"
                 data-titulo="Nivel <?= $nivel_num ?>: <?= htmlspecialchars($nombre_nivel) ?>"
                 data-sub="<?= $texto_xp ?>"
                 data-desc="<?= htmlspecialchars($desc_nivel) ?>"
                 data-icono="<?= htmlspecialchars($icono_nivel) ?>"
                 data-color="<?= $hex_color_nivel ?>"
                 data-progreso="<?= $porcentaje_xp ?>"
                 onclick="abrirModalInfoDinamico(this)">

                <div class="d-flex align-items-center gap-3 w-100">
                    <div class="perfil-hex-container <?= $hex_color_nivel ?>">
                        <div class="perfil-hex-inner">
                            <?= renderIcon($icono_nivel) ?>
                        </div>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-text-box flex-grow-1">
                        <span class="stat-label">Nivel <?= $nivel_num ?></span>
                        <span class="stat-value" style="font-size: 1.3rem;"><?= htmlspecialchars($nombre_nivel) ?></span>
                    </div>
                </div>
                <div class="w-100 mt-1">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span style="font-size: 0.75rem; font-weight: 800; color: var(--abeja-text-muted); text-transform: uppercase;">Progreso XP</span>
                        <span style="font-size: 0.8rem; font-weight: 900; color: var(--abeja-dark);"><?= $texto_xp ?></span>
                    </div>
                    <div style="width: 100%; height: 10px; background-color: rgba(0,0,0,0.06); border-radius: 5px; overflow: hidden; position: relative;">
                        <div style="width: <?= $porcentaje_xp ?>%; height: 100%; background-color: var(--primary-yellow-dark); border-radius: 5px; transition: width 1s cubic-bezier(0.175, 0.885, 0.32, 1.275);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-header-row fade-in-section delay-2 mb-4">
        <h3 class="section-title">Tus Logros</h3>
    </div>

    <div class="row g-5 mb-5 fade-in-section delay-2">
        <?php foreach($logros_all as $logro): ?>
            <?php
                $obtenido = in_array($logro['id'], $logros_obtenidos_ids);
                $icono    = $obtenido ? $logro['icono_css'] : 'fa-lock';
                $color_base = $obtenido ? ($logro['color_css'] ?? 'icon-blue') : 'icon-comun';
                
                $hex_color_logro = str_replace('icon-', 'hex-color-', $color_base);
                $card_class = str_replace('icon-', 'card-', $color_base);
            ?>
            <div class="col-12 col-lg-6">
                <div class="stat-card <?= $card_class ?> <?= $obtenido ? '' : 'rareza-bloqueado' ?> sound-item"
                     data-tipo="logro"
                     data-titulo="<?= htmlspecialchars($logro['titulo']) ?>"
                     data-rareza="<?= htmlspecialchars($logro['rareza']) ?>"
                     data-desc="<?= htmlspecialchars($logro['descripcion']) ?>"
                     data-icono="<?= htmlspecialchars($icono) ?>"
                     data-color="<?= $obtenido ? $hex_color_logro : 'hex-color-comun' ?>"
                     data-estado="<?= $obtenido ? 'obtenido' : 'bloqueado' ?>"
                     onclick="abrirModalInfoDinamico(this)">

                    <div class="d-flex align-items-center gap-3 w-100">
                        <div class="perfil-hex-container <?= $obtenido ? $hex_color_logro : 'hex-color-comun' ?>">
                            <div class="perfil-hex-inner">
                                <?= renderIcon($icono) ?>
                            </div>
                        </div>

                        <div class="stat-divider"></div>
                        <div class="stat-text-box">
                            <span class="stat-label"><?= $obtenido ? htmlspecialchars($logro['titulo']) : 'Bloqueado' ?></span>
                            <span class="stat-value" style="font-size: 1.3rem;"><?= $obtenido ? ucfirst(htmlspecialchars($logro['rareza'])) : '???' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?> 
    </div>

    <div class="section-header-row fade-in-section delay-3 mb-4">
        <h3 class="section-title">Objetos Obtenidos</h3>
    </div>

    <div class="inventory-grid fade-in-section delay-3 mb-5">
        <?php foreach($inventario_all as $item): ?>
            <?php
                $obtenido = array_key_exists($item['id'], $inventario_obtenido);
                $cantidad = $obtenido ? $inventario_obtenido[$item['id']]['cantidad'] : 0;
                $clase    = $obtenido ? rarezaClase($item['rareza']) : 'rareza-bloqueado';
                $icono    = $obtenido ? $item['icono_css'] : 'fa-lock';
                $hex_color_obj = $obtenido ? hexColorRareza($item['rareza']) : 'hex-color-comun';
            ?>
            <div class="item-card <?= $clase ?> sound-item"
                 data-tipo="objeto"
                 data-titulo="<?= htmlspecialchars($item['nombre']) ?>"
                 data-rareza="<?= htmlspecialchars($item['rareza']) ?>"
                 data-desc="<?= htmlspecialchars($item['descripcion']) ?>"
                 data-icono="<?= htmlspecialchars($icono) ?>"
                 data-color="<?= $hex_color_obj ?>"
                 data-cantidad="<?= $cantidad ?>"
                 data-estado="<?= $obtenido ? 'obtenido' : 'bloqueado' ?>"
                 onclick="abrirModalInfoDinamico(this)">

                <div class="item-hex-container">
                    <div class="item-hex">
                        <?= renderIcon($icono) ?>
                    </div>
                    <?php if($cantidad > 1): ?>
                        <div class="lock-overlay" style="top:auto;bottom:-5px;right:-5px;border-radius:50%; font-size: 0.7rem; padding: 2px 5px;">
                            x<?= $cantidad ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="item-rarity"><?= $obtenido ? ucfirst(htmlspecialchars($item['rareza'])) : 'Bloqueado' ?></div>
                <div class="item-name"><?= $obtenido ? htmlspecialchars($item['nombre']) : '???' ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal-abeja-custom" id="modalInfoDinamico">
    <div class="modal-dialog-custom">
        <div class="modal-content-abeja text-center">
            <div class="modal-header-abeja border-0 pb-0 justify-content-center position-relative">
                <h5 class="modal-title-abeja fs-4" id="mdlInfoTitulo" style="color: var(--abeja-dark);">Título</h5>
                <button type="button" class="btn-close-abeja position-absolute end-0 me-4" onclick="cerrarModalAbeja('modalInfoDinamico')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body-abeja pt-4 pb-4 d-flex flex-column align-items-center" style="background-color: var(--abeja-white);">
                
                <div class="perfil-hex-container mb-4" id="mdlInfoHexContainer" style="transform: scale(1.3); margin-bottom: 25px !important;">
                    <div class="perfil-hex-inner" id="mdlInfoIconoContainer">
                        </div>
                </div>

                <div id="mdlInfoSubContainer" class="mb-3">
                    <span class="badge-dinamico" id="mdlInfoSubText" style="padding: 6px 16px; border-radius: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px;"></span>
                </div>

                <p class="fw-bold mb-0 fs-6 px-2" id="mdlInfoDesc" style="color: var(--abeja-text-muted); line-height: 1.4;"></p>

                <div class="w-100 px-3 mt-4" id="mdlInfoExtra" style="display: none;"></div>

            </div>
            <div class="border-0 d-flex justify-content-center gap-3 pt-0 pb-4" style="background-color: var(--abeja-white);" id="mdlInfoBotones">
                <button type="button" class="btn-stay w-75" onclick="cerrarModalAbeja('modalInfoDinamico')">¡Entendido!</button>
            </div>
        </div>
    </div>
</div>

<div class="modal-abeja-custom" id="modalEditarPerfil">
    <div class="modal-dialog-custom">
        <div class="modal-content-abeja">
            <div class="modal-header-abeja">
                <h5 class="modal-title-abeja"><i class="fa-solid fa-user-pen me-2" style="color: var(--primary-blue);"></i>Editar Perfil</h5>
                <button type="button" class="btn-close-abeja" onclick="cerrarModalAbeja('modalEditarPerfil')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body-abeja">
                <form id="formEditarPerfil">
                    <input type="hidden" name="action" value="edit_profile">
                    <input type="hidden" name="foto_id" id="inputFotoId" value="<?= $user['perfil_foto_id'] ?>">
                    
                    <div class="preview-avatar-container">
                        <img src="<?= htmlspecialchars($user['foto_ruta'] ?? 'perfil-imgs/1.png') ?>" id="modalPreviewAvatar" class="preview-avatar-img">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" style="color: var(--abeja-text-muted);">Elige un nuevo Avatar</label>
                        <div class="foto-selector shadow-sm">
                            <?php foreach($fotos_cat as $foto): ?>
                                <img src="<?= htmlspecialchars($foto['ruta']) ?>" 
                                     class="foto-option <?= ($foto['id']==$user['perfil_foto_id']) ? 'selected' : '' ?>"
                                     data-id="<?= $foto['id'] ?>"
                                     data-ruta="<?= htmlspecialchars($foto['ruta']) ?>"
                                     onclick="seleccionarAvatar(this)">
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold" style="color: var(--abeja-text-muted);">Nombre de la Abeja</label>
                        <input type="text" name="nombre" class="form-control" style="border-radius: 12px; padding: 12px; border: 2px solid var(--abeja-gray-medium); font-weight: 700;" required value="<?= htmlspecialchars($user['nombre']) ?>">
                    </div>

                    <button type="submit" class="btn-submit-request w-100" id="btnGuardarPerfil">
                        <i class="fa-solid fa-floppy-disk me-2"></i>Guardar Cambios
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal-abeja-custom" id="modalCerrarSesion">
    <div class="modal-dialog-custom">
        <div class="modal-content-abeja text-center">
            <div class="modal-header-abeja border-0 pb-0 justify-content-center position-relative">
                <h5 class="modal-title-abeja fs-4" style="color: var(--pastel-red-dark);">
                    <i class="fa-solid fa-door-open me-2"></i>¿Abandonar el Panal?
                </h5>
                <button type="button" class="btn-close-abeja position-absolute end-0 me-4" onclick="cerrarModalAbeja('modalCerrarSesion')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body-abeja pt-3 pb-4" style="background-color: var(--abeja-white);">
                <p class="fw-bold mb-0 fs-6" style="color: var(--abeja-text-muted);">¿Estás seguro de que deseas cerrar tu sesión actual? Tendrás que volver a ingresar tus datos para continuar recolectando miel.</p>
            </div>
            <div class="border-0 d-flex justify-content-center gap-3 pt-0 pb-4" style="background-color: var(--abeja-white);">
                <button type="button" class="btn-stay" onclick="cerrarModalAbeja('modalCerrarSesion')">Quedarme</button>
                <button type="button" class="btn-exit-red" onclick="ejecutarLogout()">Sí, salir ahora</button>
            </div>
        </div>
    </div>
</div>

<script>
const endpointAPI = '<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>';

// --- CONTROL DE MODALES BÁSICOS ---
function abrirModalAbeja(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    
    document.body.appendChild(modal);
    modal.style.display = 'flex';
    void modal.offsetWidth; 
    modal.classList.add('show');
}

function cerrarModalAbeja(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300); 
    }
}

window.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal-abeja-custom')) {
        cerrarModalAbeja(event.target.id);
    }
});

// --- MAGIA: MODAL DINÁMICO UNIVERSAL (Acepta Emojis o FontAwesome) ---
function abrirModalInfoDinamico(elemento) {
    const ds = elemento.dataset;

    // 1. Resetear clases del Hexágono
    const hexC = document.getElementById('mdlInfoHexContainer');
    hexC.className = 'perfil-hex-container mb-4 ' + (ds.color || 'hex-color-comun');
    
    // 2. Insertar Icono o Emoji Dinámicamente
    const iconC = document.getElementById('mdlInfoIconoContainer');
    if(ds.icono.startsWith('fa-')) {
        iconC.innerHTML = `<i class="fa-solid ${ds.icono}"></i>`;
    } else {
        iconC.innerHTML = ds.icono; // Es un emoji
    }

    // 3. Título y Desc
    document.getElementById('mdlInfoTitulo').textContent = ds.titulo;
    document.getElementById('mdlInfoDesc').textContent = ds.desc;

    // 4. Subtítulo / Badge de Rareza
    const subContainer = document.getElementById('mdlInfoSubContainer');
    const subText = document.getElementById('mdlInfoSubText');
    subText.className = 'badge-dinamico'; // reset

    if(ds.tipo === 'logro' || ds.tipo === 'objeto') {
        let txt = ds.rareza ? ds.rareza.toUpperCase() : 'COMÚN';
        if (ds.estado === 'bloqueado') txt = 'BLOQUEADO';
        else if (ds.cantidad && parseInt(ds.cantidad) > 1) txt += ` (x${ds.cantidad})`;

        subText.textContent = txt;
        if(ds.estado === 'bloqueado') subText.classList.add('comun');
        else subText.classList.add(ds.rareza ? ds.rareza.toLowerCase() : 'comun');
        subContainer.style.display = 'block';
    } 
    else if (ds.sub) {
        subText.textContent = ds.sub;
        subText.classList.add(ds.tipo === 'racha' ? 'epico' : 'legendario');
        subContainer.style.display = 'block';
    } else {
        subContainer.style.display = 'none';
    }

    // 5. Contenido Extra (Barra de progreso de Nivel)
    const extraCont = document.getElementById('mdlInfoExtra');
    extraCont.innerHTML = '';
    extraCont.style.display = 'none';

    if (ds.tipo === 'nivel' && ds.progreso) {
        extraCont.style.display = 'block';
        extraCont.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-1">
                <span style="font-size: 0.75rem; font-weight: 800; color: var(--abeja-text-muted); text-transform: uppercase;">Progreso hacia el siguiente nivel</span>
                <span style="font-size: 0.8rem; font-weight: 900; color: var(--abeja-dark);">${ds.progreso}%</span>
            </div>
            <div style="width: 100%; height: 12px; background-color: rgba(0,0,0,0.06); border-radius: 6px; overflow: hidden;">
                <div style="width: ${ds.progreso}%; height: 100%; background-color: var(--primary-yellow-dark); border-radius: 6px;"></div>
            </div>
        `;
    }

    // 6. Botones de acción dinámicos
    const btnBox = document.getElementById('mdlInfoBotones');
    if(ds.estado === 'bloqueado') {
        btnBox.innerHTML = `<button type="button" class="btn-stay w-75" onclick="cerrarModalAbeja('modalInfoDinamico')"><i class="fa-solid fa-lock me-2"></i>Sigue Jugando</button>`;
    } else {
        btnBox.innerHTML = `<button type="button" class="btn-submit-request w-75 shadow-sm" onclick="cerrarModalAbeja('modalInfoDinamico')">¡Fantástico!</button>`;
    }

    // Mostrar
    abrirModalAbeja('modalInfoDinamico');
}


function seleccionarAvatar(el){
    document.querySelectorAll('.foto-option').forEach(x => x.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('inputFotoId').value = el.getAttribute('data-id');
    document.getElementById('modalPreviewAvatar').src = el.getAttribute('data-ruta');
}

// --- IR A MISIONES Y GRUPO ---
function irAMisiones(){ 
    const contenedor = document.getElementById('dynamic-content');
    if(!contenedor) return;

    contenedor.style.opacity = '0.4'; 
    
    fetch('pages/misiones.php?action=verGrupo')
    .then(response => {
        if (!response.ok) throw new Error('Página no encontrada');
        return response.text();
    })
    .then(html => {
        contenedor.innerHTML = html;
        contenedor.style.opacity = '1';
        contenedor.scrollTop = 0;
        
        document.querySelectorAll('.nav-btn, .mobile-nav-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('[data-page="misiones"]').forEach(b => b.classList.add('active'));
        
        const headerPageTitle = document.getElementById('header-page-title');
        const headerPageIcon = document.getElementById('header-page-icon');
        if(headerPageTitle) headerPageTitle.textContent = 'Misiones';
        if(headerPageIcon) headerPageIcon.innerHTML = '<i class="fa-solid fa-crosshairs"></i>';
        
        const newUrl = new URL(window.location);
        newUrl.searchParams.set('page', 'misiones');
        newUrl.searchParams.set('action', 'verGrupo'); 
        window.history.pushState({ page: 'misiones' }, '', newUrl);

        const scripts = contenedor.querySelectorAll('script');
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
            if (oldScript.innerHTML) {
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
            }
            oldScript.parentNode.replaceChild(newScript, oldScript);
        });
    })
    .catch(err => {
        console.error("Error al cargar misiones:", err);
        contenedor.style.opacity = '1';
    });
}

// --- ACTUALIZACIÓN DE PERFIL SIN RECARGAR ---
const formEditar = document.getElementById('formEditarPerfil');
if (formEditar) {
    formEditar.addEventListener('submit', function(e) {
        e.preventDefault(); 

        const formData = new FormData(this);
        const btnGuardar = document.getElementById('btnGuardarPerfil');
        
        btnGuardar.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Guardando...';
        btnGuardar.disabled = true;

        fetch(endpointAPI, { 
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                btnGuardar.classList.add('success-state');
                btnGuardar.innerHTML = '<i class="fa-solid fa-check me-2"></i>¡Perfil Actualizado!';
                
                const mainName = document.querySelector('.perfil-name');
                if(mainName) mainName.textContent = data.nuevo_nombre;
                
                document.querySelectorAll('.user-avatar, .hex-avatar').forEach(img => { img.src = data.nueva_foto; });
                
                const primerNombre = data.nuevo_nombre.split(' ')[0];
                document.querySelectorAll('.user-widget-desktop h5').forEach(txt => { txt.textContent = data.nuevo_nombre; });
                document.querySelectorAll('.mobile-top-bar h6').forEach(txt => { txt.textContent = primerNombre; });

                setTimeout(() => {
                    cerrarModalAbeja('modalEditarPerfil');
                    setTimeout(() => {
                        btnGuardar.classList.remove('success-state');
                        btnGuardar.innerHTML = '<i class="fa-solid fa-floppy-disk me-2"></i>Guardar Cambios';
                        btnGuardar.disabled = false;
                    }, 300);
                }, 1500);

            } else {
                alert("Uy, algo salió mal: " + (data.msg || 'Intenta de nuevo'));
                btnGuardar.innerHTML = '<i class="fa-solid fa-floppy-disk me-2"></i>Guardar Cambios';
                btnGuardar.disabled = false;
            }
        })
        .catch(err => {
            console.error("Error en Fetch:", err);
            btnGuardar.innerHTML = '<i class="fa-solid fa-floppy-disk me-2"></i>Guardar Cambios';
            btnGuardar.disabled = false;
        });
    });
}

// --- CIERRE DE SESIÓN HACIA INDEX.PHP ---
function ejecutarLogout() {
    fetch(endpointAPI + '?action=logout')
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            window.location.href = 'index.php'; 
        }
    })
    .catch(() => {
        window.location.href = 'index.php';
    });
}
</script>