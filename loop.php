<?php if ( ! have_posts() ) : ?>
    <div id="post-0" class="post error404 not-found">
        <h1 class="entry-title"><?php _e( 'Not Found', 'imbalance2' ); ?></h1>
        <div class="entry-content">
            <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'imbalance2' ); ?></p>
            <?php get_search_form(); ?>
        </div><!-- .entry-content -->
    </div><!-- #post-0 -->
<?php endif; ?>

<?php
function ap_print_icon_html( AP_Image $icon = null ) {
    if ( empty( $icon ) ) { ?>
        <img src="<?php ap_print_image_url( "tour-icon-missed.jpg" ); ?>" alt="Изображение остутствует"
             width="300px" height="300px">
    <?php }
    else { ?>
        <img src="<?php echo $icon->get_url( ); ?>" alt="Иконка статьи"
             width="300px" height="<?= $icon->get_height( ) * 300 / $icon->get_width( ); ?>">
    <?php }
}
?>

<div id="boxes">
<?php while ( have_posts() ) : the_post();
    $article = ap_get_article_by_id( get_the_ID( ) );
    $article_icon = $article->get_icon( ); ?>

    <div class="box">
        <div class="rel">
            <a href="<?php the_permalink( ); ?>"><?php ap_print_icon_html( $article_icon ); ?></a>
            <h1><a href="<?php the_permalink( ); ?>"><?php the_title( ); ?></a></h1>
            <?= get_the_excerpt( )."..."; ?>
            <div class="texts">
                <div class="abs">
                    <a href="<?php the_permalink(); ?>"><?php ap_print_icon_html( $article_icon ); ?></a>
                    <?php if ( is_user_logged_in( ) ) { ?>
                        <a href="<?php ap_print_delete_article_permalink( $article->id ); ?>" class="delete-article-link" style="float: right;">
                            Удалить
                        </a>
                        <a href="<?php ap_print_edit_article_page_permalink( $article->id ); ?>" style="float: right; padding-right: 10px;">
                            Редактировать
                        </a>
                    <?php } ?>
                    <h1><a href="<?php the_permalink( ); ?>"><?php the_title( ); ?></a></h1>
                    <?= get_the_excerpt( )."..."; ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

<script type="text/javascript">
    $('.delete-article-link').on('click', function(e) {
            var divToDelete = $(this).closest(".box");
            e.preventDefault();
            $.ajax( $(this).attr('href') )
                .done(function() {
                    divToDelete.remove();
                })
                .fail(function() {
                    alert('При удалении статьи произошла ошибка!');
                });
        }
    );
</script>
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
