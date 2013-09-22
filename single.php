<?php get_header(); ?>

<?php the_post( );
$article = ap_get_article_by_id( get_the_ID( ) );
$article_banner = $article->get_banner( ); ?>

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
                                 width=940px" height="370px">
                            <?php } ?>
                        </div>
                        <div id="left-arrow"
                            <?php if ( !empty( $article->quote ) ) { ?>
                                style="background: url(<?php ap_print_image_url( 'left-arrow.png' ); ?>) no-repeat 83px 185px;"
                            <?php } ?>>
                            <a href="/"></a>
                        </div>
                        <div class="announcement">
                            <h1><?php the_title( ); ?></h1>
                            <?php if ( !empty( $article->quote ) ) { ?>
                                <p><?= $article->quote; ?></p>
                            <?php } ?>
                        </div>
                        <div id="right-arrow" class="horizontal-flip"
                             <?php if ( !empty( $article->quote ) ) { ?>
                                 style="background: url(<?php ap_print_image_url( 'left-arrow.png' ); ?>) no-repeat 83px 225px;"
                             <?php } ?>>
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

                    <?php if ( !empty( $article->country ) || !empty( $article->resort ) ) { ?>
                        <div class="links">
                            <a id="similar_directions_link" class="left" href="<?php ap_print_search_tour_page_permalink( ); ?>">
                                <form id="similar_directions_form" name="similar-directions-form"
                                      action="<?php ap_print_search_tour_page_permalink( ); ?>"
                                      method="post" style="display: none">
                                    <?php if ( !empty( $article->country ) ) { ?>
                                        <input type="hidden" name="ap_tour_country" value="<?= $article->country; ?>">
                                    <?php } ?>
                                    <?php if ( !empty( $article->resort ) ) { ?>
                                        <input type="hidden" name="ap_tour_resort" value="<?= $article->resort; ?>">
                                    <?php } ?>
                                </form>
                                <img src="<?php ap_print_image_url('plane.png'); ?>">Путевки в <?= ap_get_article_about_place_name( $article ); ?>
                            </a>
                            <script type="application/javascript">
                                $(document).ready(function() {
                                    $("#similar_directions_link").on("click", function() {
                                        $(this).find("form").submit();
                                        return false;
                                    });
                                });
                            </script>
                        </div><!--.links-->
                    <?php } ?>
                </div><!-- #content -->
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
