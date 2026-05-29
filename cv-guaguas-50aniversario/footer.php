<?php
/**
 * Footer con logos institucionales configurables
 * CV Guaguas - 50 Aniversario
 * IDENTICAL to React InstitutionalFooter.tsx
 */

// Obtener logos desde opciones del tema
$logos = get_option('libro_footer_logos', array());

// Logos por defecto con las imágenes incluidas en el tema (identical to React sponsorLogos)
if (empty($logos)) {
    $base = get_template_directory_uri() . '/assets/images/sponsors/';
    $logos = array(
        array('alt' => 'Cabildo de Gran Canaria', 'src' => $base . 'cabildo-gran-canaria.png', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Instituto Insular de Deportes', 'src' => $base . 'instituto-insular-deportes.png', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Gobierno de Canarias', 'src' => $base . 'gobierno-canarias.png', 'url' => 'https://www.gobiernodecanarias.org'),
        array('alt' => 'Islas Canarias', 'src' => $base . 'islas-canarias.png', 'url' => 'https://www.islascanarias.org'),
        array('alt' => 'Ayuntamiento de Las Palmas de Gran Canaria', 'src' => $base . 'ayuntamiento-las-palmas.png', 'url' => 'https://www.laspalmasgc.es'),
        array('alt' => 'Instituto Municipal de Deportes', 'src' => $base . 'instituto-municipal-deportes.png', 'url' => 'https://www.laspalmasgc.es'),
        array('alt' => 'Turismo de Gran Canaria', 'src' => $base . 'turismo-gran-canaria.png', 'url' => 'https://www.grancanaria.com'),
        array('alt' => 'Real Federación Española de Voleibol', 'src' => $base . 'rfevb.png', 'url' => 'https://www.rfevb.com'),
    );
}
?>

<footer class="bg-sidebar border-t border-sidebar-border">
    <!-- Logos Section -->
    <div class="py-12 md:py-16 border-b border-sidebar-border">
        <div class="container mx-auto px-6">
            <p class="text-center text-xs uppercase tracking-widest text-muted-foreground mb-8">
                Con el apoyo de
            </p>
            
            <div class="flex flex-wrap items-center justify-center gap-6 md:gap-10 lg:gap-14">
                <?php foreach ($logos as $logo) : ?>
                <a 
                    href="<?php echo esc_url($logo['url'] ?: '#'); ?>" 
                    class="group flex items-center justify-center p-2 transition-opacity duration-300 hover:opacity-80"
                    target="_blank" 
                    rel="noopener noreferrer"
                >
                    <?php if (!empty($logo['src'])) : ?>
                        <img 
                            src="<?php echo esc_url($logo['src']); ?>" 
                            alt="<?php echo esc_attr($logo['alt']); ?>"
                            class="h-8 md:h-10 lg:h-12 w-auto object-contain transition-all duration-500 grayscale opacity-40 group-hover:opacity-80 dark:invert dark:group-hover:opacity-90"
                            loading="lazy"
                        >
                    <?php else : ?>
                        <!-- Placeholder - identical to React -->
                        <div class="h-10 md:h-12 px-4 flex items-center justify-center bg-muted/30 rounded border border-border/50 text-muted-foreground text-xs uppercase tracking-wider">
                            <?php echo esc_html($logo['alt']); ?>
                        </div>
                    <?php endif; ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="py-6">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-muted-foreground">
                <p>© <?php echo date('Y'); ?> Club Voleibol Guaguas. Todos los derechos reservados.</p>
                
                <nav class="flex items-center gap-6">
                    <a href="<?php echo home_url('/aviso-legal'); ?>" class="hover:text-gold transition-colors duration-300">
                        Aviso legal
                    </a>
                    <a href="<?php echo home_url('/politica-de-cookies'); ?>" class="hover:text-gold transition-colors duration-300">
                        Cookies
                    </a>
                    <a href="<?php echo home_url('/politica-de-privacidad'); ?>" class="hover:text-gold transition-colors duration-300">
                        Privacidad
                    </a>
                    <a href="<?php echo home_url('/accesibilidad'); ?>" class="hover:text-gold transition-colors duration-300">
                        Accesibilidad
                    </a>
                </nav>
            </div>
        </div>
    </div>
</footer>

<!-- ═══════════════════════════════════════════════
     BANNER DE COOKIES
     Se muestra en la primera visita. Preferencia guardada en localStorage.
     ═══════════════════════════════════════════════ -->
<div id="cv-cookie-banner" class="cv-cookie-banner" role="dialog" aria-label="Aviso de cookies" aria-live="polite" style="display:none">
    <div class="cv-cookie-inner">

        <div class="cv-cookie-top">
            <div class="cv-cookie-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/>
                    <circle cx="8.5" cy="10" r="1" fill="currentColor"/>
                    <circle cx="14.5" cy="9" r="1.5" fill="currentColor"/>
                    <circle cx="11" cy="15" r="1" fill="currentColor"/>
                </svg>
            </div>
            <div class="cv-cookie-text">
                <p class="cv-cookie-title">Este sitio utiliza cookies</p>
                <p class="cv-cookie-desc">
                    Usamos cookies propias y de terceros para mejorar tu experiencia, analizar el tráfico y personalizar contenido.
                    Puedes aceptarlas todas, rechazarlas o gestionar tus preferencias.
                    Consulta nuestra <a href="<?php echo home_url('/politica-de-cookies'); ?>">política de cookies</a>.
                </p>
            </div>
            <button class="cv-cookie-close" id="cv-cookie-close" aria-label="Cerrar aviso de cookies">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="cv-cookie-actions">
            <button class="cv-cookie-btn cv-cookie-btn--accept" id="cv-cookie-accept">Aceptar todas</button>
            <button class="cv-cookie-btn cv-cookie-btn--reject" id="cv-cookie-reject">Rechazar no esenciales</button>
            <button class="cv-cookie-btn cv-cookie-btn--manage" id="cv-cookie-manage-toggle">Gestionar preferencias</button>
        </div>

        <div class="cv-cookie-panel" id="cv-cookie-panel" aria-hidden="true">
            <div class="cv-cookie-toggle-row">
                <div class="cv-cookie-toggle-label">
                    Cookies esenciales
                    <span>Necesarias para el funcionamiento del sitio. No se pueden desactivar.</span>
                </div>
                <div class="cv-cookie-toggle cv-cookie-toggle--locked" aria-label="Siempre activas" title="Siempre activas"></div>
            </div>
            <div class="cv-cookie-divider"></div>
            <div class="cv-cookie-toggle-row">
                <div class="cv-cookie-toggle-label">
                    Cookies analíticas
                    <span>Nos ayudan a entender cómo se usa el sitio (Google Analytics).</span>
                </div>
                <button class="cv-cookie-toggle" id="cv-toggle-analytics" role="switch" aria-checked="false" aria-label="Cookies analíticas"></button>
            </div>
            <div class="cv-cookie-divider"></div>
            <div class="cv-cookie-toggle-row">
                <div class="cv-cookie-toggle-label">
                    Cookies de redes sociales
                    <span>Permiten los botones de compartir en redes sociales.</span>
                </div>
                <button class="cv-cookie-toggle" id="cv-toggle-social" role="switch" aria-checked="false" aria-label="Cookies de redes sociales"></button>
            </div>
            <div class="cv-cookie-panel-save">
                <button class="cv-cookie-btn cv-cookie-btn--accept" id="cv-cookie-save">Guardar preferencias</button>
            </div>
        </div>

    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>