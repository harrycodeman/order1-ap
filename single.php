<?php get_header(); ?>

<div id="content">
    <?php get_template_part( 'loop', 'single' ); ?>

<!--    <div id="postdivrich" class="postarea">-->
<!--        --><?php
//        if (have_posts()) : the_post();
//            wp_editor(get_the_content(), 'content', array( 'dfw', 'tinymce', 'editor_width' => 360 ));
//        endif;
//        ?>
<!--    </div>--><!-- #postdivrich-->
</div><!-- #content-->

<?php get_footer(); ?>
