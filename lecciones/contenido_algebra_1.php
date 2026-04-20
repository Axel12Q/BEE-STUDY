<style>
    /* Fila de Abejitas (Paso 0) */
    .visual-row { display: flex; justify-content: center; align-items: center; gap: 15px; margin: 20px 0; flex-wrap: wrap; }
    .visual-item { text-align: center; font-size: 3.5rem; filter: drop-shadow(0 5px 10px rgba(0,0,0,0.1)); animation: float 3s ease-in-out infinite; }
    .visual-item.delay { animation-delay: 1.5s; }
    
    /* Recta Numérica (Paso 2) */
    .number-line-wrapper { margin: 40px 0 20px 0; position: relative; width: 100%; height: 60px; }
    .number-line { position: absolute; top: 50%; left: 5%; right: 5%; height: 6px; background: var(--abeja-gray-dark); transform: translateY(-50%); border-radius: 3px;}
    .nl-tick { position: absolute; top: 50%; width: 6px; height: 24px; background: var(--abeja-gray-dark); transform: translate(-50%, -50%); border-radius: 3px; }
    .nl-tick.highlight { background: var(--pastel-red-dark); height: 34px; z-index: 2; box-shadow: 0 0 10px rgba(231,76,60,0.4); }
    .nl-label { position: absolute; top: 30px; left: 50%; transform: translateX(-50%); font-weight: 900; font-size: 1.3rem; color: var(--abeja-text-muted); }
    .nl-tick.highlight .nl-label { color: var(--pastel-red-dark); font-size: 1.5rem; }

    /* Hexágono Partido a la Mitad (Paso 4) */
    .split-hex-container { display: flex; justify-content: center; gap: 4px; margin: 30px 0 20px 0; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1)); }
    .hex-part-left, .hex-part-right { width: 45px; height: 100px; }
    .hex-part-left { background: var(--primary-yellow-dark); clip-path: polygon(100% 0, 100% 100%, 0 75%, 0 25%); display: flex; align-items: center; justify-content: flex-end; padding-right: 5px; }
    .hex-part-right { background: var(--abeja-white); clip-path: polygon(0 0, 0 100%, 100% 75%, 100% 25%); border-right: 3px solid var(--abeja-gray-medium); }
    .hex-part-left::after { content: '½'; font-size: 1.5rem; font-weight: 900; color: white; }
</style>

<div class="step-container" id="step-0">
    <div class="theory-box">
        <div class="set-badge badge-yellow">Naturales (N)</div>
        <h1 class="lesson-title mt-4">Los primeros números de la historia</h1>
        <p class="fs-5 text-muted fw-bold">Los seres humanos (y las abejas) inventamos los números <strong>Naturales (1, 2, 3...)</strong> con un solo propósito: ¡Contar cosas reales!</p>
        
        <div class="visual-row">
            <div class="visual-item">🐝</div>
            <div class="visual-item delay">🐝</div>
            <div class="visual-item">🐝</div>
        </div>
        <p class="fs-4 fw-bold text-dark mt-2"><span class="math-nowrap">= 3 Abejas</span></p>
    </div>
    <div class="feedback-area" id="feedback-0"></div>
</div>

<div class="step-container" id="step-1" 
        data-error="¡Cuidado! Los números negativos o fraccionarios no sirven para contar abejas vivas.">
    <h1 class="lesson-title">Si ves un enjambre y quieres contar cuántas abejas hay, ¿qué conjunto numérico usas?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="false"><span class="math-nowrap">-5, -4, -3...</span> (Negativos)</div>
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="true" data-success="¡Exacto! Son cosas que puedes ver y contar con los dedos."><span class="math-nowrap">1, 2, 3, 4...</span> (Naturales)</div>
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="false"><span class="math-nowrap">0.5, 1.5, 2.5...</span> (Decimales)</div>
    </div>
    <div class="feedback-area" id="feedback-1"></div>
</div>

<div class="step-container" id="step-2">
    <div class="theory-box" style="border-color: var(--pastel-red-dark);">
        <div class="set-badge badge-dark" style="background-color: var(--pastel-red-dark) !important; color: white !important;">Enteros (Z)</div>
        <h1 class="lesson-title mt-4">¿Y si no hay nada... o debemos miel?</h1>
        <p class="fs-5 text-muted fw-bold">Los Naturales no nos alcanzan si nos quedamos sin miel (Cero) o si pedimos prestado (Negativos). Así nacen los <strong>Enteros (Z)</strong>.</p>
        
        <div class="number-line-wrapper">
            <div class="number-line"></div>
            <div class="nl-tick highlight" style="left: 20%;"><span class="nl-label">-2</span></div>
            <div class="nl-tick" style="left: 40%;"><span class="nl-label">-1</span></div>
            <div class="nl-tick" style="left: 60%;"><span class="nl-label">0</span></div>
            <div class="nl-tick" style="left: 80%;"><span class="nl-label">1</span></div>
        </div>
        <p class="fs-6 fw-bold text-muted mt-4"><i class="fa-solid fa-droplet-slash text-danger"></i> -2 significa "Debo dos frascos".</p>
    </div>
    <div class="feedback-area" id="feedback-2"></div>
</div>

<div class="step-container" id="step-3"
        data-error="¡Casi! Recuerda que los Naturales empiezan desde el 1. El cero nos dice que el frasco está vacío.">
    <h1 class="lesson-title">Si tienes un frasco de miel completamente vacío, ¿con qué número lo representas y a qué conjunto pertenece?</h1>
    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false">1, Naturales</div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="true" data-success="¡Perfecto! El Cero es parte fundamental de los Enteros (Z).">0, Enteros</div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false">-1, Naturales</div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false">0, Naturales</div>
    </div>
    <div class="feedback-area" id="feedback-3"></div>
</div>

<div class="step-container" id="step-4">
    <div class="theory-box blue">
        <div class="set-badge badge-blue">Racionales (Q)</div>
        <h1 class="lesson-title mt-4">Partiendo el Panal</h1>
        <p class="fs-5 text-muted fw-bold">A veces no tenemos cosas enteras. Si partimos un panal, tenemos fracciones. Los <strong>Racionales (Q)</strong> son números que se pueden escribir como división (Ej: 1/2).</p>
        
        <div class="split-hex-container">
            <div class="hex-part-left"></div>
            <div class="hex-part-right"></div>
        </div>

        <p class="fs-3 fw-bold text-primary mt-2"><span class="math-nowrap">1 / 2</span> <span class="text-muted fs-5 mx-2">ó</span> <span class="math-nowrap">0.5</span></p>
        <p class="fs-6 fw-bold text-muted mt-2"><i class="fa-solid fa-lightbulb text-warning"></i> Tip: Un entero como el 3 también es racional porque es igual a 3/1.</p>
    </div>
    <div class="feedback-area" id="feedback-4"></div>
</div>

<div class="step-container" id="step-5"
        data-error="Analiza bien. Busca el número que esté expresado claramente como una fracción entre dos enteros.">
    <h1 class="lesson-title">De las siguientes opciones, ¿cuál es un número Racional (Q) pero NO es Entero (Z)?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false">5</div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="true" data-success="¡Exacto! -3/4 es una fracción, por lo tanto pertenece a los Racionales (Q)."><span class="math-nowrap">-3 / 4</span></div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false">0</div>
    </div>
    <div class="feedback-area" id="feedback-5"></div>
</div>

<div class="step-container" id="step-6">
    <div class="theory-box purple">
        <div class="set-badge badge-purple">Irracionales (I) y Reales (R)</div>
        <h1 class="lesson-title mt-4">Los números infinitos y la Gran Caja</h1>
        <p class="fs-5 text-muted fw-bold text-start">
            🐝 <strong>Irracionales (I):</strong> Tienen decimales infinitos que jamás se repiten y NO se pueden hacer fracción. (Ej: <strong style="color:var(--pastel-purple-dark);" class="math-nowrap">π = 3.14159...</strong>).<br><br>
            📦 <strong>Los Reales (R):</strong> Es el conjunto supremo. Si metes a los Naturales, Enteros, Racionales e Irracionales en una gran caja, ¡obtienes a los Reales!
        </p>
    </div>
    <div class="feedback-area" id="feedback-6"></div>
</div>

<div class="step-container" id="step-7"
        data-error="¡Piensa en grande! Si es un Entero, automáticamente está dentro de las cajas más grandes.">
    <h1 class="lesson-title">El número <strong class="text-primary">"-5"</strong> a qué conjuntos pertenece simultáneamente:</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false">Solo a los Naturales</div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false">A los Irracionales y Naturales</div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="true" data-success="¡Magnífico! El -5 es un Entero, también se puede escribir como fracción (-5/1) así que es Racional, y como todo lo que hemos visto, es un número Real.">A los Enteros (Z), Racionales (Q) y Reales (R)</div>
    </div>
    <div class="feedback-area" id="feedback-7"></div>
</div>

<div class="step-container" id="step-8">
    <img src="webp_animations/1.webp" onerror="this.src='https://cdn3d.iconscout.com/3d/premium/thumb/trophy-4990924-4159588.png'" alt="Victoria" class="success-illustration">
    <h1 class="lesson-title text-center" style="color: var(--primary-yellow-dark); font-size: 2.5rem;">¡Lección Dominada!</h1>
    <p class="text-center fw-bold text-muted fs-4">Conoces la colmena matemática a la perfección.</p>

    <div class="stats-grid">
        <div class="stat-box">
            <h4>Miel Ganada</h4>
            <span>+30 <i class="fa-solid fa-droplet" style="color: var(--primary-yellow-dark);"></i></span>
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
    // Se sobreescribe la variable global del cascarón con la configuración de esta lección
    window.lessonSteps = [
        { type: "Teoría N", isQuiz: false },    // 0
        { type: "Quiz N", isQuiz: true },       // 1
        { type: "Teoría Z", isQuiz: false },    // 2
        { type: "Quiz Z", isQuiz: true },       // 3
        { type: "Teoría Q", isQuiz: false },    // 4
        { type: "Quiz Q", isQuiz: true },       // 5
        { type: "Teoría R", isQuiz: false },    // 6
        { type: "Quiz R", isQuiz: true },       // 7
        { type: "Final", isQuiz: false }        // 8
    ];
</script>