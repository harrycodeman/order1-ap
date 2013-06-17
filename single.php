<?php get_header(); ?>

<?php the_post( ); ?>

<div class="triparticles-wrapper">
    <div id="content" class="homepage" role="main">
        <div class="triparticles-wrapper">
            <div id="triparticles">
                <div id="articlethumbnail">
                    <div class="image">
                        <?php $url = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID( ) ) ); ?>
                        <img src="<?= $url; ?>" alt="" width="940px" height="370px">
                    </div>
                    <div id="left-arrow">
                        <a href="/"></a>
                    </div>
                    <div class="announcement">
                        <h1><?php the_title( ); ?></h1>
                    </div>
                    <div id="right-arrow" class="horizontal-flip">
                        <a href="/"></a>
                    </div>
                </div>

                <div id="content" class="homepage" role="main">
                <div id="article" class="entry">
                    <article>
                        <?php the_content( ); ?>
                    </article>
                </div>

                <div class="links">
                    <a class="left" href="<?php ap_print_page_under_development_permalink( ); ?>">
                        <img src="<?php ap_print_image_url('plane.png'); ?>">Путевки в Париж
                    </a>
                    <br>
                    <a class="left" href="<?php ap_print_page_under_development_permalink( ); ?>">
                        Похожие направления
                    </a>
                </div>
                </div><!-- #content -->
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
