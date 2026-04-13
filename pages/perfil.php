

<div class="mobile-page-title-card d-lg-none fade-in-section">
    <div class="mobile-page-title-icon">
        <i class="fa-solid fa-user"></i>
    </div>
    <div class="mobile-page-title-divider"></div>
    <h2 class="mobile-page-title-text">Perfil</h2>
</div>

<div class="perfil-header fade-in-section">
    <div class="hex-avatar-wrapper">
        <img src="perfil-imgs/9.jpg" alt="Axel" class="hex-avatar">
    </div>
    
    <div class="perfil-main-divider"></div>
    
    <div class="perfil-info-box">
        <h1 class="perfil-name">Axel Jesús Quintero Salazar</h1>
        <div class="perfil-badges">
            <span title="Grado Académico"><i class="fa-solid fa-graduation-cap badge-icon"></i> 6to Semestre</span>
            <div class="badge-divider"></div>
            <span title="Institución"><i class="fa-solid fa-building-columns badge-icon"></i> ENMS Silao (UG)</span>
        </div>
    </div>

    <div class="perfil-actions">
        <button class="btn-perfil btn-edit sound-action">
            <i class="fa-solid fa-pen"></i> Editar
        </button>
        <button class="btn-perfil btn-logout sound-action">
            <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
        </button>
        <button class="btn-perfil btn-group-view sound-action">
            <i class="fa-solid fa-users"></i> Ver grupo
        </button>
    </div>
</div>

<div class="row g-4 mb-4 fade-in-section delay-1">
    <div class="col-12 col-lg-6">
        <div class="stat-card">
            <div class="stat-icon-box icon-orange">
                <i class="fa-solid fa-fire"></i>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-text-box">
                <span class="stat-label">Tiempo de racha</span>
                <span class="stat-value">14 días</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-6">
        <div class="stat-card" style="border-color: #FFF0B3;">
            <div class="stat-icon-box icon-yellow">
                <i class="fa-solid fa-crown"></i>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-text-box">
                <span class="stat-label">Nivel 5</span>
                <span class="stat-value">Abeja Exploradora</span>
            </div>
        </div>
    </div>
</div>

<div class="section-header-row fade-in-section delay-2">
    <h3 class="section-title">Tus Logros</h3>
    <button class="btn-view-more sound-action">Ver más <i class="fa-solid fa-angle-right ms-1"></i></button>
</div>

<div class="row g-4 mb-5 fade-in-section delay-2">
    <div class="col-12 col-lg-6">
        <div class="stat-card">
            <div class="stat-icon-box icon-blue">
                <i class="fa-solid fa-square-root-variable"></i>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-text-box">
                <span class="stat-label">Genio del Álgebra</span>
                <span class="stat-value">30 Lecciones</span>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-lg-6">
        <div class="stat-card">
            <div class="stat-icon-box icon-green">
                <i class="fa-solid fa-check-double"></i>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-text-box">
                <span class="stat-label">Precisión Perfecta</span>
                <span class="stat-value">100% Aciertos</span>
            </div>
        </div>
    </div>
</div>

<div class="section-header-row fade-in-section delay-3">
    <h3 class="section-title">Objetos Obtenidos</h3>
</div>

<div class="inventory-grid fade-in-section delay-3">
    
    <div class="item-card rareza-legendario">
        <div class="item-hex-container">
            <div class="item-hex">👑</div>
        </div>
        <div class="item-rarity">Legendario</div>
        <div class="item-name">Corona del Rey</div>
    </div>

    <div class="item-card rareza-epico">
        <div class="item-hex-container">
            <div class="item-hex">🎄</div>
        </div>
        <div class="item-rarity">Épico</div>
        <div class="item-name">Gorro de Navidad</div>
    </div>

    <div class="item-card rareza-raro">
        <div class="item-hex-container">
            <div class="item-hex">🎀</div>
        </div>
        <div class="item-rarity">Raro</div>
        <div class="item-name">Moño Lujoso</div>
    </div>

    <div class="item-card rareza-comun">
        <div class="item-hex-container">
            <div class="item-hex">🕶️</div>
        </div>
        <div class="item-rarity">Común</div>
        <div class="item-name">Lentes Cool</div>
    </div>

    <div class="item-card rareza-bloqueado">
        <div class="item-hex-container">
            <div class="item-hex"><i class="fa-solid fa-lock"></i></div>
        </div>
        <div class="item-rarity">Bloqueado</div>
        <div class="item-name">???</div>
    </div>

    <div class="item-card rareza-bloqueado">
        <div class="item-hex-container">
            <div class="item-hex"><i class="fa-solid fa-lock"></i></div>
        </div>
        <div class="item-rarity">Bloqueado</div>
        <div class="item-name">???</div>
    </div>
    
    <div class="item-card rareza-bloqueado">
        <div class="item-hex-container">
            <div class="item-hex"><i class="fa-solid fa-lock"></i></div>
        </div>
        <div class="item-rarity">Bloqueado</div>
        <div class="item-name">???</div>
    </div>
    
    <div class="item-card rareza-bloqueado">
        <div class="item-hex-container">
            <div class="item-hex"><i class="fa-solid fa-lock"></i></div>
        </div>
        <div class="item-rarity">Bloqueado</div>
        <div class="item-name">???</div>
    </div>

</div>

<script>
    (function() {
        // Aseguramos que el scroll inicie arriba al cargar la página en el fetch
        const dynamicContent = document.getElementById('dynamic-content');
        if(dynamicContent) {
            dynamicContent.scrollTop = 0;
        }
    })();
</script>