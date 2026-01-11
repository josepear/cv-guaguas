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

})();
