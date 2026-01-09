<?php
/**
 * Plantilla para páginas de error 404
 *
 * @package CV_Guaguas_Libro
 */

get_header();
?>

<main class="main-content flex-1 overflow-y-auto lg:ml-[320px]">
    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="text-center max-w-lg">
            
            <!-- Número 404 estilizado -->
            <div class="mb-8">
                <span class="text-[120px] md:text-[180px] font-serif font-bold leading-none text-gold/20">
                    404
                </span>
            </div>
            
            <!-- Mensaje principal -->
            <h1 class="font-serif text-3xl md:text-4xl text-foreground mb-4">
                Página no encontrada
            </h1>
            
            <p class="text-lg text-muted-foreground mb-8 leading-relaxed">
                Lo sentimos, la página que buscas no existe o ha sido movida. 
                Te invitamos a explorar nuestro libro institucional.
            </p>
            
            <!-- Botones de acción -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="<?php echo esc_url(home_url('/')); ?>" 
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gold text-sidebar font-sans text-sm uppercase tracking-wider rounded hover:bg-gold-light transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Ir al inicio
                </a>
                
                <a href="<?php echo esc_url(home_url('/#capitulo-1')); ?>" 
                   class="inline-flex items-center gap-2 px-6 py-3 border border-gold/30 text-gold font-sans text-sm uppercase tracking-wider rounded hover:bg-gold/10 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Leer el libro
                </a>
            </div>
            
            <!-- Decoración -->
            <div class="mt-16 flex items-center justify-center gap-3">
                <span class="w-12 h-px bg-gold/30"></span>
                <img src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.png" 
                     alt="CV Guaguas" 
                     class="h-8 w-auto opacity-50">
                <span class="w-12 h-px bg-gold/30"></span>
            </div>
            
        </div>
    </div>
</main>

<?php
get_sidebar('indice');
get_footer();
?>
