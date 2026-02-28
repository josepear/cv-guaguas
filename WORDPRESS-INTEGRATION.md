# 📚 Plantilla WordPress - Libro Institucional

Esta plantilla está diseñada para mostrar el contenido completo de un libro institucional con un diseño editorial moderno, similar a [https://xxegc.ciudaddeportivagc.com/](https://xxegc.ciudaddeportivagc.com/).

## 🎨 Características

- **Hero full-screen** con overlay dorado/oscuro
- **Sidebar sticky** con índice de capítulos (20+ secciones)
- **Scroll suave** con indicador de sección activa
- **Tipografía editorial** (Playfair Display + Inter)
- **Botones de descarga** PDF/EPUB
- **Footer institucional** con logos
- **100% responsive** (mobile-first)

---

## 🔧 Integración con WordPress

### Estructura de archivos para el tema

```
/wp-content/themes/libro-institucional/
├── style.css
├── functions.php
├── header.php
├── footer.php
├── sidebar-indice.php
├── template-home.php
├── template-capitulo.php
├── assets/
│   ├── css/
│   │   └── main.css
│   ├── js/
│   │   └── main.js
│   └── images/
└── inc/
    ├── custom-post-types.php
    └── shortcodes.php
```

---

### 1. style.css (Theme Header)

```css
/*
Theme Name: Libro Institucional
Theme URI: https://tu-sitio.com
Author: Tu Nombre
Author URI: https://tu-sitio.com
Description: Plantilla para libros institucionales con índice lateral
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: libro-institucional
*/

/* Importar los estilos principales */
@import url('./assets/css/main.css');
```

---

### 2. functions.php

```php
<?php
/**
 * Libro Institucional - Functions
 */

// Definir constantes del tema
define('LIBRO_VERSION', '1.0.0');
define('LIBRO_DIR', get_template_directory());
define('LIBRO_URI', get_template_directory_uri());

/**
 * Enqueue scripts y styles
 */
function libro_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'libro-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Estilos principales
    wp_enqueue_style(
        'libro-main',
        LIBRO_URI . '/assets/css/main.css',
        array('libro-fonts'),
        LIBRO_VERSION
    );
    
    // JavaScript principal
    wp_enqueue_script(
        'libro-main',
        LIBRO_URI . '/assets/js/main.js',
        array(),
        LIBRO_VERSION,
        true
    );
    
    // Pasar variables a JS
    wp_localize_script('libro-main', 'libroVars', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'siteUrl' => home_url(),
    ));
}
add_action('wp_enqueue_scripts', 'libro_enqueue_assets');

/**
 * Registrar Custom Post Type: Capítulos
 */
function libro_register_capitulos_cpt() {
    $labels = array(
        'name'               => 'Capítulos',
        'singular_name'      => 'Capítulo',
        'menu_name'          => 'Libro',
        'add_new'            => 'Añadir capítulo',
        'add_new_item'       => 'Añadir nuevo capítulo',
        'edit_item'          => 'Editar capítulo',
        'new_item'           => 'Nuevo capítulo',
        'view_item'          => 'Ver capítulo',
        'search_items'       => 'Buscar capítulos',
        'not_found'          => 'No se encontraron capítulos',
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'capitulo'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'show_in_rest'       => true, // Gutenberg compatible
    );
    
    register_post_type('capitulo', $args);
}
add_action('init', 'libro_register_capitulos_cpt');

/**
 * Registrar campos personalizados con ACF (opcional)
 */
function libro_register_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_capitulo',
            'title' => 'Datos del Capítulo',
            'fields' => array(
                array(
                    'key' => 'field_numero_capitulo',
                    'label' => 'Número de Capítulo',
                    'name' => 'numero_capitulo',
                    'type' => 'text',
                    'instructions' => 'Ej: 01, 02, etc. Dejar vacío para prólogo/epílogo',
                ),
                array(
                    'key' => 'field_mostrar_marcador',
                    'label' => 'Mostrar marcador de capítulo',
                    'name' => 'mostrar_marcador',
                    'type' => 'true_false',
                    'default_value' => 1,
                ),
                array(
                    'key' => 'field_cita_destacada',
                    'label' => 'Cita destacada',
                    'name' => 'cita_destacada',
                    'type' => 'textarea',
                ),
                array(
                    'key' => 'field_autor_cita',
                    'label' => 'Autor de la cita',
                    'name' => 'autor_cita',
                    'type' => 'text',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'capitulo',
                    ),
                ),
            ),
        ));
    }
}
add_action('acf/init', 'libro_register_acf_fields');

/**
 * Shortcode para índice automático
 * Uso: [indice_libro]
 */
function libro_shortcode_indice($atts) {
    $capitulos = get_posts(array(
        'post_type'      => 'capitulo',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));
    
    if (empty($capitulos)) {
        return '<p>No hay capítulos disponibles.</p>';
    }
    
    ob_start();
    ?>
    <nav class="indice-libro">
        <ul class="lista-capitulos">
            <?php foreach ($capitulos as $cap) : 
                $numero = get_field('numero_capitulo', $cap->ID);
                $slug = sanitize_title($cap->post_title);
            ?>
            <li class="capitulo-item">
                <a href="#<?php echo esc_attr($slug); ?>" class="capitulo-link">
                    <?php if ($numero) : ?>
                        <span class="capitulo-numero"><?php echo esc_html($numero); ?></span>
                    <?php endif; ?>
                    <span class="capitulo-titulo"><?php echo esc_html($cap->post_title); ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php
    return ob_get_clean();
}
add_shortcode('indice_libro', 'libro_shortcode_indice');

/**
 * Shortcode para mostrar contenido de capítulos
 * Uso: [contenido_libro]
 */
function libro_shortcode_contenido($atts) {
    $capitulos = get_posts(array(
        'post_type'      => 'capitulo',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));
    
    if (empty($capitulos)) {
        return '';
    }
    
    ob_start();
    foreach ($capitulos as $cap) :
        $numero = get_field('numero_capitulo', $cap->ID);
        $mostrar_marcador = get_field('mostrar_marcador', $cap->ID);
        $cita = get_field('cita_destacada', $cap->ID);
        $autor_cita = get_field('autor_cita', $cap->ID);
        $slug = sanitize_title($cap->post_title);
    ?>
    <section id="<?php echo esc_attr($slug); ?>" class="capitulo-section scroll-mt-24 py-16 md:py-24 border-b border-border/30">
        <header class="capitulo-header mb-8 md:mb-12">
            <?php if ($mostrar_marcador && $numero) : ?>
                <span class="chapter-marker block mb-4">Capítulo <?php echo esc_html($numero); ?></span>
            <?php endif; ?>
            <h2 class="font-serif text-3xl md:text-4xl lg:text-5xl text-foreground leading-tight">
                <?php echo esc_html($cap->post_title); ?>
            </h2>
        </header>
        
        <div class="reading-content text-foreground/85">
            <?php echo apply_filters('the_content', $cap->post_content); ?>
            
            <?php if ($cita) : ?>
            <blockquote class="editorial-quote my-8 md:my-12 py-4">
                <p class="text-xl md:text-2xl text-foreground/90 leading-relaxed mb-4">
                    <?php echo esc_html($cita); ?>
                </p>
                <?php if ($autor_cita) : ?>
                <footer class="text-sm text-muted-foreground">
                    <cite class="not-italic font-medium"><?php echo esc_html($autor_cita); ?></cite>
                </footer>
                <?php endif; ?>
            </blockquote>
            <?php endif; ?>
        </div>
    </section>
    <?php
    endforeach;
    return ob_get_clean();
}
add_shortcode('contenido_libro', 'libro_shortcode_contenido');

/**
 * Añadir soporte para el tema
 */
function libro_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    
    // Registrar menús
    register_nav_menus(array(
        'footer-menu' => 'Menú del Footer',
    ));
}
add_action('after_setup_theme', 'libro_theme_setup');

/**
 * Registrar Widgets
 */
function libro_widgets_init() {
    register_sidebar(array(
        'name'          => 'Área de Logos Footer',
        'id'            => 'footer-logos',
        'description'   => 'Añade widgets de imagen para los logos institucionales',
        'before_widget' => '<div class="footer-logo-item">',
        'after_widget'  => '</div>',
    ));
}
add_action('widgets_init', 'libro_widgets_init');
```

---

### 3. header.php

```php
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
    
    <!-- Preconnect para performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-background text-foreground antialiased'); ?>>
<?php wp_body_open(); ?>

<!-- Mobile Index Toggle -->
<button id="toggle-indice" class="lg:hidden fixed top-4 left-4 z-50 flex items-center gap-2 px-4 py-2 bg-sidebar/95 backdrop-blur-sm border border-sidebar-border rounded text-foreground hover:text-gold transition-colors">
    <svg class="menu-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
    <svg class="close-icon w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
    <span class="text-sm uppercase tracking-wider font-sans">Índice</span>
</button>

<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="lg:hidden fixed inset-0 bg-background/80 backdrop-blur-sm z-40 hidden"></div>
```

---

### 4. sidebar-indice.php

```php
<?php
/**
 * Sidebar con índice de capítulos
 */
$capitulos = get_posts(array(
    'post_type'      => 'capitulo',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
));

// URLs de descarga (configurables desde Opciones del tema o ACF)
$pdf_url = get_option('libro_pdf_url', '#');
$epub_url = get_option('libro_epub_url', '#');
?>

<aside id="sidebar-indice" class="fixed left-0 top-0 h-screen z-40 bg-sidebar border-r border-sidebar-border w-[320px] flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full">
    
    <!-- Header -->
    <div class="p-6 border-b border-sidebar-border">
        <h2 class="font-serif text-xl text-foreground mb-1">Índice</h2>
        <p class="text-xs text-muted-foreground uppercase tracking-wider">
            Contenido del libro
        </p>
    </div>

    <!-- Download Buttons Top -->
    <div class="p-4 border-b border-sidebar-border flex gap-2">
        <a href="<?php echo esc_url($pdf_url); ?>" class="btn-download btn-download-primary flex-1 justify-center text-xs" download>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            PDF
        </a>
        <a href="<?php echo esc_url($epub_url); ?>" class="btn-download btn-download-outline flex-1 justify-center text-xs" download>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            EPUB
        </a>
    </div>

    <!-- Chapters List -->
    <nav class="flex-1 overflow-y-auto p-4">
        <ul class="lista-capitulos space-y-1">
            <?php foreach ($capitulos as $cap) : 
                $numero = get_field('numero_capitulo', $cap->ID);
                $slug = sanitize_title($cap->post_title);
            ?>
            <li class="capitulo-item relative">
                <a href="#<?php echo esc_attr($slug); ?>" 
                   class="capitulo-link sidebar-active-indicator flex-1 text-left py-2.5 px-3 rounded-sm transition-all duration-200 font-sans text-sm hover:bg-sidebar-accent hover:text-gold block"
                   data-section="<?php echo esc_attr($slug); ?>">
                    <span class="flex items-baseline gap-2">
                        <?php if ($numero) : ?>
                            <span class="text-gold-muted text-xs font-sans tracking-wider"><?php echo esc_html($numero); ?></span>
                        <?php endif; ?>
                        <span><?php echo esc_html($cap->post_title); ?></span>
                    </span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <!-- Download Buttons Bottom -->
    <div class="p-4 border-t border-sidebar-border">
        <div class="flex gap-2">
            <a href="<?php echo esc_url($pdf_url); ?>" class="btn-download btn-download-outline flex-1 justify-center text-xs" download>
                PDF
            </a>
            <a href="<?php echo esc_url($epub_url); ?>" class="btn-download btn-download-outline flex-1 justify-center text-xs" download>
                EPUB
            </a>
        </div>
    </div>
</aside>
```

---

### 5. footer.php

```php
<!-- Footer -->
<footer class="bg-sidebar border-t border-sidebar-border lg:ml-[320px]">
    
    <!-- Logos Section -->
    <div class="py-12 md:py-16 border-b border-sidebar-border">
        <div class="container mx-auto px-6">
            <p class="text-center text-xs uppercase tracking-widest text-muted-foreground mb-8">
                Con el apoyo de
            </p>
            
            <div class="flex flex-wrap items-center justify-center gap-6 md:gap-10 lg:gap-14">
                <?php if (is_active_sidebar('footer-logos')) : ?>
                    <?php dynamic_sidebar('footer-logos'); ?>
                <?php else : ?>
                    <!-- Placeholder logos -->
                    <div class="h-10 md:h-12 px-4 flex items-center justify-center bg-muted/30 rounded border border-border/50 text-muted-foreground text-xs uppercase tracking-wider">
                        Logo 1
                    </div>
                    <div class="h-10 md:h-12 px-4 flex items-center justify-center bg-muted/30 rounded border border-border/50 text-muted-foreground text-xs uppercase tracking-wider">
                        Logo 2
                    </div>
                    <div class="h-10 md:h-12 px-4 flex items-center justify-center bg-muted/30 rounded border border-border/50 text-muted-foreground text-xs uppercase tracking-wider">
                        Logo 3
                    </div>
                    <div class="h-10 md:h-12 px-4 flex items-center justify-center bg-muted/30 rounded border border-border/50 text-muted-foreground text-xs uppercase tracking-wider">
                        Logo 4
                    </div>
                    <div class="h-10 md:h-12 px-4 flex items-center justify-center bg-muted/30 rounded border border-border/50 text-muted-foreground text-xs uppercase tracking-wider">
                        Logo 5
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="py-6">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted-foreground">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container'      => 'nav',
                    'container_class'=> 'footer-nav',
                    'menu_class'     => 'flex items-center gap-6',
                    'fallback_cb'    => function() {
                        echo '<nav class="flex items-center gap-6">
                            <a href="#" class="hover:text-gold transition-colors">Aviso Legal</a>
                            <a href="#" class="hover:text-gold transition-colors">Privacidad</a>
                            <a href="#" class="hover:text-gold transition-colors">Accesibilidad</a>
                        </nav>';
                    }
                ));
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
```

---

### 6. assets/js/main.js

```javascript
/**
 * Libro Institucional - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const sidebar = document.getElementById('sidebar-indice');
    const toggleBtn = document.getElementById('toggle-indice');
    const overlay = document.getElementById('sidebar-overlay');
    const chapterLinks = document.querySelectorAll('.capitulo-link');
    const sections = document.querySelectorAll('.capitulo-section, section[id]');
    
    // Mobile sidebar toggle
    function toggleSidebar() {
        const isOpen = sidebar.classList.contains('translate-x-0');
        
        if (isOpen) {
            sidebar.classList.remove('translate-x-0');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            toggleBtn.querySelector('.menu-icon').classList.remove('hidden');
            toggleBtn.querySelector('.close-icon').classList.add('hidden');
        } else {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.remove('hidden');
            toggleBtn.querySelector('.menu-icon').classList.add('hidden');
            toggleBtn.querySelector('.close-icon').classList.remove('hidden');
        }
    }
    
    if (toggleBtn) {
        toggleBtn.addEventListener('click', toggleSidebar);
    }
    
    if (overlay) {
        overlay.addEventListener('click', toggleSidebar);
    }
    
    // Smooth scroll for chapter links
    chapterLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetSection = document.getElementById(targetId);
            
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Close mobile sidebar after navigation
                if (window.innerWidth < 1024) {
                    toggleSidebar();
                }
            }
        });
    });
    
    // Scroll spy - highlight active section
    function updateActiveSection() {
        let currentSection = '';
        
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= 150) {
                currentSection = section.getAttribute('id');
            }
        });
        
        chapterLinks.forEach(link => {
            const sectionId = link.getAttribute('data-section') || 
                              link.getAttribute('href').substring(1);
            
            if (sectionId === currentSection) {
                link.classList.add('active', 'text-gold', 'bg-sidebar-accent');
            } else {
                link.classList.remove('active', 'text-gold', 'bg-sidebar-accent');
            }
        });
    }
    
    // Throttle scroll event
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            window.cancelAnimationFrame(scrollTimeout);
        }
        scrollTimeout = window.requestAnimationFrame(updateActiveSection);
    }, { passive: true });
    
    // Initial check
    updateActiveSection();
    
    // Lazy loading for images
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
});
```

---

### 7. template-home.php (Page Template)

```php
<?php
/**
 * Template Name: Página Libro
 * 
 * Template para mostrar el libro completo con hero e índice
 */

get_header();
?>

<!-- Hero Section -->
<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <?php 
    $hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if (!$hero_image) {
        $hero_image = LIBRO_URI . '/assets/images/hero-default.jpg';
    }
    ?>
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
         style="background-image: url('<?php echo esc_url($hero_image); ?>')"></div>
    
    <!-- Overlay -->
    <div class="hero-overlay absolute inset-0"></div>
    
    <!-- Content -->
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
        <span class="chapter-marker inline-block mb-6 opacity-0 animate-fade-in-up">
            Libro Institucional
        </span>
        
        <h1 class="font-serif text-4xl md:text-5xl lg:text-7xl text-foreground mb-6 opacity-0 animate-fade-in-up" style="animation-delay: 200ms">
            <span class="text-gold-gradient"><?php the_title(); ?></span>
        </h1>
        
        <?php if (has_excerpt()) : ?>
        <p class="font-sans text-lg md:text-xl text-foreground/80 max-w-2xl mx-auto mb-12 opacity-0 animate-fade-in-up" style="animation-delay: 400ms">
            <?php echo get_the_excerpt(); ?>
        </p>
        <?php endif; ?>
        
        <!-- Download buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16 opacity-0 animate-fade-in-up" style="animation-delay: 600ms">
            <a href="<?php echo esc_url(get_option('libro_pdf_url', '#')); ?>" class="btn-download btn-download-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Descargar PDF
            </a>
            <a href="<?php echo esc_url(get_option('libro_epub_url', '#')); ?>" class="btn-download btn-download-outline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Descargar EPUB
            </a>
        </div>
        
        <!-- Scroll indicator -->
        <button onclick="document.getElementById('prologo').scrollIntoView({behavior: 'smooth'})" 
                class="inline-flex flex-col items-center text-foreground/60 hover:text-gold transition-colors duration-300 opacity-0 animate-fade-in-up" style="animation-delay: 800ms">
            <span class="text-xs uppercase tracking-widest mb-2 font-sans">Consulta el índice</span>
            <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </button>
    </div>
    
    <!-- Bottom gradient -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-background to-transparent"></div>
</section>

<!-- Main Layout -->
<div class="relative lg:flex">
    <!-- Sidebar -->
    <?php get_template_part('sidebar', 'indice'); ?>

    <!-- Main Content -->
    <main class="lg:ml-[320px] min-h-screen">
        <div class="max-w-4xl mx-auto px-6 md:px-12 lg:px-16">
            <?php echo do_shortcode('[contenido_libro]'); ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>
```

---

## 🎨 Compatibilidad con Elementor

Para hacer la plantilla compatible con Elementor:

### 1. Añadir soporte en functions.php

```php
// Añadir soporte para Elementor
function libro_elementor_support() {
    add_post_type_support('capitulo', 'elementor');
}
add_action('init', 'libro_elementor_support');

// Registrar ubicaciones de Elementor Theme Builder
function libro_register_elementor_locations($elementor_theme_manager) {
    $elementor_theme_manager->register_location('header');
    $elementor_theme_manager->register_location('footer');
    $elementor_theme_manager->register_location('single-capitulo');
}
add_action('elementor/theme/register_locations', 'libro_register_elementor_locations');
```

### 2. Zonas widgetizables

Las siguientes áreas son editables con Elementor:
- **Hero Section**: Imagen de fondo, título, subtítulo
- **Contenido de capítulos**: Cada capítulo usa el editor de bloques
- **Footer**: Logos institucionales (widget area)

---

## 📱 Responsive Breakpoints

```css
/* Mobile First */
@media (min-width: 640px) { /* sm */ }
@media (min-width: 768px) { /* md */ }
@media (min-width: 1024px) { /* lg - Sidebar visible */ }
@media (min-width: 1280px) { /* xl */ }
@media (min-width: 1536px) { /* 2xl */ }
```

---

## 🚀 Instalación

1. Subir la carpeta del tema a `/wp-content/themes/`
2. Activar el tema desde **Apariencia > Temas**
3. Crear capítulos desde **Libro > Añadir capítulo**
4. Ordenar capítulos con el campo "Orden" (Page Attributes)
5. Crear una página con la plantilla "Página Libro"
6. Configurar como página de inicio en **Ajustes > Lectura**

---

## ✏️ Shortcodes de contenido

Estos shortcodes replican los componentes de React para mantener paridad visual al 100%.

### `[resaltado]` — Resaltado de texto

Resalta cualquier fragmento de texto con colores personalizables. Equivalente al componente React `<HighlightText>`.

**Parámetros:**

| Parámetro     | Descripción                  | Por defecto |
|---------------|------------------------------|-------------|
| `color_fondo` | Color de fondo del resaltado | `#D4AF37`   |
| `color_texto` | Color del texto resaltado    | `#1a237e`   |

**Ejemplos de uso:**

```
<!-- Resaltado por defecto (dorado con texto azul marino) -->
Llegaron a la [resaltado]División de Honor[/resaltado] tras años de esfuerzo.

<!-- Azul marino con texto blanco -->
Una [resaltado color_fondo="#1a237e" color_texto="#FFFFFF"]nueva página en la historia[/resaltado] del deporte.

<!-- Rojo con texto blanco -->
La [resaltado color_fondo="#b71c1c" color_texto="#FFFFFF"]consolidación del proyecto[/resaltado] sin precedentes.

<!-- Crema con texto marrón -->
Una [resaltado color_fondo="#e8d5b7" color_texto="#3e2723"]planificación meticulosa[/resaltado] del club.

<!-- Gris oscuro con texto amarillo -->
La [resaltado color_fondo="#37474f" color_texto="#ffd54f"]solidez del club[/resaltado] quedó demostrada.

<!-- Naranja con texto blanco -->
Las [resaltado color_fondo="#ff8f00" color_texto="#FFFFFF"]dificultades económicas[/resaltado] no frenaron al equipo.

<!-- Verde con texto blanco -->
El club [resaltado color_fondo="#1b5e20" color_texto="#FFFFFF"]renació con más fuerza[/resaltado].

<!-- Azul marino con texto dorado (invertido) -->
La [resaltado color_fondo="#1a237e" color_texto="#D4AF37"]Copa del Rey[/resaltado] volvió a las vitrinas.
```

**HTML generado:**

```html
<mark class="px-1 py-0.5 rounded-sm font-semibold" style="background-color: #D4AF37; color: #1a237e;">
  División de Honor
</mark>
```

---

### `[cita_editorial]` — Cita destacada

Muestra una cita editorial con autor opcional. Equivalente a `<EditorialQuote>`.

```
[cita_editorial author="Club Voleibol Guaguas"]
"Más que un club, una familia."
[/cita_editorial]
```

### `[imagen_contenido]` — Imagen con pie de foto

Inserta una imagen con pie de foto opcional. Equivalente a `<ContentImage>`.

```
[imagen_contenido src="https://..." alt="Descripción" caption="Pie de foto" fullwidth="true"]
```

### `[imagen]` — Imagen desde la biblioteca de medios

Igual que `[imagen_contenido]` pero usando el ID de la biblioteca de WordPress.

```
[imagen id="123" caption="Pie de foto" fullwidth="true"]
```

### `[hero_capitulo]` + `[hero_linea]` — Cabecera de capítulo

Crea una cabecera visual personalizada. Equivalente a `<ChapterHero>`.

```
[hero_capitulo background="url" overlay="rgba(212,175,55,0.85)" icon="custom" custom_icon="url" alignment="right" height="500px"]
  [hero_linea color="#1a237e" highlight="#FFFFFF"]DEL PATIO[/hero_linea]
  [hero_linea color="#1a237e" highlight="#FFFFFF"]DEL COLEGIO[/hero_linea]
[/hero_capitulo]
```

---

## 📦 Dependencias opcionales

- **ACF (Advanced Custom Fields)**: Para campos personalizados de capítulos
- **Yoast SEO**: Para optimización SEO
- **WP Rocket**: Para caché y optimización

---

## 🎯 Variables CSS principales

```css
:root {
    --gold: 42 87% 55%;           /* Dorado principal */
    --background: 220 15% 8%;      /* Fondo oscuro */
    --foreground: 42 30% 95%;      /* Texto claro */
    --sidebar-width: 320px;        /* Ancho del índice */
    --font-serif: 'Playfair Display';
    --font-sans: 'Inter';
}
```
