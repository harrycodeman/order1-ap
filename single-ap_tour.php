<?php get_header(); ?>

<div id="content">
<?php if ( ap_is_edit_mode() ):
    if ( is_user_logged_in() ):
        get_template_part( 'ap_tour', 'edit' );
    else:
        get_template_part( 'error', 'low_rights' );
    endif;
else:
    get_template_part( 'loop', 'single' );
endif; ?>
</div><!-- #content -->

<?php get_footer(); ?>
