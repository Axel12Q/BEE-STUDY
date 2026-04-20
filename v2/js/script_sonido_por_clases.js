document.addEventListener('DOMContentLoaded', () => {
    // SISTEMA DE SONIDOS POR CLASES (Event Delegation)
    // =========================================
    const sfxNav = document.getElementById('sfx-nav');
    const sfxAction = document.getElementById('sfx-action');
    const sfxList = document.getElementById('sfx-list');

    const playSound = (audioEl) => {
        if (audioEl) {
            audioEl.currentTime = 0;
            audioEl.play().catch(e => console.log('El navegador bloqueó el autoplay del audio.'));
        }
    };

    document.addEventListener('click', (e) => {
        if (e.target.closest('.sound-nav') || e.target.closest('.nav-btn') || e.target.closest('.mobile-nav-btn') || e.target.closest('.path-node')) {
            playSound(sfxNav);
        } else if (e.target.closest('.sound-action') || e.target.closest('.btn') || e.target.closest('.shop-item-card-hz')) {
            playSound(sfxAction);
        } else if (e.target.closest('.sound-item') || e.target.closest('.dropdown-item') || e.target.closest('.rec-item')) {
            playSound(sfxList);
        } else if (e.target.closest('.sound-default')) {
            playSound(sfxNav);
        }
    });
});