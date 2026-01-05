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
                    <!-- Logo CV Guaguas -->
                    <img src="<?php echo LIBRO_URI; ?>/assets/images/logo-guaguas.png" alt="CV Guaguas" class="h-16 w-auto opacity-80 hover:opacity-100 transition-opacity">
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
                
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container'      => 'nav',
                    'container_class'=> 'footer-nav',
                    'menu_class'     => 'flex items-center gap-6',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                ));
                ?>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
