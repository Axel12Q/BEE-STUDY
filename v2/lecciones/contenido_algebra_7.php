<style>
    /* =======================================================
       ESTILOS PREMIUM PARA ÁLGEBRA 7 (Suma y Resta Pro)
       ======================================================= */
    
    .math-highlight {
        background-color: var(--primary-blue-light);
        color: var(--primary-blue-dark);
        border: 2px solid var(--primary-blue);
        padding: 8px 20px;
        border-radius: 16px;
        font-weight: 900;
        font-size: 1.15rem;
        box-shadow: 0 4px 0 rgba(52, 152, 219, 0.2);
        display: inline-block;
        transition: transform 0.2s;
    }

    .math-formula {
        font-family: 'Nunito', sans-serif;
        font-size: 1.8rem;
        letter-spacing: 1px;
        font-weight: 900;
    }

    .info-box-clean {
        background: var(--abeja-white);
        border-radius: 20px;
        padding: 20px;
        border: 2px solid var(--abeja-gray-medium);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        text-align: left;
        margin-bottom: 15px;
    }

    /* Contenedor de términos para visualizar la agrupación */
    .term-group-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin: 20px 0;
    }

    .term-bubble {
        padding: 10px 15px;
        border-radius: 12px;
        font-weight: 900;
        border: 2px solid;
        background: white;
    }
    .term-x { border-color: var(--primary-blue); color: var(--primary-blue-dark); }
    .term-y { border-color: var(--pastel-purple); color: var(--pastel-purple-dark); }
    .term-num { border-color: var(--abeja-gray-dark); color: var(--abeja-dark); }

    /* Estabilizador visual para Quizzes */
    .option-card {
        box-sizing: border-box !important;
        transform: translateZ(0); 
        backface-visibility: hidden;
        -webkit-font-smoothing: antialiased;
    }

    /* Bloque de advertencia (El porqué) */
    .logic-warning {
        background: #FFF5F5;
        border-left: 5px solid var(--pastel-red-dark);
        padding: 15px;
        border-radius: 0 15px 15px 0;
        margin: 15px 0;
        text-align: left;
    }

    @media (max-width: 768px) {
        .math-formula { font-size: 1.4rem; }
        .info-box-clean { padding: 15px; }
    }
</style>

<div class="step-container" id="step-0">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-yellow" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-cube"></i> La Base</div>
        <h1 class="lesson-title mt-2">¿Qué es un Monomio?</h1>
        
        <div class="info-box-clean">
            <p class="fs-5 text-muted fw-bold mb-0">Un <strong>Monomio</strong> es un solo término (un solo bloque). Para poder sumarlos o restarlos, deben ser "almas gemelas": misma letra y mismo exponente.</p>
        </div>

        <div class="math-visual-row mt-4">
            <div class="math-highlight" style="background: white;">Ejemplo: <span class="text-primary">4x²</span></div>
        </div>
        
        <p class="fs-6 fw-bold text-muted mt-3">Si intentas sumar <span class="text-primary">4x²</span> con <span class="text-danger">4x³</span>, ¡es imposible! Son de familias diferentes debido al exponente.</p>
    </div>
    <div class="feedback-area" id="feedback-0"></div>
</div>

<div class="step-container" id="step-1">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-blue" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-circle-question"></i> ¿Por qué?</div>
        <h1 class="lesson-title mt-2">¿Por qué el exponente no cambia?</h1>
        
        <div class="info-box-clean" style="border-color: var(--primary-blue);">
            <p class="fs-5 text-muted fw-bold mb-0">Un error muy común es sumar los exponentes: <span class="text-danger">x² + x² = x⁴</span> ❌ <strong>¡ERROR!</strong></p>
        </div>

        <div class="logic-warning">
            <h5 class="fw-bold text-danger">Lógica de Abeja:</h5>
            <p class="mb-0 fw-bold text-muted">Si tienes <span class="text-dark">2 cubetas</span> de miel y te dan otras <span class="text-dark">3 cubetas</span>, ahora tienes <span class="text-dark">5 cubetas</span>. ¡Las cubetas no se transformaron en barriles! Siguen siendo cubetas.</p>
        </div>

        <div class="bg-white rounded-4 border p-3 shadow-sm text-center">
            <span class="math-formula">2x² + 3x² = 5x²</span><br>
            <span class="badge bg-success mt-2">El exponente se queda igual</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-1"></div>
</div>

<div class="step-container" id="step-2" data-error="Fíjate bien: los coeficientes se restan (10 - 7), pero la parte literal (a³b) debe quedar exactamente igual.">
    <h1 class="lesson-title">Resuelve la resta de monomios: <br><span class="math-formula text-primary">10a³b - 7a³b</span></h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="false"><span class="math-formula">3</span></div>
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="true" data-success="¡Perfecto! Restaste los números y conservaste la familia (a³b) intacta."><span class="math-formula">3a³b</span></div>
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="false"><span class="math-formula">3a⁶b²</span></div>
    </div>
    <div class="feedback-area" id="feedback-2"></div>
</div>

<div class="step-container" id="step-3">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-green" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-boxes-stacked"></i> Polinomios</div>
        <h1 class="lesson-title mt-2">Agrupar para Ganar</h1>
        
        <div class="info-box-clean" style="border-color: var(--pastel-green-dark);">
            <p class="fs-5 text-muted fw-bold mb-0">Un <strong>Polinomio</strong> es una cadena de muchos monomios. Para sumarlos, simplemente buscamos parejas semejantes y las unimos.</p>
        </div>

        <div class="term-group-container">
            <div class="term-bubble term-x">5x</div>
            <div class="term-bubble term-y">+ 2y</div>
            <div class="term-bubble term-x">+ 3x</div>
            <div class="term-bubble term-y">+ y</div>
        </div>

        <div class="bg-white rounded-4 border p-3 shadow-sm text-start">
            <p class="fw-bold text-muted mb-0"><i class="fa-solid fa-arrow-right text-success me-2"></i> Paso 1: Junta las x → <span class="text-primary">5x + 3x = 8x</span></p>
            <p class="fw-bold text-muted mb-0"><i class="fa-solid fa-arrow-right text-success me-2"></i> Paso 2: Junta las y → <span class="text-purple">2y + y = 3y</span></p>
        </div>
    </div>
    <div class="feedback-area" id="feedback-3"></div>
</div>

<div class="step-container" id="step-4" data-error="Busca los términos que tienen 'm' y súmalos (4m + 2m). Luego busca los números solos (3 + 5).">
    <h1 class="lesson-title">Reduce el polinomio: <br><span class="math-formula text-primary">4m + 3 + 2m + 5</span></h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="false"><span class="math-formula">6m + 15</span></div>
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="false"><span class="math-formula">14m</span></div>
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="true" data-success="¡Excelente! 4m+2m son 6m, y 3+5 son 8. ¡No se pueden mezclar!">
            <span class="math-formula">6m + 8</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-4"></div>
</div>

<div class="step-container" id="step-5">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-purple" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-triangle-exclamation"></i> ¡Cuidado!</div>
        <h1 class="lesson-title mt-2">La Trampa del Signo Menos</h1>
        
        <div class="info-box-clean" style="border-color: var(--pastel-purple-dark);">
            <p class="fs-5 text-muted fw-bold mb-0">Cuando restas un polinomio completo, el signo <strong class="text-danger">menos (-)</strong> afuera del paréntesis funciona como una "abeja rebelde": ¡le cambia el signo a <strong>TODO</strong> lo que está adentro!</p>
        </div>

        <div class="bg-white rounded-4 border p-4 shadow-sm text-center">
            <span class="math-formula">-( 3x + 5 )</span><br>
            <i class="fa-solid fa-shuffle text-danger my-2 fs-3"></i><br>
            <span class="math-formula text-danger">-3x - 5</span>
        </div>
        <p class="text-muted fw-bold mt-2 fs-6">El 3x era positivo y se volvió negativo. El 5 era positivo y también cambió.</p>
    </div>
    <div class="feedback-area" id="feedback-5"></div>
</div>

<div class="step-container" id="step-6" data-error="Recuerda que el signo menos multiplica a ambos. -(+2a) se vuelve -2a, y -(-4) se vuelve +4.">
    <h1 class="lesson-title">¿Cuál es el resultado de eliminar el paréntesis en: <br><span class="math-formula text-primary">-(2a - 4)</span>?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 6)" data-correct="false"><span class="math-formula">-2a - 4</span></div>
        <div class="option-card" onclick="selectOption(this, 6)" data-correct="true" data-success="¡Brillante! Menos por más es menos, y menos por menos es más."><span class="math-formula">-2a + 4</span></div>
        <div class="option-card" onclick="selectOption(this, 6)" data-correct="false"><span class="math-formula">2a + 4</span></div>
    </div>
    <div class="feedback-area" id="feedback-6"></div>
</div>

<div class="step-container" id="step-7" data-error="Paso 1: x² + 4x² = 5x². Paso 2: 3x - x = 2x. Paso 3: une los resultados.">
    <h1 class="lesson-title">Reto Maestro: Reduce esta expresión completa</h1>
    
    <div class="p-4 bg-white rounded-4 border shadow-sm text-center mb-4">
        <span class="math-formula text-dark">(x² + 3x) + (4x² - x)</span>
    </div>

    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">5x⁴ + 2x²</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="true" data-success="¡ERES UNA LEYENDA DEL ÁLGEBRA! Sumaste las x² correctamente y restaste las x sin confundirte.">
            <span class="math-formula">5x² + 2x</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">7x³</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">5x² + 4x</span></div>
    </div>
    <div class="feedback-area" id="feedback-7"></div>
</div>

<div class="step-container" id="step-8">
    <img src="webp_animations/1.webp" onerror="this.src='https://cdn3d.iconscout.com/3d/premium/thumb/trophy-4990924-4159588.png'" alt="Victoria" class="success-illustration">
    <h1 class="lesson-title text-center" style="color: var(--primary-yellow-dark); font-size: 2.5rem;">¡Nivel 7 Dominado!</h1>
    <p class="text-center fw-bold text-muted fs-4">Has perfeccionado el arte de sumar y restar polinomios. ¡Tu panal es más fuerte ahora!</p>

    <div class="stats-grid">
        <div class="stat-box">
            <h4>Miel Ganada</h4>
            <span>+40 <i class="fa-solid fa-droplet" style="color: var(--primary-yellow-dark);"></i></span>
        </div>
        <div class="stat-box">
            <h4>Precisión</h4>
            <span id="final-accuracy">100%</span>
        </div>
    </div>
</div>

<div class="step-container" id="step-game-over">
    <img src="https://cdn3d.iconscout.com/3d/premium/thumb/sad-face-5187768-4328574.png" alt="Derrota" class="success-illustration" style="filter: grayscale(0.2) drop-shadow(0 15px 25px rgba(231,76,60, 0.4)); animation: float 4s ease-in-out infinite;">
    <h1 class="lesson-title text-center" style="color: var(--pastel-red-dark); font-size: 2.5rem;">¡Sin miel en el tanque!</h1>
    <p class="text-center fw-bold text-muted fs-4">La reducción de términos puede ser confusa al principio. ¡Tómate un respiro y vuelve!</p>

    <div class="stats-grid">
        <div class="stat-box fail-box">
            <h4>Consuelo</h4>
            <span id="game-over-honey">+0 <i class="fa-solid fa-droplet"></i></span>
        </div>
        <div class="stat-box fail-box">
            <h4>Precisión</h4>
            <span id="game-over-acc">0%</span>
        </div>
    </div>
</div>

<script>
    // Configuración de pasos para el motor de curso.php
    window.lessonSteps = [
        { type: "Monomios", isQuiz: false },    // 0
        { type: "Lógica", isQuiz: false },      // 1
        { type: "Quiz", isQuiz: true },         // 2
        { type: "Polinomios", isQuiz: false },  // 3
        { type: "Quiz", isQuiz: true },         // 4
        { type: "Signos", isQuiz: false },      // 5
        { type: "Quiz", isQuiz: true },         // 6
        { type: "Reto", isQuiz: true },         // 7
        { type: "Final", isQuiz: false }        // 8
    ];
</script>