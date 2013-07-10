<?php
function ap_article_view_single( $article_post ) { ?>
    <div id="articlethumbnail-outer">
        <div id="articlethumbnail">
            <div class="image">
                <?php $url = wp_get_attachment_url( get_post_thumbnail_id( $article_post->ID ) ); ?>
                <img src="<?= $url; ?>" alt="" width="940px" height="370px">
            </div>
            <div id="left-arrow">
                <a href="/"></a>
            </div>
            <div class="announcement">
                <h1><?= $article_post->post_title; ?></h1>
            </div>
            <div id="right-arrow" class="horizontal-flip">
                <a href="/"></a>
            </div>
        </div><!--articlethumbnail-->
    </div><!--#articlethumbnail-outer-->

    <div id="content" class="homepage" role="main">
        <div id="article" class="entry">
            <article>
                <?= $article_post->post_content; ?>
            </article>
        </div><!--#article-->

        <div class="links">
            <a class="left" href="<?php ap_print_page_under_development_permalink( ); ?>">
                <img src="<?php ap_print_image_url('plane.png'); ?>">Путевки в Париж
            </a>
            <br>
            <a class="left" href="<?php ap_print_page_under_development_permalink( ); ?>">
                Похожие направления
            </a>
        </div><!--.links-->
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
