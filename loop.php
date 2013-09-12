<?php if ( ! have_posts() ) : ?>
    <div id="post-0" class="post error404 not-found">
        <h1 class="entry-title"><?php _e( 'Not Found', 'imbalance2' ); ?></h1>
        <div class="entry-content">
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'imbalance2' ); ?></p>
            <?php get_search_form(); ?>
        </div><!-- .entry-content -->
    </div><!-- #post-0 -->
<?php endif; ?>

<div id="boxes">
<?php while ( have_posts() ) : the_post();
    $article = ap_get_article_by_id( get_the_ID( ) ); ?>
    <div class="box">
        <div class="rel">


            <a href="<?php the_permalink(); ?>">
                <?php
                $icon = $article->get_icon( );
                if ( !empty( $icon ) ) { ?>
                    <img src="<?php echo $icon->get_url( ); ?>" alt="Изображение остутствует">
                    <?php }
                else { ?>
                    <img src="<?php ap_print_image_url( 'tour-icon-missed.jpg' ); ?>"
                         alt="Изображение остутствует">
                <?php } ?>
            </a>


            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <?php the_excerpt() ?>
            <div class="texts">
                <div class="abs">

                    <a href="<?php the_permalink(); ?>">
                        <?php
                        $icon = $article->get_icon( );
                        if ( !empty( $icon ) ) { ?>
                            <img src="<?php echo $icon->get_url( ); ?>" alt="Изображение остутствует">
                        <?php }
                        else { ?>
                            <img src="<?php ap_print_image_url( 'tour-icon-missed.jpg' ); ?>"
                                 alt="Изображение остутствует">
                        <?php } ?>
                    </a>

                    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    <?php the_excerpt() ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
</div>

<?php
global $wp_query;
if ( $wp_query->max_num_pages > 1 ) : ?>
    <div class="fetch">
        <?php next_posts_link( __( 'Загрузить следующие статьи', 'imbalance2' ) ); ?>
    </div>

    <script type="text/javascript">
    // Ajax-fetching "Load more posts"
    $('.fetch a').on('click', function(e) {
        e.preventDefault();
        $(this).addClass('loading').text('Загрузка...');
        $.ajax({
            type: "GET",
            url: $(this).attr('href') + '#boxes',
            dataType: "html",
            success: function(out) {
                out = $.trim(out);
                var result = $(out).find('#boxes .box');
                var next_link = $(out).find('.fetch a').attr('href');
                $('#boxes').append(result).masonry('appended', result);
                $('.fetch a').removeClass('loading').text('Загрузить следующие статьи');
                if (next_link != undefined) {
                    $('.fetch a').attr('href', next_link);
                } else {
                    $('.fetch').remove();
                }
            }
        });
    });
    </script>
<?php endif; ?>
