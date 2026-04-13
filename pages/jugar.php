

<div class="landscape-warning">
    <i class="fa-solid fa-mobile-screen-button rotate-icon"></i>
    <h3 class="mt-4 fw-bold" style="color: var(--abeja-dark);">¡Gira tu teléfono!</h3>
    <p class="text-muted fw-bold">Abeja GO funciona mejor en vertical para que no te pierdas ningún detalle de tu ruta de aprendizaje.</p>
</div>

<div class="bg-floating-hexagons">
    <div class="floating-hex-bg" style="width:100px; height:100px; top: 2%; left: 10%; animation-duration: 20s;"></div><div class="floating-hex-bg" style="width:70px; height:70px; top: 10%; right: 15%; animation-duration: 15s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:130px; height:130px; top: 35%; left: 15%; animation-duration: 28s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:110px; height:110px; top: 52%; left: 35%; animation-duration: 19s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:140px; height:140px; top: 68%; left: 20%; animation-duration: 26s; animation-direction: reverse;"></div>
    <div class="floating-hex-bg" style="width:65px; height:65px; top: 76%; right: 30%; animation-duration: 16s;"></div>
    <div class="floating-hex-bg" style="width:105px; height:105px; top: 95%; right: 18%; animation-duration: 20s;"></div>
</div>

<div class="sticky-course-mobile">
    <div style="position: relative; display: inline-block; width: 100%;" class="fade-in-section">
        <button class="course-selector-btn sound-nav" type="button" id="customCourseBtn">
            <div class="course-icon-box"><i class="fa-solid fa-square-root-variable"></i></div>
            <div class="text-start">
                <span class="d-block text-muted" style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1px;">CURSO ACTUAL</span>
                <span class="d-block fw-bold" style="font-size: 1.15rem; color: var(--abeja-dark); line-height: 1;">Álgebra</span>
            </div>
            <i class="fa-solid fa-chevron-down ms-auto text-muted"></i>
        </button>
        
        <ul class="dropdown-menu custom-dropdown-menu border-0 shadow-lg rounded-4 p-2 w-100" id="customCourseMenu" style="z-index: 200;">
            <li>
                <a class="dropdown-item sound-nav d-flex align-items-center p-2 rounded-3 active" href="#">
                    <div class="course-icon-box me-3" style="width: 35px; height: 35px; font-size: 1rem;"><i class="fa-solid fa-square-root-variable"></i></div>
                    <span class="fw-bold">Álgebra</span>
                    <i class="fa-solid fa-circle-check ms-auto"></i>
                </a>
            </li>
            <li>
                <a class="dropdown-item sound-nav d-flex align-items-center p-2 rounded-3 mt-1" href="#">
                    <div class="course-icon-box me-3 bg-light text-muted border border-light" style="width: 35px; height: 35px; font-size: 1rem; background-color: var(--abeja-gray-light) !important;"><i class="fa-solid fa-atom"></i></div>
                    <span class="fw-bold text-muted" style="color: var(--abeja-dark);">Física</span>
                </a>
            </li>
            <li><hr class="dropdown-divider my-2"></li>
            <li>
                <a class="dropdown-item sound-nav d-flex align-items-center p-2 rounded-3 text-primary" href="#">
                    <div class="course-icon-box me-3 bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25" style="width: 35px; height: 35px; font-size: 1rem;"><i class="fa-solid fa-plus"></i></div>
                    <span class="fw-bold" style="color: #0d6efd;">Añadir curso</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="section-sticky-header">
    <div class="section-banner fade-in-section delay-1">
        <div class="banner-text-col">
            <span>SECCIÓN 1, ÁLGEBRA FUNDAMENTAL</span>
            <h3>Introducción a Ecuaciones</h3>
        </div>
        <div class="banner-img-col">
            <img src="https://images.unsplash.com/photo-1635070041078-e363dbe005cb?auto=format&fit=crop&w=300&q=80" alt="Algebra">
        </div>
    </div>
</div>

<div class="path-container">
    <div class="path-bg-hexagons">
        <div class="path-hex blue" style="width: 140px; height: 140px; top: 10%; left: 5%; animation-duration: 20s;"></div>
        <div class="path-hex yellow" style="width: 90px; height: 90px; top: 40%; right: 10%; animation-duration: 15s; animation-direction: reverse;"></div>
        <div class="path-hex gray" style="width: 180px; height: 180px; top: 75%; left: 15%; animation-duration: 25s;"></div>
        <div class="path-hex blue" style="width: 110px; height: 110px; top: 85%; right: 20%; animation-duration: 18s; animation-direction: reverse;"></div>
    </div>

    <div class="path-nodes">
        
        <svg class="path-line-svg-desktop path-line-anim" style="position: absolute; top: 42px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M -160 0 L -80 115 L 0 230 L 80 345 L 160 460 L 80 575" stroke="var(--abeja-gray-dark)" stroke-width="22" fill="none" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M -160 0 L -80 115 L 0 230 L 80 345" stroke="var(--primary-blue)" stroke-width="22" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <svg class="path-line-svg-mobile path-line-anim" style="position: absolute; top: 37px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M -60 0 L -30 115 L 0 230 L 30 345 L 60 460 L 30 575" stroke="var(--abeja-gray-dark)" stroke-width="18" fill="none" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M -60 0 L -30 115 L 0 230 L 30 345" stroke="var(--primary-blue)" stroke-width="18" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div class="node-wrapper offset-left-2 fade-in-node delay-2">
            <div class="mascot-zone zone-right">
                <img src="webp_animations/1.webp" class="mascot-img sound-nav" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-completed sound-nav">
                <button class="btn-hex"><i class="fa-solid fa-check"></i></button>
            </div>
        </div>
        
        <div class="node-wrapper offset-left-1 fade-in-node delay-3">
            <div class="btn-hex-wrapper state-completed sound-nav">
                <button class="btn-hex"><i class="fa-solid fa-check"></i></button>
            </div>
        </div>

        <div class="node-wrapper offset-center fade-in-node delay-4">
            <div class="btn-hex-wrapper state-chest sound-nav">
                <button class="btn-hex"><i class="fa-solid fa-box-open"></i></button>
            </div>
        </div>

        <div class="node-wrapper offset-right-1 fade-in-node delay-5">
            <div class="btn-hex-wrapper state-active sound-nav">
                <div class="tooltip-start">EMPEZAR</div>
                <div class="node-active-orbit">
                    <div class="node-active-ring"></div>
                </div>
                <button class="btn-hex"><i class="fa-solid fa-star"></i></button>
            </div>
        </div>

        <div class="node-wrapper offset-right-2 fade-in-node delay-6">
            <div class="mascot-zone zone-left">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-crown"></i></button>
            </div>
        </div>
        
        <div class="node-wrapper offset-right-1 fade-in-node delay-7">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-dumbbell"></i></button>
            </div>
        </div>

    </div>
</div>

<div class="section-sticky-header">
    <div class="section-banner banner-green fade-in-section delay-8">
        <div class="banner-text-col">
            <span>SECCIÓN 2, ÁLGEBRA AVANZADA</span>
            <h3>Sistemas de Ecuaciones</h3>
        </div>
        <div class="banner-img-col">
            <img src="https://images.unsplash.com/photo-1509228468518-180dd4864904?auto=format&fit=crop&w=300&q=80" alt="Ciencia">
        </div>
    </div>
</div>

<div class="path-container">
    <div class="path-bg-hexagons">
        <div class="path-hex pastel-green" style="width: 150px; height: 150px; top: 15%; right: -20px; animation-duration: 22s;"></div>
        <div class="path-hex blue" style="width: 80px; height: 80px; top: 50%; left: 8%; animation-duration: 16s; animation-direction: reverse;"></div>
        <div class="path-hex pastel-green" style="width: 130px; height: 130px; top: 80%; right: 25%; animation-duration: 24s;"></div>
    </div>

    <div class="path-nodes">
        
        <svg class="path-line-svg-desktop path-line-anim" style="position: absolute; top: 42px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M 0 0 L -80 115 L -160 230 L -80 345 L 0 460 L 80 575" stroke="var(--abeja-gray-dark)" stroke-width="22" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <svg class="path-line-svg-mobile path-line-anim" style="position: absolute; top: 37px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M 0 0 L -30 115 L -60 230 L -30 345 L 0 460 L 30 575" stroke="var(--abeja-gray-dark)" stroke-width="18" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div class="node-wrapper offset-center fade-in-node delay-9">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-forward-step"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-left-1 fade-in-node delay-10">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-book-open"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-left-2 fade-in-node delay-11">
            <div class="mascot-zone zone-right">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-shield-halved"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-left-1 fade-in-node delay-12">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-bolt"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-center fade-in-node delay-13">
            <div class="mascot-zone zone-left">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-brain"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-right-1 fade-in-node delay-14">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-medal"></i></button>
            </div>
        </div>
    </div>
</div>

<div class="section-sticky-header">
    <div class="section-banner banner-purple fade-in-section delay-15">
        <div class="banner-text-col">
            <span>SECCIÓN 3, GEOMETRÍA</span>
            <h3>Planos y Rectas</h3>
        </div>
        <div class="banner-img-col">
            <img src="https://images.unsplash.com/photo-1543286386-2e659306cd6c?auto=format&fit=crop&w=300&q=80" alt="Geometria">
        </div>
    </div>
</div>

<div class="path-container">
    <div class="path-bg-hexagons">
        <div class="path-hex blue" style="width: 100px; height: 100px; top: 12%; left: 15%; animation-duration: 19s; animation-direction: reverse;"></div>
        <div class="path-hex pastel-purple" style="width: 170px; height: 170px; top: 45%; right: 5%; animation-duration: 28s;"></div>
        <div class="path-hex blue" style="width: 120px; height: 120px; top: 85%; left: 20%; animation-duration: 21s; animation-direction: reverse;"></div>
    </div>

    <div class="path-nodes">
        
        <svg class="path-line-svg-desktop path-line-anim" style="position: absolute; top: 42px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M 0 0 L 80 115 L 160 230 L 80 345 L 0 460 L -80 575" stroke="var(--abeja-gray-dark)" stroke-width="22" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <svg class="path-line-svg-mobile path-line-anim" style="position: absolute; top: 37px; left: 50%; width: 0; height: 100%; z-index: 0; overflow: visible;">
            <path d="M 0 0 L 30 115 L 60 230 L 30 345 L 0 460 L -30 575" stroke="var(--abeja-gray-dark)" stroke-width="18" fill="none" stroke-linecap="round" stroke-linejoin="round" />
        </svg>

        <div class="node-wrapper offset-center fade-in-node delay-16">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-shapes"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-right-1 fade-in-node delay-17">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-ruler-combined"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-right-2 fade-in-node delay-18">
            <div class="mascot-zone zone-left">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-compass"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-right-1 fade-in-node delay-19">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-calculator"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-center fade-in-node delay-20">
            <div class="mascot-zone zone-right">
                <img src="webp_animations/2_estatico.png" class="mascot-img mascot-locked sound-locked" alt="Abeja" onerror="this.src='https://cdn-icons-png.flaticon.com/512/826/826955.png';">
            </div>
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-trophy"></i></button>
            </div>
        </div>
        <div class="node-wrapper offset-left-1 fade-in-node delay-21">
            <div class="btn-hex-wrapper state-locked sound-locked">
                <button class="btn-hex"><i class="fa-solid fa-flag-checkered"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const customCourseBtn = document.getElementById('customCourseBtn');
        const customCourseMenu = document.getElementById('customCourseMenu');

        if (customCourseBtn && customCourseMenu) {
            customCourseBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                customCourseMenu.classList.toggle('show');
            });

            if (!window.courseDropdownListenerAdded) {
                document.addEventListener('click', (e) => {
                    const currentBtn = document.getElementById('customCourseBtn');
                    const currentMenu = document.getElementById('customCourseMenu');
                    
                    if (currentBtn && currentMenu && !currentBtn.contains(e.target) && !currentMenu.contains(e.target)) {
                        currentMenu.classList.remove('show');
                    }
                });
                window.courseDropdownListenerAdded = true;
            }
        }

        document.querySelectorAll('.btn-hex-wrapper:not(.state-locked)').forEach(btn => {
            btn.addEventListener('click', function(e) {
                
                const hexBtn = this.querySelector('.btn-hex');
                const pulse = document.createElement('div');
                pulse.classList.add('click-pulse');
                hexBtn.appendChild(pulse);
                setTimeout(() => pulse.remove(), 500);

                const ripple = document.createElement('div');
                ripple.classList.add('click-ripple-3d');
                
                let activeOrbit = null;
                if(this.classList.contains('state-active')) {
                    ripple.style.borderColor = 'var(--primary-yellow-dark)';
                    
                    activeOrbit = this.querySelector('.node-active-orbit');
                    if (activeOrbit) {
                        activeOrbit.classList.remove('orbit-appear');
                        activeOrbit.classList.add('orbit-hidden');
                    }
                } else if (this.classList.contains('state-completed')) {
                    ripple.style.borderColor = 'var(--primary-blue)';
                } else if (this.classList.contains('state-chest')) {
                    ripple.style.borderColor = 'var(--secondary-orange-dark)';
                }
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                    if (activeOrbit) {
                        activeOrbit.classList.remove('orbit-hidden');
                        void activeOrbit.offsetWidth;
                        activeOrbit.classList.add('orbit-appear');
                    }
                }, 600);
                
            });
        });
    })();
</script>