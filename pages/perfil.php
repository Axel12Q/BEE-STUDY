<style>
    /* =========================================
       ESTILOS EXCLUSIVOS DE PERFIL.PHP
       ========================================= */

    /* Animación de entrada suave */
    .fade-in-section {
        animation: fadeInSlide 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    @keyframes fadeInSlide {
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- CABECERA DE PERFIL --- */
    .perfil-header {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 40px;
        position: relative;
    }

    .hex-avatar-wrapper {
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .hex-avatar-wrapper:hover {
        transform: scale(1.05) rotate(5deg);
    }

    .hex-avatar {
        width: 140px;
        height: 140px;
        object-fit: cover;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        border-left: 4px solid var(--abeja-yellow-dark);
        border-right: 4px solid var(--abeja-yellow-dark);
    }

    .perfil-main-divider {
        width: 2px;
        height: 90px;
        background-color: var(--abeja-gray-medium);
        flex-shrink: 0;
    }

    .perfil-info-box {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .perfil-name {
        font-size: 2rem;
        font-weight: 900;
        color: var(--abeja-dark);
        margin: 0 0 12px 0;
        line-height: 1.1;
        letter-spacing: -0.5px;
    }

    .perfil-badges {
        display: flex;
        align-items: center;
        gap: 15px;
        color: var(--abeja-text);
        font-weight: 800;
        font-size: 1.05rem;
    }

    .badge-icon { color: var(--abeja-yellow-dark); margin-right: 6px; font-size: 1.2rem; }
    
    .badge-divider {
        width: 2px;
        height: 22px;
        background-color: var(--abeja-gray-medium);
    }

    .perfil-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: flex-end;
        flex-shrink: 0;
    }

    .btn-perfil {
        padding: 8px 20px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: 2px solid;
    }
    .btn-edit { 
        background-color: var(--abeja-white); 
        border-color: var(--abeja-gray-medium); 
        color: var(--abeja-text); 
    }
    .btn-edit:hover { 
        background-color: var(--abeja-gray); 
        border-color: #d1d1d1;
    }
    
    .btn-group-view { 
        background-color: #FFF9E6; /* Amarillo muy claro */
        border-color: #FFE066; 
        color: var(--abeja-yellow-dark); 
    }
    .btn-group-view:hover { 
        background-color: #FFF0B3; 
        transform: translateY(-2px); 
    }

    /* --- TARJETAS DE ESTADÍSTICAS (PC y Móvil) --- */
    .stat-card {
        background-color: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        border-radius: 24px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        cursor: default; /* Removido el pointer por no ser interactivo */
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    }

    .stat-icon-box {
        width: 65px;
        height: 65px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        flex-shrink: 0;
    }
    
    /* Colores pastel/claros para los iconos de las tarjetas */
    .icon-orange { background-color: #FFF0E5; color: var(--abeja-orange); }
    .icon-yellow { background-color: #FFF9E6; color: var(--abeja-yellow-dark); }
    .icon-blue { background-color: #EBF5FB; color: #5DADE2; }
    .icon-green { background-color: #E9F7EF; color: #48C9B0; }

    .stat-divider {
        width: 2px;
        height: 55px;
        background-color: var(--abeja-gray-medium);
    }

    .stat-text-box { display: flex; flex-direction: column; justify-content: center; }
    
    .stat-label {
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--abeja-text);
        opacity: 0.85;
        margin-bottom: 4px;
    }
    
    .stat-value {
        font-size: 1.6rem;
        font-weight: 900;
        line-height: 1;
        color: var(--abeja-dark);
    }

    /* --- ENCABEZADOS DE SECCIÓN --- */
    .section-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 45px 0 20px 0;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--abeja-gray);
    }
    .section-title {
        font-size: 1.4rem;
        font-weight: 900;
        color: var(--abeja-dark);
        margin: 0;
    }
    .btn-view-more {
        background: none;
        border: none;
        color: var(--abeja-text);
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        transition: color 0.2s;
    }
    .btn-view-more:hover { color: var(--abeja-orange); }

    /* --- INVENTARIO (Hexágonos 3D) --- */
    .inventory-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); /* Más grandes en PC */
        gap: 40px; /* Más separados en PC */
        margin-top: 30px;
    }

    .item-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .item-hex-container {
        width: 130px; /* Incrementado tamaño base */
        height: 145px;
        position: relative;
        margin-bottom: 20px;
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .item-card:hover .item-hex-container { transform: translateY(-8px); }

    .item-hex {
        width: 100%;
        height: 100%;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 4rem;
        position: relative;
        z-index: 2;
    }

    /* Colores claros/pastel por rareza con drop-shadow sutil */
    .rareza-legendario .item-hex-container { filter: drop-shadow(0 8px 0px #FFE066); }
    .rareza-legendario .item-hex { background-color: #FFF9E6; }
    .rareza-legendario .item-rarity { color: var(--abeja-yellow-dark); }

    .rareza-epico .item-hex-container { filter: drop-shadow(0 8px 0px #D2B4DE); }
    .rareza-epico .item-hex { background-color: #F5EEF8; }
    .rareza-epico .item-rarity { color: #A569BD; }

    .rareza-raro .item-hex-container { filter: drop-shadow(0 8px 0px #AED6F1); }
    .rareza-raro .item-hex { background-color: #EBF5FB; }
    .rareza-raro .item-rarity { color: #5DADE2; }

    .rareza-comun .item-hex-container { filter: drop-shadow(0 8px 0px #D5D8DC); }
    .rareza-comun .item-hex { background-color: #F2F3F4; }
    .rareza-comun .item-rarity { color: #839192; }

    /* Estilos para objetos no obtenidos/bloqueados */
    .rareza-bloqueado .item-hex-container { filter: drop-shadow(0 8px 0px var(--abeja-gray-medium)); }
    .rareza-bloqueado .item-hex { background-color: var(--abeja-white); }
    .rareza-bloqueado .item-hex i { font-size: 2.5rem; color: var(--abeja-gray-medium); }
    .rareza-bloqueado .item-name, .rareza-bloqueado .item-rarity { color: var(--abeja-gray-medium); }

    .item-rarity {
        font-size: 0.85rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 6px;
    }
    
    .item-name {
        font-size: 1.1rem;
        font-weight: 900;
        color: var(--abeja-dark);
        line-height: 1.2;
    }

    /* =========================================
       RESPONSIVE DESIGN (Móvil / Tablet)
       ========================================= */
    @media (max-width: 991px) {
        .perfil-header {
            flex-direction: column;
            text-align: center;
            gap: 20px;
            margin-bottom: 30px;
            margin-top: 20px; /* Compensa la falta del título */
        }

        .hex-avatar {
            width: 180px;
            height: 180px;
        }

        .perfil-main-divider {
            width: 60%;
            height: 2px;
            margin: 5px 0;
        }

        .perfil-badges {
            flex-direction: column;
            gap: 10px;
        }

        .badge-divider { display: none; }

        .perfil-actions {
            flex-direction: row;
            justify-content: center;
            width: 100%;
            margin-top: 15px;
        }

        .btn-perfil { flex: 1; justify-content: center; }

        /* Inventario Gigante en Móvil (1 por fila) */
        .inventory-grid {
            grid-template-columns: 1fr;
            gap: 25px;
        }

        .item-card {
            background-color: var(--abeja-white);
            border: 2px solid var(--abeja-gray-medium);
            border-radius: 24px;
            padding: 35px 20px;
            flex-direction: column;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .item-hex-container {
            width: 150px;
            height: 170px;
            margin-bottom: 25px;
        }

        .item-hex { font-size: 5rem; }
        .item-name { font-size: 1.4rem; }
        .item-rarity { font-size: 1rem; }
    }
</style>

<div class="perfil-header fade-in-section">
    <div class="hex-avatar-wrapper">
        <img src="https://wallpapers.com/images/hd/xbox-360-profile-pictures-e2bpy4ip6cmbx6cr.jpg" alt="Axel" class="hex-avatar">
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