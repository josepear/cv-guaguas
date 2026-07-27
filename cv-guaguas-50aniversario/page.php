<?php
/**
 * Plantilla para páginas de WordPress (page)
 * Mismo layout que single-capitulo.php sin hero:
 * offset de header, breadcrumb, título en mayúsculas bold, reading-content.
 *
 * @package CV_Guaguas_Libro
 */

get_header();
?>

<?php libro_context_bar(get_the_ID()); ?>

<div class="guaguas-menu-layout">
<!-- Sidebar -->
<?php get_template_part('sidebar', 'indice'); ?>

<!-- Main Content -->
<main class="pt-[56px] min-h-screen bg-background">
    <div class="max-w-4xl mx-auto px-6 md:px-12 lg:px-16 py-16">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-6 reading-context-trigger">
            <ol class="flex flex-wrap items-center gap-1.5 break-words text-xs text-muted-foreground sm:gap-2.5">
                <li class="inline-flex items-center gap-1.5">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-muted-foreground hover:text-gold transition-colors flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Inicio
                    </a>
                </li>
                <li role="presentation" aria-hidden="true">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </li>
                <li class="inline-flex items-center gap-1.5">
                    <span role="link" aria-disabled="true" aria-current="page" class="font-normal text-foreground/70">
                        <?php the_title(); ?>
                    </span>
                </li>
            </ol>
        </nav>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <section class="scroll-mt-24 py-8 md:py-12 border-b border-border/30">

            <header class="mb-8 md:mb-12">
                <h2 class="font-display font-black uppercase tracking-tight text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-foreground leading-tight">
                    <?php the_title(); ?>
                </h2>
            </header>

            <div class="reading-content text-foreground/85">
                <?php the_content(); ?>
            </div>

        </section>

        <?php endwhile; endif; ?>

    </div>
</main>
</div>

<?php get_footer(); ?>
