<?php get_header() ?>

<div id="container">
    <div id="content" role="main">

        <div id="post-0" class="post error404 not-found">
            <h1 class="entry-title"><?php _e( 'В связи с внутренними ошибками не удалось сохранить запись!', 'imbalance2' ); ?></h1>
            <div class="entry-content">
                <p><?php _e( 'В случае повторения данной ошибки следует обратиться к разработчикам сайта.', 'imbalance2' ); ?></p>
                <a href="<?php echo home_url( '/' ); ?>">На главную</a>
                <br /><br />
            </div><!-- .entry-content -->
        </div><!-- #post-0 -->

    </div><!-- #content -->
</div><!-- #container -->

<?php get_footer() ?>
