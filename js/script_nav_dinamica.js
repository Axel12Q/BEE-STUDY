 document.addEventListener('DOMContentLoaded', () => {
            
            // =========================================
            // NAVEGACIÓN DINÁMICA (FETCH) Y MANEJO DE URL
            
            // Actualizado para escuchar también el nuevo botón de configuración en móvil
            const navLinks = document.querySelectorAll('.nav-btn, .mobile-nav-btn, .top-config-btn, .user-profile-info');
            const dynamicContent = document.getElementById('dynamic-content');
            const headerPageTitle = document.getElementById('header-page-title');
            const headerPageIcon = document.getElementById('header-page-icon');

            function loadPage(pageName, updateUrl = true) {
                if (!pageName) return;

                navLinks.forEach(n => {
                    // Solo removemos 'active' de los botones de navegación reales, no de elementos extra
                    if (n.classList.contains('nav-btn') || n.classList.contains('mobile-nav-btn')) {
                        n.classList.remove('active');
                    }
                });

                const activeNavs = document.querySelectorAll(`[data-page="${pageName}"]`);
                activeNavs.forEach(n => {
                    if (n.classList.contains('nav-btn') || n.classList.contains('mobile-nav-btn')) {
                        n.classList.add('active');
                    }
                });

                if (activeNavs.length > 0) {
                    const pcNavNode = Array.from(activeNavs).find(el => el.classList.contains('nav-btn'));
                    if (pcNavNode) {
                        const iconNode = pcNavNode.querySelector('i');
                        const iconHtml = iconNode ? iconNode.outerHTML : '<i class="fa-solid fa-cube"></i>';
                        const pageText = pcNavNode.innerText.trim();
                        if (headerPageTitle && headerPageIcon) {
                            headerPageTitle.innerText = pageText;
                            headerPageIcon.innerHTML = iconHtml;
                        }
                    }
                }

                if (updateUrl) {
                    const newUrl = new URL(window.location);
                    newUrl.searchParams.set('page', pageName);
                    window.history.pushState({
                        page: pageName
                    }, '', newUrl);
                }

                dynamicContent.style.opacity = '0.4';

                fetch(`pages/${pageName}.php`)
                    .then(res => {
                        if (!res.ok) throw new Error('Página no encontrada');
                        return res.text();
                    })
                    .then(html => {
                        dynamicContent.innerHTML = html;
                        dynamicContent.style.opacity = '1';
                        dynamicContent.scrollTop = 0;

                        const scripts = dynamicContent.querySelectorAll('script');
                        scripts.forEach(oldScript => {
                            const newScript = document.createElement('script');
                            Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                            if (oldScript.innerHTML) {
                                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                            }
                            oldScript.parentNode.replaceChild(newScript, oldScript);
                        });
                    })
                    .catch(error => {
                        dynamicContent.innerHTML = `
                            <div class="text-center mt-5 text-muted">
                                <i class="fa-solid fa-person-digging fs-1 text-warning mb-3"></i>
                                <h3>🚧 En construcción</h3>
                                <p>La sección <strong>pages/${pageName}.php</strong> aún no está lista o no existe.</p>
                            </div>`;
                        dynamicContent.style.opacity = '1';
                    });
            }

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Prevenir default solo si es un ancla
                    if (this.tagName === 'A') e.preventDefault();

                    const page = this.getAttribute('data-page');
                    if (page) loadPage(page, true);
                });
            });

            window.addEventListener('popstate', (e) => {
                if (e.state && e.state.page) {
                    loadPage(e.state.page, false);
                } else {
                    loadPage('jugar', false);
                }
            });

            const urlParams = new URLSearchParams(window.location.search);
            const pageFromUrl = urlParams.get('page');

            if (pageFromUrl) {
                loadPage(pageFromUrl, false);
            } else {
                loadPage('jugar', true);
            }

        });