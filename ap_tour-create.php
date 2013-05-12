<?php
/*
Template Name: Создание тура
*/
?>

<?php if (!is_user_logged_in()):
    get_template_part( 'error', 'low_rights' );
else:
    if (empty( $_POST )):
        get_header(); ?>
            <div id="content">
                <?php get_template_part( 'ap_tour', 'edit' ); ?>
            </div><!-- #content -->
        <?php get_footer();
    else:
        header("Location: " . get_permalink( ap_create_tour_from_post() ) );
        exit();
    endif;
endif;
