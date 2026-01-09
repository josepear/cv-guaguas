<!-- Footer -->
<footer class="bg-sidebar border-t border-sidebar-border">
    
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
                    <!-- Logo CV Guaguas por defecto -->
                    <a href="https://cvguaguas.com" target="_blank" rel="noopener noreferrer" class="opacity-80 hover:opacity-100 transition-opacity">
                        <img src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.png" alt="CV Guaguas" class="h-16 w-auto">
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="py-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted-foreground">
                <p>
                    © <?php echo date('Y'); ?> CV Guaguas. Todos los derechos reservados.
                </p>
                
                <nav class="footer-nav">
                    <?php 
                    if (has_nav_menu('footer-menu')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'container'      => false,
                            'menu_class'     => 'flex items-center gap-6',
                            'fallback_cb'    => false,
                            'depth'          => 1,
                            'link_before'    => '',
                            'link_after'     => '',
                        ));
                    } else {
                        // Enlaces por defecto si no hay menú configurado
                        ?>
                        <ul class="flex items-center gap-6">
                            <li><a href="<?php echo home_url('/aviso-legal'); ?>" class="hover:text-gold transition-colors">Aviso Legal</a></li>
                            <li><a href="<?php echo home_url('/privacidad'); ?>" class="hover:text-gold transition-colors">Privacidad</a></li>
                            <li><a href="<?php echo home_url('/accesibilidad'); ?>" class="hover:text-gold transition-colors">Accesibilidad</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </nav>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
