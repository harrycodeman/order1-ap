<?php

add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'ap_tour',
        array(
            'labels' => array(
                'name' => __( 'Tours' ),
                'singular_name' => __( 'Tour' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}
