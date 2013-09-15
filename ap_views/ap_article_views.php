<?php
function ap_article_view_single( $article ) { ?>
    <div id="articlethumbnail-outer">
        <div id="articlethumbnail">
            <div class="image">
                <?php $url = wp_get_attachment_url( get_post_thumbnail_id( $article->id ) ); ?>
                <img src="<?= $url; ?>" alt="" width="940px" height="370px">
            </div>
            <div id="left-arrow">
                <a href="/"></a>
            </div>
            <div class="announcement">
                <h1><?= $article->title; ?></h1>
            </div>
            <div id="right-arrow" class="horizontal-flip">
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
