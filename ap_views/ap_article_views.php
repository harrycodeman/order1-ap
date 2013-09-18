<?php
function ap_article_view_single( AP_Article $article ) {
    $article_banner = $article->get_banner( ); ?>
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
            <div id="left-arrow"
                <?php if ( !empty( $article->quote ) ) { ?>
                    style="background: url(<?php ap_print_image_url( 'left-arrow.png' ); ?>) no-repeat 83px 185px;"
                <?php } ?>>
                <a href="/"></a>
            </div>
            <div class="announcement">
                <h1><?= $article->title; ?></h1>
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
        </div><!--articlethumbnail-->
    </div><!--#articlethumbnail-outer-->

    <div id="content" class="homepage" role="main">
        <div id="article" class="entry">
            <article>
                <?= $article->content; ?>
            </article>
        </div><!--#article-->

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
    </div><!--#content-->
<?php }

function ap_article_view_single_with_links( $article_posts ) { ?>
    <div class="triparticles-wrapper">
        <div id="content" class="homepage" role="main">
            <div class="triparticles-wrapper">
                <div id="triparticles">
                    <div class="title">
                        <h1>Статьи о путешествиях</h1>
                        <a href="<?php ap_print_blog_url(); ?>">Другие статьи</a>
                    </div>

                    <?php if ( count( $article_posts ) === 1 ) {
                        $article_post = $article_posts[0];
                        ap_article_view_single( $article_post );
                    }
                    else { ?>
                        <p>К сожалению, на текущий момент не опубликовано ни одной статьи.</p>
                    <?php } ?>
                </div><!--#triparticles-->
            </div><!--.triparticles-wrapper-->
        </div><!--.homepage-->
    </div><!--.triparticles-wrapper-->
<?php }

function ap_get_article_about_place_name( AP_Article $article ) {
    $result = $article->resort;
    if ( !empty( $article->resort ) && !empty( $article->country ) ) {
        $result .= ' (';
    }
    $result .= $article->country;
    if ( !empty( $article->resort ) && !empty( $article->country ) ) {
        $result .= ')';
    }
    return $result;
}
