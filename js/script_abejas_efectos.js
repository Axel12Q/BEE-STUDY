
document.addEventListener('DOMContentLoaded', () => {
    // =========================================
    // EFECTOS DE MOUSE Y MIEL TÁCTIL
    // =========================================
    const mouseEffectContainer = document.getElementById('mouse-effect-container');
    const cursorIlluminator = document.getElementById('cursor-illuminator');
    let particleInterval;

    function handlePointerMove(clientX, clientY) {
        cursorIlluminator.style.left = `${clientX}px`;
        cursorIlluminator.style.top = `${clientY}px`;
        cursorIlluminator.style.display = 'block';

        if (!particleInterval) {
            particleInterval = setTimeout(() => {
                createHoneyParticle(clientX, clientY);
                particleInterval = null;
            }, 40);
        }
    }

    document.addEventListener('mousemove', (e) => {
        handlePointerMove(e.clientX, e.clientY);
    });

    document.addEventListener('touchmove', (e) => {
        if (e.touches.length > 0) {
            handlePointerMove(e.touches[0].clientX, e.touches[0].clientY);
        }
    }, {
        passive: true
    });

    document.addEventListener('mouseleave', () => {
        cursorIlluminator.style.display = 'none';
    });
    document.addEventListener('touchend', () => {
        cursorIlluminator.style.display = 'none';
    });

    function createHoneyParticle(x, y) {
        const particle = document.createElement('div');
        particle.classList.add('honey-particle');
        const offset = 8;
        particle.style.left = `${x + (Math.random() - 0.5) * offset}px`;
        particle.style.top = `${y + (Math.random() - 0.5) * offset}px`;
        mouseEffectContainer.appendChild(particle);
        setTimeout(() => particle.remove(), 1000);
    }

    // =========================================
    // SISTEMA DE ABEJAS VOLADORAS CON RASTRO
    // =========================================
    const activeBees = [];

    function spawnTinyBee() {
        const container = document.getElementById('flying-bees-container');
        if (!container) return;

        const wrapper = document.createElement('div');
        wrapper.className = 'tiny-bee-wrapper';

        const rotator = document.createElement('div');
        rotator.className = 'tiny-bee-rotator';

        const inner = document.createElement('div');
        inner.className = 'tiny-bee-inner';
        inner.innerText = '🐝';

        let startX, startY;
        if (Math.random() < 0.8) {
            const edge = Math.floor(Math.random() * 4);
            if (edge === 0) {
                startX = Math.random() * 100;
                startY = -10;
            } else if (edge === 1) {
                startX = 110;
                startY = Math.random() * 100;
            } else if (edge === 2) {
                startX = Math.random() * 100;
                startY = 110;
            } else {
                startX = -10;
                startY = Math.random() * 100;
            }
        } else {
            startX = 20 + Math.random() * 60;
            startY = 20 + Math.random() * 60;
        }

        wrapper.style.left = `${startX}%`;
        wrapper.style.top = `${startY}%`;

        const paths = ['fly-path-1', 'fly-path-2', 'fly-path-3', 'fly-path-4'];
        const path = paths[Math.floor(Math.random() * paths.length)];
        const duration = 6 + Math.random() * 6;

        wrapper.style.animation = `${path} ${duration}s linear forwards`;
        inner.style.setProperty('--flight-duration', `${duration}s`);

        rotator.appendChild(inner);
        wrapper.appendChild(rotator);
        container.appendChild(wrapper);

        const beeTracker = {
            wrapper,
            rotator,
            lastX: null,
            lastY: null
        };
        activeBees.push(beeTracker);

        setTimeout(() => {
            wrapper.remove();
            const index = activeBees.indexOf(beeTracker);
            if (index > -1) activeBees.splice(index, 1);
        }, duration * 1000);
    }

    function createBeeTrailParticle(x, y) {
        const container = document.getElementById('flying-bees-container');
        if (!container) return;

        const particle = document.createElement('div');
        particle.classList.add('bee-trail-particle');

        const offset = 10;
        particle.style.left = `${x + (Math.random() - 0.5) * offset}px`;
        particle.style.top = `${y + (Math.random() - 0.5) * offset}px`;

        container.appendChild(particle);

        setTimeout(() => particle.remove(), 1500);
    }

    function updateBeeRotations() {
        activeBees.forEach(bee => {
            const rect = bee.wrapper.getBoundingClientRect();
            const currentX = rect.left + (rect.width / 2);
            const currentY = rect.top + (rect.height / 2);

            if (bee.lastX !== null && bee.lastY !== null) {
                const dx = currentX - bee.lastX;
                const dy = currentY - bee.lastY;

                if (Math.abs(dx) > 0.2 || Math.abs(dy) > 0.2) {
                    const angle = Math.atan2(dy, dx) * (180 / Math.PI);
                    let rotation = angle - 180;
                    let flip = '';

                    if (angle > -90 && angle < 90) {
                        flip = 'scaleY(-1)';
                    }
                    bee.rotator.style.transform = `rotate(${rotation}deg) ${flip}`;

                    if (Math.random() < 0.15) {
                        createBeeTrailParticle(currentX, currentY);
                    }
                }
            }
            bee.lastX = currentX;
            bee.lastY = currentY;
        });
        requestAnimationFrame(updateBeeRotations);
    }

    requestAnimationFrame(updateBeeRotations);
    setInterval(spawnTinyBee, 1500);
    setTimeout(spawnTinyBee, 100);
});