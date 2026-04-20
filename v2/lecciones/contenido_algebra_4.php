<style>
    /* =======================================================
       ESTILOS PREMIUM PARA ÁLGEBRA 4 (Fracciones/Racionales)
       ======================================================= */
    
    /* Cajas de resaltado matemático generales */
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

    /* Construcción visual de FRACCIONES verticales */
    .math-fraction {
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        vertical-align: middle;
        margin: 0 8px;
        font-family: 'Nunito', sans-serif;
        font-weight: 900;
        line-height: 1.1;
        /* Estabilizador visual para evitar saltos */
        transform: translateZ(0);
        backface-visibility: hidden;
        -webkit-font-smoothing: antialiased;
    }
    .math-fraction .num {
        padding: 2px 8px;
        border-bottom: 3px solid var(--abeja-dark);
    }
    .math-fraction .den {
        padding: 2px 8px;
    }
    /* Colores para hacer énfasis en reglas */
    .math-fraction.text-primary .num { border-bottom-color: var(--primary-blue-dark); }
    .math-fraction.text-success .num { border-bottom-color: var(--pastel-green-dark); }
    .math-fraction.text-danger .num { border-bottom-color: var(--pastel-red-dark); }
    .math-fraction.text-warning .num { border-bottom-color: var(--secondary-orange-dark); }

    /* Símbolos matemáticos grandes */
    .math-sign {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--abeja-text-muted);
        margin: 0 5px;
        vertical-align: middle;
    }

    /* Contenedor flexible para alinear las fórmulas visuales */
    .math-visual-row {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 5px;
        font-size: 1.8rem;
        margin: 15px 0;
    }

    /* Animación de la Mariposa */
    .butterfly-emoji {
        font-size: 3rem;
        display: inline-block;
        filter: drop-shadow(0 5px 10px rgba(0,0,0,0.15));
        animation: flyButterfly 3s ease-in-out infinite;
    }

    @keyframes flyButterfly {
        0%, 100% { transform: translateY(0) rotate(-5deg) scale(1); }
        50% { transform: translateY(-10px) rotate(5deg) scale(1.1); }
    }

    /* Cajas explicativas */
    .info-box-clean {
        background: var(--abeja-white);
        border-radius: 20px;
        padding: 20px;
        border: 2px solid var(--abeja-gray-medium);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        text-align: left;
        margin-bottom: 15px;
    }

    /* 🐛 FIX: Evitar salto u oscilación horizontal al hacer clic en opciones */
    .option-card {
        box-sizing: border-box !important;
        transform: translateZ(0); 
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        transform-style: preserve-3d;
        -webkit-font-smoothing: antialiased;
        will-change: transform, border-width;
    }

    /* --- RESPONSIVE PARA MÓVILES --- */
    @media (max-width: 768px) {
        .math-fraction { font-size: 1.3rem; margin: 0 5px; }
        .math-sign { font-size: 1.4rem; }
        .math-visual-row { font-size: 1.5rem; }
        .info-box-clean { padding: 15px; }
    }
</style>

<div class="step-container" id="step-0">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-yellow" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-pizza-slice"></i> Racional</div>
        <h1 class="lesson-title mt-2">Anatomía de una Fracción</h1>
        
        <div class="info-box-clean">
            <h4 class="fw-bold" style="color: var(--abeja-dark);">¿Qué es un número Racional?</h4>
            <p class="fs-5 text-muted fw-bold mb-0">Es cualquier número que se puede escribir como una <strong>fracción</strong> (un trozo de algo entero). Tiene dos partes clave:</p>
        </div>

        <div class="d-flex justify-content-center align-items-stretch my-4">
            <div class="text-end me-3 d-flex flex-column justify-content-start pt-2">
                <div class="fw-bold fs-5" style="color: var(--primary-blue-dark);">Numerador <i class="fa-solid fa-arrow-right fs-6"></i></div>
                <div class="fw-bold text-muted" style="font-size: 0.85rem;">(Lo que tomas)</div>
            </div>
            
            <div class="math-fraction" style="font-size: 3.5rem; color: var(--abeja-dark);">
                <div class="num" style="border-color: var(--primary-blue); padding: 0 15px;">3</div>
                <div class="den" style="border-color: var(--pastel-green-dark); padding: 0 15px;">8</div>
            </div>

            <div class="text-start ms-3 d-flex flex-column justify-content-end pb-2">
                <div class="fw-bold fs-5" style="color: var(--pastel-green-dark);"><i class="fa-solid fa-arrow-left fs-6"></i> Denominador</div>
                <div class="fw-bold text-muted" style="font-size: 0.85rem;">(Total de partes)</div>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-0"></div>
</div>

<div class="step-container" id="step-1">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-blue" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-xmark"></i>Operación</div>
        <h1 class="lesson-title mt-2">Multiplicación: El Camino Recto</h1>
        
        <div class="info-box-clean" style="border-color: var(--primary-blue);">
            <p class="fs-5 text-muted fw-bold mb-0">A diferencia de la suma, la multiplicación de fracciones es la operación <strong>más fácil del mundo</strong>. Se hace directo, en línea recta:</p>
            <ul class="text-start fs-5 fw-bold text-muted mt-2 mb-0 ps-3">
                <li><span style="color: var(--primary-blue-dark);">Arriba</span> por <span style="color: var(--primary-blue-dark);">Arriba</span>.</li>
                <li><span style="color: var(--pastel-green-dark);">Abajo</span> por <span style="color: var(--pastel-green-dark);">Abajo</span>.</li>
            </ul>
        </div>
        
        <div class="math-visual-row mt-4 px-3 py-4 bg-white rounded-4 shadow-sm border">
            <div class="math-fraction text-primary"><div class="num">2</div><div class="den">3</div></div>
            <span class="math-sign">·</span>
            <div class="math-fraction text-success"><div class="num">4</div><div class="den">5</div></div>
            <span class="math-sign text-dark">=</span>
            <div class="math-fraction text-dark"><div class="num">2 · 4</div><div class="den">3 · 5</div></div>
            <span class="math-sign text-dark">=</span>
            <div class="math-fraction" style="color: var(--secondary-orange-dark);"><div class="num">8</div><div class="den">15</div></div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-1"></div>
</div>

<div class="step-container" id="step-2" 
        data-error="¡Recuerda! Es en línea recta. Multiplica 1 · 3 para el de arriba, y 2 · 4 para el de abajo.">
    <h1 class="lesson-title">Resuelve la siguiente multiplicación:</h1>
    
    <div class="math-visual-row mb-4">
        <div class="math-fraction"><div class="num">1</div><div class="den">2</div></div>
        <span class="math-sign">·</span>
        <div class="math-fraction"><div class="num">3</div><div class="den">4</div></div>
        <span class="math-sign text-primary">=?</span>
    </div>

    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="false">
            <div class="math-fraction"><div class="num">4</div><div class="den">6</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="false">
            <div class="math-fraction"><div class="num">3</div><div class="den">6</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="true" data-success="¡Facilísimo verdad! 1 · 3 es 3, y 2 · 4 es 8.">
            <div class="math-fraction"><div class="num">3</div><div class="den">8</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="false">
            <div class="math-fraction"><div class="num">4</div><div class="den">8</div></div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-2"></div>
</div>

<div class="step-container" id="step-3">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-purple" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-divide"></i>Operación</div>
        <h1 class="lesson-title mt-2">División: El Rebote Cruzado</h1>
        
        <div class="info-box-clean" style="border-color: var(--pastel-purple);">
            <p class="fs-5 text-muted fw-bold mb-0">Aunque haya un signo de división (÷), ¡en realidad <strong>vamos a multiplicar</strong>! Pero lo haremos rebotando en <strong>zigzag (cruzado)</strong>:</p>
        </div>
        
        <div class="math-visual-row mt-4 px-2 py-4 bg-white rounded-4 shadow-sm border">
            <div class="math-fraction text-primary"><div class="num">2</div><div class="den">5</div></div>
            <span class="math-sign text-danger">÷</span>
            <div class="math-fraction text-success"><div class="num">3</div><div class="den">4</div></div>
            <span class="math-sign text-dark">=</span>
            
            <div class="math-fraction text-dark" style="font-size: 1.3rem;">
                <div class="num">2 · 4</div>
                <div class="den">5 · 3</div>
            </div>
            
            <span class="math-sign text-dark">=</span>
            <div class="math-fraction" style="color: var(--pastel-purple-dark);"><div class="num">8</div><div class="den">15</div></div>
        </div>
        <p class="text-muted fw-bold fs-6 mt-2"><i class="fa-solid fa-lightbulb text-warning"></i> Numerador 1 · Denominador 2 = Sube al resultado.</p>
    </div>
    <div class="feedback-area" id="feedback-3"></div>
</div>

<div class="step-container" id="step-4" 
        data-error="Sigue el zigzag. (1 · 5) va arriba. (2 · 4) va abajo.">
    <h1 class="lesson-title">Resuelve esta división usando el rebote cruzado:</h1>
    
    <div class="math-visual-row mb-4">
        <div class="math-fraction"><div class="num">1</div><div class="den">2</div></div>
        <span class="math-sign text-danger">÷</span>
        <div class="math-fraction"><div class="num">4</div><div class="den">5</div></div>
        <span class="math-sign text-purple">=?</span>
    </div>

    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="false">
            <div class="math-fraction"><div class="num">4</div><div class="den">10</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="true" data-success="¡Genial! 1 · 5 sube como 5. 2 · 4 baja como 8.">
            <div class="math-fraction"><div class="num">5</div><div class="den">8</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="false">
            <div class="math-fraction"><div class="num">8</div><div class="den">5</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="false">
            <div class="math-fraction"><div class="num">5</div><div class="den">10</div></div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-4"></div>
</div>

<div class="step-container" id="step-5">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-green" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-plus-minus"></i>Operación</div>
        <h1 class="lesson-title mt-2">Suma de "Clones"</h1>
        
        <div class="info-box-clean" style="border-color: var(--pastel-green);">
            <p class="fs-5 text-muted fw-bold mb-0">Cuando las fracciones tienen el <strong>mismo número abajo</strong> (mismo denominador), todo es paz y tranquilidad. Solo sumas o restas los de arriba, ¡y el de abajo se queda intacto!</p>
        </div>

        <div class="math-visual-row mt-4 px-3 py-4 bg-white rounded-4 shadow-sm border">
            <div class="math-fraction"><div class="num text-primary">3</div><div class="den fw-bold">7</div></div>
            <span class="math-sign text-success">+</span>
            <div class="math-fraction"><div class="num text-primary">2</div><div class="den fw-bold">7</div></div>
            <span class="math-sign">=</span>
            <div class="math-fraction"><div class="num text-primary">3 + 2</div><div class="den fw-bold">7</div></div>
            <span class="math-sign">=</span>
            <div class="math-fraction text-success"><div class="num">5</div><div class="den">7</div></div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-5"></div>
</div>

<div class="step-container" id="step-6" 
        data-error="¡No sumes ni restes los de abajo! Como el denominador es igual, pásalo directo y solo resta los de arriba (8 - 3).">
    <h1 class="lesson-title">Resuelve esta sencilla resta de clones:</h1>
    
    <div class="math-visual-row mb-4">
        <div class="math-fraction"><div class="num">8</div><div class="den">9</div></div>
        <span class="math-sign text-danger">-</span>
        <div class="math-fraction"><div class="num">3</div><div class="den">9</div></div>
        <span class="math-sign text-success">=?</span>
    </div>

    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 6)" data-correct="false">
            <div class="math-fraction"><div class="num">5</div><div class="den">0</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 6)" data-correct="false">
            <div class="math-fraction"><div class="num">11</div><div class="den">9</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 6)" data-correct="true" data-success="¡Perfecto! Mantienes el 9 intacto, y restas 8 - 3 = 5.">
            <div class="math-fraction"><div class="num">5</div><div class="den">9</div></div>
        </div>
        <div class="option-card" onclick="selectOption(this, 6)" data-correct="false">
            <div class="math-fraction"><div class="num">11</div><div class="den">18</div></div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-6"></div>
</div>

<div class="step-container" id="step-7">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-orange" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"></i>Hack</div>
        <h1 class="lesson-title mt-2">El Método de la Mariposa <span class="butterfly-emoji">🦋</span></h1>
        
        <div class="info-box-clean" style="border-color: var(--secondary-orange-dark);">
            <p class="fs-5 text-muted fw-bold mb-0">¿Qué pasa si los números de abajo son distintos? ¡Usamos el método de la Mariposa! Dibuja unas alas multiplicando cruzado, y une la cola multiplicando los de abajo.</p>
        </div>

        <div class="bg-white rounded-4 shadow-sm border p-4 text-center mt-3">
            <div class="math-visual-row mt-0 mb-3">
                <div class="math-fraction"><div class="num text-primary">1</div><div class="den text-success">3</div></div>
                <span class="math-sign">+</span>
                <div class="math-fraction"><div class="num text-danger">2</div><div class="den text-warning">5</div></div>
            </div>
            
            <ul class="text-start fs-5 fw-bold text-muted mb-0 ps-2" style="list-style: none;">
                <li class="mb-2">🦋 <strong>Ala Izquierda:</strong> <span class="text-primary">1</span> · <span class="text-warning">5</span> = <strong class="text-dark">5</strong></li>
                <li class="mb-2">🦋 <strong>Ala Derecha:</strong> <span class="text-success">3</span> · <span class="text-danger">2</span> = <strong class="text-dark">6</strong></li>
                <li class="mb-0">🦋 <strong>Cuerpo (abajo):</strong> <span class="text-success">3</span> · <span class="text-warning">5</span> = <strong class="text-dark">15</strong></li>
            </ul>
        </div>
    </div>
    <div class="feedback-area" id="feedback-7"></div>
</div>

<div class="step-container" id="step-8">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-blue" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-puzzle-piece"></i> Acomodo</div>
        <h1 class="lesson-title mt-2">Armando la Fracción Final</h1>
        
        <div class="info-box-clean" style="border-color: var(--primary-blue);">
            <p class="fs-5 text-muted fw-bold mb-0">¿A dónde van los números que calculamos? Es muy lógico y ordenado:</p>
            <ul class="text-start fs-5 fw-bold text-muted mt-2 mb-0 ps-3">
                <li class="mb-2">Las <strong>Alas</strong> se multiplican cruzado y se suman en el <strong class="text-primary">Numerador (Arriba)</strong>.</li>
                <li>El <strong>Cuerpo</strong> se multiplica en línea y va al <strong class="text-success">Denominador (Abajo)</strong>.</li>
            </ul>
        </div>

        <div class="bg-white rounded-4 shadow-sm border py-4 px-2 text-center mt-3 overflow-auto">
            <div class="math-visual-row m-0 flex-nowrap" style="min-width: max-content;">
                <div class="math-fraction" style="font-size: 1.5rem;">
                    <div class="num"><span class="text-primary">1 · 5</span> + <span class="text-danger">3 · 2</span></div>
                    <div class="den text-success">3 · 5</div>
                </div>
                <span class="math-sign">=</span>
                <div class="math-fraction" style="font-size: 1.5rem;">
                    <div class="num"><span class="text-primary">5</span> + <span class="text-danger">6</span></div>
                    <div class="den text-success">15</div>
                </div>
                <span class="math-sign">=</span>
                <div class="math-fraction text-dark" style="font-size: 1.5rem;">
                    <div class="num">11</div>
                    <div class="den">15</div>
                </div>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-8"></div>
</div>

<div class="step-container" id="step-9"
        data-error="¡Haz las alas de la mariposa! Ala 1 (1 · 4)=4. Ala 2 (3 · 2)=6. Súmalos (4 + 6 = 10) y ponlo ARRIBA. Para el cuerpo multiplica abajo (3 · 4 = 12) y ponlo ABAJO.">
    <h1 class="lesson-title">Reto Final: Usa la mariposa para sumar estas fracciones.</h1>
    
    <div class="math-visual-row mb-4">
        <div class="math-fraction"><div class="num">1</div><div class="den">3</div></div>
        <span class="math-sign">+</span>
        <div class="math-fraction"><div class="num">2</div><div class="den">4</div></div>
        <span class="math-sign text-warning">=?</span>
    </div>

    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">
            <div class="math-fraction"><div class="num">3</div><div class="den">7</div></div>
        </div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">
            <div class="math-fraction"><div class="num">2</div><div class="den">12</div></div>
        </div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="true" 
                data-success="¡ERES BRILLANTE! Ala 1 (4) + Ala 2 (6) = 10 (va arriba). Cuerpo (3 · 4) = 12 (va abajo). ¡10/12 es correcto!">
            <div class="math-fraction"><div class="num">10</div><div class="den">12</div></div>
        </div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">
            <div class="math-fraction"><div class="num">10</div><div class="den">7</div></div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-9"></div>
</div>

<div class="step-container" id="step-10">
    <img src="webp_animations/1.webp" onerror="this.src='https://cdn3d.iconscout.com/3d/premium/thumb/trophy-4990924-4159588.png'" alt="Victoria" class="success-illustration">
    <h1 class="lesson-title text-center" style="color: var(--primary-yellow-dark); font-size: 2.5rem;">¡Lección Dominada!</h1>
    <p class="text-center fw-bold text-muted fs-4">¡Ya puedes sumar, restar, multiplicar y dividir cualquier fracción!</p>

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
    <h1 class="lesson-title text-center" style="color: var(--pastel-red-dark); font-size: 2.5rem;">¡Te quedaste sin vidas!</h1>
    <p class="text-center fw-bold text-muted fs-4">¡No te desanimes! Descansa un poco a tus abejas y vuelve a intentarlo más tarde.</p>

    <div class="stats-grid">
        <div class="stat-box fail-box">
            <h4>Premio de Consuelo</h4>
            <span id="game-over-honey">+0 <i class="fa-solid fa-droplet"></i></span>
        </div>
        <div class="stat-box fail-box">
            <h4>Precisión</h4>
            <span id="game-over-acc">0%</span>
        </div>
    </div>
</div>

<script>
    // Configuración de la lección para el Game Loop (Total: 11 pasos + GameOver independiente)
    window.lessonSteps = [
        { type: "Base", isQuiz: false },        // 0. Intro
        { type: "Multiplicar", isQuiz: false }, // 1. Teo Multiplicar
        { type: "Quiz", isQuiz: true },         // 2. Quiz Mult
        { type: "Dividir", isQuiz: false },     // 3. Teo Dividir
        { type: "Quiz", isQuiz: true },         // 4. Quiz Div
        { type: "Suma Fácil", isQuiz: false },  // 5. Teo Suma Igual Den
        { type: "Quiz", isQuiz: true },         // 6. Quiz Suma Fácil
        { type: "Mariposa 1", isQuiz: false },  // 7. Teo Mariposa (Las partes)
        { type: "Mariposa 2", isQuiz: false },  // 8. Teo Mariposa (El Armado)
        { type: "Reto Final", isQuiz: true },   // 9. Quiz Mariposa Completo
        { type: "Final", isQuiz: false }        // 10. Victoria
    ];
</script>