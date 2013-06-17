<?php get_header(); ?>

<div class="error-wrapper">
    <div id="container">
        <div id="content" role="main">
            <div class="error-text-wrapper">
                <h1 class="entry-title" style="margin-left: 0;">
                    <?php _e( '404! Не получается найти страницу!', 'imbalance2' ); ?>
                </h1>
                <div class="entry-content" style="margin-left: 0; width: 960px;">
                    <p><?php _e( 'Запрошенная Вами страница не может быть отображена.', 'imbalance2' ); ?></p>
                </div><!-- .entry-content -->
            </div><!--.error-text-wrapper-->
        </div><!--#content-->
    </div><!--#container-->
</div><!--.error-wrapper-->

<?php get_footer(); ?>
