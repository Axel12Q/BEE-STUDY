<style>
    /* =======================================================
       ESTILOS PREMIUM PARA ÁLGEBRA 3 (MCM y MCD)
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

    /* Fórmula grande en texto */
    .math-formula {
        font-family: 'Nunito', sans-serif;
        font-size: 1.8rem;
        letter-spacing: 1px;
    }

    /* Pistas de Números para MCM (Saltos) */
    .number-track-wrapper {
        background: var(--abeja-gray-light);
        border: 2px dashed var(--abeja-gray-medium);
        border-radius: 20px;
        padding: 15px;
        margin: 15px 0;
        position: relative;
    }
    .track-label {
        font-size: 1.1rem;
        font-weight: 900;
        color: var(--abeja-text-muted);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .number-track {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-start;
    }
    .track-item {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 1.2rem;
        background: var(--abeja-white);
        color: var(--abeja-text-muted);
        border: 2px solid var(--abeja-gray-medium);
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }
    
    /* Estilos para los saltos regulares */
    .track-item.jump-blue { background: var(--primary-blue-light); color: var(--primary-blue-dark); border-color: var(--primary-blue); }
    .track-item.jump-orange { background: #FFF0E5; color: var(--secondary-orange-dark); border-color: var(--secondary-orange-dark); }
    
    /* Estilo estelar para cuando COINCIDEN (El MCM) */
    .track-item.match {
        background: var(--primary-yellow-dark);
        color: #FFF;
        border-color: var(--primary-yellow-text);
        box-shadow: 0 5px 15px rgba(229,180,0,0.5);
        transform: scale(1.2);
        z-index: 2;
        animation: pulseMatch 2s infinite;
    }

    /* Cajas para el MCD (Divisores) */
    .divisor-boxes {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
        margin-top: 10px;
    }
    .div-box {
        padding: 10px 15px;
        border-radius: 12px;
        font-weight: 900;
        font-size: 1.2rem;
        background: var(--abeja-white);
        border: 2px solid var(--abeja-gray-medium);
        color: var(--abeja-text-muted);
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }
    .div-box.shared { background: var(--pastel-purple-light); border-color: var(--pastel-purple); color: var(--pastel-purple-dark); }
    .div-box.max { background: var(--pastel-green-dark); border-color: #117A65; color: white; transform: scale(1.15); box-shadow: 0 5px 15px rgba(26,188,156,0.4); animation: float 3s ease-in-out infinite;}

    @keyframes pulseMatch {
        0% { transform: scale(1.1); box-shadow: 0 0 0 0 rgba(229,180,0, 0.7); }
        70% { transform: scale(1.25); box-shadow: 0 0 0 15px rgba(229,180,0, 0); }
        100% { transform: scale(1.1); box-shadow: 0 0 0 0 rgba(229,180,0, 0); }
    }

    /* --- RESPONSIVE PARA MÓVILES --- */
    @media (max-width: 768px) {
        .track-item { width: 38px; height: 38px; font-size: 1rem; }
        .math-formula { font-size: 1.5rem; }
        .track-label { font-size: 1rem; }
        .div-box { padding: 8px 12px; font-size: 1rem; }
    }
</style>

<div class="step-container" id="step-0">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-yellow" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-forward-step"></i> Base 1</div>
        <h1 class="lesson-title mt-2">Los "Saltos" de un Número</h1>
        
        <div class="p-4 bg-white rounded-4 border shadow-sm text-start mb-3">
            <h4 class="fw-bold" style="color: var(--abeja-dark);">¿Qué es un Múltiplo?</h4>
            <p class="fs-5 text-muted fw-bold mb-0">Un múltiplo es el resultado de multiplicar un número por otro (1, 2, 3...). Imagina que son los <strong>saltos exactos</strong> que da una rana.</p>
        </div>

        <div class="number-track-wrapper">
            <div class="track-label"><i class="fa-solid fa-frog text-success"></i> Saltos del número 5:</div>
            <div class="number-track justify-content-center">
                <div class="track-item jump-blue">5</div>
                <div class="track-item jump-blue">10</div>
                <div class="track-item jump-blue">15</div>
                <div class="track-item jump-blue">20</div>
                <div class="track-item">...</div>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-0"></div>
</div>

<div class="step-container" id="step-1" 
        data-error="Un múltiplo de 3 debe estar en su tabla de multiplicar (3, 6, 9, 12, 15...).">
    <h1 class="lesson-title">¿Cuál de estos números es un <strong>Múltiplo de 3</strong>?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="false"><span class="math-formula">10</span></div>
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="false"><span class="math-formula">14</span></div>
        <div class="option-card" onclick="selectOption(this, 1)" data-correct="true" data-success="¡Perfecto! 3 por 5 es 15, así que 15 es un salto exacto del 3."><span class="math-formula">15</span></div>
    </div>
    <div class="feedback-area" id="feedback-1"></div>
</div>

<div class="step-container" id="step-2">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-blue" style="position: relative; top: 0; transform: none; margin-bottom: 15px;">M.C.M.</div>
        <h1 class="lesson-title mt-2">Mínimo Común Múltiplo</h1>
        
        <div class="p-4 bg-white rounded-4 border shadow-sm text-start mb-3">
            <p class="fs-5 text-muted fw-bold mb-0">Si tenemos dos abejas dando "saltos" de distinto tamaño, el <strong>MCM</strong> responde a: <strong class="text-primary">"¿En qué salto coinciden por primera vez?"</strong></p>
        </div>
        
        <div class="number-track-wrapper">
            <div class="track-label"><i class="fa-solid fa-bug" style="color: var(--primary-blue);"></i> Abeja Azul (salta de 3 en 3):</div>
            <div class="number-track">
                <div class="track-item jump-blue">3</div>
                <div class="track-item jump-blue">6</div>
                <div class="track-item jump-blue">9</div>
                <div class="track-item match" title="¡MCM!">12</div>
                <div class="track-item jump-blue">15</div>
            </div>
        </div>

        <div class="number-track-wrapper">
            <div class="track-label"><i class="fa-solid fa-bug" style="color: var(--secondary-orange-dark);"></i> Abeja Naranja (salta de 4 en 4):</div>
            <div class="number-track">
                <div class="track-item jump-orange">4</div>
                <div class="track-item jump-orange">8</div>
                <div class="track-item match" title="¡MCM!">12</div>
                <div class="track-item jump-orange">16</div>
            </div>
        </div>

        <p class="fs-5 fw-bold mt-3 bg-white p-3 rounded-4 shadow-sm border" style="color: var(--primary-blue-dark);">
            Se encuentran en el salto 12. <br><span class="math-formula text-dark">MCM (3, 4) = 12</span>
        </p>
    </div>
    <div class="feedback-area" id="feedback-2"></div>
</div>

<div class="step-container" id="step-3" 
        data-error="Calcula los saltos del 4 (4, 8, 12, 16) y los del 6 (6, 12, 18). ¿Dónde chocan primero?">
    <h1 class="lesson-title">Encuentra el MCM (el primer salto en común) de <span class="math-formula text-primary">4 y 6</span>.</h1>
    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false"><span class="math-formula">24</span></div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="true" data-success="¡Excelente! Aunque también coinciden en el 24, el 'Mínimo' (el primero) es el 12."><span class="math-formula">12</span></div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false"><span class="math-formula">2</span></div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false"><span class="math-formula">10</span></div>
    </div>
    <div class="feedback-area" id="feedback-3"></div>
</div>

<div class="step-container" id="step-4">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-yellow" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-cubes-stacked"></i> Base 2</div>
        <h1 class="lesson-title mt-2">Empacando Cajas</h1>
        
        <div class="p-4 bg-white rounded-4 border shadow-sm text-start mb-3">
            <h4 class="fw-bold" style="color: var(--abeja-dark);">¿Qué es un Divisor?</h4>
            <p class="fs-5 text-muted fw-bold mb-0">Es un número que puede dividir a otro de forma <strong>EXACTA</strong> (sin que sobre nada).</p>
        </div>

        <p class="fw-bold text-muted text-start mt-3 px-2">Ejemplo: ¿En qué tamaños de cajas podemos empacar exactamente 12 frascos?</p>
        <div class="divisor-boxes mb-3">
            <div class="div-box">1</div>
            <div class="div-box">2</div>
            <div class="div-box">3</div>
            <div class="div-box">4</div>
            <div class="div-box">6</div>
            <div class="div-box">12</div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-4"></div>
</div>

<div class="step-container" id="step-5" 
        data-error="Busca el número que pueda dividir al 14 y que el resultado sea un número entero (sin decimales).">
    <h1 class="lesson-title">¿Cuál de los siguientes números es un <strong>Divisor de 14</strong>?</h1>
    <div class="options-grid">
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false"><span class="math-formula">3</span></div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false"><span class="math-formula">5</span></div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="true" data-success="¡Muy bien! 14 dividido entre 7 es exactamente 2. ¡No sobra nada!"><span class="math-formula">7</span></div>
    </div>
    <div class="feedback-area" id="feedback-5"></div>
</div>

<div class="step-container" id="step-6">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-purple" style="position: relative; top: 0; transform: none; margin-bottom: 15px;">M.C.D.</div>
        <h1 class="lesson-title mt-2">Máximo Común Divisor</h1>
        
        <div class="p-4 bg-white rounded-4 border shadow-sm text-start mb-3">
            <p class="fs-5 text-muted fw-bold mb-0">El MCD responde a: <strong style="color: var(--pastel-purple-dark);">"¿Cuál es el pedazo o caja MÁS GRANDE que sirve para empacar ambos números a la vez?"</strong></p>
        </div>
        
        <div class="text-start mt-4">
            <span class="fw-bold px-2" style="color: var(--abeja-text-muted);"><i class="fa-solid fa-box text-dark"></i> Cajas para el 12:</span>
            <div class="divisor-boxes mb-3">
                <div class="div-box shared">1</div>
                <div class="div-box shared">2</div>
                <div class="div-box">3</div>
                <div class="div-box max" title="¡MCD!">4</div>
                <div class="div-box">6</div>
                <div class="div-box">12</div>
            </div>

            <span class="fw-bold px-2" style="color: var(--abeja-text-muted);"><i class="fa-solid fa-box text-dark"></i> Cajas para el 8:</span>
            <div class="divisor-boxes">
                <div class="div-box shared">1</div>
                <div class="div-box shared">2</div>
                <div class="div-box max" title="¡MCD!">4</div>
                <div class="div-box">8</div>
            </div>
        </div>

        <p class="fs-5 fw-bold mt-4 bg-white p-3 rounded-4 shadow-sm border" style="color: var(--pastel-purple-dark);">
            Ambos comparten la caja de 1, 2 y 4. ¡La mayor es 4!<br>
            <span class="math-formula text-dark">MCD (12, 8) = 4</span>
        </p>
    </div>
    <div class="feedback-area" id="feedback-6"></div>
</div>

<div class="step-container" id="step-7"
        data-error="Los divisores de 15 son (1, 3, 5, 15). Los de 10 son (1, 2, 5, 10). ¿Cuál es el más grande en común?">
    <h1 class="lesson-title">Encuentra el Máximo Común Divisor (MCD) de <span class="math-formula text-primary">15 y 10</span>.</h1>
    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">30</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="true" data-success="¡Perfecto! Tanto el 15 como el 10 se pueden dividir entre 5. ¡Es la caja más grande que comparten!"><span class="math-formula">5</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula" >1</span></div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false"><span class="math-formula">2</span></div>
    </div>
    <div class="feedback-area" id="feedback-7"></div>
</div>

<div class="step-container" id="step-8">
    <div class="theory-box orange" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-orange" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-wand-magic-sparkles"></i>Truco</div>
        <h1 class="lesson-title mt-2">El Secreto para los Exámenes</h1>
        <p class="fs-5 text-muted fw-bold text-center mb-4">
            ¿Cómo saber qué usar en los problemas de texto? Memoriza esto:
        </p>

        <div class="row g-3">
            <div class="col-12">
                <div class="p-3 rounded-4 shadow-sm text-start" style="background: var(--primary-blue-light); border: 2px solid var(--primary-blue);">
                    <h4 class="fw-bold m-0" style="color: var(--primary-blue-dark);"><i class="fa-solid fa-clock"></i> Usa el M.C.M. si...</h4>
                    <p class="fs-6 fw-bold text-muted mt-2 mb-0">Hablan de <strong>TIEMPO</strong> o de cuándo <strong>VUELVEN A COINCIDIR</strong>. <br>(Ej. "Pasan a la vez", "Se encuentran juntos").</p>
                </div>
            </div>
            <div class="col-12">
                <div class="p-3 rounded-4 shadow-sm text-start" style="background: var(--pastel-purple-light); border: 2px solid var(--pastel-purple);">
                    <h4 class="fw-bold m-0" style="color: var(--pastel-purple-dark);"><i class="fa-solid fa-scissors"></i> Usa el M.C.D. si...</h4>
                    <p class="fs-6 fw-bold text-muted mt-2 mb-0">Hablan de <strong>CORTAR, REPARTIR o EMPACAR</strong> algo en el tamaño <strong>MÁXIMO</strong> posible.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-8"></div>
</div>

<div class="step-container" id="step-9"
        data-error="Lee bien: hablan de TIEMPO (cada 15 min y cada 20 min) y te preguntan cuándo COINCIDEN. El truco dice que eso es MCM. Calcula los múltiplos de 15 y 20.">
    <h1 class="lesson-title">Reto Final</h1>
    <div class="p-4 bg-white rounded-4 border shadow-sm text-start mb-4">
        <p class="fs-5 text-muted fw-bold mb-0">Dos rutas de autobús salen de la estación. La Ruta A sale cada <strong>15 minutos</strong>. La Ruta B cada <strong>20 minutos</strong>. Si acaban de salir juntas, ¿en cuántos minutos volverán a salir juntas?</p>
    </div>

    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">En 5 minutos</div>
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="true" 
                data-success="¡ERES BRILLANTE! Identificaste que es un problema de tiempo (MCM). Múltiplos de 15: 15, 30, 45, 60. Múltiplos de 20: 20, 40, 60. ¡Coinciden en el 60!">En 60 minutos</div>
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">En 35 minutos</div>
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">En 100 minutos</div>
    </div>
    <div class="feedback-area" id="feedback-9"></div>
</div>

<div class="step-container" id="step-10">
    <img src="webp_animations/1.webp" onerror="this.src='https://cdn3d.iconscout.com/3d/premium/thumb/trophy-4990924-4159588.png'" alt="Victoria" class="success-illustration">
    <h1 class="lesson-title text-center" style="color: var(--primary-yellow-dark); font-size: 2.5rem;">¡Lección Dominada!</h1>
    <p class="text-center fw-bold text-muted fs-4">El MCM y el MCD ya no tienen secretos para ti.</p>

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
    // Se sobreescribe la variable global con la configuración de esta lección (¡11 pasos!)
    window.lessonSteps = [
        { type: "Base", isQuiz: false },        // 0
        { type: "Quiz", isQuiz: true },         // 1
        { type: "M.C.M.", isQuiz: false },      // 2
        { type: "Quiz", isQuiz: true },         // 3
        { type: "Base", isQuiz: false },        // 4
        { type: "Quiz", isQuiz: true },         // 5
        { type: "M.C.D.", isQuiz: false },      // 6
        { type: "Quiz", isQuiz: true },         // 7
        { type: "Hack", isQuiz: false },        // 8
        { type: "Reto Final", isQuiz: true },   // 9
        { type: "Final", isQuiz: false }        // 10
    ];
</script>