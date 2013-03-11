<?php
/*
Template Name: Blog-page
*/
?>

<?php get_header(); ?>

		<div id="container">
      <h1>Статьи о путешествиях</h1>
			<div id="content" role="main">
        <?php get_template_part( 'loop', 'index' ); ?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>