<!doctype html>
    <html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <div class="wp-site-blocks">
            <header class="wp-block-template-part site-header">
                <?php block_header_area(); ?>
            </header>
            <div class="wp-site-blocks">
            <main>
                <div class="container">
                    <div class="trening-single-content">
                        <div class="trening-single-thumb">
                            <figure>
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" />
                            </figure>
                        </div>
                        <div class="trening-single-details">
                            <div class="trening-single-title"><h1><?php the_title() ?></h1></div>
                                <?php if (get_field('termin')): ?>
                                    <div class="trening-single-date">
                                        <?php the_field('termin')?>
                                        <?php if (get_field('czas_trwania')): ?>
                                            <span> <?php the_field('czas_trwania')?></span>
                                        <?php endif;?>
                                    </div>
                                <?php endif;?>
                                <?php if (get_field('cena')): ?><div class="trening-single-cena">Cena: <?php the_field('cena')?></div><?php endif;?>   
                                <?php if (get_field('prowadzacy')): ?><div class="trening-single-person"> <?php the_field('prowadzacy')?></div><?php endif;?>
                            <div class="trening-single-description"><?php the_content();?></div>
                        </div>
                    </div>
                </div>
            </main>
            </div>
            <footer class="wp-block-template-part site-footer">
                <?php block_footer_area(); ?>
            </footer>
        </div>
        <?php wp_footer(); ?>
    </body>

    </html>