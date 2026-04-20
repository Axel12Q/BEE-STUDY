<style>
    /* =======================================================
       ESTILOS PREMIUM PARA OPERACIONES ALGEBRAICAS (2.2)
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
    }

    .math-formula {
        font-family: 'Nunito', sans-serif;
        font-size: 1.8rem;
        letter-spacing: 1px;
        font-weight: 900;
    }

    /* Cajas explicativas estilo Abeja GO */
    .info-box-clean {
        background: var(--abeja-white);
        border-radius: 20px;
        padding: 20px;
        border: 2px solid var(--abeja-gray-medium);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        text-align: left;
        margin-bottom: 15px;
    }

    /* Regla de los signos visual */
    .sign-rule-table {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin: 15px 0;
    }
    .sign-item {
        padding: 10px;
        border-radius: 12px;
        font-weight: 900;
        text-align: center;
        border: 2px solid rgba(0,0,0,0.05);
    }

    /* Estabilizador para evitar saltos horizontales en Quizzes */
    .option-card {
        box-sizing: border-box !important;
        transform: translateZ(0); 
        backface-visibility: hidden;
        will-change: transform;
    }

    /* Leyes de exponentes visuales */
    .exponent-rule {
        background: var(--abeja-gray-light);
        border-left: 5px solid var(--primary-blue);
        padding: 15px;
        border-radius: 0 15px 15px 0;
        margin-bottom: 15px;
        text-align: left;
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 768px) {
        .math-formula { font-size: 1.4rem; }
        .info-box-clean { padding: 15px; }
    }
</style>

<div class="step-container" id="step-0">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-yellow" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-layer-group"></i> Nivel 1</div>
        <h1 class="lesson-title mt-2">La Regla de las Manzanas</h1>
        
        <div class="info-box-clean">
            <h4 class="fw-bold" style="color: var(--abeja-dark);">Términos Semejantes</h4>
            <p class="fs-5 text-muted fw-bold mb-0">En álgebra solo puedes sumar o restar cosas que sean <strong>iguales</strong>. <br><br>Puedes sumar <span class="text-primary">3a + 2a</span> (porque ambas son 'a'), pero <strong>NUNCA</strong> puedes sumar <span class="text-danger">3a + 2b</span>.</p>
        </div>

        <div class="p-3 bg-white rounded-4 border shadow-sm mt-3 text-center">
            <span class="math-formula">3🍎 + 2🍎 = 5🍎</span><br>
            <i class="fa-solid fa-check-circle text-success fs-3 my-2"></i><br>
            <span class="math-formula text-muted" style="font-size: 1.2rem;">3x + 2x = 5x</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-0"></div>
</div>

<div class="step-container" id="step-1" data-error="Recuerda: las letras y sus exponentes deben ser EXACTAMENTE iguales para poder sumarse.">
    <h1 class="lesson-title">¿Cuál es el resultado de reducir: <span class="math-formula text-primary">7x² - 3x²</span>?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="false"><span class="math-formula">4</span></div>
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="true" data-success="¡Correcto! Como ambos son x², solo restas los coeficientes (7-3) y dejas la letra igual."><span class="math-formula">4x²</span></div>
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="false"><span class="math-formula">4x⁴</span></div>
    </div>
    <div class="feedback-area" id="feedback-1"></div>
</div>

<div class="step-container" id="step-2">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-blue" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-object-group"></i> Nivel 2</div>
        <h1 class="lesson-title mt-2">Reduciendo Polinomios</h1>
        
        <div class="info-box-clean" style="border-color: var(--primary-blue);">
            <p class="fs-5 text-muted fw-bold mb-0">Cuando tienes muchos términos mezclados, el secreto es <strong>agrupar por familias</strong>: <br><br>🔵 Las 'x' con las 'x'. <br>🟢 Los números solos con los números solos.</p>
        </div>

        <div class="bg-white rounded-4 border p-3 text-center shadow-sm">
            <span class="math-formula"><span class="text-primary">5x</span> + <span class="text-success">3</span> + <span class="text-primary">2x</span> + <span class="text-success">4</span></span><br>
            <i class="fa-solid fa-arrow-down text-muted my-2"></i><br>
            <span class="math-formula"><span class="text-primary">7x</span> + <span class="text-success">7</span></span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-2"></div>
</div>

<div class="step-container" id="step-3" data-error="Agrupa las 'a' por un lado y las 'b' por otro. 10a - 4a = ? y 5b + 2b = ?">
    <h1 class="lesson-title">Reduce el siguiente polinomio: <br><span class="math-formula text-primary">10a + 5b - 4a + 2b</span></h1>
    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false"><span class="math-formula">13ab</span></div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="true" data-success="¡Increíble! 10a-4a=6a y 5b+2b=7b. No se pueden mezclar más."><span class="math-formula">6a + 7b</span></div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false"><span class="math-formula">14a + 7b</span></div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false"><span class="math-formula">6a - 7b</span></div>
    </div>
    <div class="feedback-area" id="feedback-3"></div>
</div>

<div class="step-container" id="step-4">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-green" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-microchip"></i> Nivel 3</div>
        <h1 class="lesson-title mt-2">Leyes de Exponentes 1</h1>
        
        <div class="info-box-clean" style="border-color: var(--pastel-green-dark);">
            <h4 class="fw-bold" style="color: var(--pastel-green-dark);">Regla del Producto</h4>
            <p class="fs-5 text-muted fw-bold mb-0">Cuando multiplicas letras iguales, los exponentes <strong>SE SUMAN</strong>. <br><br> Es como si las letras se unieran para hacerse más fuertes.</p>
        </div>

        <div class="exponent-rule">
            <span class="math-formula">x<sup>a</sup> · x<sup>b</sup> = x<sup>a+b</sup></span>
            <hr>
            <span class="fw-bold text-muted">Ejemplo: <span class="text-dark">x² · x³ = x<sup>2+3</sup> = x⁵</span></span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-4"></div>
</div>

<div class="step-container" id="step-5" data-error="Suma los números pequeñitos (exponentes): 4 + 4 = ?">
    <h1 class="lesson-title">¿Cuánto es <span class="math-formula text-primary">m⁴ · m⁴</span>?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false"><span class="math-formula">m¹⁶</span></div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false"><span class="math-formula">2m⁴</span></div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="true" data-success="¡Exacto! En la multiplicación, los exponentes se suman."><span class="math-formula">m⁸</span></div>
    </div>
    <div class="feedback-area" id="feedback-5"></div>
</div>

<div class="step-container" id="step-6">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-purple" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-divide"></i> Nivel 4</div>
        <h1 class="lesson-title mt-2">Leyes de Exponentes 2</h1>
        
        <div class="info-box-clean" style="border-color: var(--pastel-purple-dark);">
            <h4 class="fw-bold" style="color: var(--pastel-purple-dark);">Regla del Cociente</h4>
            <p class="fs-5 text-muted fw-bold mb-0">Cuando divides letras iguales, los exponentes <strong>SE RESTAN</strong>. <br><br> Es como si los de arriba eliminaran a los de abajo.</p>
        </div>

        <div class="exponent-rule" style="border-color: var(--pastel-purple);">
            <span class="math-formula">x<sup>a</sup> / x<sup>b</sup> = x<sup>a-b</sup></span>
            <hr>
            <span class="fw-bold text-muted">Ejemplo: <span class="text-dark">x⁷ / x³ = x<sup>7-3</sup> = x⁴</span></span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-6"></div>
</div>

<div class="step-container" id="step-7" data-error="Resta los exponentes: 10 - 2 = ?">
    <h1 class="lesson-title">Resuelve: <span class="math-formula text-primary">y¹⁰ / y²</span></h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="true" data-success="¡Perfecto! 10 menos 2 son 8."><span class="math-formula">y⁸</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">y⁵</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">y¹²</span></div>
    </div>
    <div class="feedback-area" id="feedback-7"></div>
</div>

<div class="step-container" id="step-8">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-orange" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-burst"></i> Nivel 5</div>
        <h1 class="lesson-title mt-2">Monomio por Monomio</h1>
        
        <div class="info-box-clean" style="border-color: var(--secondary-orange-dark);">
            <p class="fs-5 text-muted fw-bold mb-0">Para multiplicar términos completos, sigue este orden:<br><br>
            1️⃣ <strong>Signos</strong> (+ por -). <br>
            2️⃣ <strong>Números</strong> (coeficientes). <br>
            3️⃣ <strong>Letras</strong> (sumar sus exponentes).</p>
        </div>

        <div class="p-3 bg-white rounded-4 border shadow-sm text-center">
            <span class="math-formula">(2x³) · (4x²)</span><br>
            <i class="fa-solid fa-arrow-down text-muted my-1"></i><br>
            <span class="math-formula text-success">8x⁵</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-8"></div>
</div>

<div class="step-container" id="step-9" data-error="Multiplica los números (3·5=15) y suma los exponentes de 'a' (2+1=3).">
    <h1 class="lesson-title">Resuelve: <span class="math-formula text-primary">(3a²) · (5a)</span></h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false"><span class="math-formula">8a³</span></div>
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="true" data-success="¡Excelente! 3x5=15 y sumaste los exponentes correctamente (recuerda que 'a' sola tiene un 1 invisible)."><span class="math-formula">15a³</span></div>
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false"><span class="math-formula">15a²</span></div>
    </div>
    <div class="feedback-area" id="feedback-9"></div>
</div>

<div class="step-container" id="step-10">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-dark" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-arrows-to-circle"></i> Nivel 6</div>
        <h1 class="lesson-title mt-2">La Lluvia Algebraica</h1>
        
        <div class="info-box-clean">
            <p class="fs-5 text-muted fw-bold mb-0">Cuando un término multiplica a un paréntesis, <strong>"llueve"</strong> sobre cada uno de los que están adentro. <br><br>Multiplicas el de afuera por el primero, LUEGO el de afuera por el segundo.</p>
        </div>

        <div class="bg-white rounded-4 border p-4 text-center">
            <span class="math-formula text-primary">2x</span><span class="math-formula">(x + 5)</span><br>
            <i class="fa-solid fa-arrow-turn-down text-muted mx-3"></i>
            <i class="fa-solid fa-arrow-turn-down text-muted mx-3" style="transform: scaleX(-1);"></i><br>
            <span class="math-formula">2x² + 10x</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-10"></div>
</div>

<div class="step-container" id="step-11" data-error="Multiplica 3 por 'x' y TAMBIÉN multiplica 3 por '4'.">
    <h1 class="lesson-title">Resuelve: <span class="math-formula text-primary">3(x + 4)</span></h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 11)" data-correct="false"><span class="math-formula">3x + 4</span></div>
        <div class="option-card" onclick="selectOption(this, 11)" data-correct="true" data-success="¡Muy bien! Distribuiste el 3 a ambos términos del paréntesis."><span class="math-formula">3x + 12</span></div>
        <div class="option-card" onclick="selectOption(this, 11)" data-correct="false"><span class="math-formula">7x</span></div>
    </div>
    <div class="feedback-area" id="feedback-11"></div>
</div>

<div class="step-container" id="step-12">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-blue" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-stairs"></i> Nivel 7</div>
        <h1 class="lesson-title mt-2">División Sintética (El Atajo)</h1>
        
        <div class="info-box-clean" style="border-color: var(--primary-blue);">
            <p class="fs-5 text-muted fw-bold mb-0">Dividir polinomios largos puede ser difícil, pero existe la <strong>Regla de Ruffini (Sintética)</strong>. <br><br>Solo usamos los <strong>números (coeficientes)</strong> y bajamos, multiplicamos y sumamos. ¡Es mucho más rápido!</p>
        </div>

        <div class="bg-white rounded-4 border p-3 text-start shadow-sm">
            <p class="fw-bold text-muted mb-1">Para dividir <span class="text-dark">x² + 5x + 6</span> entre <span class="text-dark">x + 2</span>:</p>
            <div class="d-flex gap-3 align-items-center justify-content-center mt-3">
                 <div style="border-right: 2px solid #ccc; padding-right: 15px; font-weight: 900;">-2</div>
                 <div class="math-formula" style="font-size: 1.2rem;">1 &nbsp;&nbsp; 5 &nbsp;&nbsp; 6</div>
            </div>
            <p class="text-center text-muted mt-2" style="font-size: 0.8rem;">(Se usan solo los coeficientes para operar)</p>
        </div>
    </div>
    <div class="feedback-area" id="feedback-12"></div>
</div>

<div class="step-container" id="step-13" data-error="En la división, los exponentes se restan. 2-1 = 1 para la x, y 1-1=0 para la y (la y desaparece).">
    <h1 class="lesson-title">Reto de División: <br><span class="math-formula text-primary">10x²y / 2xy</span></h1>
    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 13)" data-correct="false"><span class="math-formula">5xy</span></div>
        <div class="option-card" onclick="selectOption(this, 13)" data-correct="true" data-success="¡Genio! 10/2=5, restaste exponentes de x (2-1=1) y la y se canceló (1-1=0)."><span class="math-formula">5x</span></div>
        <div class="option-card" onclick="selectOption(this, 13)" data-correct="false"><span class="math-formula">8x</span></div>
        <div class="option-card" onclick="selectOption(this, 13)" data-correct="false"><span class="math-formula">5x²</span></div>
    </div>
    <div class="feedback-area" id="feedback-13"></div>
</div>

<div class="step-container" id="step-14">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-yellow" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-trophy"></i> Resumen</div>
        <h1 class="lesson-title mt-2">¡Lo lograste!</h1>
        
        <div class="row g-2">
            <div class="col-6"><div class="p-3 bg-white rounded-4 border fw-bold" style="font-size: 0.8rem;">➕ <strong>Suma/Resta:</strong> Solo iguales. Exponentes NO cambian.</div></div>
            <div class="col-6"><div class="p-3 bg-white rounded-4 border fw-bold" style="font-size: 0.8rem;">✖️ <strong>Multiplicar:</strong> Sumas exponentes.</div></div>
            <div class="col-6"><div class="p-3 bg-white rounded-4 border fw-bold" style="font-size: 0.8rem;">➗ <strong>Dividir:</strong> Restas exponentes.</div></div>
            <div class="col-6"><div class="p-3 bg-white rounded-4 border fw-bold" style="font-size: 0.8rem;">🚀 <strong>Sintética:</strong> El atajo con solo números.</div></div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-14"></div>
</div>

<div class="step-container" id="step-15">
    <img src="webp_animations/1.webp" onerror="this.src='https://cdn3d.iconscout.com/3d/premium/thumb/trophy-4990924-4159588.png'" alt="Victoria" class="success-illustration">
    <h1 class="lesson-title text-center" style="color: var(--primary-yellow-dark); font-size: 2.5rem;">¡Nivel Completado!</h1>
    <p class="text-center fw-bold text-muted fs-4">Has dominado las operaciones algebraicas fundamentales. ¡Eres una abeja maestra!</p>

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
    <h1 class="lesson-title text-center" style="color: var(--pastel-red-dark); font-size: 2.5rem;">¡Sin energía!</h1>
    <p class="text-center fw-bold text-muted fs-4">Las operaciones algebraicas requieren práctica. ¡Vuelve pronto al enjambre!</p>

    <div class="stats-grid">
        <div class="stat-box fail-box">
            <h4>Miel Recogida</h4>
            <span id="game-over-honey">+0 <i class="fa-solid fa-droplet"></i></span>
        </div>
        <div class="stat-box fail-box">
            <h4>Precisión</h4>
            <span id="game-over-acc">0%</span>
        </div>
    </div>
</div>

<script>
    window.lessonSteps = [
        { type: "Semejantes", isQuiz: false }, // 0
        { type: "Quiz", isQuiz: true },        // 1
        { type: "Reducción", isQuiz: false },  // 2
        { type: "Quiz", isQuiz: true },        // 3
        { type: "Exp 1", isQuiz: false },      // 4
        { type: "Quiz", isQuiz: true },        // 5
        { type: "Exp 2", isQuiz: false },      // 6
        { type: "Quiz", isQuiz: true },        // 7
        { type: "Monomios", isQuiz: false },   // 8
        { type: "Quiz", isQuiz: true },        // 9
        { type: "Distributiva", isQuiz: false },// 10
        { type: "Quiz", isQuiz: true },        // 11
        { type: "Sintética", isQuiz: false },  // 12
        { type: "Reto", isQuiz: true },         // 13
        { type: "Resumen", isQuiz: false },    // 14
        { type: "Final", isQuiz: false }       // 15
    ];
</script>