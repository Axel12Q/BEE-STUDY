<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['user_id'])) exit;

$user_id = $_SESSION['user_id'];
$nodo_id = intval($_POST['nodo_id']);
$xp_ganada = intval($_POST['xp']);
$miel_ganada = intval($_POST['miel']);

try {
    $pdo->beginTransaction();

    // 1. Actualizar XP y Miel del usuario
    $stmt = $pdo->prepare("UPDATE usuarios SET xp = xp + ?, miel = miel + ? WHERE id = ?");
    $stmt->execute([$xp_ganada, $miel_ganada, $user_id]);

    // 2. Marcar lección como completada
    $stmtProg = $pdo->prepare("
        INSERT INTO progreso_usuario (usuario_id, nodo_id, estado, fecha_completado)
        VALUES (?, ?, 'completado', NOW())
        ON DUPLICATE KEY UPDATE estado = 'completado', fecha_completado = NOW()
    ");
    $stmtProg->execute([$user_id, $nodo_id]);

    $pdo->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}