<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../conexion.php'; 

if (!isset($_SESSION['user_id'])) exit;
$user_id = $_SESSION['user_id'];
$hoy = date('Y-m-d');

// ==========================================
// 1. LÓGICA DE ACCIONES (AJAX GET)
// ==========================================
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'claim_daily' && isset($_GET['id'])) {
        $mdp_id = (int)$_GET['id'];
        
        // Verificamos que la misión esté en estado completada
        $stmtCheck = $pdo->prepare("
            SELECT mdp.id, mdc.recompensa_miel 
            FROM misiones_diarias_progreso mdp
            JOIN misiones_diarias_cat mdc ON mdp.mision_id = mdc.id
            WHERE mdp.id = ? AND mdp.usuario_id = ? AND mdp.estado = 'completada'
        ");
        $stmtCheck->execute([$mdp_id, $user_id]);
        $mision = $stmtCheck->fetch(PDO::FETCH_ASSOC);
        
        if ($mision) {
            $pdo->prepare("UPDATE misiones_diarias_progreso SET estado = 'reclamada' WHERE id = ?")->execute([$mdp_id]);
            $pdo->prepare("UPDATE usuarios SET miel = miel + ? WHERE id = ?")->execute([$mision['recompensa_miel'], $user_id]);
        }
    }
    
    if ($_GET['action'] == 'claim_reward' && isset($_GET['id'])) {
        $recompensa_id = (int)$_GET['id'];
        // Evitar dobles reclamos
        $check = $pdo->prepare("SELECT id FROM recompensas_reclamadas WHERE usuario_id = ? AND recompensa_id = ?");
        $check->execute([$user_id, $recompensa_id]);
        if (!$check->fetch()) {
            $pdo->prepare("INSERT INTO recompensas_reclamadas (usuario_id, recompensa_id) VALUES (?, ?)")->execute([$user_id, $recompensa_id]);
            // Opcional: Aquí sumarías skins, cofres, etc. a su inventario real.
        }
    }

    if ($_GET['action'] == 'join' && isset($_GET['grupo_id'])) {
        $grupo_id = (int)$_GET['grupo_id'];
        $pdo->prepare("UPDATE usuarios SET grupo_id = ? WHERE id = ? AND grupo_id IS NULL")->execute([$grupo_id, $user_id]);
        $pdo->prepare("UPDATE grupos SET miembros_count = miembros_count + 1 WHERE id = ?")->execute([$grupo_id]);
    }
}

// ==========================================
// 2. EXTRACCIÓN DE ESTADÍSTICAS DEL USUARIO
// ==========================================
$stmtUsr = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmtUsr->execute([$user_id]);
$usuario = $stmtUsr->fetch(PDO::FETCH_ASSOC);

// Lecciones totales (contamos registros en progreso_usuario)
$stmtLec = $pdo->prepare("SELECT COUNT(*) FROM progreso_usuario WHERE usuario_id = ? AND estado = 'completado'");
$stmtLec->execute([$user_id]);
$total_lecciones = $stmtLec->fetchColumn();

// Misiones diarias completadas históricas
$stmtMisTot = $pdo->prepare("SELECT COUNT(*) FROM misiones_diarias_progreso WHERE usuario_id = ? AND estado IN ('completada', 'reclamada')");
$stmtMisTot->execute([$user_id]);
$misiones_historicas = $stmtMisTot->fetchColumn();

// ==========================================
// 3. ASIGNACIÓN Y ACTUALIZACIÓN DINÁMICA DE MISIONES
// ==========================================
// ¿Tiene 3 misiones diarias hoy? Si no, se las asignamos aleatorias.
$stmtCheckDaily = $pdo->prepare("SELECT COUNT(*) FROM misiones_diarias_progreso WHERE usuario_id = ? AND fecha = ?");
$stmtCheckDaily->execute([$user_id, $hoy]);
if ($stmtCheckDaily->fetchColumn() < 3) {
    $pdo->prepare("
        INSERT INTO misiones_diarias_progreso (usuario_id, mision_id, fecha, progreso, estado)
        SELECT ?, id, ?, 0, 'activa' FROM misiones_diarias_cat
        WHERE id NOT IN (SELECT mision_id FROM misiones_diarias_progreso WHERE usuario_id = ? AND fecha = ?)
        ORDER BY RAND() LIMIT 3
    ")->execute([$user_id, $hoy, $user_id, $hoy]);
}

// Actualizar progresos dinámicos diarios
// - Tipo login: progreso automático a 1
$pdo->prepare("UPDATE misiones_diarias_progreso mdp JOIN misiones_diarias_cat mdc ON mdp.mision_id = mdc.id SET mdp.progreso = 1 WHERE mdp.usuario_id = ? AND mdp.fecha = ? AND mdc.tipo = 'login' AND mdp.estado = 'activa'")->execute([$user_id, $hoy]);
// - Tipo lecciones: igualamos al total de lecciones
$pdo->prepare("UPDATE misiones_diarias_progreso mdp JOIN misiones_diarias_cat mdc ON mdp.mision_id = mdc.id SET mdp.progreso = ? WHERE mdp.usuario_id = ? AND mdp.fecha = ? AND mdc.tipo = 'lecciones' AND mdp.estado = 'activa'")->execute([$total_lecciones, $user_id, $hoy]);
// - Tipo racha:
$pdo->prepare("UPDATE misiones_diarias_progreso mdp JOIN misiones_diarias_cat mdc ON mdp.mision_id = mdc.id SET mdp.progreso = ? WHERE mdp.usuario_id = ? AND mdp.fecha = ? AND mdc.tipo = 'racha' AND mdp.estado = 'activa'")->execute([$usuario['racha_dias'], $user_id, $hoy]);
// - Tipo miel total:
$pdo->prepare("UPDATE misiones_diarias_progreso mdp JOIN misiones_diarias_cat mdc ON mdp.mision_id = mdc.id SET mdp.progreso = ? WHERE mdp.usuario_id = ? AND mdp.fecha = ? AND mdc.tipo = 'miel_total' AND mdp.estado = 'activa'")->execute([$usuario['miel'], $user_id, $hoy]);

// Revisar si superaron el objetivo y marcarlas como 'completadas'
$pdo->prepare("UPDATE misiones_diarias_progreso mdp JOIN misiones_diarias_cat mdc ON mdp.mision_id = mdc.id SET mdp.estado = 'completada' WHERE mdp.usuario_id = ? AND mdp.fecha = ? AND mdp.estado = 'activa' AND mdp.progreso >= mdc.objetivo")->execute([$user_id, $hoy]);

// Traer misiones diarias renderizables
$stmtMis = $pdo->prepare("
    SELECT mdp.id as progreso_id, mdp.progreso, mdp.estado, mdc.* FROM misiones_diarias_progreso mdp
    JOIN misiones_diarias_cat mdc ON mdp.mision_id = mdc.id
    WHERE mdp.usuario_id = ? AND mdp.fecha = ?
    ORDER BY FIELD(mdp.estado, 'completada', 'activa', 'reclamada')
");
$stmtMis->execute([$user_id, $hoy]);
$misiones_diarias = $stmtMis->fetchAll(PDO::FETCH_ASSOC);

$total_misiones = count($misiones_diarias);
$misiones_listas = 0;
foreach ($misiones_diarias as $m) {
    if ($m['estado'] == 'reclamada' || $m['estado'] == 'completada') $misiones_listas++;
}
$progreso_header = $total_misiones > 0 ? round(($misiones_listas / $total_misiones) * 100) : 0;

// ==========================================
// 4. CARGAR RECOMPENSAS DINÁMICAS (Límite 3 no reclamadas)
// ==========================================
$stmtRec = $pdo->prepare("
    SELECT * FROM recompensas_cat 
    WHERE id NOT IN (SELECT recompensa_id FROM recompensas_reclamadas WHERE usuario_id = ?)
    ORDER BY id ASC LIMIT 3
");
$stmtRec->execute([$user_id]);
$recompensas = $stmtRec->fetchAll(PDO::FETCH_ASSOC);

?>

<style>
    .mission-claim {
        border: 2px solid var(--primary-yellow-dark) !important;
        background: linear-gradient(to right, #ffffff, rgba(255, 224, 102, 0.15)) !important;
    }
    .btn-claim-mission {
        background: var(--primary-yellow-dark);
        color: white;
        border: none;
        padding: 6px 15px;
        border-radius: 10px;
        font-weight: 800;
        font-size: 0.85rem;
        box-shadow: 0 4px 0 #CC9900;
        transition: all 0.1s;
    }
    .btn-claim-mission:active {
        transform: translateY(3px);
        box-shadow: 0 1px 0 #CC9900;
    }
    .progress-text-sm {
        font-size: 0.8rem;
        font-weight: 800;
        color: var(--abeja-text-muted);
    }
</style>

<div class="mobile-page-title-card d-lg-none fade-in-section">
    <div class="mobile-page-title-icon">
        <i class="fa-solid fa-crosshairs"></i>
    </div>
    <div class="mobile-page-title-divider"></div>
    <h2 class="mobile-page-title-text">Misiones</h2>
</div>

<div class="row g-4 fade-in-section align-items-stretch">
    
    <div class="col-12 col-lg-7">
        <div class="d-flex flex-column h-100">
            
            <div class="daily-header-card sound-item">
                <div class="daily-header-title">
                    <div class="daily-header-icon"><i class="fa-solid fa-calendar-day"></i></div>
                    <h3>Misiones Diarias</h3>
                </div>
                <div class="daily-header-progress-bg">
                    <div class="daily-header-progress-fill progress-anim" data-target="<?= $progreso_header ?>%"></div>
                </div>
                <div class="daily-header-text"><?= $misiones_listas ?> / <?= $total_misiones ?> Completadas</div>
            </div>

            <div class="d-flex flex-column flex-grow-1 gap-3">
                <?php foreach ($misiones_diarias as $m): 
                    $pct = min(100, round(($m['progreso'] / $m['objetivo']) * 100));
                    $estado = $m['estado'];
                    $clase_card = 'mission-card sound-item flex-grow-1';
                    if ($estado == 'reclamada') $clase_card .= ' mission-completed';
                    if ($estado == 'completada') $clase_card .= ' mission-claim';
                ?>
                <div class="<?= $clase_card ?>">
                    <div class="mission-content">
                        <div class="mission-icon-box">
                            <i class="fa-solid <?= $estado == 'reclamada' ? 'fa-check-double' : htmlspecialchars($m['icono']) ?>"></i>
                        </div>
                        <div class="mission-divider"></div>
                        <div class="mission-info w-100">
                            <h4><?= htmlspecialchars($m['titulo']) ?></h4>
                            <p><?= htmlspecialchars($m['descripcion']) ?></p>
                            
                            <?php if ($estado == 'completada'): ?>
                                <div class="mt-2">
                                    <button class="btn-claim-mission sound-action" onclick="ejecutarAccionMision('claim_daily', <?= $m['progreso_id'] ?>)">RECLAMAR</button>
                                </div>
                            <?php elseif($estado == 'activa'): ?>
                                <div class="progress-text-sm mt-1">
                                    Progreso: <?= number_format($m['progreso']) ?> / <?= number_format($m['objetivo']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mission-reward">
                            <?php if($estado != 'reclamada'): ?>
                                <span>+<?= $m['recompensa_miel'] ?></span> <i class="fa-solid fa-droplet text-warning"></i>
                            <?php else: ?>
                                <span>Lista</span> <i class="fa-solid fa-check text-muted"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="mission-bottom-bar-bg">
                        <div class="mission-bottom-bar-fill progress-anim" data-target="<?= $estado == 'reclamada' ? 100 : $pct ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-5">
        <div class="d-flex flex-column h-100">
            
            <div class="reward-header-card sound-item">
                <div class="reward-header-icon">
                    <i class="fa-solid fa-gift"></i>
                </div>
                <div class="reward-header-divider"></div>
                <h3 class="reward-header-text">Recompensas</h3>
            </div>

            <div class="d-flex flex-column flex-grow-1 gap-3">
                <?php 
                if (count($recompensas) > 0):
                    foreach ($recompensas as $rec): 
                        // Calculamos progreso según su tipo de requisito
                        $valor_actual = 0;
                        if($rec['tipo_requisito'] == 'lecciones') $valor_actual = $total_lecciones;
                        if($rec['tipo_requisito'] == 'racha') $valor_actual = $usuario['racha_dias'];
                        if($rec['tipo_requisito'] == 'miel') $valor_actual = $usuario['miel'];
                        if($rec['tipo_requisito'] == 'misiones_completadas') $valor_actual = $misiones_historicas;

                        $objetivo_rec = $rec['valor_requisito'];
                        $desbloqueado = ($valor_actual >= $objetivo_rec);
                ?>
                <div class="reward-card sound-action flex-grow-1">
                    <div class="reward-hex-container <?= htmlspecialchars($rec['rareza']) ?>">
                        <div class="reward-hex"><span class="animated-emoji"><?= htmlspecialchars($rec['emoji']) ?></span></div>
                    </div>
                    <div class="reward-info">
                        <h4><?= htmlspecialchars($rec['titulo']) ?></h4>
                        <p><?= htmlspecialchars($rec['descripcion']) ?></p>
                    </div>
                    <div class="reward-action text-end">
                        <?php if ($desbloqueado): ?>
                            <button class="btn-claim mb-1" onclick="ejecutarAccionMision('claim_reward', <?= $rec['id'] ?>)">Reclamar</button>
                        <?php else: ?>
                            <button class="btn-locked mb-1"><i class="fa-solid fa-lock"></i> Bloqueado</button>
                            <div class="progress-text-sm"><?= number_format($valor_actual) ?>/<?= number_format($objetivo_rec) ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php 
                    endforeach; 
                else:
                ?>
                <div class="alert-abeja w-100">
                    <i class="fa-solid fa-crown text-warning"></i>
                    <div>¡Impresionante! Has reclamado todas las recompensas disponibles. Pronto añadiremos más.</div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>


<div class="section-header-row mt-5 mb-4 fade-in-section delay-2">
    <h3 class="section-title">
        <?= !$usuario['grupo_id'] ? 'Unirse a un Grupo' : 'Misiones Grupales' ?>
    </h3>
</div>

<div class="row g-4 mb-5 fade-in-section delay-3 align-items-stretch">
    
    <?php if (!$usuario['grupo_id']): 
        // Lógica: Mostrar los mejores grupos para unirse
        $stmtG = $pdo->query("SELECT * FROM grupos ORDER BY miembros_count DESC LIMIT 6");
        $grupos = $stmtG->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($grupos as $g):
    ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="mission-card group-mission sound-item h-100 d-flex flex-column">
                <div class="mission-content flex-grow-1">
                    <div class="mission-icon-box" style="background: var(--<?= $g['color_css'] ?? 'primary-blue' ?>-light); color: var(--<?= $g['color_css'] ?? 'primary-blue' ?>-dark);">
                        <i class="fa-solid <?= htmlspecialchars($g['icono'] ?? 'fa-users') ?>"></i>
                    </div>
                    <div class="mission-divider"></div>
                    <div class="mission-info w-100">
                        <h4><?= htmlspecialchars($g['nombre']) ?></h4>
                        <p><?= htmlspecialchars($g['descripcion']) ?></p>
                        <span class="small fw-bold text-muted mt-2 d-block"><i class="fa-solid fa-user-group me-1"></i><?= $g['miembros_count'] ?> miembros</span>
                    </div>
                </div>
                <div class="p-3 pt-0 border-top mt-auto" style="border-color: var(--abeja-gray-medium) !important;">
                    <button class="btn-submit-request w-100 mt-2 py-2" style="font-size: 0.95rem;" onclick="ejecutarAccionMision('join', <?= $g['id'] ?>)">UNIRSE AL GRUPO</button>
                </div>
            </div>
        </div>
    <?php 
        endforeach;
    else: 
        // Lógica: Mostrar misiones de grupo desde las tablas nuevas
        $grupo_id = $usuario['grupo_id'];
        
        // Asignación de misiones grupales dinámicas (Si no tienen 3)
        $stmtCheckG = $pdo->prepare("SELECT COUNT(*) FROM misiones_grupales_progreso WHERE grupo_id = ? AND fecha = ?");
        $stmtCheckG->execute([$grupo_id, $hoy]);
        if ($stmtCheckG->fetchColumn() < 3) {
            $pdo->prepare("
                INSERT INTO misiones_grupales_progreso (grupo_id, mision_id, fecha, progreso, estado)
                SELECT ?, id, ?, 0, 'activa' FROM misiones_grupales_cat
                WHERE id NOT IN (SELECT mision_id FROM misiones_grupales_progreso WHERE grupo_id = ? AND fecha = ?)
                ORDER BY RAND() LIMIT 3
            ")->execute([$grupo_id, $hoy, $grupo_id, $hoy]);
        }

        // Leer datos del grupo
        $gInf = $pdo->prepare("SELECT nombre FROM grupos WHERE id = ?");
        $gInf->execute([$grupo_id]);
        $nombre_grupo = $gInf->fetchColumn();

        // Extraer progreso de misiones grupales
        $stmtMisionG = $pdo->prepare("
            SELECT mgp.*, mgc.* FROM misiones_grupales_progreso mgp
            JOIN misiones_grupales_cat mgc ON mgp.mision_id = mgc.id
            WHERE mgp.grupo_id = ? AND mgp.fecha = ?
        ");
        $stmtMisionG->execute([$grupo_id, $hoy]);
        $misionesGrupales = $stmtMisionG->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($misionesGrupales) > 0):
            foreach($misionesGrupales as $mG):
                $pctG = min(100, round(($mG['progreso'] / $mG['objetivo']) * 100));
    ?>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="mission-card group-mission sound-item h-100">
                <div class="mission-content">
                    <div class="mission-icon-box"><i class="fa-solid <?= htmlspecialchars($mG['icono']) ?>"></i></div>
                    <div class="mission-divider"></div>
                    <div class="mission-info">
                        <span class="badge bg-light text-primary mb-2" style="border-radius: 8px; border: 1px solid var(--primary-blue-light); color: var(--primary-blue-dark) !important;">
                            <?= htmlspecialchars($nombre_grupo) ?>
                        </span>
                        <h4><?= htmlspecialchars($mG['titulo']) ?></h4>
                        <p><?= htmlspecialchars($mG['descripcion']) ?></p>
                        <div class="text-end fw-bold small mb-1 mt-2" style="color: var(--abeja-dark);">
                            Progreso: <?= number_format($mG['progreso']) ?> / <?= number_format($mG['objetivo']) ?>
                        </div>
                    </div>
                </div>
                <div class="mission-bottom-bar-bg">
                    <div class="mission-bottom-bar-fill progress-anim" data-target="<?= $pctG ?>%"></div>
                </div>
            </div>
        </div>
    <?php 
            endforeach;
        endif;
    endif; 
    ?>
</div>

<script>
    function ejecutarAccionMision(accion, id) {
        const dynamicContent = document.getElementById('dynamic-content');
        
        // Guardamos el scroll actual antes de llamar por fetch
        let scrollGuardado = 0;
        if (dynamicContent) {
            scrollGuardado = dynamicContent.scrollTop;
            dynamicContent.style.opacity = '0.4';
        }
        
        let url = `pages/misiones.php?action=${accion}`;
        if (accion === 'claim_daily') url += `&id=${id}`;
        if (accion === 'claim_reward') url += `&id=${id}`;
        if (accion === 'join') url += `&grupo_id=${id}`;

        fetch(url)
            .then(res => res.text())
            .then(html => {
                if (dynamicContent) {
                    dynamicContent.innerHTML = html;
                    dynamicContent.style.opacity = '1';
                    
                    // ¡TRUCAZO! Devolvemos el scroll exacto donde estaba
                    dynamicContent.scrollTop = scrollGuardado;

                    // Reejecutar scripts inyectados
                    const scripts = dynamicContent.querySelectorAll('script');
                    scripts.forEach(oldScript => {
                        if (!oldScript.src) {
                            const newScript = document.createElement('script');
                            newScript.textContent = oldScript.textContent;
                            oldScript.parentNode.replaceChild(newScript, oldScript);
                        }
                    });
                }
            });
    }

    (function() {
        // Animación fluida de las Barras de Progreso al cargar el script
        setTimeout(() => {
            const progressBars = document.querySelectorAll('.progress-anim');
            progressBars.forEach(bar => {
                const targetWidth = bar.getAttribute('data-target');
                if (targetWidth) bar.style.width = targetWidth;
            });
        }, 150);
        
        // Omitimos enviar al scroll top aquí para no romper el truco de arriba,
        // a menos que vengamos del navbar directamente.
        // Pero como este script se reejecuta en fetch, mejor lo dejamos sin forzar el scrollTop a 0.
    })();
</script>