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
        </div>
    </div>

    <div id="content" class="homepage" role="main">
        <div id="article" class="entry">
            <article>
                <?= $article_post->post_content; ?>
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
    </div><!--#content-->
<?php }
