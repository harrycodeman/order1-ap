<?php get_header(); ?>

<?php the_post( );
$article = ap_get_article_by_id( get_the_ID( ) );
$article_banner = $article->get_banner( );
?>

<div class="triparticles-wrapper">
    <div id="content" class="homepage" role="main">
        <div class="triparticles-wrapper">
            <div id="triparticles">
                <div id="articlethumbnail-outer">
                    <div id="articlethumbnail">
                        <div class="image">
                            <?php if ( empty( $article_banner ) ) { ?>
                            <img src="<?php ap_print_image_url( "tour-banner-missed.jpg" ); ?>" alt="Изображение остутствует"
                                 width="940px" height="370px">
                            <?php }
                            else { ?>
                            <img src="<?php echo $article_banner->get_url( ); ?>" alt="Иконка статьи"
                                 width=940px" height="<?= $article_banner->get_height( ) * 940 / $article_banner->get_width( ); ?>">
                            <?php } ?>
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
