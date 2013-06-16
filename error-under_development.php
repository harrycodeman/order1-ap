<?php
/*
Template Name: Раздел находится в разработке
*/
?>

<?php get_header(); ?>

<div class="error-wrapper">
    <div id="container">
        <div id="content" role="main">
            <div class="error-text-wrapper">
                <h1 class="entry-title" style="margin-left: 0;">
                    <?php _e( 'Раздел находится в разработке!', 'imbalance2' ); ?>
                </h1>
                <div class="entry-content" style="margin-left: 0; width: 960px;">
                    <p><?php _e( 'В настоящий момент данный раздел сайта находится в разработке.', 'imbalance2' ); ?></p>
                </div><!--.entry-content-->
            </div><!--.error-text-wrapper-->
        </div><!--#content-->
    </div><!--#container-->
</div><!--.error-wrapper-->

<?php get_footer(); ?>
