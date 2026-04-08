<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="robots" content="noindex, nofollow">

    <title>Entrar | Abeja Go 🐝</title>

    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="manifest" href="img/site.webmanifest">
    <meta name="theme-color" content="#FFD700">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style_sesion.css">

</head>
<body>

    <nav class="navbar fixed-top" id="mainNavbar">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a class="navbar-brand m-0" href="index.html">
                <i class="fa-solid fa-bug"></i> Abeja Go
            </a>
            
            <a href="index.html" class="btn btn-duo btn-duo-outline btn-mobile-nav d-md-none text-decoration-none">Inicio</a>

            <div class="d-none d-md-flex align-items-center gap-4">
                <a class="fw-bold text-dark text-decoration-none" href="#" style="font-size: 1.1rem;">Idioma del sitio</a>
                <a href="index.html" class="btn btn-duo btn-duo-outline text-decoration-none">Volver al inicio</a>
            </div>

        </div>
    </nav>

    <div class="auth-wrapper">
        <div class="container d-flex justify-content-center">
            <div class="auth-card">
                
                <div class="auth-image-col">
                    <h2>¡Qué gusto verte volar por aquí!</h2>
                    <img src="img/logo.png" alt="Abeja Go Mascot" class="auth-mascot">
                </div>

                <div class="auth-form-col">
                    
                    <div class="auth-form-inner" id="formContainer">
                        
                        <div class="slider-wrapper">
                            
                            <div class="form-view view-login">
                                <h3>Iniciar Sesión</h3>
                                <p>Ingresa tus datos para continuar.</p>
                                
                                <form action="#" method="POST">
                                    <div class="input-group-duo">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input type="email" class="form-control-duo" placeholder="Correo electrónico o usuario" required>
                                    </div>
                                    
                                    <div class="input-group-duo">
                                        <i class="fa-solid fa-lock"></i>
                                        <input type="password" class="form-control-duo" placeholder="Contraseña" required>
                                    </div>
                                    
                                    <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                                    <button type="submit" class="btn-duo-form">¡Entrar al Panal!</button>
                                </form>
                            </div>

                            <div class="form-view view-register">
                                <h3>Crear Cuenta</h3>
                                <p>Únete hoy y empieza a aprender volando.</p>
                                
                                <form action="#" method="POST">
                                    <div class="input-group-duo">
                                        <i class="fa-solid fa-user"></i>
                                        <input type="text" class="form-control-duo" placeholder="Nombre completo" required>
                                    </div>

                                    <div class="input-group-duo">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input type="email" class="form-control-duo" placeholder="Correo electrónico" required>
                                    </div>
                                    
                                    <div class="input-group-duo">
                                        <i class="fa-solid fa-lock"></i>
                                        <input type="password" class="form-control-duo" placeholder="Contraseña nueva" required>
                                    </div>
                                    
                                    <button type="submit" class="btn-duo-form">¡Registrarme!</button>
                                </form>
                            </div>
                        </div>

                        <div class="fixed-bottom-elements">
                            <div class="divider">
                                <span class="d-none d-xl-inline">o</span>
                                <span class="d-inline d-xl-none">o continuar con</span>
                            </div>

                            <button class="btn-duo-form btn-google">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" style="width: 22px; height: 22px;">
                                <span class="d-none d-xl-inline">Continuar con </span>Google
                            </button>
                        </div>

                        <div class="form-wave">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                                <path d="M0,60 C300,120 900,0 1200,60 L1200,120 L0,120 Z" class="shape-fill"></path>
                            </svg>
                        </div>

                        <div class="form-wave-vertical">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 1000" preserveAspectRatio="none">
                                <path d="M100,0 L100,1000 L0,1000 C60,750 -20,250 0,0 Z" class="shape-fill"></path>
                            </svg>
                        </div>

                    </div>

                    <div class="auth-form-footer">
                        <button class="btn-duo-register" id="btnToggleMode">Registrarse</button>
                    </div>

                </div>

                <div class="auth-extra-col">
                    </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.css"></script>
    
    <script>
    if ('scrollRestoration' in history) {
        history.scrollRestoration = 'manual';
    }
    window.scrollTo(0, 0);

    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // --- FUNCIÓN PERSONALIZADA PARA SCROLL ---
    function scrollLento(targetPosition, duration) {
        const startPosition = window.scrollY;
        const distance = targetPosition - startPosition;
        let startTime = null;

        function ease(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const run = ease(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            
            if (timeElapsed < duration) {
                requestAnimationFrame(animation);
            } else {
                document.documentElement.style.scrollBehavior = '';
            }
        }

        requestAnimationFrame(animation);
    }

    const btnToggle = document.getElementById('btnToggleMode');
    const formContainer = document.getElementById('formContainer');
    let isLoginView = true;

    btnToggle.addEventListener('click', function() {
        // 1. Inicia el cambio de formulario (Animación CSS)
        if (isLoginView) {
            formContainer.classList.add('show-register');
            btnToggle.textContent = 'Iniciar Sesión';
        } else {
            formContainer.classList.remove('show-register');
            btnToggle.textContent = 'Registrarse';
        }
        isLoginView = !isLoginView;
        
        this.blur(); 

        // 2. Inicia el scroll AL MISMO TIEMPO
        if (window.innerWidth <= 1024) {
            const formTopPosition = formContainer.getBoundingClientRect().top;
            
            if (formTopPosition < 100) {
                const offsetPosition = formContainer.getBoundingClientRect().top + window.scrollY - 100;
                
                document.documentElement.style.scrollBehavior = 'auto';
                
                // 600ms para que vaya a la par con la animación del form (0.5s)
                scrollLento(offsetPosition, 500); 
            }
        }
    });
</script>
</body>
</html>