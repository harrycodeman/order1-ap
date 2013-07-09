<?php
/*
Template Name: Front-page
*/
?>

<?php get_header(); ?>
<?php ap_tour_view_banners( ); ?>
<?php ap_tour_view_search( ); ?>
<?php ap_tour_view_interesting_offers( ); ?>

<div class="triparticles-wrapper">
    <div id="content" class="homepage" role="main">
        <div class="triparticles-wrapper">
            <div id="triparticles">

                <div class="title">
                    <h1>Статьи о путешествиях</h1>
                    <a href="<?php ap_print_blog_url(); ?>">Другие статьи</a>
                </div>

                <?php
                $article_posts = get_posts(
                    array(
                        'posts_per_page' => 1,
                        'orderby' => 'rand'
                    )
                );
                foreach ( $article_posts as $article_post ) {
                    ap_article_view_single( $article_post );
                }
                if ( count( $article_posts ) < 1 ) { ?>
                    <p>К сожалению, на текущий момент не опубликовано ни одной статьи.</p>
                <?php } ?>
            </div><!--#triparticles-->
        </div><!--.triparticles-wrapper-->
    </div><!--.homepage-->
</div><!--.triparticles-wrapper-->

<?php ap_add_js_calendar_to_element( '#datepicker' ); ?>
<?php get_footer(); ?>
