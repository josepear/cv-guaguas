/**
 * CV Guaguas - Libro Institucional
 * Main JavaScript
 */

(function() {
    'use strict';

    // DOM Elements
    const toggleBtn = document.getElementById('toggle-indice');
    const sidebar = document.getElementById('sidebar-indice');
    const overlay = document.getElementById('sidebar-overlay');
    const menuIcon = toggleBtn?.querySelector('.menu-icon');
    const closeIcon = toggleBtn?.querySelector('.close-icon');
    const chapterLinks = document.querySelectorAll('.capitulo-link');
    const sections = document.querySelectorAll('.capitulo-section');
    const accordionToggles = document.querySelectorAll('.accordion-toggle');

    /**
     * Toggle Mobile Sidebar
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
     * Accordion Toggle for Subchapters
     */
    function initAccordions() {
        accordionToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const accordionItem = this.closest('.accordion-item');
                const content = accordionItem?.querySelector('.accordion-content');
                const icon = this.querySelector('.accordion-icon');
                
                if (!content) return;
                
                const isOpen = !content.classList.contains('hidden');
                
                if (isOpen) {
                    // Close accordion
                    content.style.maxHeight = content.scrollHeight + 'px';
                    content.offsetHeight; // Force reflow
                    content.style.maxHeight = '0';
                    content.style.opacity = '0';
                    
                    setTimeout(() => {
                        content.classList.add('hidden');
                        content.style.maxHeight = '';
                        content.style.opacity = '';
                    }, 300);
                    
                    icon?.classList.remove('rotate-180');
                    accordionItem?.classList.remove('is-open');
                } else {
                    // Open accordion
                    content.classList.remove('hidden');
                    content.style.maxHeight = '0';
                    content.style.opacity = '0';
                    content.offsetHeight; // Force reflow
                    content.style.maxHeight = content.scrollHeight + 'px';
                    content.style.opacity = '1';
                    
                    setTimeout(() => {
                        content.style.maxHeight = '';
                        content.style.opacity = '';
                    }, 300);
                    
                    icon?.classList.add('rotate-180');
                    accordionItem?.classList.add('is-open');
                }
            });
        });
    }

    /**
     * Expand accordion if it contains the active section
     */
    function expandActiveAccordion() {
        const activeLink = document.querySelector('.capitulo-link.active, .sub-capitulo-link.active');
        
        if (activeLink) {
            const accordionItem = activeLink.closest('.accordion-item');
            const content = accordionItem?.querySelector('.accordion-content');
            const icon = accordionItem?.querySelector('.accordion-icon');
            
            if (content && content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon?.classList.add('rotate-180');
                accordionItem?.classList.add('is-open');
            }
        }
    }

    // Initialize accordions
    initAccordions();
    expandActiveAccordion();

    /**
     * Smooth Scroll for Chapter Links
     */
    function initSmoothScroll() {
        const allLinks = document.querySelectorAll('.capitulo-link, .sub-capitulo-link');
        
        allLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Only handle anchor links
                if (!href || !href.startsWith('#')) return;
                
                e.preventDefault();
                
                const targetId = href.substring(1);
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    // Close mobile sidebar first
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                    
                    // Smooth scroll to section
                    setTimeout(() => {
                        const headerOffset = 80;
                        const elementPosition = targetSection.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }, 100);
                }
            });
        });
    }

    initSmoothScroll();

    /**
     * Scroll Spy - Highlight Active Section
     */
    function updateActiveSection() {
        let currentSection = '';
        const scrollPosition = window.scrollY + 150;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });

        // Update active state in sidebar
        const allLinks = document.querySelectorAll('.capitulo-link, .sub-capitulo-link');
        
        allLinks.forEach(link => {
            const sectionId = link.getAttribute('data-section') || link.getAttribute('href')?.substring(1);
            
            if (sectionId === currentSection) {
                link.classList.add('active', 'text-gold', 'bg-sidebar-accent/50');
                
                // Expand parent accordion if this is a sub-chapter
                const accordionItem = link.closest('.accordion-item');
                const content = accordionItem?.querySelector('.accordion-content');
                const icon = accordionItem?.querySelector('.accordion-icon');
                
                if (content && content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    icon?.classList.add('rotate-180');
                    accordionItem?.classList.add('is-open');
                }
            } else {
                link.classList.remove('active', 'text-gold', 'bg-sidebar-accent/50');
            }
        });
    }

    // Throttled scroll handler
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            window.cancelAnimationFrame(scrollTimeout);
        }
        scrollTimeout = window.requestAnimationFrame(updateActiveSection);
    });

    // Initial call
    updateActiveSection();

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
        const progress = (scrollTop / docHeight) * 100;
        
        progressBar.style.width = `${Math.min(progress, 100)}%`;
    }

    window.addEventListener('scroll', updateReadingProgress);

    /**
     * Close sidebar on Escape key
     */
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar?.classList.contains('translate-x-0')) {
            closeSidebar();
        }
    });

    /**
     * Handle resize - close mobile sidebar on desktop
     */
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            sidebar?.classList.remove('-translate-x-full');
            sidebar?.classList.add('translate-x-0');
            overlay?.classList.add('hidden');
            document.body.style.overflow = '';
        } else {
            if (!sidebar?.classList.contains('translate-x-0')) {
                sidebar?.classList.add('-translate-x-full');
            }
        }
    });

    /**
     * Keyboard Navigation for Accessibility
     */
    accordionToggles.forEach(toggle => {
        toggle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

})();
