/**
 * CV Guaguas - Libro Institucional
 * Main JavaScript - IDENTICAL behavior to React
 */

(function() {
    'use strict';

    // DOM Elements
    const toggleBtn = document.getElementById('toggle-indice');
    const sidebar = document.getElementById('sidebar-indice');
    const overlay = document.getElementById('sidebar-overlay');
    const menuIcon = toggleBtn?.querySelector('.menu-icon');
    const closeIcon = toggleBtn?.querySelector('.close-icon');
    const themeBtn = document.getElementById('toggle-theme');
    const sunIcon = themeBtn?.querySelector('.theme-icon-sun');
    const moonIcon = themeBtn?.querySelector('.theme-icon-moon');

    /**
     * Theme Toggle - localStorage + system preference (like React useTheme)
     */
    function getTheme() {
        var stored = localStorage.getItem('cv-guaguas-theme');
        if (stored === 'light' || stored === 'dark') return stored;
        return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    }

    function applyTheme(theme) {
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

    applyTheme(getTheme());

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
        sidebar?.classList.remove('-translate-x-full');
        sidebar?.classList.add('translate-x-0');
        overlay?.classList.remove('hidden');
        menuIcon?.classList.add('hidden');
        closeIcon?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar?.classList.add('-translate-x-full');
        sidebar?.classList.remove('translate-x-0');
        overlay?.classList.add('hidden');
        menuIcon?.classList.remove('hidden');
        closeIcon?.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Event Listeners for sidebar toggle
    toggleBtn?.addEventListener('click', toggleSidebar);
    overlay?.addEventListener('click', closeSidebar);

    /**
     * Accordion Toggle for Subchapters - IDENTICAL to React behavior
     */
    function initAccordions() {
        const accordionToggles = document.querySelectorAll('.sidebar-accordion-toggle');
        
        accordionToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const capitulo = this.closest('.capitulo-item');
                const content = capitulo?.querySelector('.subcapitulos-list');
                const icon = this.querySelector('.chevron-icon');
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                if (!content) return;
                
                if (isExpanded) {
                    // Close
                    content.classList.add('hidden');
                    icon?.classList.remove('rotate-90');
                    this.setAttribute('aria-expanded', 'false');
                } else {
                    // Open
                    content.classList.remove('hidden');
                    icon?.classList.add('rotate-90');
                    this.setAttribute('aria-expanded', 'true');
                }
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
