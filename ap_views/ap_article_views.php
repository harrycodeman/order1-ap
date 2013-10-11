<?php
function ap_article_view_single( AP_Article $article ) {
    $article_banner = $article->get_banner( ); ?>
    <div id="articlethumbnail-outer">
        <div id="articlethumbnail">
            <div class="image">
                <?php if ( empty( $article_banner ) ) { ?>
                    <img src="<?php ap_print_image_url( "tour-banner-missed.jpg" ); ?>" alt="<?= $article->title; ?>"
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

function ap_articles_list_view_for_map( $articles ) {
    function ap_print_icon_html( AP_Image $icon = null ) {
        if ( empty( $icon ) ) { ?>
            <img src="<?php ap_print_image_url( "tour-icon-missed.jpg" ); ?>" alt="Изображение остутствует"
                 width="100px" height="100px">
        <?php }
        else { ?>
            <img src="<?php echo $icon->get_url( ); ?>" alt="Иконка статьи"
                 width="100px" height="<?= $icon->get_height( ) * 100 / $icon->get_width( ); ?>">
        <?php }
    }

    function get_excerpt_by_id( $post_id ){
        $the_post = get_post($post_id); //Gets post ID
        $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
        $excerpt_length = 35; //Sets excerpt length by word count
        $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
        $words = explode(' ', $the_excerpt, $excerpt_length + 1);
        if(count($words) > $excerpt_length) :
            array_pop($words);
            array_push($words, '…');
            $the_excerpt = implode(' ', $words);
        endif;
        $the_excerpt = '<p>' . $the_excerpt . '</p>';
        return $the_excerpt;
    } ?>

    <h1 class="red">Статьи</h1>
    <div id="tours" class="list">
        <?php foreach ( $articles as $article ) { ?>
            <div class="article-item">
                <a href="<?php ap_print_article_permalink( $article->id ); ?>">
                    <div class="image" style="text-align: center;">
                        <?php ap_print_icon_html( AP_Image::cast( $article->get_icon( ) ) ); ?>
                    </div>
                </a>
                <div class="info" style="width: 260px;">
                    <a href="<?php ap_print_article_permalink( $article->id ); ?>"
                       style="color: #535349;">
                        <h2><?= $article->title; ?></h2>
                    </a>
                    <?= get_excerpt_by_id( $article->id ); ?>
                </div>
            </div><!--.item-->
        <?php } ?>
    </div><!--#tours-->
<? }
