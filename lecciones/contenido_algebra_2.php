<style>
    /* =======================================================
       ESTILOS PREMIUM PARA ÁLGEBRA 2 (Visuales y Matemáticas)
       ======================================================= */
    
    /* Etiquetas resaltadas (Conmutativa, Asociativa, etc) */
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
    .math-highlight:hover {
        transform: translateY(-2px);
    }

    /* Emojis flotantes gigantes */
    .visual-emoji {
        font-size: 3.5rem;
        display: inline-block;
        filter: drop-shadow(0 8px 10px rgba(0,0,0,0.15));
        animation: float 3s ease-in-out infinite;
        line-height: 1;
        vertical-align: middle;
    }
    
    .visual-emoji.delay-1 { animation-delay: 0.5s; }
    .visual-emoji.delay-2 { animation-delay: 1s; }

    /* Signos matemáticos hermosos (+, =, ·) */
    .math-symbol {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--abeja-gray-dark);
        margin: 0 12px;
        vertical-align: middle;
        display: inline-block;
    }

    /* Contenedor flexible para alinear las fórmulas visuales */
    .math-visual {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        margin: 30px 0;
        font-size: 1.8rem;
        font-weight: 900;
    }

    /* Cajas agrupadoras (Propiedad Asociativa) */
    .math-box {
        border: 3px dashed var(--abeja-text-muted);
        border-radius: 20px;
        padding: 12px 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0,0,0,0.03);
        box-shadow: inset 0 4px 10px rgba(0,0,0,0.02);
        gap: 5px;
        margin: 0 5px;
    }
    
    .math-box .visual-emoji {
        font-size: 2.8rem; /* Un poco más pequeño dentro de la caja */
        animation: none; /* Quitamos flotación para que la caja no se deforme */
    }

    /* Fórmula grande en texto */
    .math-formula {
        font-family: 'Nunito', sans-serif;
        font-size: 2rem;
        letter-spacing: 1px;
    }

    /* --- RESPONSIVE PARA MÓVILES --- */
    @media (max-width: 768px) {
        .visual-emoji { font-size: 2.5rem; }
        .math-symbol { font-size: 1.8rem; margin: 0 8px; }
        .math-box { padding: 8px 12px; border-radius: 16px;}
        .math-box .visual-emoji { font-size: 2rem; }
        .math-visual { font-size: 1.4rem; margin: 20px 0; }
        .math-formula { font-size: 1.5rem; }
        .math-highlight { font-size: 1rem; padding: 6px 15px; }
    }
</style>

<div class="step-container" id="step-0">
    <div class="theory-box">
        <div class="set-badge badge-yellow"><i class="fa-solid fa-book"></i> Propiedades</div>
        <h1 class="lesson-title mt-4">Las Reglas de Oro del Álgebra</h1>
        <p class="fs-5 text-muted fw-bold">Los números reales tienen "superpoderes" matemáticos que <strong>siempre funcionan</strong> en las sumas y multiplicaciones.</p>
        
        <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
            <span class="math-highlight">Conmutativa</span>
            <span class="math-highlight">Asociativa</span>
            <span class="math-highlight">Distributiva</span>
        </div>

        <div class="mt-4 p-4 bg-white rounded-4 border shadow-sm" style="border-color: var(--primary-blue) !important; text-align: left;">
            <div class="d-flex align-items-center gap-2 mb-3">
                <i class="fa-solid fa-circle-info fs-3" style="color: var(--primary-blue);"></i>
                <strong style="color: var(--primary-blue-dark); font-size: 1.2rem;">NUEVA REGLA DESBLOQUEADA</strong>
            </div>
            <p class="fs-5 fw-bold text-muted mb-0">
                A partir de ahora, para multiplicar <strong>YA NO usaremos la "x"</strong> (para no confundirla con las letras). Usaremos un punto "<strong>·</strong>" o simplemente <strong>paréntesis</strong>. <br><br>
                <span class="d-block text-center mt-3 p-3 rounded-3" style="background: var(--abeja-gray-light); color: var(--abeja-dark);">
                    Ejemplo: <span class="math-formula text-primary">3 · 4</span> es lo mismo que <span class="math-formula text-primary">3(4)</span>
                </span>
            </p>
        </div>
    </div>
    <div class="feedback-area" id="feedback-0"></div>
</div>

<div class="step-container" id="step-1">
    <div class="theory-box blue">
        <div class="set-badge badge-blue">1. Propiedad Conmutativa</div>
        <h1 class="lesson-title mt-4">El orden NO altera el resultado</h1>
        <p class="fs-5 text-muted fw-bold">"Conmutar" significa cambiar de lugar. Si sumas o multiplicas, no importa quién va primero.</p>
        
        <div class="math-visual">
            <span class="math-nowrap"><span class="visual-emoji">🍯</span> <span class="math-symbol">+</span> <span class="visual-emoji delay-1">🐝</span></span>
            <span class="math-symbol text-primary">=</span>
            <span class="math-nowrap"><span class="visual-emoji delay-1">🐝</span> <span class="math-symbol">+</span> <span class="visual-emoji">🍯</span></span>
        </div>
        <div class="math-visual text-primary math-formula mt-0">
            <span class="math-nowrap">a + b</span> <span class="math-symbol text-primary">=</span> <span class="math-nowrap">b + a</span>
        </div>
        <p class="fs-6 fw-bold text-muted mt-2 p-2 rounded-3" style="background: rgba(231,76,60,0.1); border: 2px dashed var(--pastel-red);">
            <i class="fa-solid fa-triangle-exclamation text-danger"></i> OJO: ¡Esto NO funciona con la resta ni la división!
        </p>
    </div>
    <div class="feedback-area" id="feedback-1"></div>
</div>

<div class="step-container" id="step-2" 
        data-error="Analiza bien. Buscamos el ejemplo donde los MISMOS números solo cambian de posición de izquierda a derecha.">
    <h1 class="lesson-title">¿Cuál de estos ejemplos demuestra la Propiedad Conmutativa de la multiplicación?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="false"><span class="math-formula">5 · 1 = 5</span></div>
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="true" data-success="¡Excelente! Solo invertiste el orden y el resultado de la multiplicación es el mismo."><span class="math-formula">4 · 2 = 2 · 4</span></div>
        <div class="option-card" onclick="selectOption(this, 2)" data-correct="false"><span class="math-formula">3 + (2 + 1) = 6</span></div>
    </div>
    <div class="feedback-area" id="feedback-2"></div>
</div>

<div class="step-container" id="step-3">
    <div class="theory-box green">
        <div class="set-badge badge-green">2. Propiedad Asociativa</div>
        <h1 class="lesson-title mt-4">El arte de agrupar cajas</h1>
        <p class="fs-5 text-muted fw-bold">"Asociar" es hacer grupos. En sumas o multiplicaciones largas, puedes agruparlos con paréntesis como quieras y el total será igual.</p>
        
        <div class="math-visual">
            <span class="math-nowrap">
                <div class="math-box">
                    <span class="visual-emoji">🍯</span> <span class="math-symbol fs-4">+</span> <span class="visual-emoji delay-1">🍯</span>
                </div> 
                <span class="math-symbol">+</span> <span class="visual-emoji delay-2">🍯</span>
            </span> 
            <span class="math-symbol text-success">=</span> 
            <span class="math-nowrap">
                <span class="visual-emoji">🍯</span> <span class="math-symbol">+</span> 
                <div class="math-box">
                    <span class="visual-emoji delay-1">🍯</span> <span class="math-symbol fs-4">+</span> <span class="visual-emoji delay-2">🍯</span>
                </div>
            </span>
        </div>
        <div class="math-visual math-formula mt-0" style="color: var(--pastel-green-dark);">
            <span class="math-nowrap">(a + b) + c</span> <span class="math-symbol text-success">=</span> <span class="math-nowrap">a + (b + c)</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-3"></div>
</div>

<div class="step-container" id="step-4"
        data-error="Recuerda: la propiedad asociativa trata sobre mover los PARÉNTESIS para hacer grupos distintos, sin cambiar el orden de los números.">
    <h1 class="lesson-title">Si aplicamos la Propiedad Asociativa a <span class="math-formula text-primary">1 + 2 + 3</span>, ¿cómo se vería?</h1>
    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="false"><span class="math-formula">3 + 2 + 1</span></div>
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="true" data-success="¡Perfecto! Los paréntesis solo cambiaron de grupo, pero los números mantuvieron su orden. ¡Esa es la asociativa!"><span class="math-formula">1 + (2 + 3)</span></div>
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="false"><span class="math-formula" >1 + 3 + 2</span></div>
        <div class="option-card" onclick="selectOption(this, 4)" data-correct="false"><span class="math-formula">1 · (2 · 3)</span></div>
    </div>
    <div class="feedback-area" id="feedback-4"></div>
</div>

<div class="step-container" id="step-5">
    <div class="theory-box orange">
        <div class="set-badge badge-orange">¡Alerta de Letras!</div>
        <h1 class="lesson-title mt-4">¿Por qué metieron letras a las Matemáticas?</h1>
        <p class="fs-5 text-muted fw-bold text-start">
            Antes de pasar a la última propiedad, hablemos del elefante en la habitación: <strong>Las Letras (Variables).</strong><br><br>
            Los matemáticos inventaron el uso de letras porque son como "atajos" para crear reglas generales. En lugar de escribir mil veces la misma regla:
        </p>
        <div class="math-visual math-formula" style="color: var(--abeja-text-muted);">
            <span class="math-nowrap">1·0=0,</span> <span class="math-nowrap">2·0=0,</span> <span class="math-nowrap">3·0=0...</span>
        </div>
        <p class="fs-5 text-muted fw-bold text-center mt-3">
            ¡Simplemente usan una letra para decir <strong>"CUALQUIER NÚMERO"</strong>!
        </p>
        <div class="math-visual math-formula text-danger mb-0">
            <span class="math-nowrap bg-white p-3 rounded-4 shadow-sm border border-danger">a · 0 = 0</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-5"></div>
</div>

<div class="step-container" id="step-6">
    <div class="theory-box orange">
        <div class="set-badge badge-orange">Variables = Cajas Fuertes</div>
        <h1 class="lesson-title mt-4">Las Letras son Números Disfrazados</h1>
        
        <div class="math-visual mt-5 mb-2" style="font-size: 1.5rem; color: var(--abeja-text);">
            <span class="math-nowrap fw-900">Imagina que la letra <strong class="text-danger fs-1 mx-2" style="font-family: serif; font-style: italic;">x</strong></span>
        </div>
        <div class="math-visual mt-2 mb-4">
            <span class="math-symbol" style="font-size: 1.5rem;">ES IGUAL A</span>
            <span class="math-nowrap"><span class="visual-emoji" style="font-size: 5rem; filter: drop-shadow(0 15px 20px rgba(0,0,0,0.2));">📦</span></span>
        </div>
        
        <p class="fs-5 fw-bold text-muted mt-5 text-start p-4 bg-white rounded-4 border shadow-sm">
            Una letra (como <strong>x</strong>, <strong>y</strong>, o <strong>a</strong>) es simplemente una <strong>caja cerrada</strong>. Sabemos que adentro hay un número, pero no sabemos cuál es hasta resolver el problema.
        </p>
    </div>
    <div class="feedback-area" id="feedback-6"></div>
</div>

<div class="step-container" id="step-7"
        data-error="¡Piensa en el atajo matemático! Si 'x' representa a CUALQUIER número, la regla de multiplicar por uno siempre aplica.">
    <h1 class="lesson-title">Si la letra <strong class="text-primary fs-1" style="font-family: serif; font-style: italic;">x</strong> es un número cualquiera escondido en una caja, ¿cuánto es <span class="math-formula text-primary">x · 1</span>?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">1</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="true" data-success="¡Genial! Cualquier número multiplicado por 1 es igual a sí mismo. Así que si multiplicas la caja 'x' por 1, sigue siendo 'x'."><span class="math-formula">x</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">0</span></div>
    </div>
    <div class="feedback-area" id="feedback-7"></div>
</div>

<div class="step-container" id="step-8">
    <div class="theory-box purple">
        <div class="set-badge badge-purple">3. Propiedad Distributiva ⚠️</div>
        <h1 class="lesson-title mt-4">Repartir el polen a todos</h1>
        <p class="fs-5 text-muted fw-bold">"Distribuir" es repartir. Cuando un número multiplica a un paréntesis, ese número <strong>debe multiplicarse por CADA elemento que haya adentro</strong> (incluso si hay letras).</p>
        
        <div class="math-visual math-formula mt-5 mb-4 p-3 bg-white rounded-4 shadow-sm border border-secondary">
            <span class="math-nowrap"><span class="text-danger">A</span>( <span class="text-primary">B</span> + <span class="text-success">C</span> )</span> 
            <span class="math-symbol">=</span> 
            <span class="math-nowrap">(<span class="text-danger">A</span><span class="text-primary">B</span>) + (<span class="text-danger">A</span><span class="text-success">C</span>)</span>
        </div>
        
        <p class="fs-6 fw-bold text-muted mt-4 p-4 bg-white rounded-4 border border-danger text-start shadow-sm">
            <span class="d-flex align-items-center mb-2">
                <i class="fa-solid fa-triangle-exclamation text-danger fs-3 me-2"></i>
                <strong class="text-danger fs-5">ERROR MÁS COMÚN DEL MUNDO:</strong>
            </span>
            Muchos alumnos hacen esto: <strong class="text-danger math-formula" style="font-size:1.3rem;">3(x + 2) = 3x + 2</strong> ❌<br>
            ¡Olvidaron multiplicar el 3 por el 2! Lo correcto es: <strong class="text-success math-formula" style="font-size:1.3rem;">3x + 6</strong> ✅
        </p>
    </div>
    <div class="feedback-area" id="feedback-8"></div>
</div>

<div class="step-container" id="step-9"
        data-error="¡Cuidado! Caíste en la trampa. Recuerda que el 5 que está afuera debe multiplicar a la 'x' y TAMBIÉN al '3'.">
    <h1 class="lesson-title">Resuelve correctamente distribuyendo: <span class="math-formula text-primary">5(x + 3)</span></h1>
    <p class="text-center text-muted fw-bold mb-4 fs-5"><i class="fa-solid fa-lightbulb text-warning"></i> Pista: ¡Hay dos opciones que son correctas!</p>
    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false"><span class="math-formula">5x + 3</span></div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="true" 
                data-success="¡Magnífico! Multiplicaste el 5 por la 'x' y TAMBIÉN el 5 por el '3' para obtener 15. ¡Acabas de salvarte de reprobar álgebra!"><span class="math-formula">5x + 15</span></div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="true" 
                data-success="¡Doble genialidad! Distribuiste el 5 Y ADEMÁS aplicaste la propiedad conmutativa al poner el 15 primero. ¡Ambas formas son 100% correctas!"><span class="math-formula">15 + 5x</span></div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false"><span class="math-formula">15x</span></div>
    </div>
    <div class="feedback-area" id="feedback-9"></div>
</div>

<div class="step-container" id="step-10">
    <div class="theory-box" style="border-color: var(--abeja-gray-dark); background: var(--abeja-gray-light);">
        <div class="set-badge badge-dark"><i class="fa-solid fa-bolt text-warning"></i> Resumen de Poderes</div>
        <h1 class="lesson-title mt-4">¿Por qué importa esto?</h1>
        <p class="fs-5 text-muted fw-bold text-start p-3">
            En preparatoria, trabajarás muchísimo con esas "cajas secretas" llamadas variables. <br><br>
            🐝 <strong class="text-primary">Conmutativa:</strong> Te deja ordenar ecuaciones (<span class="math-formula fs-5 text-dark">x + 5 = 5 + x</span>).<br><br>
            📦 <strong class="text-success">Asociativa:</strong> Te deja agrupar lo más fácil primero.<br><br>
            🚀 <strong class="text-danger">Distributiva:</strong> Es la llave maestra para abrir paréntesis y despejar la 'x'.
        </p>
    </div>
    <div class="feedback-area" id="feedback-10"></div>
</div>

<div class="step-container" id="step-11"
        data-error="Fíjate bien: los números no cambiaron de orden (siguen siendo 2, 4, 6), solo movimos los paréntesis para agrupar diferente.">
    <h1 class="lesson-title">Reto Final: ¿Qué propiedad se usó en esta operación?</h1>
    <div class="math-visual math-formula mb-5 p-4 bg-white rounded-4 border shadow-sm" style="border-color: var(--primary-yellow-dark) !important;">
        <span class="math-nowrap">2 + (4 + 6)</span> <span class="math-symbol text-primary">=</span> <span class="math-nowrap">(2 + 4) + 6</span>
    </div>
    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 11)" data-correct="false">Conmutativa</div>
        <div class="option-card" onclick="selectOption(this, 11)" data-correct="true" data-success="¡ERES UN GENIO! Identificaste perfectamente que agrupar distinto con paréntesis es la propiedad Asociativa.">Asociativa</div>
        <div class="option-card" onclick="selectOption(this, 11)" data-correct="false">Distributiva</div>
        <div class="option-card" onclick="selectOption(this, 11)" data-correct="false">Ninguna</div>
    </div>
    <div class="feedback-area" id="feedback-11"></div>
</div>

<div class="step-container" id="step-12">
    <img src="webp_animations/1.webp" onerror="this.src='https://cdn3d.iconscout.com/3d/premium/thumb/trophy-4990924-4159588.png'" alt="Victoria" class="success-illustration">
    <h1 class="lesson-title text-center" style="color: var(--primary-yellow-dark); font-size: 2.5rem;">¡Lección Dominada!</h1>
    <p class="text-center fw-bold text-muted fs-4">Ya conoces los secretos detrás de los números reales.</p>

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
    // Se sobreescribe la variable global con la configuración de esta lección
    window.lessonSteps = [
        { type: "Intro", isQuiz: false },       // 0
        { type: "Conmutar", isQuiz: false },    // 1
        { type: "Quiz", isQuiz: true },         // 2
        { type: "Asociar", isQuiz: false },     // 3
        { type: "Quiz", isQuiz: true },         // 4
        { type: "Letras 1", isQuiz: false },    // 5
        { type: "Letras 2", isQuiz: false },    // 6
        { type: "Quiz", isQuiz: true },         // 7
        { type: "Distribuir", isQuiz: false },  // 8
        { type: "Quiz", isQuiz: true },         // 9
        { type: "Resumen", isQuiz: false },     // 10
        { type: "Reto", isQuiz: true },         // 11
        { type: "Final", isQuiz: false }        // 12
    ];
</script>