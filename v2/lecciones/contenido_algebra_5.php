<style>
    /* =======================================================
       ESTILOS PREMIUM PARA LENGUAJE ALGEBRAICO
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
        gap: 10px;
        font-size: 1.8rem;
        margin: 15px 0;
    }

    /* Fórmula grande en texto */
    .math-formula {
        font-family: 'Nunito', sans-serif;
        font-size: 1.8rem;
        letter-spacing: 1px;
    }

    /* Cajas explicativas limpias */
    .info-box-clean {
        background: var(--abeja-white);
        border-radius: 20px;
        padding: 20px;
        border: 2px solid var(--abeja-gray-medium);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
        text-align: left;
        margin-bottom: 15px;
    }

    /* ANATOMÍA DEL TÉRMINO ALGEBRAICO */
    .term-anatomy-container {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 5px;
        margin: 30px 0;
        padding: 20px;
        background: var(--abeja-gray-light);
        border-radius: 20px;
        border: 2px dashed var(--abeja-gray-medium);
    }
    .term-part {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    .term-value {
        font-size: 4rem;
        font-weight: 900;
        font-family: 'Nunito', sans-serif;
        line-height: 1;
        text-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .term-value.sup {
        font-size: 2.2rem;
        margin-bottom: 35px; /* Elevar el exponente */
    }
    .term-label {
        font-size: 0.85rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 4px 10px;
        border-radius: 10px;
        color: white;
        white-space: nowrap;
    }

    /* Diccionario Traductor */
    .dictionary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 20px;
        background: var(--abeja-white);
        border-radius: 16px;
        border: 2px solid var(--abeja-gray-medium);
        margin-bottom: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.02);
    }
    .dict-es { font-size: 1.1rem; font-weight: 800; color: var(--abeja-dark); text-align: left;}
    .dict-math { font-size: 1.4rem; font-weight: 900; color: var(--primary-blue-dark); background: var(--primary-blue-light); padding: 5px 15px; border-radius: 10px; border: 2px solid var(--primary-blue); font-family: 'Nunito', sans-serif;}

    /* FIX: Evitar salto u oscilación horizontal al hacer clic en opciones */
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
        .math-sign { font-size: 1.4rem; }
        .math-visual-row { font-size: 1.5rem; }
        .info-box-clean { padding: 15px; }
        .term-value { font-size: 3rem; }
        .term-value.sup { font-size: 1.6rem; margin-bottom: 25px; }
        .term-label { font-size: 0.65rem; padding: 3px 6px;}
        .dictionary-row { flex-direction: column; gap: 10px; align-items: flex-start; }
        .dict-math { align-self: flex-end; }
    }
</style>

<div class="step-container" id="step-0">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-yellow" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-language"></i> Traducción</div>
        <h1 class="lesson-title mt-2">El Idioma de las Matemáticas</h1>
        
        <div class="info-box-clean">
            <h4 class="fw-bold" style="color: var(--abeja-dark);">¿Qué es el Lenguaje Algebraico?</h4>
            <p class="fs-5 text-muted fw-bold mb-0">Así como traduces del Español al Inglés, en álgebra traducimos palabras comunes a <strong>números y letras</strong>. Usamos letras para representar cosas que aún no conocemos (incógnitas).</p>
        </div>

        <div class="math-visual-row mt-4 px-3 py-4 bg-white rounded-4 shadow-sm border" style="border-color: var(--primary-yellow-dark) !important;">
            <div class="fs-4 fw-bold text-muted text-center w-100 mb-2">"Un número cualquiera"</div>
            <i class="fa-solid fa-arrow-down fs-3 text-warning w-100 text-center mb-2"></i>
            <div class="math-formula text-dark fs-1 fw-900 px-4 py-2 rounded-4" style="background: #FFF9E6; border: 3px dashed var(--primary-yellow-dark);">x</div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-0"></div>
</div>

<div class="step-container" id="step-1">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-blue" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-microscope"></i> Anatomía</div>
        <h1 class="lesson-title mt-2">Las partes de un Término</h1>
        
        <div class="info-box-clean" style="border-color: var(--primary-blue);">
            <p class="fs-5 text-muted fw-bold mb-0">Antes de empezar a traducir, debes conocer cómo se compone un "término algebraico". Es como la estructura de una palabra. Tiene 4 partes fundamentales:</p>
        </div>
        
        <div class="term-anatomy-container">
            <div class="term-part">
                <div class="term-value" style="color: var(--pastel-red-dark);">-</div>
                <div class="term-label" style="background: var(--pastel-red-dark);">Signo</div>
            </div>
            <div class="term-part">
                <div class="term-value" style="color: var(--primary-blue-dark);">5</div>
                <div class="term-label" style="background: var(--primary-blue-dark);">Coeficiente</div>
            </div>
            <div class="term-part">
                <div class="term-value" style="color: var(--pastel-green-dark); font-style: italic;">x</div>
                <div class="term-label" style="background: var(--pastel-green-dark);">Literal</div>
            </div>
            <div class="term-part">
                <div class="term-value sup" style="color: var(--secondary-orange-dark);">²</div>
                <div class="term-label" style="background: var(--secondary-orange-dark);">Exponente</div>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-1"></div>
</div>

<div class="step-container" id="step-2">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-blue" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-list-check"></i> Definiciones</div>
        <h1 class="lesson-title mt-2">¿Qué hace cada pieza?</h1>
        
        <div class="row g-3 mt-3">
            <div class="col-12 col-md-6">
                <div class="p-3 rounded-4 shadow-sm text-start h-100" style="background: var(--primary-blue-light); border: 2px solid var(--primary-blue);">
                    <h4 class="fw-bold m-0" style="color: var(--primary-blue-dark);">Coeficiente (El Número)</h4>
                    <p class="fs-6 fw-bold text-muted mt-2 mb-0">Nos dice <strong>cuántas</strong> de esas cosas tenemos. Si dice <strong>5x</strong>, significa que tienes "5 veces" esa x.</p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="p-3 rounded-4 shadow-sm text-start h-100" style="background: var(--pastel-green-light); border: 2px solid var(--pastel-green);">
                    <h4 class="fw-bold m-0" style="color: var(--pastel-green-dark);">Literal (La Letra)</h4>
                    <p class="fs-6 fw-bold text-muted mt-2 mb-0">Es la <strong>caja misteriosa</strong>. Representa un valor que aún no conocemos (ej. x, y, a, b).</p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="p-3 rounded-4 shadow-sm text-start h-100" style="background: var(--secondary-orange-dark); color: white; border: 2px solid var(--secondary-orange-dark);">
                    <h4 class="fw-bold m-0" style="color: white;">Exponente (El Pequeñito)</h4>
                    <p class="fs-6 fw-bold mt-2 mb-0" style="color: rgba(255,255,255,0.9);">Indica la <strong>potencia</strong>. Un "2" (cuadrado) nos dice que la letra se multiplica por sí misma.</p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="p-3 rounded-4 shadow-sm text-start h-100" style="background: var(--pastel-red-light); border: 2px solid var(--pastel-red);">
                    <h4 class="fw-bold m-0" style="color: var(--pastel-red-dark);">Signo (+ o -)</h4>
                    <p class="fs-6 fw-bold text-muted mt-2 mb-0">Nos dice si estamos <strong>sumando (ganando)</strong> o <strong>restando (debiendo)</strong> esta cantidad completa.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-2"></div>
</div>

<div class="step-container" id="step-3" 
        data-error="¡Fíjate bien en lo que acabamos de leer! El coeficiente es el número GRANDE que multiplica a la letra.">
    <h1 class="lesson-title">Observa el siguiente término: <span class="math-formula text-primary">8m³</span><br>¿Cuál es su <strong>Coeficiente</strong>?</h1>

    <div class="options-grid two-cols mt-4">
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="true" data-success="¡Perfecto! El 8 es el número principal (coeficiente), la 'm' es la literal y el 3 es el exponente.">
            <span class="math-formula">8</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false">
            <span class="math-formula">m</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false">
            <span class="math-formula">3</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 3)" data-correct="false">
            <span class="math-formula">+</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-3"></div>
</div>

<div class="step-container" id="step-4">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-green" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-book-open"></i> Diccionario 1</div>
        <h1 class="lesson-title mt-2">Palabras a Números</h1>
        
        <div class="info-box-clean" style="border-color: var(--pastel-green);">
            <p class="fs-5 text-muted fw-bold mb-0">Aquí tienes las traducciones más comunes. Cuando dicen "un número", significa que no sabemos cuál es, así que usamos la letra <strong>x</strong>.</p>
        </div>
        
        <div class="mt-4">
            <div class="dictionary-row">
                <span class="dict-es">Un número cualquiera</span>
                <span class="dict-math">x</span>
            </div>
            <div class="dictionary-row">
                <span class="dict-es">El <strong>doble</strong> de un número</span>
                <span class="dict-math">2x</span>
            </div>
            <div class="dictionary-row">
                <span class="dict-es">El <strong>triple</strong> de un número</span>
                <span class="dict-math">3x</span>
            </div>
            <div class="dictionary-row">
                <span class="dict-es">La <strong>mitad</strong> de un número</span>
                <span class="dict-math">x / 2</span>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-4"></div>
</div>

<div class="step-container" id="step-5" 
        data-error="Si dice 'triple', significa que debes multiplicar ese número desconocido (x) por tres.">
    <h1 class="lesson-title">¿Cómo se traduce la frase: <strong>"El triple de un número"</strong>?</h1>

    <div class="options-grid two-cols mt-4">
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false">
            <span class="math-formula">x + 3</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false">
            <span class="math-formula">x³</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="true" data-success="¡Genial! Poner el 3 junto a la 'x' significa que lo estás multiplicando (el triple).">
            <span class="math-formula">3x</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 5)" data-correct="false">
            <span class="math-formula">x / 3</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-5"></div>
</div>

<div class="step-container" id="step-6">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-purple" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-book-bookmark"></i> Diccionario 2</div>
        <h1 class="lesson-title mt-2">Palabras Avanzadas</h1>
        
        <div class="info-box-clean" style="border-color: var(--pastel-purple);">
            <p class="fs-5 text-muted fw-bold mb-0">Subamos el nivel. ¿Qué pasa si hay dos números diferentes o si usamos potencias?</p>
        </div>

        <div class="mt-4">
            <div class="dictionary-row">
                <span class="dict-es">Dos números <strong>diferentes</strong></span>
                <span class="dict-math" style="color: var(--pastel-purple-dark); background: var(--pastel-purple-light); border-color: var(--pastel-purple);">x, y</span>
            </div>
            <div class="dictionary-row">
                <span class="dict-es">La <strong>suma</strong> de dos números</span>
                <span class="dict-math" style="color: var(--pastel-purple-dark); background: var(--pastel-purple-light); border-color: var(--pastel-purple);">x + y</span>
            </div>
            <div class="dictionary-row">
                <span class="dict-es">La <strong>diferencia</strong> (resta)</span>
                <span class="dict-math" style="color: var(--pastel-purple-dark); background: var(--pastel-purple-light); border-color: var(--pastel-purple);">x - y</span>
            </div>
            <div class="dictionary-row">
                <span class="dict-es">El <strong>cuadrado</strong> de un número</span>
                <span class="dict-math" style="color: var(--pastel-purple-dark); background: var(--pastel-purple-light); border-color: var(--pastel-purple);">x²</span>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-6"></div>
</div>

<div class="step-container" id="step-7" 
        data-error="¡Cuidado con la palabra 'diferencia'! En matemáticas, diferencia siempre significa una resta entre dos cosas.">
    <h1 class="lesson-title">¿Cómo se traduce la frase: <strong>"La diferencia de dos números distintos"</strong>?</h1>

    <div class="options-grid two-cols mt-4">
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false">
            <span class="math-formula">x + y</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="true" data-success="¡Excelente! Al decir 'dos números' usamos letras diferentes (x, y), y 'diferencia' es resta (-).">
            <span class="math-formula">x - y</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false">
            <span class="math-formula">x - x</span>
        </div>
        <div class="option-card" onclick="selectOption(this, 7)" data-correct="false">
            <span class="math-formula">x / y</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-7"></div>
</div>

<div class="step-container" id="step-8">
    <div class="theory-box" style="background: transparent; border: none; box-shadow: none; padding: 0;">
        <div class="set-badge badge-orange" style="position: relative; top: 0; transform: none; margin-bottom: 15px;"><i class="fa-solid fa-puzzle-piece"></i> Constructor</div>
        <h1 class="lesson-title mt-2">Armando Oraciones Completas</h1>
        
        <div class="info-box-clean" style="border-color: var(--secondary-orange-dark);">
            <p class="fs-5 text-muted fw-bold mb-0">Para traducir frases largas, hazlo pedacito a pedacito, igual que armar un rompecabezas de izquierda a derecha.</p>
        </div>

        <div class="bg-white rounded-4 shadow-sm border py-4 px-3 text-center mt-3">
            <h4 class="fw-900 mb-4 text-dark">"El doble de un número <span class="text-danger">más</span> cinco"</h4>
            
            <div class="math-visual-row m-0 mb-3">
                <div class="math-fraction">
                    <div class="den fw-bold text-primary fs-5" style="border:none;">El doble de<br>un número</div>
                    <div class="num text-primary" style="border-top: 3px solid var(--primary-blue-dark); border-bottom: none;"><i class="fa-solid fa-arrow-down mb-2"></i><br>2x</div>
                </div>
                
                <div class="math-fraction mx-3">
                    <div class="den fw-bold text-danger fs-5" style="border:none;"><br>más</div>
                    <div class="num text-danger" style="border-top: 3px solid var(--pastel-red-dark); border-bottom: none;"><i class="fa-solid fa-arrow-down mb-2"></i><br>+</div>
                </div>
                
                <div class="math-fraction">
                    <div class="den fw-bold text-success fs-5" style="border:none;"><br>cinco</div>
                    <div class="num text-success" style="border-top: 3px solid var(--pastel-green-dark); border-bottom: none;"><i class="fa-solid fa-arrow-down mb-2"></i><br>5</div>
                </div>
            </div>

            <div class="mt-4 p-3 rounded-4" style="background: var(--secondary-orange-dark); color: white;">
                <span class="fs-5 fw-bold">Resultado Final:</span><br>
                <span class="math-formula fs-1 fw-900">2x + 5</span>
            </div>
        </div>
    </div>
    <div class="feedback-area" id="feedback-8"></div>
</div>

<div class="step-container" id="step-9"
        data-error="¡Traduce por partes! 'El cuadrado de un número' es x². 'Más' es +. 'El doble de otro número diferente' es 2y.">
    <h1 class="lesson-title">Reto Final: Traduce la siguiente frase a lenguaje algebraico.</h1>
    
    <div class="p-4 bg-white rounded-4 border shadow-sm text-center mb-4">
        <p class="fs-4 text-dark fw-900 mb-0">"El cuadrado de un número <span class="text-danger">más</span> el doble de otro número diferente"</p>
    </div>

    <div class="options-grid two-cols">
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">
            <span class="math-formula">x² + 2x</span>
        </div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="true" 
                data-success="¡ERES BRILLANTE! Identificaste que 'otro número diferente' debía ser una letra distinta (y). ¡Tradujiste la frase perfectamente!">
            <span class="math-formula">x² + 2y</span>
        </div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">
            <span class="math-formula">2x + y²</span>
        </div>
        
        <div class="option-card" onclick="selectOption(this, 9)" data-correct="false">
            <span class="math-formula">x² - 2y</span>
        </div>
    </div>
    <div class="feedback-area" id="feedback-9"></div>
</div>

<div class="step-container" id="step-10">
    <img src="webp_animations/1.webp" onerror="this.src='https://cdn3d.iconscout.com/3d/premium/thumb/trophy-4990924-4159588.png'" alt="Victoria" class="success-illustration">
    <h1 class="lesson-title text-center" style="color: var(--primary-yellow-dark); font-size: 2.5rem;">¡Lección Dominada!</h1>
    <p class="text-center fw-bold text-muted fs-4">¡Has aprendido el Idioma de las Matemáticas!</p>

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
        { type: "Base", isQuiz: false },        // 0. Intro Lenguaje
        { type: "Anatomía", isQuiz: false },    // 1. Teo Partes del término
        { type: "Roles", isQuiz: false },       // 2. Teo Roles de las partes (NUEVO)
        { type: "Quiz", isQuiz: true },         // 3. Quiz Partes
        { type: "Diccionario", isQuiz: false }, // 4. Teo Diccionario 1
        { type: "Quiz", isQuiz: true },         // 5. Quiz Diccionario 1
        { type: "Avanzado", isQuiz: false },    // 6. Teo Diccionario 2
        { type: "Quiz", isQuiz: true },         // 7. Quiz Diccionario 2
        { type: "Constructor", isQuiz: false }, // 8. Teo Armando Oraciones
        { type: "Reto Final", isQuiz: true },   // 9. Quiz Final
        { type: "Final", isQuiz: false }        // 10. Victoria
    ];
</script>