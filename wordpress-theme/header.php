<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <!-- SEO Tags -->
    <meta property="og:title" content="<?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?>">
    <meta property="og:description" content="<?php bloginfo('description'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo LIBRO_URI; ?>/assets/images/hero-stadium.jpg">
    
    <!-- Preconnect para performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN with custom config (identical to React) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            container: {
                center: true,
                padding: '2rem',
            },
            extend: {
                colors: {
                    border: 'hsl(220 30% 22%)',
                    input: 'hsl(220 30% 25%)',
                    ring: 'hsl(45 100% 50%)',
                    background: 'hsl(220 50% 10%)',
                    foreground: 'hsl(0 0% 98%)',
                    gold: {
                        DEFAULT: 'hsl(45 100% 50%)',
                        light: 'hsl(45 100% 60%)',
                        dark: 'hsl(45 100% 40%)',
                        muted: 'hsl(45 60% 45%)',
                    },
                    primary: {
                        DEFAULT: 'hsl(45 100% 50%)',
                        foreground: 'hsl(220 50% 10%)',
                    },
                    secondary: {
                        DEFAULT: 'hsl(220 45% 20%)',
                        foreground: 'hsl(0 0% 95%)',
                    },
                    muted: {
                        DEFAULT: 'hsl(220 30% 22%)',
                        foreground: 'hsl(220 15% 65%)',
                    },
                    accent: {
                        DEFAULT: 'hsl(45 100% 50%)',
                        foreground: 'hsl(220 50% 10%)',
                    },
                    sidebar: {
                        DEFAULT: 'hsl(220 55% 8%)',
                        foreground: 'hsl(0 0% 90%)',
                        primary: 'hsl(45 100% 50%)',
                        'primary-foreground': 'hsl(220 50% 10%)',
                        accent: 'hsl(220 45% 18%)',
                        'accent-foreground': 'hsl(0 0% 98%)',
                        border: 'hsl(220 40% 18%)',
                        ring: 'hsl(45 100% 50%)',
                    },
                },
                fontFamily: {
                    serif: ['Montserrat', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    sans: ['Inter', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                },
                borderRadius: {
                    lg: '0.25rem',
                    md: 'calc(0.25rem - 2px)',
                    sm: 'calc(0.25rem - 4px)',
                },
                keyframes: {
                    'fade-in-up': {
                        from: { opacity: '0', transform: 'translateY(20px)' },
                        to: { opacity: '1', transform: 'translateY(0)' },
                    },
                    'slide-in-left': {
                        from: { opacity: '0', transform: 'translateX(-20px)' },
                        to: { opacity: '1', transform: 'translateX(0)' },
                    },
                },
                animation: {
                    'fade-in-up': 'fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    'slide-in-left': 'slide-in-left 0.5s ease forwards',
                },
            },
        },
    }
    </script>
    
    <!-- Custom styles for components not covered by Tailwind -->
    <style>
        /* === LIGHT MODE OVERRIDES === */
        .light {
            --lm-bg: hsl(40 20% 96%);
            --lm-fg: hsl(220 50% 12%);
            --lm-card: hsl(0 0% 100%);
            --lm-muted: hsl(220 15% 90%);
            --lm-muted-fg: hsl(220 15% 45%);
            --lm-border: hsl(220 15% 85%);
            --lm-gold: hsl(45 100% 42%);
            --lm-sidebar-bg: hsl(40 25% 95%);
            --lm-sidebar-border: hsl(220 15% 88%);
            --lm-sidebar-accent: hsl(40 15% 90%);
        }
        .light { background-color: var(--lm-bg) !important; color: var(--lm-fg) !important; }
        .light .bg-background { background-color: var(--lm-bg) !important; }
        .light .text-foreground { color: var(--lm-fg) !important; }
        .light .bg-sidebar, .light .bg-sidebar\/95 { background-color: var(--lm-sidebar-bg) !important; }
        .light .border-sidebar-border { border-color: var(--lm-sidebar-border) !important; }
        .light .bg-sidebar-accent { background-color: var(--lm-sidebar-accent) !important; }
        .light .text-sidebar-foreground { color: var(--lm-fg) !important; }
        .light .text-sidebar-foreground\/80 { color: hsl(220 50% 12% / 0.8) !important; }
        .light .text-muted-foreground { color: var(--lm-muted-fg) !important; }
        .light .bg-muted { background-color: var(--lm-muted) !important; }
        .light .bg-muted\/30 { background-color: hsl(220 15% 90% / 0.3) !important; }
        .light .border-border { border-color: var(--lm-border) !important; }
        .light .border-border\/30 { border-color: hsl(220 15% 85% / 0.3) !important; }
        .light .border-border\/50 { border-color: hsl(220 15% 85% / 0.5) !important; }
        .light .text-foreground\/85 { color: hsl(220 50% 12% / 0.85) !important; }
        .light .text-foreground\/80 { color: hsl(220 50% 12% / 0.8) !important; }
        .light .text-foreground\/70 { color: hsl(220 50% 12% / 0.7) !important; }
        .light .bg-card\/30 { background-color: hsl(0 0% 100% / 0.3) !important; }
        .light .bg-card\/50 { background-color: hsl(0 0% 100% / 0.5) !important; }
        .light .bg-background\/80 { background-color: hsl(40 20% 96% / 0.8) !important; }
        .light .text-gold { color: var(--lm-gold) !important; }
        .light .bg-gold { background-color: var(--lm-gold) !important; }
        .light .text-gold-muted { color: hsl(45 50% 38%) !important; }
        .light .header-blur { background-color: hsl(40 25% 95% / 0.95) !important; }
        .light .section-header-highlighted { color: hsl(0 0% 100%); background-color: hsl(220 50% 15%); }
        .light .article-number { color: hsl(0 0% 100%); background-color: hsl(220 50% 15%); }

        .light .hero-overlay {
            background: linear-gradient(135deg, hsl(40 20% 95% / 0.85) 0%, hsl(45 40% 80% / 0.6) 50%, hsl(40 20% 95% / 0.9) 100%);
        }
        .light .text-gold-gradient {
            background: linear-gradient(135deg, hsl(45 100% 50%) 0%, hsl(45 100% 42%) 50%, hsl(45 100% 32%) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .light ::-webkit-scrollbar-track { background: var(--lm-bg); }
        .light ::-webkit-scrollbar-thumb { background: hsl(220 15% 82%); }
        .light ::-webkit-scrollbar-thumb:hover { background: hsl(45 50% 38%); }
        .light ::selection { background: hsl(45 100% 42% / 0.25); color: var(--lm-fg); }
        .light .newspaper-quote { background: hsl(220 15% 90% / 0.3); border-left-color: hsl(45 100% 42% / 0.5); color: hsl(220 50% 12% / 0.85); }
        .light .editorial-quote { border-left-color: var(--lm-gold); }
        .light .editorial-quote::before { color: hsl(45 100% 42% / 0.3); }
        .light .timeline-container { border-left-color: var(--lm-gold); }
        .light .timeline-event::before { background: var(--lm-gold); }
        .light .timeline-year { color: var(--lm-gold); }
        .light .timeline-content { color: hsl(220 50% 12% / 0.8); }
        .light .chapter-marker { color: var(--lm-gold); }
        .light .drop-cap { color: var(--lm-gold); }
        .light .btn-download-primary { background-color: var(--lm-gold); border-color: var(--lm-gold); color: hsl(0 0% 100%); }
        .light .btn-download-primary:hover { background-color: transparent; color: var(--lm-gold); }
        .light .btn-download-outline { color: var(--lm-fg); border-color: var(--lm-border); }
        .light .btn-download-outline:hover { border-color: var(--lm-gold); color: var(--lm-gold); }

        /* === DARK MODE (default) STYLES === */
        /* Hero Overlay - identical to React */
        .dark .hero-overlay,
        .hero-overlay {
            background: linear-gradient(
                135deg,
                hsl(220 15% 5% / 0.85) 0%,
                hsl(42 40% 20% / 0.7) 50%,
                hsl(220 15% 5% / 0.9) 100%
            );
        }
        
        /* Text gradient - identical to React */
        .text-gold-gradient {
            background: linear-gradient(
                135deg,
                hsl(45 100% 60%) 0%,
                hsl(45 100% 50%) 50%,
                hsl(45 100% 40%) 100%
            );
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Chapter marker */
        .chapter-marker {
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: hsl(45 100% 50%);
        }
        
        /* Sidebar active indicator */
        .sidebar-active-indicator {
            position: relative;
        }
        .sidebar-active-indicator::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 0;
            background: hsl(45 100% 50%);
            transition: height 0.3s ease;
            border-radius: 0 2px 2px 0;
        }
        .sidebar-active-indicator.active::before {
            height: 60%;
        }
        
        /* Download button styles */
        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: 0.25rem;
            border: 1px solid;
            font-family: 'Inter', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-download-primary {
            background-color: hsl(45 100% 50%);
            color: hsl(220 50% 10%);
            border-color: hsl(45 100% 50%);
        }
        .btn-download-primary:hover {
            background-color: transparent;
            color: hsl(45 100% 50%);
            box-shadow: 0 0 30px hsl(45 100% 50% / 0.2);
        }
        .btn-download-outline {
            background-color: transparent;
            color: hsl(0 0% 98%);
            border-color: hsl(220 30% 22%);
        }
        .btn-download-outline:hover {
            border-color: hsl(45 100% 50%);
            color: hsl(45 100% 50%);
        }
        
        /* Header blur effect */
        .header-blur {
            background-color: hsl(220 55% 8% / 0.95);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: hsl(220 50% 10%); }
        ::-webkit-scrollbar-thumb { background: hsl(220 30% 22%); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: hsl(45 60% 45%); }
        
        /* Selection */
        ::selection {
            background: hsl(45 100% 50% / 0.3);
            color: hsl(0 0% 98%);
        }
        
        /* Animation delays */
        .\[animation-delay\:100ms\] { animation-delay: 100ms; }
        .\[animation-delay\:200ms\] { animation-delay: 200ms; }
        .\[animation-delay\:400ms\] { animation-delay: 400ms; }
        .\[animation-delay\:600ms\] { animation-delay: 600ms; }
        .\[animation-delay\:800ms\] { animation-delay: 800ms; }
        
        /* Editorial Quote - identical to React */
        .editorial-quote {
            position: relative;
            padding-left: 1.5rem;
            border-left: 3px solid hsl(45 100% 50%);
            font-style: italic;
        }
        .editorial-quote::before {
            content: '"';
            position: absolute;
            top: -0.5rem;
            left: 0.5rem;
            font-size: 3rem;
            font-family: Georgia, serif;
            color: hsl(45 100% 50% / 0.3);
            line-height: 1;
        }
        
        /* Content Image hover effect */
        .content-image img {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .content-image:hover img {
            transform: scale(1.02);
        }
        
        /* Reading content typography */
        .reading-content p {
            font-size: 1.125rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }
        .reading-content p:last-child {
            margin-bottom: 0;
        }
        
        /* Card background for Tailwind */
        .bg-card\/30 {
            background-color: hsl(220 45% 20% / 0.3);
        }
        .bg-card\/50 {
            background-color: hsl(220 45% 20% / 0.5);
        }
    </style>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class('dark bg-background text-foreground antialiased'); ?>>
<?php wp_body_open(); ?>

<script>
// Theme detection: localStorage > system preference
(function() {
    var stored = localStorage.getItem('cv-guaguas-theme');
    var theme = stored || (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
    document.body.classList.remove('dark', 'light');
    document.body.classList.add(theme);
})();
</script>

<!-- Fixed Header - identical to React -->
<header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-4 h-[52px] header-blur border-b border-sidebar-border">
    <!-- Menu Toggle Button -->
    <button id="toggle-indice" class="flex items-center gap-2 px-3 py-2 text-foreground hover:text-gold transition-colors duration-300" aria-label="Abrir índice">
        <svg class="menu-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg class="close-icon w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span class="text-sm uppercase tracking-wider font-sans">Menú</span>
    </button>
    
    <div class="flex items-center gap-2">
        <!-- Theme Toggle -->
        <button id="toggle-theme" class="p-2 text-muted-foreground hover:text-gold transition-colors rounded-sm" aria-label="Cambiar tema">
            <svg class="theme-icon-sun w-[18px] h-[18px] hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            <svg class="theme-icon-moon w-[18px] h-[18px] hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
        </button>
        <!-- Logo -->
        <a href="<?php echo home_url(); ?>" class="flex items-center gap-2 px-2 py-1 hover:opacity-80 transition-opacity duration-300">
            <img src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.svg" alt="CV Guaguas" class="h-10 w-auto">
        </a>
    </div>
</header>

<!-- Overlay - IDENTICAL to React (shows on all devices when sidebar is open) -->
<div id="sidebar-overlay" class="fixed inset-0 top-[52px] bg-background/80 backdrop-blur-sm z-40 hidden"></div>