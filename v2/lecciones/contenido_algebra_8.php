<style>
/* =======================================================
   ESTILOS PREMIUM PARA EXPONENTES Y POLINOMIOS (2.2.3 - 2.2.5)
   ======================================================= */

.math-highlight{
    background-color: var(--primary-blue-light);
    color: var(--primary-blue-dark);
    border:2px solid var(--primary-blue);
    padding:8px 20px;
    border-radius:16px;
    font-weight:900;
    font-size:1.15rem;
    box-shadow:0 4px 0 rgba(52,152,219,.2);
    display:inline-block;
}

.math-formula{
    font-family:'Nunito',sans-serif;
    font-size:1.8rem;
    letter-spacing:1px;
    font-weight:900;
}

.info-box-clean{
    background:var(--abeja-white);
    border-radius:20px;
    padding:20px;
    border:2px solid var(--abeja-gray-medium);
    box-shadow:0 5px 15px rgba(0,0,0,.03);
    text-align:left;
    margin-bottom:15px;
}

.option-card{
    box-sizing:border-box!important;
    transform:translateZ(0);
    backface-visibility:hidden;
    will-change:transform;
}

.exponent-rule{
    background:var(--abeja-gray-light);
    border-left:5px solid var(--primary-blue);
    padding:15px;
    border-radius:0 15px 15px 0;
    margin-bottom:15px;
    text-align:left;
}

@media (max-width:768px){
    .math-formula{font-size:1.4rem;}
    .info-box-clean{padding:15px;}
}
</style>

<!-- STEP 0 -->
<div class="step-container" id="step-0">
<div class="theory-box" style="background:transparent;border:none;box-shadow:none;padding:0;">
<div class="set-badge badge-yellow" style="position:relative;top:0;transform:none;margin-bottom:15px;">
<i class="fa-solid fa-bolt"></i> Nivel 1
</div>

<h1 class="lesson-title mt-2">Leyes de los Exponentes</h1>

<div class="info-box-clean">
<h4 class="fw-bold">Regla del Producto</h4>
<p class="fs-5 text-muted fw-bold mb-0">
Cuando multiplicas letras iguales, los exponentes <strong>se suman</strong>.
</p>
</div>

<div class="exponent-rule">
<span class="math-formula">x² · x³ = x⁵</span>
<hr>
<span class="fw-bold text-muted">2 + 3 = 5</span>
</div>

</div>
<div class="feedback-area" id="feedback-0"></div>
</div>

<!-- STEP 1 -->
<div class="step-container" id="step-1" data-error="Recuerda: al multiplicar bases iguales, los exponentes se suman.">
<h1 class="lesson-title">¿Cuánto es <span class="math-formula text-primary">a⁴ · a²</span>?</h1>

<div class="options-grid">
<div class="option-card" onclick="selectOption(this,1)" data-correct="false"><span class="math-formula">a⁶⁴</span></div>
<div class="option-card" onclick="selectOption(this,1)" data-correct="true" data-success="¡Correcto! 4 + 2 = 6"><span class="math-formula">a⁶</span></div>
<div class="option-card" onclick="selectOption(this,1)" data-correct="false"><span class="math-formula">a⁸</span></div>
</div>

<div class="feedback-area" id="feedback-1"></div>
</div>

<!-- STEP 2 -->
<div class="step-container" id="step-2">
<div class="theory-box" style="background:transparent;border:none;box-shadow:none;padding:0;">
<div class="set-badge badge-blue" style="position:relative;top:0;transform:none;margin-bottom:15px;">
<i class="fa-solid fa-divide"></i> Nivel 2
</div>

<h1 class="lesson-title mt-2">Regla del Cociente</h1>

<div class="info-box-clean">
<p class="fs-5 text-muted fw-bold mb-0">
Cuando divides letras iguales, los exponentes <strong>se restan</strong>.
</p>
</div>

<div class="exponent-rule">
<span class="math-formula">x⁷ / x² = x⁵</span>
<hr>
<span class="fw-bold text-muted">7 - 2 = 5</span>
</div>

</div>
<div class="feedback-area" id="feedback-2"></div>
</div>

<!-- STEP 3 -->
<div class="step-container" id="step-3" data-error="Al dividir, resta exponentes: 9 - 3">
<h1 class="lesson-title">Resuelve: <span class="math-formula text-primary">m⁹ / m³</span></h1>

<div class="options-grid">
<div class="option-card" onclick="selectOption(this,3)" data-correct="true" data-success="¡Excelente! 9 - 3 = 6"><span class="math-formula">m⁶</span></div>
<div class="option-card" onclick="selectOption(this,3)" data-correct="false"><span class="math-formula">m³</span></div>
<div class="option-card" onclick="selectOption(this,3)" data-correct="false"><span class="math-formula">m¹²</span></div>
</div>

<div class="feedback-area" id="feedback-3"></div>
</div>

<!-- STEP 4 -->
<div class="step-container" id="step-4">
<div class="theory-box" style="background:transparent;border:none;box-shadow:none;padding:0;">
<div class="set-badge badge-green" style="position:relative;top:0;transform:none;margin-bottom:15px;">
<i class="fa-solid fa-cube"></i> Nivel 3
</div>

<h1 class="lesson-title mt-2">Multiplicación de Monomios</h1>

<div class="info-box-clean">
<p class="fs-5 text-muted fw-bold mb-0">
Multiplica números y suma exponentes de letras iguales.
</p>
</div>

<div class="p-3 bg-white rounded-4 border shadow-sm text-center">
<span class="math-formula">(3x²)(2x³)</span><br>
<i class="fa-solid fa-arrow-down text-muted my-2"></i><br>
<span class="math-formula text-success">6x⁵</span>
</div>

</div>
<div class="feedback-area" id="feedback-4"></div>
</div>

<!-- STEP 5 -->
<div class="step-container" id="step-5" data-error="3×4=12 y 2+1=3">
<h1 class="lesson-title">¿Resultado de <span class="math-formula text-primary">3y² · 4y</span>?</h1>

<div class="options-grid">
<div class="option-card" onclick="selectOption(this,5)" data-correct="false"><span class="math-formula">12y²</span></div>
<div class="option-card" onclick="selectOption(this,5)" data-correct="true" data-success="¡Perfecto!"><span class="math-formula">12y³</span></div>
<div class="option-card" onclick="selectOption(this,5)" data-correct="false"><span class="math-formula">7y³</span></div>
</div>

<div class="feedback-area" id="feedback-5"></div>
</div>

<!-- STEP 6 -->
<div class="step-container" id="step-6">
<div class="theory-box" style="background:transparent;border:none;box-shadow:none;padding:0;">
<div class="set-badge badge-purple" style="position:relative;top:0;transform:none;margin-bottom:15px;">
<i class="fa-solid fa-scissors"></i> Nivel 4
</div>

<h1 class="lesson-title mt-2">División de Monomios</h1>

<div class="info-box-clean">
<p class="fs-5 text-muted fw-bold mb-0">
Divide coeficientes y resta exponentes.
</p>
</div>

<div class="p-3 bg-white rounded-4 border shadow-sm text-center">
<span class="math-formula">12x⁵ / 3x²</span><br>
<i class="fa-solid fa-arrow-down text-muted my-2"></i><br>
<span class="math-formula text-success">4x³</span>
</div>

</div>
<div class="feedback-area" id="feedback-6"></div>
</div>

<!-- STEP 7 -->
<div class="step-container" id="step-7" data-error="12/4=3 y 6-2=4">
<h1 class="lesson-title">¿Resultado de <span class="math-formula text-primary">12a⁶ / 4a²</span>?</h1>

<div class="options-grid">
<div class="option-card" onclick="selectOption(this,7)" data-correct="true" data-success="¡Muy bien!"><span class="math-formula">3a⁴</span></div>
<div class="option-card" onclick="selectOption(this,7)" data-correct="false"><span class="math-formula">8a⁴</span></div>
<div class="option-card" onclick="selectOption(this,7)" data-correct="false"><span class="math-formula">3a³</span></div>
</div>

<div class="feedback-area" id="feedback-7"></div>
</div>

<!-- STEP 8 -->
<div class="step-container" id="step-8">
<div class="theory-box" style="background:transparent;border:none;box-shadow:none;padding:0;">
<div class="set-badge badge-orange" style="position:relative;top:0;transform:none;margin-bottom:15px;">
<i class="fa-solid fa-table-cells-large"></i> Nivel 5
</div>

<h1 class="lesson-title mt-2">Multiplicación de Polinomios</h1>

<div class="info-box-clean">
<p class="fs-5 text-muted fw-bold mb-0">
Cada término del primer paréntesis multiplica a cada término del segundo.
</p>
</div>

<div class="p-3 bg-white rounded-4 border shadow-sm text-center">
<span class="math-formula">(x+2)(x+3)</span><br>
<i class="fa-solid fa-arrow-down text-muted my-2"></i><br>
<span class="math-formula text-success">(x²+3x)+(2x+6)</span>
</div>

</div>
<div class="feedback-area" id="feedback-8"></div>
</div>

<!-- STEP 9 -->
<div class="step-container" id="step-9" data-error="Multiplica todo con todo.">
<h1 class="lesson-title">¿Cuánto es <span class="math-formula text-primary">(x+1)(x+2)</span>?</h1>

<div class="options-grid two-cols">
<div class="option-card" onclick="selectOption(this,9)" data-correct="true" data-success="¡Genial!"><span class="math-formula">x²+3x+2</span></div>
<div class="option-card" onclick="selectOption(this,9)" data-correct="false"><span class="math-formula">x²+2</span></div>
<div class="option-card" onclick="selectOption(this,9)" data-correct="false"><span class="math-formula">x²+x+2</span></div>
<div class="option-card" onclick="selectOption(this,9)" data-correct="false"><span class="math-formula">x²+4x+2</span></div>
</div>

<div class="feedback-area" id="feedback-9"></div>
</div>

<!-- STEP 10 -->
<div class="step-container" id="step-10">
<div class="theory-box" style="background:transparent;border:none;box-shadow:none;padding:0;">
<div class="set-badge badge-dark" style="position:relative;top:0;transform:none;margin-bottom:15px;">
<i class="fa-solid fa-ruler-horizontal"></i> Nivel 6
</div>

<h1 class="lesson-title mt-2">División Tradicional</h1>

<div class="info-box-clean">
<p class="fs-5 text-muted fw-bold mb-0">
Se acomoda como división larga, ordenando por grados. <b><strong>Solo disponible con asesorias.</strong></b>
</p>
</div>

<div class="p-3 bg-white rounded-4 border shadow-sm text-center">
<span class="math-formula">(x²+5x+6) ÷ (x+2)</span><br>
<i class="fa-solid fa-arrow-down text-muted my-2"></i><br>
<span class="math-formula text-success">x+3</span>
</div>

</div>
<div class="feedback-area" id="feedback-10"></div>
</div>

<!-- STEP 11 -->
<div class="step-container" id="step-11">
<div class="theory-box" style="background:transparent;border:none;box-shadow:none;padding:0;">
<div class="set-badge badge-blue" style="position:relative;top:0;transform:none;margin-bottom:15px;">
<i class="fa-solid fa-forward-fast"></i> Nivel 7
</div>

<h1 class="lesson-title mt-2">División Sintética </h1>

<div class="info-box-clean">
<p class="fs-5 text-muted fw-bold mb-0">
Atajo para dividir entre <strong>x - c</strong>. Solo usas coeficientes. <b><strong>Solo disponible con asesorias.</strong></b>
</p>
</div>

<div class="p-3 bg-white rounded-4 border shadow-sm text-center">
<span class="math-formula">1 &nbsp; 5 &nbsp; 6 &nbsp; | -2</span>
</div>

</div>
<div class="feedback-area" id="feedback-11"></div>
</div>

<!-- STEP 12 -->
<div class="step-container" id="step-12" data-error="Resta exponentes: 5 - 2">
<h1 class="lesson-title">Reto Final: <span class="math-formula text-primary">z⁵ / z²</span></h1>

<div class="options-grid">
<div class="option-card" onclick="selectOption(this,12)" data-correct="false"><span class="math-formula">z¹⁰</span></div>
<div class="option-card" onclick="selectOption(this,12)" data-correct="true" data-success="¡Dominado!"><span class="math-formula">z³</span></div>
<div class="option-card" onclick="selectOption(this,12)" data-correct="false"><span class="math-formula">z⁷</span></div>
</div>

<div class="feedback-area" id="feedback-12"></div>
</div>

<!-- STEP 13 -->
<div class="step-container" id="step-13">
<img src="webp_animations/1.webp"
onerror="this.src='https://cdn3d.iconscout.com/3d/premium/thumb/trophy-4990924-4159588.png'"
class="success-illustration">

<h1 class="lesson-title text-center" style="color:var(--primary-yellow-dark);font-size:2.5rem;">¡Nivel Completado!</h1>

<p class="text-center fw-bold text-muted fs-4">
Dominas exponentes, monomios y polinomios.
</p>

<div class="stats-grid">
<div class="stat-box">
<h4>Miel Ganada</h4>
<span>+50 <i class="fa-solid fa-droplet" style="color:var(--primary-yellow-dark);"></i></span>
</div>

<div class="stat-box">
<h4>Precisión</h4>
<span id="final-accuracy">100%</span>
</div>
</div>
</div>

<!-- GAME OVER -->
<div class="step-container" id="step-game-over">
<h1 class="lesson-title text-center" style="color:var(--pastel-red-dark);font-size:2.5rem;">¡Sin energía!</h1>
<p class="text-center fw-bold text-muted fs-4">
Repasa y vuelve a intentarlo.
</p>
</div>

<script>
window.lessonSteps = [
{ type:"Exp 1", isQuiz:false },
{ type:"Quiz", isQuiz:true },
{ type:"Exp 2", isQuiz:false },
{ type:"Quiz", isQuiz:true },
{ type:"Mono x Mono", isQuiz:false },
{ type:"Quiz", isQuiz:true },
{ type:"Div Monomio", isQuiz:false },
{ type:"Quiz", isQuiz:true },
{ type:"Polinomios", isQuiz:false },
{ type:"Quiz", isQuiz:true },
{ type:"Tradicional", isQuiz:false },
{ type:"Sintética", isQuiz:false },
{ type:"Reto", isQuiz:true },
{ type:"Final", isQuiz:false }
];
</script>