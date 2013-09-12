<?php
/*
Template Name: Blog-page
*/
?>

<?php get_header(); ?>
    <div class="main-wrapper">
        <div id="main">
            <h1 class="moderating-header">Статьи о путешествиях</h1>
            <div id="content" role="main">
                <?php get_template_part( 'loop', 'index' ); ?>
            </div><!-- #content -->
        </div><!-- #main -->
    </div><!-- .main-wrapper -->
<?php get_footer(); ?>
