<?php

add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'ap_tour',
        array(
            'labels' => array(
                'name' => __( 'Tours' ),
                'singular_name' => __( 'Tour' ),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Tour'),
                'edit_item' => __('Edit Tour'),
                'new_item' => __('New Tour'),
                'all_items' => __('All Books'),
                'view_item' => __('View Tour'),
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
        )
    );
}
