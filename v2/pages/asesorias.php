<?php
// asesorias.php - Abeja GO Asesorías Unificadas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Aseguramos la conexión
require_once file_exists('../conexion.php') ? '../conexion.php' : 'conexion.php';

if (!isset($_SESSION['user_id'])) {
    exit('Acceso denegado');
}

$user_id = $_SESSION['user_id'];

// =========================================================================
// 🛠️ AUTO-PARCHE DE BASE DE DATOS (Se ejecuta silenciosamente si hace falta)
// =========================================================================
try {
    $pdo->exec("ALTER TABLE asesorias ADD COLUMN fecha_sugerida_asesor DATETIME DEFAULT NULL");
    $pdo->exec("ALTER TABLE asesorias MODIFY COLUMN estado ENUM('pendiente','negociando','aceptada','completada','cancelada') NOT NULL DEFAULT 'pendiente'");
} catch (Exception $e) {
    // Ignoramos si ya existen
}

// =========================================================================
// 🚀 BACKEND: MANEJADOR DE PETICIONES AJAX
// =========================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    // 1. Crear una nueva solicitud de asesoría
    if ($_POST['action'] === 'solicitar_asesoria') {
        $materia = (int)$_POST['materia'];
        $tema = trim($_POST['tema']);
        $tipo = $_POST['tipo'] === 'grupal' ? 'grupal' : 'individual';
        $fecha_raw = $_POST['fecha'];

        if (empty($tema) || $materia <= 0 || empty($fecha_raw)) {
            echo json_encode(['status' => 'error', 'msg' => 'Faltan campos por llenar, incluyendo la fecha.']);
            exit;
        }

        $fecha_mysql = date('Y-m-d H:i:s', strtotime($fecha_raw));

        $stmt = $pdo->prepare("INSERT INTO asesorias (curso_id, tema, estudiante_id, tipo, estado, fecha_programada) VALUES (?, ?, ?, ?, 'pendiente', ?)");
        if ($stmt->execute([$materia, $tema, $user_id, $tipo, $fecha_mysql])) {
            if ($tipo === 'grupal') {
                $asesoria_id = $pdo->lastInsertId();
                $pdo->prepare("INSERT INTO asesorias_participantes (asesoria_id, usuario_id) VALUES (?, ?)")->execute([$asesoria_id, $user_id]);
            }
            echo json_encode(['status' => 'success', 'msg' => '¡Asesoría solicitada con éxito!']);
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Hubo un error al procesar tu solicitud.']);
        }
        exit;
    }

    // 2. Unirse a una asesoría grupal
    if ($_POST['action'] === 'unirse_asesoria') {
        $asesoria_id = (int)$_POST['asesoria_id'];
        
        $stmtCheck = $pdo->prepare("SELECT id FROM asesorias_participantes WHERE asesoria_id = ? AND usuario_id = ?");
        $stmtCheck->execute([$asesoria_id, $user_id]);
        if ($stmtCheck->rowCount() > 0) {
            echo json_encode(['status' => 'error', 'msg' => 'Ya estás inscrito en esta sesión.']);
            exit;
        }

        $stmt = $pdo->prepare("INSERT INTO asesorias_participantes (asesoria_id, usuario_id) VALUES (?, ?)");
        if ($stmt->execute([$asesoria_id, $user_id])) {
            echo json_encode(['status' => 'success', 'msg' => '¡Te has unido a la sesión grupal!']);
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'No se pudo completar la acción.']);
        }
        exit;
    }

    // 3. Responder a la negociación de fecha (Aceptar o Proponer otra)
    if ($_POST['action'] === 'negociar_fecha') {
        $asesoria_id = (int)$_POST['asesoria_id'];
        $respuesta = $_POST['respuesta']; // 'aceptar' o 'proponer'

        if ($respuesta === 'aceptar') {
            $stmt = $pdo->prepare("UPDATE asesorias SET fecha_programada = fecha_sugerida_asesor, fecha_sugerida_asesor = NULL, estado = 'aceptada' WHERE id = ? AND estudiante_id = ?");
            $stmt->execute([$asesoria_id, $user_id]);
            echo json_encode(['status' => 'success', 'msg' => '¡Fecha aceptada! La asesoría está programada.']);
        } else if ($respuesta === 'proponer') {
            $nueva_fecha = date('Y-m-d H:i:s', strtotime($_POST['nueva_fecha']));
            $stmt = $pdo->prepare("UPDATE asesorias SET fecha_programada = ?, fecha_sugerida_asesor = NULL, estado = 'pendiente' WHERE id = ? AND estudiante_id = ?");
            $stmt->execute([$nueva_fecha, $asesoria_id, $user_id]);
            echo json_encode(['status' => 'success', 'msg' => 'Nueva fecha enviada al asesor. Tu solicitud vuelve a estar pendiente.']);
        }
        exit;
    }

    // 4. Cancelar Solicitud Propia
    if ($_POST['action'] === 'cancelar_asesoria') {
        $asesoria_id = (int)$_POST['asesoria_id'];
        
        // Solo permite cancelar si no está completada/cancelada y si pertenece al estudiante
        $stmt = $pdo->prepare("UPDATE asesorias SET estado = 'cancelada' WHERE id = ? AND estudiante_id = ? AND estado NOT IN ('completada', 'cancelada')");
        if ($stmt->execute([$asesoria_id, $user_id]) && $stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'msg' => 'Solicitud cancelada correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'No se pudo cancelar esta solicitud.']);
        }
        exit;
    }
}

// =========================================================================
// 📥 OBTENCIÓN DE DATOS PARA RENDERIZAR LA VISTA
// =========================================================================

$stmtCursos = $pdo->query("SELECT id, nombre, icono FROM cursos ORDER BY nombre ASC");
$cursos_disponibles = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);

// Mis solicitudes
$stmtMisReq = $pdo->prepare("
    SELECT a.*, c.nombre as curso_nombre, c.icono as curso_icono, u.nombre as asesor_nombre
    FROM asesorias a
    JOIN cursos c ON a.curso_id = c.id
    LEFT JOIN usuarios u ON a.asesor_id = u.id
    WHERE a.estudiante_id = ?
    ORDER BY a.fecha_creacion DESC
");
$stmtMisReq->execute([$user_id]);
$mis_solicitudes = $stmtMisReq->fetchAll(PDO::FETCH_ASSOC);

$stmtGrupales = $pdo->prepare("
    SELECT a.*, c.nombre as curso_nombre, c.icono as curso_icono,
           est.nombre as creador_nombre, ase.nombre as asesor_nombre,
           (SELECT COUNT(*) FROM asesorias_participantes ap WHERE ap.asesoria_id = a.id AND ap.usuario_id = ?) as estoy_inscrito
    FROM asesorias a
    JOIN cursos c ON a.curso_id = c.id
    JOIN usuarios est ON a.estudiante_id = est.id
    LEFT JOIN usuarios ase ON a.asesor_id = ase.id
    WHERE a.tipo = 'grupal' 
      AND a.estado IN ('pendiente', 'negociando', 'aceptada') 
    ORDER BY a.fecha_programada ASC
");
$stmtGrupales->execute([$user_id]);
$asesorias_grupales = $stmtGrupales->fetchAll(PDO::FETCH_ASSOC);

// Helpers de Color
function estadoColorClass($estado) {
    switch($estado) {
        case 'pendiente': return 'orange';
        case 'negociando': return 'purple';
        case 'aceptada': return 'green';
        case 'cancelada': return 'comun';
        default: return 'blue';
    }
}
function estadoHexColor($estado) {
    switch($estado) {
        case 'pendiente': return 'hex-color-orange';
        case 'negociando': return 'hex-color-purple';
        case 'aceptada': return 'hex-color-green';
        case 'cancelada': return 'hex-color-comun';
        default: return 'hex-color-blue';
    }
}
function estadoBadgeText($estado) {
    switch($estado) {
        case 'pendiente': return '<i class="fa-solid fa-hourglass-half"></i> Buscando Asesor';
        case 'negociando': return '<i class="fa-solid fa-handshake"></i> Asesor Propone Horario';
        case 'aceptada': return '<i class="fa-solid fa-check-double"></i> Agendada';
        case 'cancelada': return '<i class="fa-solid fa-ban"></i> Cancelada';
        default: return ucfirst($estado);
    }
}
?>

<style>
/* =====================================================================
   ESTILOS DUOLINGO/ABEJA GO PARA ASESORÍAS Y BOTONES 3D
   ===================================================================== */

/* BOTONES ESTILO DUOLINGO (3D) */
.btn-duo-primary {
    background-color: var(--primary-blue);
    color: white;
    border: none;
    border-radius: 16px;
    padding: 12px 20px;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 5px 0 var(--primary-blue-dark);
    transition: all 0.1s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.btn-duo-primary:active {
    transform: translateY(5px);
    box-shadow: 0 0px 0 var(--primary-blue-dark);
}

.btn-duo-green {
    background-color: var(--pastel-green-dark);
    color: white;
    border: none;
    border-radius: 16px;
    padding: 12px 20px;
    font-size: 0.9rem;
    font-weight: 900;
    text-transform: uppercase;
    box-shadow: 0 5px 0 #138D75; /* Verde más oscuro para la sombra */
    transition: all 0.1s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-duo-green:active {
    transform: translateY(5px);
    box-shadow: 0 0px 0 #138D75;
}

.btn-duo-secondary {
    background-color: var(--abeja-white);
    color: var(--abeja-text-muted);
    border: 2px solid var(--abeja-gray-medium);
    border-radius: 16px;
    padding: 10px 20px;
    font-size: 0.9rem;
    font-weight: 900;
    text-transform: uppercase;
    box-shadow: 0 4px 0 var(--abeja-gray-medium);
    transition: all 0.1s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-duo-secondary:hover {
    background-color: var(--abeja-gray-light);
}
.btn-duo-secondary:active {
    transform: translateY(4px);
    box-shadow: 0 0px 0 var(--abeja-gray-medium);
}

.btn-duo-danger {
    background-color: var(--abeja-white);
    color: var(--pastel-red-dark);
    border: 2px solid var(--pastel-red-light);
    border-radius: 16px;
    padding: 10px 20px;
    font-size: 0.9rem;
    font-weight: 900;
    text-transform: uppercase;
    box-shadow: 0 4px 0 var(--pastel-red-light);
    transition: all 0.1s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-duo-danger:hover {
    background-color: var(--pastel-red-light);
    border-color: var(--pastel-red-dark);
    box-shadow: 0 4px 0 var(--pastel-red-dark);
}
.btn-duo-danger:active {
    transform: translateY(4px);
    box-shadow: 0 0px 0 var(--pastel-red-dark);
}

.btn-duo-danger-fill {
    background-color: var(--pastel-red-dark);
    color: white;
    border: none;
    border-radius: 16px;
    padding: 12px 20px;
    font-size: 1rem;
    font-weight: 900;
    text-transform: uppercase;
    box-shadow: 0 5px 0 #C0392B; /* Rojo más oscuro para sombra */
    transition: all 0.1s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-duo-danger-fill:active {
    transform: translateY(5px);
    box-shadow: 0 0px 0 #C0392B;
}

/* Tarjetas */
.asesoria-card {
    background-color: var(--abeja-white);
    border: 2px solid var(--abeja-gray-medium);
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

.asesoria-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.06);
}

.asesoria-card.estado-pendiente:hover { border-color: var(--secondary-orange-dark); }
.asesoria-card.estado-negociando:hover { border-color: var(--pastel-purple); }
.asesoria-card.estado-aceptada:hover { border-color: var(--pastel-green-dark); }
.asesoria-card.estado-cancelada { opacity: 0.6; filter: grayscale(80%); pointer-events: none; }

.asesoria-content {
    display: flex;
    align-items: flex-start;
    padding: 20px;
    gap: 15px;
    flex-grow: 1;
}

.asesoria-info {
    flex-grow: 1;
}

.asesoria-info h4 {
    font-size: 1.25rem;
    font-weight: 900;
    color: var(--abeja-dark);
    margin: 0 0 5px 0;
    line-height: 1.1;
}

.asesoria-info p {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--abeja-text-muted);
    margin: 0 0 10px 0;
}

.asesoria-date {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--abeja-gray-light);
    padding: 6px 12px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 800;
    color: var(--abeja-dark);
    border: 1px solid var(--abeja-gray-medium);
}

.asesoria-date.strikethrough {
    text-decoration: line-through;
    color: var(--abeja-text-muted);
    opacity: 0.7;
}

.asesoria-actions-panel {
    padding: 15px 20px;
    background-color: var(--abeja-gray);
    border-top: 2px solid var(--abeja-gray-medium);
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
}

/* Modales Custom */
.modal-abeja-custom { display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 999999; overflow: hidden; outline: 0; background-color: rgba(44, 62, 80, 0.7); backdrop-filter: blur(5px); opacity: 0; transition: opacity 0.3s ease; align-items: center; justify-content: center; }
.modal-abeja-custom.show { display: flex !important; opacity: 1; }
.modal-dialog-custom { position: relative; width: 90%; max-width: 450px; margin: 0; transform: translateY(-50px) scale(0.95); opacity: 0; transition: transform 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.3s ease; }
.modal-abeja-custom.show .modal-dialog-custom { transform: translateY(0) scale(1); opacity: 1; }
.modal-content-abeja { border: 2px solid var(--abeja-gray-medium); border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.2); overflow: hidden; background-color: var(--abeja-white); width: 100%;}
.modal-header-abeja { border-bottom: 2px solid var(--abeja-gray-medium); padding: 20px 25px; background-color: var(--abeja-white); display: flex; justify-content: space-between; align-items: center; }
.modal-body-abeja { padding: 35px 25px; background-color: var(--abeja-white); max-height: 80vh; overflow-y: auto; display: flex; flex-direction: column; align-items: center; gap: 15px; }
.modal-title-abeja { font-weight: 900; color: var(--abeja-dark); font-size: 1.25rem; margin:0;}
.btn-close-abeja { background: none; border: none; font-size: 1.5rem; color: var(--abeja-text-muted); cursor: pointer; transition: color 0.2s;}
.btn-close-abeja:hover { color: var(--pastel-red-dark); }

/* Badges Dinámicos */
.badge-dinamico {
    padding: 5px 12px;
    border-radius: 8px;
    font-weight: 900;
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.badge-dinamico.legendario { background-color: #FFF9E6; color: var(--primary-yellow-dark); border: 2px solid var(--primary-yellow-dark); }
.badge-dinamico.epico { background-color: var(--pastel-purple-light); color: var(--pastel-purple-dark); border: 2px solid var(--pastel-purple); }
.badge-dinamico.raro { background-color: var(--primary-blue-light); color: var(--primary-blue-dark); border: 2px solid var(--primary-blue); }
.badge-dinamico.comun { background-color: var(--abeja-gray-light); color: var(--abeja-text-muted); border: 2px solid var(--abeja-gray-medium); }

/* Formulario Custom */
.form-card {
    background-color: var(--abeja-white);
    border: 2px solid var(--abeja-gray-medium);
    border-radius: 24px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}

.input-duo {
    border-radius: 16px;
    padding: 14px 16px;
    border: 2px solid var(--abeja-gray-medium);
    font-weight: 800;
    color: var(--abeja-dark);
    background-color: var(--abeja-gray-light);
    transition: all 0.2s;
    width: 100%;
    box-sizing: border-box;
}
.input-duo:focus {
    border-color: var(--primary-blue);
    background-color: var(--abeja-white);
    outline: none;
    box-shadow: 0 0 0 4px rgba(93, 173, 226, 0.15);
}

/* Participantes */
.participante-tag {
    background-color: var(--abeja-gray-light);
    color: var(--abeja-text-muted);
    border: 2px solid var(--abeja-gray-medium);
    font-size: 0.8rem;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.participante-tag.ocupado {
    background-color: var(--primary-blue-light);
    color: var(--primary-blue-dark);
    border-color: var(--primary-blue);
}
</style>

<div class="mobile-page-title-card d-lg-none fade-in-section">
    <div class="mobile-page-title-icon">
        <i class="fa-solid fa-chalkboard-user"></i>
    </div>
    <div class="mobile-page-title-divider"></div>
    <h2 class="mobile-page-title-text">Asesorías</h2>
</div>

<div class="row g-4 fade-in-section align-items-stretch mb-5">
    
    <div class="col-12 col-lg-7 d-flex flex-column gap-4">
        
        <div class="promo-card sound-item">
            <div class="promo-left" style="flex: 0.6;">
                <div class="img-skeleton-wrapper" style="min-height: 140px; max-height: 140px;">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=500&q=80" alt="Estudiantes" loading="eager" onload="this.classList.add('loaded')">
                </div>
            </div>
            <div class="promo-divider"></div>
            <div class="promo-right" style="flex: 1.4;">
                <h2 class="titulo-seccion mb-2">¡Domina cualquier tema!</h2>
                <p>Agenda una clase privada o crea un grupo de estudio. Nuestros asesores te guiarán.</p>
                <div class="promo-price-box d-inline-block py-1 px-3">
                    <span class="badge-free m-0">100% Gratuito</span>
                </div>
            </div>
        </div>

        <div class="form-card">
            <h4 class="fw-900 mb-4" style="color: var(--abeja-dark);"><i class="fa-solid fa-plus-circle text-primary me-2"></i>Pedir Asesoría</h4>
            <form id="form-solicitar-asesoria">
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-bold" style="color: var(--abeja-text-muted);">Materia</label>
                        <select class="input-duo" name="materia" required>
                            <option value="" selected disabled>Elige materia...</option>
                            <?php foreach($cursos_disponibles as $curso): ?>
                                <option value="<?= $curso['id'] ?>"><?= htmlspecialchars($curso['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label fw-bold" style="color: var(--abeja-text-muted);">Tipo de sesión</label>
                        <select class="input-duo" name="tipo">
                            <option value="individual" selected>Individual (1 a 1)</option>
                            <option value="grupal">Grupal (Hasta 5 pers.)</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold" style="color: var(--abeja-text-muted);">¿Qué necesitas repasar?</label>
                        <input type="text" class="input-duo" name="tema" placeholder="Ej. Fracciones algebraicas, Leyes de Newton..." required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold" style="color: var(--abeja-text-muted);">¿Cuándo te gustaría tomarla?</label>
                        <input type="datetime-local" class="input-duo" name="fecha" required>
                    </div>
                </div>
                <button type="submit" class="btn-duo-primary w-100 mt-4" id="btn-solicitar-submit">
                    <i class="fa-solid fa-paper-plane me-2"></i>Enviar Solicitud
                </button>
            </form>
        </div>

        <div class="mt-2">
            <h4 class="titulo-seccion mb-3"><i class="fa-solid fa-folder-open me-2" style="color: var(--primary-yellow-dark);"></i>Mis Solicitudes</h4>
            
            <?php if (count($mis_solicitudes) === 0): ?>
                <div class="form-card text-center py-5">
                    <i class="fa-solid fa-ghost fs-1 mb-3" style="color: var(--abeja-gray-dark);"></i>
                    <h5 class="fw-bold" style="color: var(--abeja-text-muted);">Sin solicitudes activas</h5>
                    <p class="mb-0" style="color: var(--abeja-text-muted);">Usa el formulario de arriba para pedir una clase.</p>
                </div>
            <?php else: ?>
                <?php foreach ($mis_solicitudes as $sol): 
                    $estadoHex = estadoHexColor($sol['estado']);
                    $colorName = estadoColorClass($sol['estado']);
                ?>
                    <div class="asesoria-card estado-<?= $sol['estado'] ?> sound-item">
                        <div class="asesoria-content">
                            <div class="perfil-hex-container <?= $estadoHex ?> mt-1" style="transform: scale(0.9);">
                                <div class="perfil-hex-inner">
                                    <i class="fa-solid <?= htmlspecialchars($sol['curso_icono']) ?>"></i>
                                </div>
                            </div>
                            
                            <div class="asesoria-info">
                                <h4><?= htmlspecialchars($sol['curso_nombre']) ?></h4>
                                <p><?= htmlspecialchars($sol['tema']) ?></p>
                                
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <span class="badge-dinamico comun"><i class="fa-solid <?= $sol['tipo'] === 'grupal' ? 'fa-users' : 'fa-user' ?>"></i> <?= ucfirst($sol['tipo']) ?></span>
                                    
                                    <?php if ($sol['estado'] === 'pendiente'): ?>
                                        <span class="badge-dinamico legendario"><?= estadoBadgeText($sol['estado']) ?></span>
                                    <?php elseif ($sol['estado'] === 'negociando'): ?>
                                        <span class="badge-dinamico epico"><?= estadoBadgeText($sol['estado']) ?></span>
                                    <?php elseif ($sol['estado'] === 'aceptada'): ?>
                                        <span class="badge-dinamico raro" style="background-color: var(--pastel-green-light); color: var(--pastel-green-dark); border-color: var(--pastel-green);"><?= estadoBadgeText($sol['estado']) ?></span>
                                    <?php else: ?>
                                        <span class="badge-dinamico comun"><?= estadoBadgeText($sol['estado']) ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <?php if ($sol['estado'] === 'negociando' && !empty($sol['fecha_sugerida_asesor'])): ?>
                                    <div class="asesoria-date strikethrough mb-2">
                                        <i class="fa-regular fa-calendar-xmark"></i> Tú propusiste: <?= date('d/m/Y h:i A', strtotime($sol['fecha_programada'])) ?>
                                    </div><br>
                                    <div class="asesoria-date" style="border-color: var(--pastel-purple); background: var(--pastel-purple-light); color: var(--pastel-purple-dark);">
                                        <i class="fa-solid fa-bolt"></i> <?= htmlspecialchars($sol['asesor_nombre']) ?> propone: <strong><?= date('d/m/Y h:i A', strtotime($sol['fecha_sugerida_asesor'])) ?></strong>
                                    </div>
                                <?php else: ?>
                                    <div class="asesoria-date">
                                        <i class="fa-regular fa-calendar-check"></i> Horario: <?= date('d/m/Y h:i A', strtotime($sol['fecha_programada'])) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ($sol['estado'] !== 'cancelada' && $sol['estado'] !== 'completada'): ?>
                            <div class="asesoria-actions-panel">
                                
                                <?php if ($sol['estado'] === 'negociando'): ?>
                                    <button class="btn-duo-green flex-grow-1 m-0" onclick="responderFecha(<?= $sol['id'] ?>, 'aceptar')">
                                        <i class="fa-solid fa-check me-2"></i>Aceptar
                                    </button>
                                    <button class="btn-duo-secondary flex-grow-1 m-0" onclick="abrirModalProponerFecha(<?= $sol['id'] ?>)">
                                        <i class="fa-solid fa-clock-rotate-left me-2"></i>Otro
                                    </button>
                                <?php endif; ?>

                                <button class="btn-duo-danger m-0 <?= $sol['estado'] === 'negociando' ? 'w-100 mt-2' : '' ?>" onclick="abrirModalCancelar(<?= $sol['id'] ?>)">
                                    <i class="fa-solid fa-xmark me-2"></i>Cancelar Solicitud
                                </button>
                                
                            </div>
                        <?php endif; ?>

                        <div class="mission-bottom-bar-bg" style="height: 6px;">
                            <div class="mission-bottom-bar-fill w-100" style="background-color: var(--<?= $colorName === 'comun' ? 'abeja-gray-dark' : ($colorName === 'purple' ? 'pastel-purple' : ($colorName === 'green' ? 'pastel-green' : 'secondary-orange-dark')) ?>);"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <h4 class="titulo-seccion mb-3"><i class="fa-solid fa-users me-2" style="color: var(--primary-blue);"></i>Mural Grupal</h4>
        
        <?php if (count($asesorias_grupales) === 0): ?>
            <div class="form-card text-center py-5 h-100 d-flex flex-column justify-content-center">
                <i class="fa-solid fa-mug-hot fs-1 mb-3" style="color: var(--abeja-gray-dark);"></i>
                <h5 class="fw-bold" style="color: var(--abeja-text-muted);">Sin grupos disponibles</h5>
                <p class="mb-0" style="color: var(--abeja-text-muted);">No hay grupos de estudio abiertos en este momento.</p>
            </div>
        <?php else: ?>
            <div class="d-flex flex-column gap-3">
                <?php foreach ($asesorias_grupales as $grupal): 
                    $es_mia = ($grupal['estudiante_id'] == $user_id);
                    $estoy_inscrito = ($grupal['estoy_inscrito'] > 0);
                    
                    $stmtParts = $pdo->prepare("SELECT u.nombre FROM asesorias_participantes ap JOIN usuarios u ON ap.usuario_id = u.id WHERE ap.asesoria_id = ?");
                    $stmtParts->execute([$grupal['id']]);
                    $participantes = $stmtParts->fetchAll(PDO::FETCH_COLUMN);
                    $cupos_libres = 5 - count($participantes);
                ?>
                    <div class="asesoria-card <?= $es_mia ? 'border-primary' : '' ?> sound-item m-0">
                        <div class="asesoria-content pb-2">
                            <div class="perfil-hex-container hex-color-blue" style="transform: scale(0.8); margin-top: -10px;">
                                <div class="perfil-hex-inner">
                                    <i class="fa-solid <?= htmlspecialchars($grupal['curso_icono']) ?>"></i>
                                </div>
                            </div>
                            <div class="asesoria-info">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h4><?= htmlspecialchars($grupal['curso_nombre']) ?></h4>
                                    <?php if($es_mia): ?> <span class="badge-dinamico legendario">Mío</span> <?php endif; ?>
                                </div>
                                <p class="mb-2"><?= htmlspecialchars($grupal['tema']) ?></p>
                                
                                <p class="text-muted fw-bold mb-1" style="font-size: 0.8rem;"><i class="fa-solid fa-crown me-1 text-warning"></i> Creador: <?= $es_mia ? 'Tú' : explode(' ', $grupal['creador_nombre'])[0] ?></p>
                                <p class="text-muted fw-bold mb-2" style="font-size: 0.8rem;"><i class="fa-solid fa-chalkboard-user me-1 text-primary"></i> Asesor: <?= $grupal['asesor_nombre'] ? explode(' ', $grupal['asesor_nombre'])[0] : 'Asignando...' ?></p>
                                
                                <div class="asesoria-date w-100 justify-content-center">
                                    <i class="fa-regular fa-calendar"></i> <?= date('d/m - h:i A', strtotime($grupal['fecha_programada'])) ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-3 pb-3">
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <?php foreach($participantes as $part): ?>
                                    <span class="participante-tag ocupado"><i class="fa-solid fa-user"></i> <?= explode(' ', $part)[0] ?></span>
                                <?php endforeach; ?>
                                <?php for($i=0; $i<$cupos_libres; $i++): ?>
                                    <span class="participante-tag"><i class="fa-regular fa-circle"></i> Libre</span>
                                <?php endfor; ?>
                            </div>

                            <?php if (!$es_mia && !$estoy_inscrito && $cupos_libres > 0): ?>
                                <button class="btn-duo-primary w-100" onclick="unirseAsesoria(<?= $grupal['id'] ?>)">Unirme a este Grupo</button>
                            <?php elseif ($estoy_inscrito && !$es_mia): ?>
                                <button class="btn-duo-green w-100" disabled style="cursor: not-allowed; box-shadow: none; transform: none;"><i class="fa-solid fa-check me-2"></i> Ya estás dentro</button>
                            <?php endif; ?>
                        </div>
                        <div class="mission-bottom-bar-bg" style="height: 6px;"><div class="mission-bottom-bar-fill w-100" style="background-color: var(--primary-blue);"></div></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="modal-abeja-custom" id="modalProponerFecha" style="display: none;">
    <div class="modal-dialog-custom">
        <div class="modal-content-abeja">
            <div class="modal-header-abeja border-0 justify-content-center position-relative pt-4 pb-0">
                <div class="perfil-hex-container hex-color-purple" style="transform: scale(1.2);">
                    <div class="perfil-hex-inner"><i class="fa-solid fa-calendar-day"></i></div>
                </div>
                <button type="button" class="btn-close-abeja position-absolute end-0 top-0 mt-3 me-3" onclick="cerrarModalAbeja('modalProponerFecha')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body-abeja text-center pt-4">
                <h4 class="fw-900 mb-2" style="color: var(--abeja-dark);">Proponer Horario</h4>
                <p class="text-muted fw-bold mb-4" style="font-size: 0.9rem;">Elige una nueva fecha y hora. Se la enviaremos al asesor para confirmarla.</p>
                
                <input type="hidden" id="modal-asesoria-id">
                
                <div class="text-start mb-4 w-100">
                    <label class="form-label fw-bold text-muted ps-1">Nueva Fecha Propuesta:</label>
                    <input type="datetime-local" class="input-duo" id="modal-nueva-fecha" required>
                </div>

                <button class="btn-duo-primary w-100 mb-2" onclick="enviarNuevaFecha()">
                    <i class="fa-solid fa-paper-plane me-2"></i>Enviar Propuesta
                </button>
                <button class="btn-duo-secondary w-100 mt-2" onclick="cerrarModalAbeja('modalProponerFecha')">Volver</button>
            </div>
        </div>
    </div>
</div>

<div class="modal-abeja-custom" id="modalCancelarAsesoria" style="display: none;">
    <div class="modal-dialog-custom">
        <div class="modal-content-abeja text-center">
            <div class="modal-header-abeja border-0 pb-0 justify-content-center position-relative">
                <h5 class="modal-title-abeja fs-4" style="color: var(--pastel-red-dark);">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>¿Cancelar Solicitud?
                </h5>
                <button type="button" class="btn-close-abeja position-absolute end-0 me-4" onclick="cerrarModalAbeja('modalCancelarAsesoria')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body-abeja pt-3 pb-4" style="background-color: var(--abeja-white);">
                <p class="fw-bold mb-0 fs-6" style="color: var(--abeja-text-muted);">Estás a punto de cancelar esta solicitud de asesoría. Esta acción no se puede deshacer.</p>
                <input type="hidden" id="modal-cancel-id">
            </div>
            <div class="border-0 d-flex justify-content-center gap-3 pt-0 pb-4 px-4" style="background-color: var(--abeja-white);">
                <button type="button" class="btn-duo-secondary w-50" onclick="cerrarModalAbeja('modalCancelarAsesoria')">No, volver</button>
                <button type="button" class="btn-duo-danger-fill w-50" id="btn-ejecutar-cancel" onclick="ejecutarCancelacion()">Sí, cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const dynamicContent = document.getElementById('dynamic-content');
        if(dynamicContent) dynamicContent.scrollTop = 0;

        // Limpieza de modales huérfanos al recargar AJAX
        document.querySelectorAll('body > .modal-abeja-custom').forEach(el => el.remove());

        // ========================================================
        // 🚀 ENVIAR NUEVA SOLICITUD
        // ========================================================
        const formSolicitar = document.getElementById('form-solicitar-asesoria');
        if(formSolicitar) {
            formSolicitar.addEventListener('submit', function(e) {
                e.preventDefault();
                const btnSubmit = document.getElementById('btn-solicitar-submit');
                const originalText = btnSubmit.innerHTML;
                btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Enviando...';
                btnSubmit.disabled = true;

                const formData = new URLSearchParams(new FormData(this));
                formData.append('action', 'solicitar_asesoria');

                fetch('pages/asesorias.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: formData.toString()
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        if(typeof cargarContenido === 'function') cargarContenido('pages/asesorias.php', this);
                        else window.location.reload();
                    } else {
                        alert(data.msg);
                        btnSubmit.innerHTML = originalText;
                        btnSubmit.disabled = false;
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    alert("Ocurrió un error al enviar tu solicitud.");
                    btnSubmit.innerHTML = originalText;
                    btnSubmit.disabled = false;
                });
            });
        }
    })();

    // ========================================================
    // 🚀 CONTROL DE MODALES ABEJA GO
    // ========================================================
    function abrirModalAbeja(id) {
        const modal = document.getElementById(id);
        if (!modal) return;
        document.body.appendChild(modal); // Mover al root para z-index
        modal.style.display = 'flex';
        void modal.offsetWidth; 
        modal.classList.add('show');
    }

    function cerrarModalAbeja(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('show');
            setTimeout(() => { modal.style.display = 'none'; }, 300);
        }
    }

    // ========================================================
    // 🚀 UNIRSE A GRUPO
    // ========================================================
    function unirseAsesoria(asesoriaId) {
        if(!confirm("¿Deseas ocupar un lugar en esta sesión grupal?")) return;
        fetch('pages/asesorias.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=unirse_asesoria&asesoria_id=${asesoriaId}`
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                if(typeof cargarContenido === 'function') cargarContenido('pages/asesorias.php');
                else window.location.reload();
            } else alert(data.msg);
        });
    }

    // ========================================================
    // 🚀 CANCELAR SOLICITUD PROPIA
    // ========================================================
    function abrirModalCancelar(asesoriaId) {
        document.getElementById('modal-cancel-id').value = asesoriaId;
        abrirModalAbeja('modalCancelarAsesoria');
    }

    function ejecutarCancelacion() {
        const id = document.getElementById('modal-cancel-id').value;
        const btn = document.getElementById('btn-ejecutar-cancel');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i>Cancelando...';
        btn.disabled = true;

        fetch('pages/asesorias.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=cancelar_asesoria&asesoria_id=${id}`
        })
        .then(res => res.json())
        .then(data => {
            cerrarModalAbeja('modalCancelarAsesoria');
            if(data.status === 'success') {
                setTimeout(() => {
                    if(typeof cargarContenido === 'function') cargarContenido('pages/asesorias.php');
                    else window.location.reload();
                }, 300);
            } else {
                alert(data.msg);
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });
    }

    // ========================================================
    // 🚀 NEGOCIACIÓN DE FECHA
    // ========================================================
    function abrirModalProponerFecha(asesoriaId) {
        document.getElementById('modal-asesoria-id').value = asesoriaId;
        document.getElementById('modal-nueva-fecha').value = '';
        abrirModalAbeja('modalProponerFecha');
    }

    function enviarNuevaFecha() {
        const id = document.getElementById('modal-asesoria-id').value;
        const nuevaFecha = document.getElementById('modal-nueva-fecha').value;
        
        if (!nuevaFecha) { alert("Por favor, selecciona una fecha y hora."); return; }
        
        fetch('pages/asesorias.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=negociar_fecha&asesoria_id=${id}&respuesta=proponer&nueva_fecha=${nuevaFecha}`
        })
        .then(res => res.json())
        .then(data => {
            cerrarModalAbeja('modalProponerFecha');
            if(data.status === 'success') {
                setTimeout(() => {
                    if(typeof cargarContenido === 'function') cargarContenido('pages/asesorias.php');
                    else window.location.reload();
                }, 300);
            } else alert(data.msg);
        });
    }

    function responderFecha(id, respuesta) {
        if(respuesta !== 'aceptar') return;
        
        fetch('pages/asesorias.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `action=negociar_fecha&asesoria_id=${id}&respuesta=${respuesta}`
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                if(typeof cargarContenido === 'function') cargarContenido('pages/asesorias.php');
                else window.location.reload();
            } else alert(data.msg);
        });
    }
</script>