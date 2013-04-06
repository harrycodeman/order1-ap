<?php get_header(); ?>

<div id="content">
    <div id="postdivrich" class="postarea">
<!--    --><?php //get_template_part( 'loop', 'single' ); ?>

        <?php
        if (have_posts()) : the_post();
            wp_editor(get_the_content(), 'content', array( 'dfw', 'tinymce', 'editor_width' => 360 ));
        endif;
        ?>
    </div>
</div><!-- #content-->

<?php get_footer(); ?>
