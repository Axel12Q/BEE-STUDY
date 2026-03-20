<?php
// Obtenemos el nombre del archivo actual en el que estamos (ej: 'index.php')
$pagina_actual = basename($_SERVER['PHP_SELF']);
?>

<nav class="sidebar collapsed" id="sidebar">
    <div class="sidebar-header">
        <div class="brand-logo">
            <span class="logo-icon">🐝</span>
            <span class="logo-text">Abeja GO</span>
        </div>
    </div>

    <ul class="nav-links">
        <li>
            <a href="index.php" class="<?= ($pagina_actual == 'index.php') ? 'active' : '' ?>">
                <i class="bi bi-house-door-fill"></i> <span class="link-text">Inicio</span>
            </a>
        </li>
        <li>
            <a href="materias.php" class="<?= ($pagina_actual == 'materias.php') ? 'active' : '' ?>">
                <span class="emoji-icon">📚</span> <span class="link-text">Materias</span>
            </a>
        </li>
        <li>
            <a href="practica.php" class="<?= ($pagina_actual == 'practica.php') ? 'active' : '' ?>">
                <span class="emoji-icon">🧪</span> <span class="link-text">Práctica</span>
            </a>
        </li>
        <li>
            <a href="ruta.php" class="<?= ($pagina_actual == 'ruta.php') ? 'active' : '' ?>">
                <span class="emoji-icon">🗺️</span> <span class="link-text">Ruta</span>
            </a>
        </li>
        <li>
            <a href="clases.php" class="<?= ($pagina_actual == 'clases.php') ? 'active' : '' ?>">
                <span class="emoji-icon">🎓</span> <span class="link-text">Clases</span>
            </a>
        </li>
        <li class="mt-auto">
            <a href="perfil.php" class="<?= ($pagina_actual == 'perfil.php') ? 'active' : '' ?>">
                <span class="emoji-icon">👤</span> <span class="link-text">Perfil</span>
            </a>
        </li>
    </ul>
</nav>

<div class="menu-overlay" id="overlay"></div>