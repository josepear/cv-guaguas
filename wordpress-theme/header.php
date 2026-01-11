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
    
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-background text-foreground antialiased'); ?>>
<?php wp_body_open(); ?>

<!-- Fixed Header -->
<header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-4 py-2 header-blur border-b border-sidebar-border">
    <!-- Menu Toggle Button -->
    <button id="toggle-indice" class="flex items-center gap-2 px-3 py-2 text-foreground hover:text-gold transition-colors" aria-label="Abrir índice">
        <svg class="menu-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg class="close-icon w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span class="text-sm uppercase tracking-wider font-sans">Menú</span>
    </button>
    
    <!-- Logo -->
    <a href="<?php echo home_url(); ?>" class="flex items-center gap-2 px-2 py-1 hover:opacity-80 transition-opacity">
        <img src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.svg" alt="CV Guaguas" class="h-10 w-auto">
    </a>
</header>

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="lg:hidden fixed inset-0 bg-background/80 backdrop-blur-sm z-40 hidden"></div>
