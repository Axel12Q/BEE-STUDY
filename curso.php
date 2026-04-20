<?php
session_start();
require 'conexion.php';

// 1. Validar Sesión
if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['action'])) {
        echo json_encode(['error' => 'No session']);
        exit;
    }
    header("Location: sesion.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// 2. MANEJADOR DE PETICIONES AJAX (POST) PARA BASE DE DATOS
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    // Perder una vida dinámicamente
    if ($_POST['action'] === 'lose_life') {
        $stmt = $pdo->prepare("UPDATE usuarios SET vidas = GREATEST(vidas - 1, 0) WHERE id = ?");
        $stmt->execute([$user_id]);
        echo json_encode(['success' => true]);
        exit;
    }

    // Finalizar lección y otorgar recompensas
    if ($_POST['action'] === 'finish_lesson') {
        $nodo_id  = isset($_POST['nodo_id']) ? (int)$_POST['nodo_id'] : 0;
        $correct  = isset($_POST['correct']) ? (int)$_POST['correct'] : 0;
        $errors   = isset($_POST['errors']) ? (int)$_POST['errors'] : 0;
        $cursoStr = isset($_POST['curso']) ? strtolower($_POST['curso']) : 'algebra';
        $is_win   = isset($_POST['is_win']) ? (int)$_POST['is_win'] : 0;
        $estado_get = isset($_POST['estado']) ? $_POST['estado'] : '';

        $total_preguntas = $correct + $errors;
        $accuracy = $total_preguntas > 0 ? (int)round(($correct / $total_preguntas) * 100) : 100;

        // Miel: 5 gotas por cada respuesta correcta
        $miel_ganada = $correct * 5;

        // XP: De 15 a 35 dependiendo del desempeño
        $xp_ganada = 15; // XP base

        if ($total_preguntas > 0) {
            $xp_ganada = 15 + (int)round(20 * ($correct / $total_preguntas));
        } else {
            $xp_ganada = 35;
        }

        // =====================================================
        // 🔥 ACTIVAR RACHA DEL DÍA (solo una vez por día)
        // =====================================================

        // Intentar registrar hoy en tabla racha
        $stmtRacha = $pdo->prepare("
    INSERT IGNORE INTO racha (usuario_id, fecha)
    VALUES (?, CURDATE())
");
        $stmtRacha->execute([$user_id]);


        // Si sí se insertó hoy (fila nueva), sumamos +1 a campo racha_dias del usuario
        if ($stmtRacha->rowCount() > 0) {
            $pdo->prepare("
                UPDATE usuarios
                SET racha_dias = racha_dias + 1
                WHERE id = ?
            ")->execute([$user_id]);
        }
        // =====================================================
        // 🍯⭐ Actualizar miel y XP del usuario
        // =====================================================
        $stmt = $pdo->prepare("
    UPDATE usuarios 
    SET miel = miel + ?, 
        nivel_actual_xp = nivel_actual_xp + ?
    WHERE id = ?
");

        $stmt->execute([$miel_ganada, $xp_ganada, $user_id]);

        // =========================================================================
        // B. EL ALGORITMO PERFECTO DE AVANCE BLINDADO
        // Solo avanza si ganó la lección, tiene un nodo válido, y no es repetida
        // =========================================================================
        if ($is_win === 1 && $estado_get !== 'completado' && $nodo_id > 0) {

            // 1. Verificamos que ESTE nodo específico sea el que está activo en la DB
            $stmtCheck = $pdo->prepare("SELECT estado FROM progreso_usuario WHERE usuario_id = ? AND nodo_id = ?");
            $stmtCheck->execute([$user_id, $nodo_id]);
            $estadoActualDB = $stmtCheck->fetchColumn();

            // Solo avanzamos si la base de datos confirma que estaba activo
            if ($estadoActualDB === 'activo') {
                // 2. Marcar este nodo actual como completado
                $pdo->prepare("UPDATE progreso_usuario SET estado = 'completado' WHERE usuario_id = ? AND nodo_id = ?")
                    ->execute([$user_id, $nodo_id]);

                // 3. Encontrar el SIGUIENTE NODO respetando el orden de secciones y nodos
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

                // 4. Activar el siguiente nodo si existe y está en el rango correcto
                if ($next_nodo) {
                    $max_nodo = ($cursoStr === 'algebra' || $cursoStr === '1') ? 23 : 41;

                    if ($next_nodo <= $max_nodo) {
                        // Verificar si ya existía para evitar duplicados
                        $stmtCheckNext = $pdo->prepare("SELECT id FROM progreso_usuario WHERE usuario_id = ? AND nodo_id = ?");
                        $stmtCheckNext->execute([$user_id, $next_nodo]);

                        if ($stmtCheckNext->rowCount() == 0) {
                            $pdo->prepare("INSERT INTO progreso_usuario (usuario_id, nodo_id, estado) VALUES (?, ?, 'activo')")
                                ->execute([$user_id, $next_nodo]);
                        }
                    }
                }
            }
        }

        // =========================================================================
        // C. Obtener Datos del Nuevo Nivel para la Tarjeta Visual
        // =========================================================================
        $stmtUsrXP = $pdo->prepare("SELECT nivel_actual_xp FROM usuarios WHERE id = ?");
        $stmtUsrXP->execute([$user_id]);
        $current_xp = (int)$stmtUsrXP->fetchColumn();

        $stmtLvl = $pdo->prepare("SELECT * FROM niveles_cat WHERE xp_requerida <= ? ORDER BY nivel DESC LIMIT 1");
        $stmtLvl->execute([$current_xp]);
        $nivelActual = $stmtLvl->fetch(PDO::FETCH_ASSOC);

        $nivel_num = $nivelActual ? (int)$nivelActual['nivel'] : 1;
        $nombre_nivel = $nivelActual ? $nivelActual['nombre_nivel'] : 'Abeja Larva';
        $icono_nivel = $nivelActual ? $nivelActual['icono'] : 'fa-baby';
        $color_base = $nivelActual ? str_replace('icon-', '', $nivelActual['color_css']) : 'comun';
        $xp_base_nivel = $nivelActual ? (int)$nivelActual['xp_requerida'] : 0;

        $stmtNextLvl = $pdo->prepare("SELECT xp_requerida FROM niveles_cat WHERE nivel = ?");
        $stmtNextLvl->execute([$nivel_num + 1]);
        $xp_siguiente = $stmtNextLvl->fetchColumn();

        if ($xp_siguiente) {
            $xp_rango = $xp_siguiente - $xp_base_nivel;
            $xp_progreso = $current_xp - $xp_base_nivel;
            $porcentaje_xp = ($xp_rango > 0) ? min(100, round(($xp_progreso / $xp_rango) * 100)) : 100;
        } else {
            $xp_siguiente = $current_xp;
            $porcentaje_xp = 100; // Nivel máximo
        }

        echo json_encode([
            'success' => true,
            'miel' => $miel_ganada,
            'xp' => $xp_ganada,
            'acc' => $accuracy,
            'nivel_num' => $nivel_num,
            'nivel_nombre' => $nombre_nivel,
            'icono' => $icono_nivel,
            'color_base' => $color_base,
            'xp_actual' => $current_xp,
            'xp_siguiente' => $xp_siguiente,
            'porcentaje_xp' => $porcentaje_xp
        ]);
        exit;
    }
}

// 3. Cargar datos base de la lección mediante método GET
$leccion_curso = isset($_GET['curso']) ? strtolower(trim($_GET['curso'])) : 'algebra';
$leccion_num   = isset($_GET['num']) ? (int)$_GET['num'] : 1;
$nodo_id_url   = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_GET['nodo_id']) ? (int)$_GET['nodo_id'] : 0);

// RESOLUCIÓN BIDIRECCIONAL: Si pasaron curso=algebra&num=2 pero no pasaron ID, lo calculamos en la BD
if ($nodo_id_url === 0 && isset($_GET['curso']) && isset($_GET['num'])) {
    $curso_id_db = ($leccion_curso === 'fisica') ? 2 : 1;
    $offset = max(0, $leccion_num - 1);

    // Evitamos bind param issues en LIMIT/OFFSET asegurando el casteo a entero
    $sql = "SELECT n.id FROM nodos n JOIN secciones s ON n.seccion_id = s.id 
            WHERE s.curso_id = $curso_id_db AND n.tipo != 'cofre' 
            ORDER BY s.id ASC, n.orden ASC LIMIT 1 OFFSET $offset";

    $stmtFindNode = $pdo->query($sql);
    if ($stmtFindNode) {
        $fetched_id = $stmtFindNode->fetchColumn();
        if ($fetched_id) {
            $nodo_id_url = (int)$fetched_id;
        }
    }
}

// Si pasaron ID pero faltan los GET del navegador, resolvemos los GET a la inversa
if ($nodo_id_url > 0 && (!isset($_GET['curso']) || !isset($_GET['num']))) {
    $stmtInfo = $pdo->prepare("
        SELECT c.nombre AS curso_nombre, n.orden, s.id AS seccion_id
        FROM nodos n
        JOIN secciones s ON n.seccion_id = s.id
        JOIN cursos c ON s.curso_id = c.id
        WHERE n.id = ?
    ");
    $stmtInfo->execute([$nodo_id_url]);
    $info = $stmtInfo->fetch(PDO::FETCH_ASSOC);
    if ($info) {
        if (stripos($info['curso_nombre'], 'lgebra') !== false) {
            $leccion_curso = 'algebra';
        } else if (stripos($info['curso_nombre'], 'sica') !== false) {
            $leccion_curso = 'fisica';
        }

        $stmtCount = $pdo->prepare("
            SELECT COUNT(*) FROM nodos n2
            JOIN secciones s2 ON n2.seccion_id = s2.id
            WHERE s2.curso_id = (SELECT curso_id FROM secciones WHERE id = ?)
            AND n2.tipo != 'cofre'
            AND (s2.id < ? OR (s2.id = ? AND n2.orden <= ?))
        ");
        $stmtCount->execute([$info['seccion_id'], $info['seccion_id'], $info['seccion_id'], $info['orden']]);
        $leccion_num = $stmtCount->fetchColumn();
    }
}

// 4. Validar las vidas del usuario
$stmt = $pdo->prepare("SELECT vidas FROM usuarios WHERE id = ?");
$stmt->execute([$user_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("Location: sesion.php");
    exit;
}

$vidas_actuales = (int)$usuario['vidas'];

if ($vidas_actuales <= 0) {
    header("Location: panal.php?msg=sin_vidas");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Abeja GO 🐝 | Lección en Curso</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style_panal.css">
    <link rel="stylesheet" href="css/style_curso.css">
    <style>
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
            --pastel-green-dark: #1ABC9C;
            --pastel-green-light: #E9F7EF;
            --pastel-purple: #A569BD;
            --pastel-purple-dark: #8E44AD;
            --pastel-purple-light: #F5EEF8;
            --pastel-red: #F5B7B1;
            --pastel-red-light: #ffeae86c;
            --pastel-red-dark: #E74C3C;
            --abeja-white: #ffffff;
            --abeja-gray-light: #F2F3F4;
            --abeja-gray-medium: #E5E5E5;
            --abeja-gray-dark: #D5D8DC;
            --abeja-gray: #F7F7F7;
            --abeja-text-muted: #839192;
            --abeja-text: #4A5568;
            --abeja-dark: #2C3E50;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Nunito', sans-serif;
            background-color: var(--abeja-white);
            color: var(--abeja-text);
            overflow: hidden;
        }

        /* ================= INTERFAZ Y LAYOUT ================= */
        .app-wrapper {
            position: relative;
            z-index: 10;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .lesson-header {
            display: flex;
            align-items: center;
            padding: 20px;
            gap: 20px;
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
            flex-shrink: 0;
        }

        .btn-icon-nav {
            background: var(--abeja-white);
            border: 2px solid var(--abeja-gray-medium);
            border-bottom-width: 4px;
            width: 45px;
            height: 45px;
            border-radius: 14px;
            font-size: 1.2rem;
            color: var(--abeja-text-muted);
            cursor: pointer;
            transition: all 0.15s;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
        }

        .btn-icon-nav:hover {
            background: var(--abeja-gray-light);
            color: var(--abeja-dark);
        }

        .btn-icon-nav:active {
            border-bottom-width: 2px;
            transform: translateY(2px);
        }

        .progress-container {
            display: flex;
            flex-grow: 1;
            gap: 6px;
        }

        .progress-segment-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .progress-segment {
            width: 100%;
            height: 16px;
            background-color: var(--abeja-gray-light);
            border-radius: 8px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            border-radius: 8px;
            transition: width 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .segment-theory .progress-fill {
            background-color: var(--primary-yellow-dark);
        }

        .segment-quiz .progress-fill {
            background-color: var(--primary-blue-dark);
        }

        .progress-label {
            font-size: 0.7rem;
            font-weight: 900;
            color: var(--abeja-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .lives-indicator {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--pastel-red-dark);
            flex-shrink: 0;
            transition: transform 0.2s;
        }

        .lesson-main-area {
            flex-grow: 1;
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
            padding: 10px 20px;
            overflow-y: auto;
            overflow-x: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .lesson-main-area::-webkit-scrollbar {
            width: 6px;
        }

        .lesson-main-area::-webkit-scrollbar-track {
            background: transparent;
        }

        .lesson-main-area::-webkit-scrollbar-thumb {
            background: var(--abeja-gray-medium);
            border-radius: 10px;
        }

        /* ================= ESTILOS DE CONTENIDO DINÁMICO ================= */
        .step-container {
            display: none;
            flex-direction: column;
            justify-content: flex-start;
            margin: auto 0;
            padding: 30px 0;
            width: 100%;
            flex-shrink: 0;
        }

        .step-container.active {
            display: flex;
        }

        .anim-slide-in-right {
            animation: slideInRight 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .anim-slide-in-left {
            animation: slideInLeft 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .anim-slide-out-left {
            animation: slideOutLeft 0.3s forwards;
        }

        .anim-slide-out-right {
            animation: slideOutRight 0.3s forwards;
        }

        .lesson-title {
            font-size: 1.8rem;
            font-weight: 900;
            margin-bottom: 25px;
            color: var(--abeja-dark);
            text-align: center;
            line-height: 1.3;
        }

        .options-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 10px;
            margin-top: 15px;
        }

        .options-grid.two-cols {
            grid-template-columns: 1fr 1fr;
        }

        .option-card {
            border: 3px solid var(--abeja-gray-medium);
            border-bottom-width: 6px;
            border-radius: 20px;
            padding: 20px;
            font-size: 1.25rem;
            font-weight: 900;
            text-align: center;
            cursor: pointer;
            background: var(--abeja-white);
            color: var(--abeja-dark);
            transition: all 0.15s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .option-card:hover:not(.locked) {
            background: var(--abeja-gray-light);
            transform: translateY(-2px);
            border-bottom-width: 8px;
        }

        .option-card:active:not(.locked) {
            border-bottom-width: 3px;
            transform: translateY(3px);
        }

        .option-card.selected {
            border-color: var(--primary-blue);
            background: var(--primary-blue-light);
            color: var(--primary-blue-dark);
            border-bottom-width: 6px;
        }

        .option-card.correct {
            border-color: var(--pastel-green-dark);
            background: var(--pastel-green-light);
            color: var(--pastel-green-dark);
            border-bottom-width: 3px;
            transform: translateY(3px);
        }

        .option-card.wrong {
            border-color: var(--pastel-red-dark);
            background: #FDEDEC;
            color: var(--pastel-red-dark);
            animation: shake 0.5s;
        }

        .option-card.locked {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .feedback-area {
            display: none;
            align-items: flex-start;
            gap: 15px;
            padding: 20px;
            border-radius: 20px;
            margin-top: 25px;
            font-weight: 800;
            font-size: 1.05rem;
            animation: bounceIn 0.4s forwards;
            flex-shrink: 0;
        }

        .feedback-area.success {
            display: flex;
            background: var(--pastel-green-light);
            border: 2px solid var(--pastel-green);
            color: var(--pastel-green-dark);
        }

        .feedback-area.error {
            display: flex;
            background: #FDEDEC;
            border: 2px solid var(--pastel-red);
            color: var(--pastel-red-dark);
        }

        .feedback-icon {
            font-size: 2rem;
            flex-shrink: 0;
        }

        .feedback-text {
            display: flex;
            flex-direction: column;
        }

        .feedback-title {
            font-size: 1.3rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        /* Footer */
        .lesson-footer {
            background: var(--abeja-white);
            border-top: 2px solid var(--abeja-gray-medium);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            z-index: 100;
        }

        .lesson-footer-inner {
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .btn-duo-action {
            background: var(--primary-yellow-dark);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.2rem;
            font-weight: 900;
            border-radius: 20px;
            border-bottom: 6px solid #CC9900;
            cursor: pointer;
            transition: all 0.1s;
            text-transform: uppercase;
            letter-spacing: 1px;
            min-width: 200px;
            flex-grow: 1;
            max-width: 300px;
        }

        .btn-duo-action:active:not(:disabled) {
            border-bottom-width: 0px;
            transform: translateY(6px);
            margin-bottom: 6px;
        }

        .btn-duo-action:disabled {
            background: var(--abeja-gray-medium);
            border-bottom-color: var(--abeja-gray-dark);
            color: var(--abeja-text-muted);
            cursor: not-allowed;
        }

        .btn-duo-action.btn-continue {
            background: var(--pastel-green-dark);
            border-bottom-color: #117A65;
        }

        /* ================= STATS GLOBALES FINALES ================= */
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 30px;
            width: 100%;
        }

        .stat-box {
            background: var(--abeja-white);
            border: 2px solid var(--primary-yellow-dark);
            border-radius: 20px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 8px 0 var(--primary-yellow-dark);
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .stat-box h4 {
            margin: 0;
            font-size: 0.95rem;
            color: var(--abeja-text-muted);
            font-weight: 900;
            text-transform: uppercase;
        }

        .stat-box span {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--primary-yellow-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 5px;
        }

        .stat-box.fail-box {
            border-color: var(--pastel-red-dark);
            box-shadow: 0 8px 0 var(--pastel-red-dark);
        }

        .stat-box.fail-box span {
            color: var(--pastel-red-dark);
        }

        /* Estilos Tarjeta XP Dinámica */
        .stat-card-dinamica {
            transition: all 0.3s ease;
            border-width: 2.5px !important;
            border-style: solid !important;
            border-radius: 24px;
            padding: 20px;
            background-color: var(--abeja-white);
        }

        .bg-tint-comun {
            background-color: var(--abeja-gray-light) !important;
        }

        .bg-tint-blue {
            background-color: var(--primary-blue-light) !important;
        }

        .bg-tint-green {
            background-color: var(--pastel-green-light) !important;
        }

        .bg-tint-purple {
            background-color: var(--pastel-purple-light) !important;
        }

        .bg-tint-orange {
            background-color: #FFF0E5 !important;
        }

        .bg-tint-gold {
            background-color: #FFF9E6 !important;
        }

        .perfil-hex-container {
            width: 60px;
            height: 70px;
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
            font-size: 1.8rem;
            position: relative;
            z-index: 2;
            color: #FFF;
        }

        .hex-color-orange {
            filter: drop-shadow(0 5px 0px rgba(255, 150, 0, 0.3));
        }

        .hex-color-orange .perfil-hex-inner {
            background-color: var(--secondary-orange-dark);
        }

        .hex-color-green {
            filter: drop-shadow(0 5px 0px rgba(26, 188, 156, 0.3));
        }

        .hex-color-green .perfil-hex-inner {
            background-color: var(--pastel-green-dark);
        }

        .hex-color-blue {
            filter: drop-shadow(0 5px 0px rgba(52, 152, 219, 0.3));
        }

        .hex-color-blue .perfil-hex-inner {
            background-color: var(--primary-blue);
        }

        .hex-color-purple {
            filter: drop-shadow(0 5px 0px rgba(142, 68, 173, 0.3));
        }

        .hex-color-purple .perfil-hex-inner {
            background-color: var(--pastel-purple);
        }

        .hex-color-gold {
            filter: drop-shadow(0 5px 0px rgba(229, 180, 0, 0.3));
        }

        .hex-color-gold .perfil-hex-inner {
            background-color: var(--primary-yellow-dark);
        }

        .hex-color-comun {
            filter: drop-shadow(0 5px 0px rgba(131, 145, 146, 0.3));
        }

        .hex-color-comun .perfil-hex-inner {
            background-color: var(--abeja-text-muted);
        }

        /* Animaciones */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.9);
                opacity: 0;
            }

            60% {
                transform: scale(1.05);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-10px);
            }

            40%,
            80% {
                transform: translateX(10px);
            }
        }

        @keyframes lostLife {
            0% {
                transform: scale(1);
                color: var(--pastel-red-dark);
            }

            50% {
                transform: scale(1.5);
                color: #B03A2E;
            }

            100% {
                transform: scale(1);
                color: var(--pastel-red-dark);
            }
        }

        .loader-abeja {
            border: 6px solid var(--abeja-gray-light);
            border-top: 6px solid var(--primary-yellow-dark);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .lesson-title {
                font-size: 1.5rem;
            }

            .options-grid.two-cols {
                grid-template-columns: 1fr;
            }

            .btn-duo-action {
                max-width: 100%;
                width: 100%;
            }

            .progress-label {
                display: none;
            }

            .progress-segment {
                height: 18px;
            }

            .lesson-header {
                padding: 15px 20px;
                gap: 12px;
            }

            .btn-icon-nav {
                width: 40px;
                height: 40px;
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>

    <audio id="sfx-correct" src="https://assets.mixkit.co/active_storage/sfx/2003/2003-preview.mp3" preload="auto"></audio>
    <audio id="sfx-wrong" src="https://assets.mixkit.co/active_storage/sfx/2004/2004-preview.mp3" preload="auto"></audio>
    <audio id="sfx-click" src="https://assets.mixkit.co/active_storage/sfx/2568/2568-preview.mp3" preload="auto"></audio>
    <audio id="sfx-win" src="https://assets.mixkit.co/active_storage/sfx/2018/2018-preview.mp3" preload="auto"></audio>

    <div id="mouse-effect-container">
        <div id="cursor-illuminator"></div>
    </div>
    <div id="flying-bees-container"></div>

    <script>
        // Aquí pasamos los datos resueltos directamente al JavaScript
        const LESSON_CURSO = "<?= htmlspecialchars($leccion_curso) ?>";
        const LESSON_NUM = "<?= htmlspecialchars($leccion_num) ?>";
        const RESOLVED_NODO_ID = <?= (int)$nodo_id_url ?>;
    </script>

    <div class="app-wrapper">
        <header class="lesson-header">
            <button class="btn-icon-nav" onclick="window.location.href='panal.php';" title="Salir"><i class="fa-solid fa-xmark"></i></button>
            <div class="progress-container" id="progress-container"></div>
            <div class="lives-indicator" id="lives-container" title="Tus vidas">
                <i class="fa-solid fa-heart"></i> <span id="lives-count"><?= htmlspecialchars($vidas_actuales) ?></span>
            </div>
        </header>

        <main class="lesson-main-area" id="lesson-main">
            <div class="d-flex flex-column align-items-center justify-content-center h-100" id="loading-state">
                <div class="loader-abeja"></div>
                <h3 style="color: var(--abeja-text-muted); font-weight: 800;">Preparando enjambre...</h3>
            </div>
        </main>

        <footer class="lesson-footer">
            <div class="lesson-footer-inner">
                <button class="btn-icon-nav" id="btn-prev" onclick="goPrevStep()" style="visibility: hidden;" title="Atrás"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="btn-duo-action" id="btn-next" onclick="handleNextAction()" disabled>CARGANDO...</button>
            </div>
        </footer>
    </div>

    <script src="js/script_abejas_efectos.js"></script>

    <script>
        window.lessonSteps = [];
        let currentIndex = 0;
        let maxUnlockedIndex = 0;
        let errorsCount = 0;
        let isAnimating = false;
        const userAnswers = {};

        const progContainer = document.getElementById('progress-container');
        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');
        const mainArea = document.getElementById('lesson-main');

        const sfxClick = document.getElementById('sfx-click');
        const sfxCorrect = document.getElementById('sfx-correct');
        const sfxWrong = document.getElementById('sfx-wrong');
        const sfxWin = document.getElementById('sfx-win');

        function loadLessonContent() {
            const targetUrl = `lecciones/contenido_${LESSON_CURSO}_${LESSON_NUM}.php`;

            fetch(targetUrl)
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP Error ${res.status}`);
                    return res.text();
                })
                .then(html => {
                    mainArea.innerHTML = html;
                    const scripts = mainArea.querySelectorAll('script');
                    scripts.forEach(oldScript => {
                        const newScript = document.createElement('script');
                        if (oldScript.src) newScript.src = oldScript.src;
                        newScript.textContent = oldScript.textContent;
                        oldScript.parentNode.replaceChild(newScript, oldScript);
                    });

                    setTimeout(() => {
                        if (window.lessonSteps && window.lessonSteps.length > 0) initLesson();
                        else mainArea.innerHTML = `<div class="text-center mt-5"><h3 class="text-danger">Error:</h3><p>El archivo no tiene pasos.</p></div>`;
                    }, 50);
                })
                .catch(err => {
                    mainArea.innerHTML = `<div class="text-center mt-5"><h3 class="text-danger">¡Vaya!</h3><p>No pudimos encontrar esta lección.</p></div>`;
                });
        }

        function initLesson() {
            const segments = window.lessonSteps.length - 1;
            progContainer.innerHTML = '';
            for (let i = 0; i < segments; i++) {
                const segClass = window.lessonSteps[i].isQuiz ? 'segment-quiz' : 'segment-theory';
                const segWrapper = document.createElement('div');
                segWrapper.className = `progress-segment-wrapper ${segClass}`;
                segWrapper.innerHTML = `<div class="progress-segment"><div class="progress-fill" id="fill-${i}"></div></div><span class="progress-label">${window.lessonSteps[i].type}</span>`;
                progContainer.appendChild(segWrapper);
            }
            btnNext.disabled = false;
            renderStep(currentIndex, 'anim-slide-in-right');
        }

        function buildXpCard(data) {
            const colorCssMap = {
                'comun': 'var(--abeja-gray-dark)',
                'blue': 'var(--primary-blue)',
                'green': 'var(--pastel-green)',
                'purple': 'var(--pastel-purple)',
                'orange': 'var(--secondary-orange-dark)',
                'gold': 'var(--primary-yellow-dark)'
            };
            const borderColor = colorCssMap[data.color_base] || 'var(--abeja-gray-medium)';

            return `
            <div id="dynamic-xp-card" class="mt-4 stat-card-dinamica bg-tint-${data.color_base} fade-in-section" style="border-color: ${borderColor}; width: 100%;">
                <div class="d-flex align-items-center gap-3 w-100">
                    <div class="perfil-hex-container hex-color-${data.color_base}">
                        <div class="perfil-hex-inner"><i class="fa-solid ${data.icono}"></i></div>
                    </div>
                    <div class="text-start flex-grow-1">
                        <span class="d-block fw-bold text-muted text-uppercase" style="font-size:0.8rem; letter-spacing: 0.5px;">Nivel ${data.nivel_num} <span class="text-primary fw-bolder ms-1" style="font-size:0.9rem;">(+${data.xp} XP)</span></span>
                        <span class="d-block fw-bold" style="font-size:1.3rem; color: var(--abeja-dark); line-height: 1.2;">${data.nivel_nombre}</span>
                    </div>
                </div>
                <div class="w-100 mt-3 text-start">
                     <div class="d-flex justify-content-between align-items-center mb-1">
                         <span style="font-size:0.75rem; font-weight:800; color:var(--abeja-text-muted); text-transform:uppercase;">Progreso al Nivel ${data.nivel_num + 1}</span>
                         <span style="font-size:0.85rem; font-weight:900; color:var(--abeja-dark);">${data.xp_actual} / ${data.xp_siguiente}</span>
                     </div>
                     <div style="width:100%; height:12px; background:rgba(0,0,0,0.08); border-radius:6px; overflow:hidden;">
                         <div style="width:${data.porcentaje_xp}%; height:100%; background:var(--primary-yellow-dark); border-radius:6px; transition: width 1.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);"></div>
                     </div>
                </div>
            </div>
            `;
        }

        function updateFinalStatsUI(recompensas) {
            document.querySelectorAll('.stat-box h4').forEach(h4 => {
                if (h4.innerText.toLowerCase().includes('precisión') || h4.innerText.toLowerCase().includes('precision')) {
                    const span = h4.nextElementSibling;
                    if (span) span.innerText = `${recompensas.acc}%`;
                }
            });

            document.querySelectorAll('.stat-box h4').forEach(h4 => {
                if (h4.innerText.toLowerCase().includes('miel')) {
                    const span = h4.nextElementSibling;
                    if (span) {
                        span.innerHTML = `+${recompensas.miel} <i class="fa-solid fa-droplet" style="color: var(--primary-yellow-dark);"></i>`;
                    }
                }
            });

            const statsGrid = document.querySelector('.stats-grid');
            if (statsGrid) {
                const oldXp = document.getElementById('dynamic-xp-card');
                if (oldXp) oldXp.remove();
                statsGrid.insertAdjacentHTML('afterend', buildXpCard(recompensas));
            }
        }

        function saveProgressAndShowRewards(callback, isWin = false) {
            const correctCount = Object.keys(userAnswers).length;
            const urlParams = new URLSearchParams(window.location.search);
            // MAGIA AQUÍ: Usamos la ID resuelta por PHP dinámicamente si no está en la URL
            const currentNodoId = urlParams.get('id') || RESOLVED_NODO_ID;
            const currentEstado = urlParams.get('estado') || '';
            const isWinParam = isWin ? 1 : 0;

            fetch('curso.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `action=finish_lesson&correct=${correctCount}&errors=${errorsCount}&nodo_id=${currentNodoId}&curso=${LESSON_CURSO}&is_win=${isWinParam}&estado=${currentEstado}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success && callback) callback(data);
                })
                .catch(err => console.error("Error BD: ", err));
        }

        window.selectOption = function(element, stepIndex) {
            if (isAnimating) return;
            if (userAnswers[stepIndex] && userAnswers[stepIndex].isCorrect) return;

            sfxClick.currentTime = 0;
            sfxClick.play();

            const stepContainer = document.getElementById(`step-${stepIndex}`);
            stepContainer.querySelectorAll('.option-card').forEach(opt => {
                if (!opt.classList.contains('correct')) opt.classList.remove('selected', 'wrong');
            });
            element.classList.add('selected');

            const fb = document.getElementById(`feedback-${stepIndex}`);
            if (fb) {
                fb.classList.remove('success', 'error');
                fb.style.display = 'none';
            }
            btnNext.disabled = false;
        }

        window.handleNextAction = function() {
            if (isAnimating) return;
            if (currentIndex === 999 || window.lessonSteps[currentIndex].type === "Final") {
                window.location.href = 'panal.php';
                return;
            }

            const currentData = window.lessonSteps[currentIndex];
            if (currentData.isQuiz) {
                if (userAnswers[currentIndex] && userAnswers[currentIndex].isCorrect) {
                    goNextStep();
                    return;
                }
                const stepContainer = document.getElementById(`step-${currentIndex}`);
                const selectedOpt = stepContainer.querySelector('.option-card.selected');
                if (!selectedOpt) return;
                checkAnswer(selectedOpt, stepContainer);
            } else {
                goNextStep();
            }
        }

        function checkAnswer(selectedOpt, stepContainer) {
            const isCorrect = selectedOpt.getAttribute('data-correct') === 'true';
            const feedbackArea = document.getElementById(`feedback-${currentIndex}`);

            if (isCorrect) {
                sfxCorrect.play();
                selectedOpt.classList.remove('selected');
                selectedOpt.classList.add('correct');
                stepContainer.querySelectorAll('.option-card').forEach(opt => opt.classList.add('locked'));

                feedbackArea.className = 'feedback-area success';
                feedbackArea.innerHTML = `<div class="feedback-icon"><i class="fa-solid fa-check-circle"></i></div><div class="feedback-text"><span class="feedback-title">¡Correcto!</span><span>${selectedOpt.getAttribute('data-success') || "¡Excelente!"}</span></div>`;
                feedbackArea.style.display = 'flex';

                userAnswers[currentIndex] = {
                    isCorrect: true
                };
                if (currentIndex === maxUnlockedIndex) {
                    maxUnlockedIndex++;
                    updateProgressBars();
                }

                btnNext.innerText = "CONTINUAR";
                btnNext.classList.add('btn-continue');
                setTimeout(() => {
                    mainArea.scrollTo({
                        top: mainArea.scrollHeight,
                        behavior: 'smooth'
                    });
                }, 100);
            } else {
                sfxWrong.play();
                errorsCount++;
                selectedOpt.classList.remove('selected');
                selectedOpt.classList.add('wrong');

                feedbackArea.className = 'feedback-area error';
                feedbackArea.innerHTML = `<div class="feedback-icon"><i class="fa-solid fa-circle-xmark"></i></div><div class="feedback-text"><span class="feedback-title">¡Ups!</span><span>${selectedOpt.getAttribute('data-error') || "Intenta de nuevo."}</span></div>`;
                feedbackArea.style.display = 'flex';
                btnNext.disabled = true;

                setTimeout(() => {
                    mainArea.scrollTo({
                        top: mainArea.scrollHeight,
                        behavior: 'smooth'
                    });
                }, 100);
                updateLives();
            }
        }

        function updateLives() {
            fetch('curso.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'action=lose_life'
            });
            const livesContainer = document.getElementById('lives-container');
            const livesElem = document.getElementById('lives-count');
            let lives = parseInt(livesElem.innerText);

            if (lives > 0) {
                lives -= 1;
                livesElem.innerText = lives;
                livesContainer.style.animation = 'none';
                void livesContainer.offsetWidth;
                livesContainer.style.animation = 'lostLife 0.5s ease-out';
            }
            if (lives === 0) setTimeout(() => showGameOver(), 1200);
        }

        function showGameOver() {
            if (isAnimating) return;
            isAnimating = true;
            const currentElem = document.getElementById(`step-${currentIndex}`);
            currentElem.className = 'step-container active anim-slide-out-left';

            setTimeout(() => {
                currentElem.classList.remove('active', 'anim-slide-out-left');
                currentElem.style.display = 'none';

                const goElem = document.getElementById('step-game-over');
                goElem.style.display = 'flex';
                goElem.className = 'step-container active anim-slide-in-right';

                progContainer.style.visibility = 'hidden';
                btnPrev.style.visibility = 'hidden';
                btnNext.innerText = "VOLVER AL PANAL";
                btnNext.disabled = true;
                btnNext.classList.remove('btn-continue');
                btnNext.onclick = function() {
                    window.location.href = 'panal.php';
                };

                sfxWrong.play();
                currentIndex = 999;

                // AQUI ENVIAMOS FALSE PORQUE PERDIMOS (NO SE AVANZA EL NODO)
                saveProgressAndShowRewards((recompensas) => {
                    updateFinalStatsUI(recompensas);
                    btnNext.disabled = false;
                    isAnimating = false;
                }, false);
            }, 300);
        }

        function goNextStep() {
            if (isAnimating || currentIndex >= window.lessonSteps.length - 1) return;
            isAnimating = true;
            const currentElem = document.getElementById(`step-${currentIndex}`);
            currentElem.className = 'step-container active anim-slide-out-left';

            setTimeout(() => {
                currentElem.classList.remove('active', 'anim-slide-out-left');
                currentElem.style.display = 'none';
                currentIndex++;
                if (currentIndex > maxUnlockedIndex) maxUnlockedIndex = currentIndex;
                renderStep(currentIndex, 'anim-slide-in-right');
                isAnimating = false;
            }, 300);
        }

        window.goPrevStep = function() {
            if (isAnimating || currentIndex <= 0) return;
            isAnimating = true;
            const currentElem = document.getElementById(`step-${currentIndex}`);
            currentElem.className = 'step-container active anim-slide-out-right';

            setTimeout(() => {
                currentElem.classList.remove('active', 'anim-slide-out-right');
                currentElem.style.display = 'none';
                currentIndex--;
                renderStep(currentIndex, 'anim-slide-in-left');
                isAnimating = false;
            }, 300);
        }

        function renderStep(index, animationClass) {
            document.querySelectorAll('.step-container').forEach(el => {
                el.style.display = 'none';
                el.className = 'step-container';
            });
            const stepElem = document.getElementById(`step-${index}`);
            stepElem.style.display = 'flex';
            stepElem.className = `step-container active ${animationClass}`;
            mainArea.scrollTop = 0;

            const currentData = window.lessonSteps[index];
            btnPrev.style.visibility = (index === 0) ? 'hidden' : 'visible';
            btnNext.classList.remove('btn-continue');

            if (currentData.type === "Final") {
                progContainer.style.visibility = 'hidden';
                btnNext.innerText = "FINALIZAR";
                btnNext.disabled = true;
                sfxWin.play();

                // AQUI ENVIAMOS TRUE PORQUE GANAMOS (SÍ SE AVANZA EL NODO)
                saveProgressAndShowRewards((recompensas) => {
                    updateFinalStatsUI(recompensas);
                    btnNext.disabled = false;
                    btnNext.onclick = function() {
                        window.location.href = 'panal.php';
                    };
                }, true);
            } else {
                progContainer.style.visibility = 'visible';
                if (currentData.isQuiz) {
                    if (userAnswers[index] && userAnswers[index].isCorrect) {
                        btnNext.innerText = "CONTINUAR";
                        btnNext.classList.add('btn-continue');
                        btnNext.disabled = false;
                        btnNext.onclick = handleNextAction;
                    } else {
                        btnNext.innerText = "COMPROBAR";
                        btnNext.disabled = !stepElem.querySelector('.option-card.selected');
                        btnNext.onclick = handleNextAction;
                    }
                } else {
                    btnNext.innerText = "CONTINUAR";
                    btnNext.disabled = false;
                    btnNext.onclick = handleNextAction;
                    if (index === maxUnlockedIndex) maxUnlockedIndex++;
                }
            }
            updateProgressBars();
        }

        function updateProgressBars() {
            for (let i = 0; i < window.lessonSteps.length - 1; i++) {
                const fill = document.getElementById(`fill-${i}`);
                if (fill) {
                    if (i < maxUnlockedIndex) fill.style.width = '100%';
                    else if (i === maxUnlockedIndex) fill.style.width = (userAnswers[i]?.isCorrect) ? '100%' : '50%';
                    else fill.style.width = '0%';
                }
            }
        }

        window.onload = loadLessonContent;
    </script>
</body>

</html>