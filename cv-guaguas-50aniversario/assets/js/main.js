/**
 * CV Guaguas - Libro Institucional
 * Main JavaScript - IDENTICAL behavior to React
 */

(function() {
    'use strict';

    // DOM Elements
    const toggleBtn = document.getElementById('toggle-indice');
    const sidebar = document.getElementById('sidebar-indice');
    const menuIcon = toggleBtn?.querySelector('.menu-icon');
    const closeIcon = toggleBtn?.querySelector('.close-icon');
    const themeBtn = document.getElementById('toggle-theme');
    const sunIcon = themeBtn?.querySelector('.theme-icon-sun');
    const moonIcon = themeBtn?.querySelector('.theme-icon-moon');
    let sidebarCloseTimer = null;

    /**
     * Theme Toggle - localStorage + system preference (like React useTheme)
     */
    function getTheme() {
        var stored = localStorage.getItem('cv-guaguas-theme');
        if (stored === 'light' || stored === 'dark') return stored;
        return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    }

    function applyTheme(theme, skipTransitionLock = false) {
        if (!skipTransitionLock) {
            document.body.classList.add('theme-switching');
            requestAnimationFrame(function() {
                requestAnimationFrame(function() {
                    document.body.classList.remove('theme-switching');
                });
            });
        }

        document.body.classList.remove('dark', 'light');
        document.body.classList.add(theme);

        // Update icons
        if (sunIcon && moonIcon) {
            if (theme === 'dark') {
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            } else {
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            }
        }
    }

    applyTheme(getTheme(), true);

    themeBtn?.addEventListener('click', function() {
        var current = document.body.classList.contains('dark') ? 'dark' : 'light';
        var next = current === 'dark' ? 'light' : 'dark';
        localStorage.setItem('cv-guaguas-theme', next);
        applyTheme(next);
    });

    // Listen for system preference changes
    window.matchMedia('(prefers-color-scheme: light)').addEventListener('change', function() {
        if (!localStorage.getItem('cv-guaguas-theme')) {
            applyTheme(getTheme());
        }
    });

    /**
     * Toggle Sidebar - works identically on all devices (like React)
     */
    function toggleSidebar() {
        const isOpen = sidebar?.classList.contains('translate-x-0');
        
        if (isOpen) {
            closeSidebar();
        } else {
            openSidebar();
        }
    }

    function openSidebar() {
        if (sidebarCloseTimer) {
            window.clearTimeout(sidebarCloseTimer);
            sidebarCloseTimer = null;
        }

        document.body.classList.remove('sidebar-is-closing');
        sidebar?.classList.remove('-translate-x-full');
        sidebar?.classList.add('translate-x-0');
        menuIcon?.classList.add('hidden');
        closeIcon?.classList.remove('hidden');
        document.body.classList.add('sidebar-is-open');
        toggleBtn?.setAttribute('aria-expanded', 'true');
    }

    function closeSidebar() {
        sidebar?.classList.add('-translate-x-full');
        sidebar?.classList.remove('translate-x-0');
        menuIcon?.classList.remove('hidden');
        closeIcon?.classList.add('hidden');
        document.body.classList.remove('sidebar-is-open');
        document.body.classList.add('sidebar-is-closing');
        toggleBtn?.setAttribute('aria-expanded', 'false');

        // Conserva el estado de cierre hasta que termina la animación suave.
        sidebarCloseTimer = window.setTimeout(function() {
            document.body.classList.remove('sidebar-is-closing');
            sidebarCloseTimer = null;
        }, 720);
    }

    // Event Listeners for sidebar toggle
    toggleBtn?.addEventListener('click', toggleSidebar);

    /**
     * Accordion Toggle for Subchapters - IDENTICAL to React behavior
     */
    function initAccordions() {
        const accordionToggles = document.querySelectorAll('.sidebar-accordion-toggle');
        
        function toggleAccordion(capitulo) {
            const content = capitulo?.querySelector('.subcapitulos-list');
            const chevronBtn = capitulo?.querySelector('.sidebar-accordion-toggle');
            const icon = chevronBtn?.querySelector('.chevron-icon');
            const isExpanded = chevronBtn?.getAttribute('aria-expanded') === 'true';
            
            if (!content) return;
            
            if (isExpanded) {
                content.classList.add('hidden');
                icon?.classList.remove('rotate-90');
                chevronBtn?.setAttribute('aria-expanded', 'false');
            } else {
                content.classList.remove('hidden');
                icon?.classList.add('rotate-90');
                chevronBtn?.setAttribute('aria-expanded', 'true');
            }
        }
        
        accordionToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                toggleAccordion(this.closest('.capitulo-item'));
            });
        });
        
    }

    initAccordions();

    /**
     * Close sidebar when clicking on chapter links (like React onClose)
     */
    function initChapterLinkClose() {
        const allLinks = document.querySelectorAll('#sidebar-indice a');
        
        allLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Close sidebar after click (like React onClose prop)
                closeSidebar();
            });
        });
    }

    initChapterLinkClose();

    /**
     * Lazy Loading for Images
     */
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '100px 0px',
            threshold: 0.1
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    /**
     * Reading Progress Bar
     */
    function updateReadingProgress() {
        const progressBar = document.getElementById('reading-progress');
        if (!progressBar) return;

        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        
        progressBar.style.width = `${Math.min(progress, 100)}%`;
    }

    window.addEventListener('scroll', updateReadingProgress);
    updateReadingProgress(); // Initial call

    /**
     * Close sidebar on Escape key
     */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar?.classList.contains('translate-x-0')) {
            closeSidebar();
        }
    });

    /**
     * Keyboard Navigation for Accessibility
     */
    document.querySelectorAll('.sidebar-accordion-toggle').forEach(toggle => {
        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    /**
     * Inline SVG Icon Loader with Color Support
     * Loads SVG files and applies custom colors
     */
    function initInlineSvgIcons() {
        const svgContainers = document.querySelectorAll('.inline-svg-icon');
        
        svgContainers.forEach(async container => {
            const src = container.dataset.src;
            const color = container.dataset.color;
            
            if (!src) return;
            
            try {
                const response = await fetch(src);
                if (!response.ok) throw new Error('Failed to load SVG');
                
                let svgText = await response.text();
                
                // Parse SVG
                const parser = new DOMParser();
                const doc = parser.parseFromString(svgText, 'image/svg+xml');
                const svgElement = doc.querySelector('svg');
                
                if (!svgElement) throw new Error('Invalid SVG');
                
                // Get dimensions from container style
                const containerStyle = container.getAttribute('style');
                const widthMatch = containerStyle.match(/width:\s*(\d+)px/);
                const heightMatch = containerStyle.match(/height:\s*(\d+)px/);
                
                if (widthMatch) svgElement.setAttribute('width', widthMatch[1]);
                if (heightMatch) svgElement.setAttribute('height', heightMatch[1]);
                
                // Apply color if provided
                if (color) {
                    const elements = svgElement.querySelectorAll('*');
                    elements.forEach(el => {
                        const fill = el.getAttribute('fill');
                        const stroke = el.getAttribute('stroke');
                        
                        if (fill && fill !== 'none') {
                            el.setAttribute('fill', color);
                        }
                        if (stroke && stroke !== 'none') {
                            el.setAttribute('stroke', color);
                        }
                    });
                    
                    // Also set on root SVG
                    const rootFill = svgElement.getAttribute('fill');
                    if (rootFill && rootFill !== 'none') {
                        svgElement.setAttribute('fill', color);
                    }
                }
                
                // Add drop-shadow class
                svgElement.classList.add('drop-shadow-lg');
                
                // Replace container with SVG
                container.innerHTML = svgElement.outerHTML;
                
            } catch (error) {
                console.error('Error loading SVG:', error);
                // Fallback to img tag
                container.innerHTML = '<img src="' + src + '" alt="" style="' + container.getAttribute('style') + ' object-fit: contain;" class="drop-shadow-lg">';
            }
        });
    }

    initInlineSvgIcons();

    /**
     * Scroll-Reveal Animations via IntersectionObserver
     * Replicates React useScrollReveal hook behavior
     */
    function initScrollReveal() {
        if (!('IntersectionObserver' in window)) {
            // Fallback: show everything immediately
            document.querySelectorAll('[data-reveal]').forEach(el => el.classList.add('revealed'));
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2
        });

        document.querySelectorAll('[data-reveal]').forEach(el => observer.observe(el));
    }

    initScrollReveal();

    /**
     * Parallax Effect for Chapter Hero Background
     * Replicates React framer-motion useScroll + useTransform
     */
    function initHeroParallax() {
        const heroEl = document.querySelector('.chapter-hero');
        const heroBg = heroEl?.querySelector('.hero-bg-parallax');
        if (!heroEl || !heroBg) return;

        function updateParallax() {
            const rect = heroEl.getBoundingClientRect();
            const heroHeight = heroEl.offsetHeight;
            const viewportHeight = window.innerHeight;

            // Progress: 0 when top of hero is at top of viewport, 1 when bottom of hero reaches top
            const progress = Math.max(0, Math.min(1, -rect.top / (heroHeight + viewportHeight - heroHeight)));
            
            // Map progress [0,1] → translateY [0%, 20%] (matches React: ["0%", "20%"])
            const scrollFraction = Math.max(0, Math.min(1, (window.scrollY) / (heroHeight)));
            const yOffset = scrollFraction * 20;
            heroBg.style.transform = 'scale(1.1) translateY(' + yOffset + '%)';
        }

        window.addEventListener('scroll', updateParallax, { passive: true });
        updateParallax();
    }

    initHeroParallax();

})();

/**
 * Banner de cookies — CV Guaguas
 * Preferencias guardadas en localStorage bajo la clave 'cv-cookie-consent'
 */
(function() {
    'use strict';

    var STORAGE_KEY = 'cv-cookie-consent';
    var banner      = document.getElementById('cv-cookie-banner');
    var panel       = document.getElementById('cv-cookie-panel');
    var toggleAnalytics = document.getElementById('cv-toggle-analytics');
    var toggleSocial    = document.getElementById('cv-toggle-social');

    if (!banner) return;

    // ── Leer preferencia guardada ──────────────────────────────
    function getConsent() {
        try { return JSON.parse(localStorage.getItem(STORAGE_KEY)); } catch(e) { return null; }
    }

    function saveConsent(analytics, social) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify({
            analytics: analytics,
            social:    social,
            date:      new Date().toISOString()
        }));
    }

    // ── Mostrar / ocultar banner ───────────────────────────────
    function showBanner() {
        banner.style.display = 'block';
        banner.setAttribute('aria-hidden', 'false');
    }

    function hideBanner() {
        banner.style.display = 'none';
        banner.setAttribute('aria-hidden', 'true');
    }

    // Mostrar solo si no hay preferencia guardada
    if (!getConsent()) {
        showBanner();
    }

    // ── Acciones de los botones principales ───────────────────
    document.getElementById('cv-cookie-accept').addEventListener('click', function() {
        saveConsent(true, true);
        hideBanner();
    });

    document.getElementById('cv-cookie-reject').addEventListener('click', function() {
        saveConsent(false, false);
        hideBanner();
    });

    document.getElementById('cv-cookie-close').addEventListener('click', function() {
        saveConsent(false, false);
        hideBanner();
    });

    // ── Panel de gestión ──────────────────────────────────────
    document.getElementById('cv-cookie-manage-toggle').addEventListener('click', function() {
        var isOpen = panel.classList.contains('is-open');
        panel.classList.toggle('is-open', !isOpen);
        panel.setAttribute('aria-hidden', isOpen ? 'true' : 'false');
        this.textContent = isOpen ? 'Gestionar preferencias' : 'Ocultar preferencias';
    });

    // Toggles individuales
    function initToggle(btn) {
        if (!btn) return;
        btn.addEventListener('click', function() {
            var checked = this.getAttribute('aria-checked') === 'true';
            this.setAttribute('aria-checked', checked ? 'false' : 'true');
        });
    }
    initToggle(toggleAnalytics);
    initToggle(toggleSocial);

    // Guardar preferencias del panel
    document.getElementById('cv-cookie-save').addEventListener('click', function() {
        var analytics = toggleAnalytics ? toggleAnalytics.getAttribute('aria-checked') === 'true' : false;
        var social    = toggleSocial    ? toggleSocial.getAttribute('aria-checked')    === 'true' : false;
        saveConsent(analytics, social);
        hideBanner();
    });

})();

// ── Anclas internas del sidebar (scroll suave dentro de la misma página) ──
(function() {
    function doScroll(id, smooth) {
        var target = document.getElementById(id);
        if (!target) return false;
        var headerOffset = 80; // compensar header fijo
        var top = target.getBoundingClientRect().top + window.pageYOffset - headerOffset;
        window.scrollTo({ top: top, behavior: smooth ? 'smooth' : 'auto' });
        return true;
    }

    // Las imágenes con loading="lazy" y sin width/height reservan 0px hasta cargar,
    // lo que desplaza el documento hacia abajo justo después del primer scroll.
    // Esperamos a que las imágenes ANTERIORES al ancla terminen de cargar (o forzamos
    // su carga si siguen en lazy) antes de hacer el scroll definitivo.
    function imagesBeforeTarget(target) {
        var all = document.querySelectorAll('img');
        var before = [];
        all.forEach(function(img) {
            // Solo nos interesan imágenes que aparecen antes del target en el documento
            if (target.compareDocumentPosition(img) & Node.DOCUMENT_POSITION_PRECEDING) {
                before.push(img);
            }
        });
        return before;
    }

    function scrollToAnchor(id) {
        var target = document.getElementById(id);
        if (!target) return false;

        // Forzar carga inmediata de imágenes lazy anteriores al ancla,
        // para que reserven su altura real antes de calcular el scroll
        var imgs = imagesBeforeTarget(target);
        imgs.forEach(function(img) {
            if (img.loading === 'lazy') img.loading = 'eager';
        });

        // Primer scroll inmediato (mejor esfuerzo, sin esperar)
        doScroll(id, true);

        var pending = imgs.filter(function(img) { return !img.complete; });

        if (pending.length === 0) {
            // No hay imágenes pendientes: un par de reintentos por seguridad y listo
            requestAnimationFrame(function() {
                doScroll(id, true);
                setTimeout(function() { doScroll(id, true); }, 300);
            });
            return true;
        }

        // Recalcular el scroll cada vez que una imagen pendiente termine de cargar
        var remaining = pending.length;
        function onImgDone() {
            remaining--;
            doScroll(id, false); // sin "smooth" para evitar peleas con scrolls en curso
            if (remaining <= 0) {
                // Último ajuste suave una vez todo ha cargado
                setTimeout(function() { doScroll(id, true); }, 50);
            }
        }
        pending.forEach(function(img) {
            img.addEventListener('load', onImgDone, { once: true });
            img.addEventListener('error', onImgDone, { once: true });
        });

        // Red de seguridad: si alguna imagen nunca dispara load/error, no nos quedamos colgados
        setTimeout(function() { doScroll(id, true); }, 1200);

        return true;
    }

    // Clic en un enlace de ancla del sidebar
    document.addEventListener('click', function(e) {
        var link = e.target.closest('.sidebar-anchor-link');
        if (!link) return;

        var href = link.getAttribute('href') || '';
        var hashIndex = href.indexOf('#');
        if (hashIndex === -1) return;

        var anchorId = href.substring(hashIndex + 1);
        var currentPath = window.location.pathname.replace(/\/$/, '');
        var linkPath = href.split('#')[0].replace(/\/$/, '');

        // Si ya estamos en la misma página, hacemos scroll directo sin recargar
        if (linkPath === '' || currentPath.endsWith(linkPath) || linkPath.endsWith(currentPath)) {
            e.preventDefault();
            history.pushState(null, '', '#' + anchorId);

            // Cerrar sidebar en móvil ANTES de calcular el scroll, para que el
            // cierre no desplace el layout después de haber hecho scrollTo
            var sidebar = document.getElementById('sidebar-indice');
            var sidebarWasOpen = sidebar && window.innerWidth < 1024 && !sidebar.classList.contains('-translate-x-full');
            if (sidebarWasOpen) {
                sidebar.classList.add('-translate-x-full');
                setTimeout(function() { scrollToAnchor(anchorId); }, 320);
            } else {
                scrollToAnchor(anchorId);
            }
        }
        // Si es otra página, deja que el navegador navegue normalmente con el hash
    });

    // Al cargar la página, si la URL ya trae un hash, hacer scroll tras pintar el contenido
    window.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash) {
            var id = window.location.hash.substring(1);
            setTimeout(function() {
                scrollToAnchor(id);
            }, 200);
        }
    });

    // Reforzar tras la carga completa de la página (todas las imágenes ya tienen su tamaño final)
    window.addEventListener('load', function() {
        if (window.location.hash) {
            var id = window.location.hash.substring(1);
            doScroll(id, true);
        }
    });
})();
