<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Abeja GO | Domina tus materias de Prepa y Prepárate para la Uni 🐝</title>
    <meta name="description" content="La plataforma inteligente para estudiantes de prepa en Guanajuato. Supera matemáticas, física y química con rutas de aprendizaje personalizadas y simulacros para la UG, UNAM e IPN.">
    <meta name="keywords" content="Abeja GO, prepa, Guanajuato, ingreso a la universidad, matemáticas, física, química, guías de estudio, UNAM, UG, IPN">
    <link rel="canonical" href="https://abejago.app/" />

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://abejago.app/">
    <meta property="og:title" content="Abeja GO 🐝 | Hackea tu aprendizaje en la prepa">
    <meta property="og:description" content="Rutas de aprendizaje inteligentes, diagnóstico de temas y simulacros de admisión. ¡Sube tu promedio hoy!">
    <meta property="og:image" content="https://abejago.app/img/logo.png">

    <link rel="icon" type="image/png" href="img/favicon-logo.png">
    <link rel="apple-touch-icon" href="img/favicon-logo.png">
    <link rel="manifest" href="img/site.webmanifest">
    <meta name="theme-color" content="#FFD700">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/style_index.css">

    <style>
        /* 1. Obligamos al navegador a detenerse en CADA sección en PC para que no se salte ninguna */
        .snap-section, .features-wrapper {
            scroll-snap-stop: always !important;
        }

        /* 2. En móviles, apagamos el imán por completo. 
           Esto evita el rebote brusco y permite un deslizamiento nativo súper suave */
        @media (max-width: 768px) {
            html {
                scroll-snap-type: none !important;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar fixed-top" id="mainNavbar">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a class="navbar-brand m-0" href="#">
                <i class="fa-solid fa-bug"></i> Abeja Go
            </a>
            
            <a href="sesion.php" class="btn btn-duo btn-duo-outline btn-mobile-nav d-md-none text-decoration-none">Entrar</a>

            <div class="d-none d-md-flex align-items-center gap-4">
                <a class="fw-bold text-dark text-decoration-none" href="#" style="font-size: 1.1rem;">Idioma del sitio</a>
                <a href="sesion.php" class="btn btn-duo btn-duo-outline text-decoration-none">Ya tengo cuenta</a>
            </div>

        </div>
    </nav>

    <section class="snap-section position-relative overflow-hidden" style="background-color: var(--abeja-white);">
        <div class="hexagon hex-1"></div>
        <div class="hexagon hex-2"></div>
        <div class="hexagon hex-3"></div>
        <div class="hexagon hex-4"></div>

        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                    <h1 class="hero-title">Aprende nuevas habilidades de forma dulce y divertida.</h1>
                    <p class="hero-subtitle">La forma gratuita, divertida y efectiva de aprender programación, ciencias
                        y más, a tu propio ritmo.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        <button class="btn btn-duo">¡Empieza a volar!</button>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="img/abeja.png"
                        alt="Abeja Go Mascot" class="img-fluid hero-mascot">
                </div>
            </div>
        </div>
    </section>

    <section class="features-wrapper features-section position-relative">
        <div class="hexagon d-none d-md-block" style="top: 15%; left: 80%; width: 90px; height: 104px; animation-delay: 1s;"></div>
        <div class="hexagon d-none d-md-block" style="top: 70%; left: 10%; width: 110px; height: 126px; animation-delay: 2.5s;"></div>

        <div class="container feature-mobile-snap position-relative">
            <div class="hex-feature hf-1 d-block d-md-none"></div>
            <div class="hex-feature hf-2 d-block d-md-none"></div>
            <div class="hex-feature hf-3 d-block d-md-none"></div>

            <div class="text-center mb-md-5">
                <h2 class="fw-bold mb-0 feature-mobile-title" style="font-size: 2.8rem;">¿Por qué aprender en Abeja Go?
                </h2>
            </div>
            <div class="text-center d-block d-md-none">
                <i class="fa-solid fa-angles-down scroll-down-icon"></i>
            </div>
        </div>

        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 feature-mobile-snap position-relative">
                    <div class="hex-card-bg hc-1 d-block d-md-none"></div>
                    <div class="hex-card-bg hc-2 d-block d-md-none"></div>
                    <div class="feature-card">
                        <div class="feature-icon-wrapper"><i class="fa-solid fa-gamepad"></i></div>
                        <h3 class="fw-bold">Divertido y efectivo</h3>
                        <p>Aprender con Abeja Go es como jugar. Ganas puntos y desbloqueas niveles mientras dominas
                            nuevos temas.</p>
                    </div>
                    <div class="text-center d-block d-md-none">
                        <i class="fa-solid fa-angles-down scroll-down-icon"></i>
                    </div>
                </div>
                <div class="col-md-4 feature-mobile-snap position-relative">
                    <div class="hex-card-bg hc-1 d-block d-md-none"></div>
                    <div class="hex-card-bg hc-2 d-block d-md-none"></div>
                    <div class="feature-card">
                        <div class="feature-icon-wrapper"><i class="fa-solid fa-stopwatch"></i></div>
                        <h3 class="fw-bold">Lecciones cortas</h3>
                        <p>Estudia en ráfagas de 5 minutos. Perfecto para encajar el aprendizaje en cualquier momento de
                            tu día.</p>
                    </div>
                    <div class="text-center d-block d-md-none">
                        <i class="fa-solid fa-angles-down scroll-down-icon"></i>
                    </div>
                </div>
                <div class="col-md-4 feature-mobile-snap position-relative ">
                    <div class="hex-card-bg hc-1 d-block d-md-none"></div>
                    <div class="hex-card-bg hc-2 d-block d-md-none"></div>
                    <div class="feature-card">
                        <div class="feature-icon-wrapper"><i class="fa-solid fa-fire"></i></div>
                        <h3 class="fw-bold">Mantén tu racha</h3>
                        <p>Construye un hábito diario. Nuestra abeja te recordará todos los días que es hora de
                            recolectar conocimiento.</p>
                    </div>
                    <div class="text-center d-block d-md-none">
                        <i class="fa-solid fa-angles-down scroll-down-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="snap-section position-relative overflow-hidden" style="background-color: var(--abeja-white);">
        <div class="hex-asesoria ha-1"></div>
        <div class="hex-asesoria ha-2"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Asesorías 1 a 1" class="info-image">
                </div>
                <div class="col-lg-5 offset-lg-1 info-text-box text-center text-lg-start">
                    <h2>Asesorías 1 a 1 <i class="fa-solid fa-chalkboard-user text-warning"></i></h2>
                    <p>No estás solo en este panal. Si te atoras en algún tema de programación, matemáticas o ciencias,
                        puedes agendar sesiones en vivo con expertos<span class="hide-on-mobile"> que te guiarán paso a
                            paso hasta que lo domines</span>.</p>
                    <button class="btn btn-duo">Conoce a los tutores</button>
                </div>
            </div>
        </div>
    </section>

    <section class="snap-section position-relative overflow-hidden" style="background-color: var(--abeja-gray);">
        <div class="hexagon" style="top: 15%; left: 85%; width: 120px; height: 138px; animation-delay: 0.5s;"></div>
        <div class="hexagon" style="bottom: 10%; right: 80%; width: 80px; height: 92px; animation-delay: 2s;"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 info-text-box text-center text-lg-start order-2 order-lg-1">
                    <h2>Material de <br> apoyo <i class="fa-solid fa-book-open text-warning"></i></h2>
                    <p>Obtén acceso a nuestra bóveda de conocimiento: <strong class="text-dark">ejercicios hechos especialmente para ti</strong>, guías paso a paso y hojas de trucos que te salvarán la vida. <span class="hide-on-mobile">Además, te enviamos material físico de apoyo directo a tus manos.</span></p>
                    <button class="btn btn-duo-outline btn-duo">Ver biblioteca</button>
                </div>
                <div class="col-lg-6 offset-lg-1 mb-4 mb-lg-0 text-center order-1 order-lg-2">
                    <img src="https://cdn.pixabay.com/photo/2020/09/30/12/18/books-5615562_1280.jpg"
                        alt="Materiales" class="info-image img-right">
                </div>
            </div>
        </div>
    </section>

    <section class="snap-section position-relative overflow-hidden" style="background-color: var(--abeja-dark);">
        <div class="hexagon" style="background-color: #555555; top: 10%; left: 5%; width: 100px; height: 115px; animation-delay: 0s;"></div>
        <div class="hexagon" style="background-color: #555555; bottom: 20%; right: 10%; width: 140px; height: 161px; animation-delay: 1.5s;"></div>
        
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Simulacros de Admisión" class="info-image" style="border-color: var(--abeja-yellow); transform: rotate(-3deg);">
                </div>
                <div class="col-lg-5 offset-lg-1 info-text-box text-center text-lg-start">
                    <h2 class="text-white">Simulacros de Admisión <i class="fa-solid fa-rocket text-warning"></i></h2>
                    <p style="color: #CCCCCC;">¿Nervios por la universidad? Mídete contra el reloj con nuestros <strong class="text-white">simulacros hiperrealistas</strong> tipo UG, UNAM e IPN. Descubre tus puntos débiles y destrúyelos antes del gran día. <br><br><strong>DISPONIBLES APARTIR DEL 22 DE ABRIL</strong></p>
                    <button class="btn btn-duo" style="border-color: #CC9900;">¡Pon a prueba tu nivel!</button>
                </div>
            </div>
        </div>
    </section>

    <section class="snap-section achievements-section position-relative overflow-hidden">
        <div class="hexagon" style="top: 5%; left: 5%; width: 90px; height: 104px; animation-delay: 0s;"></div>
        <div class="hexagon" style="bottom: 15%; right: 5%; width: 110px; height: 126px; animation-delay: 1.5s;"></div>
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3" style="font-size: 2.8rem; color: var(--abeja-dark);">¡Colecciona tus logros!
                </h2>
                <p class="fs-5 fw-bold mb-5 opacity-75" style="color: #666;">Demuestra lo que sabes ganando medallas
                    exclusivas.</p>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-3 col-6">
                    <div class="achievement-card">
                        <div class="badge-circle"><i class="fa-solid fa-fire"></i></div>
                        <h4>Racha de 7 días</h4>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="achievement-card">
                        <div class="badge-circle"><i class="fa-solid fa-code"></i></div>
                        <h4>Primer Script</h4>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="achievement-card">
                        <div class="badge-circle"><i class="fa-solid fa-atom"></i></div>
                        <h4>Genio de Ciencias</h4>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="achievement-card">
                        <div class="badge-circle"><i class="fa-solid fa-crown"></i></div>
                        <h4>Abeja Reina</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="snap-section cta-section">
        <div class="container">
            <h2>¿Listo para unirte al enjambre?</h2>
            <p>Empieza a aprender hoy mismo. Es gratis, divertido y efectivo.</p>
            <a href="sesion.php" class="btn btn-duo text-decoration-none">¡Crea tu cuenta ahora!</a>
        </div>
        <div class="wave-divider">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,60 C300,120 900,0 1200,60 L1200,120 L0,120 Z" class="shape-fill"></path>
            </svg>
        </div>
    </section>

    <footer class="snap-section abeja-footer">
        <div class="container">
            <div class="row text-center text-lg-start">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h3 class="fw-bold text-white mb-3" style="font-size: 2.2rem;"><i
                            class="fa-solid fa-bug text-warning"></i> Abeja Go</h3>
                    <p class="fw-bold" style="color: #AAA; font-size: 1.1rem; line-height: 1.6;">Revolucionando la forma
                        en la que aprendes. Rápido, divertido y diseñado para ti.</p>
                    <div class="social-icons mt-4 justify-content-center justify-content-lg-start d-flex">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-discord"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6 mb-4 mb-lg-0 text-start">
                    <h5>Aprender</h5>
                    <ul>
                        <li><a href="#">Programación</a></li>
                        <li><a href="#">Matemáticas</a></li>
                        <li><a href="#">Física y Química</a></li>
                        <li><a href="#">Proyectos 3D</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-6 mb-4 mb-lg-0 text-start">
                    <h5>Recursos</h5>
                    <ul>
                        <li><a href="#">Asesorías 1 a 1</a></li>
                        <li><a href="#">Tienda Física</a></li>
                        <li><a href="#">Blog del Panal</a></li>
                        <li><a href="#">Comunidad</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0 text-center text-lg-start d-none d-md-block">
                    <h5>¡Únete al Panal!</h5>
                    <p class="fw-bold" style="color: #AAA;">Suscríbete para recibir noticias y recursos gratis cada
                        semana.</p>
                    <div class="input-group mt-4">
                        <input type="email" class="form-control" placeholder="Tu correo electrónico"
                            style="border-radius: 12px 0 0 12px; border: none; padding: 15px; font-size: 1.1rem;">
                        <button class="btn btn-warning fw-bold px-4" type="button"
                            style="border-radius: 0 12px 12px 0; font-size: 1.1rem;">Volar</button>
                    </div>
                </div>
            </div>

            <div class="footer-bottom text-center mt-5 pt-4 d-none d-md-block"
                style="border-top: 1px solid rgba(255,255,255,0.1);">
                <p class="mb-0 fs-5 fw-bold" style="color: #777;">© 2026 Abeja Go. Hecho con miel y código.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // SOLUCIÓN AL BUG DE SCROLL: Apagar memoria del navegador y forzar inicio arriba
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        window.scrollTo(0, 0);

        /* SCROLL NAVBAR */
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>
</body>

</html>