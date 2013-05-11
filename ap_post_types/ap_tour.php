<?php

add_action( 'init', 'ap_create_post_type_tour' );
function ap_create_post_type_tour() {
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

/*--- Adding Meta Box for Tour post type ---*/
add_action( 'add_meta_boxes', 'ap_add_tours_meta_boxes' );
function ap_add_tours_meta_boxes() {
    add_meta_box('truediv', 'Название', 'ap_print_tour_meta_box', 'ap_tour', 'normal', 'high');
}

function ap_print_tour_meta_box( $post ) {
    global $html;
    wp_nonce_field( basename( __FILE__ ), 'seo_metabox_nonce' );
    $html .= '<label>Поле для поиска тура <input type="text" name="seotitle" value="'
        . get_post_meta($post->ID, 'seo_title',true) . '" /></label> ';
    echo $html;
}

add_action( 'save_post', 'ap_save_tour_meta_box' );
function ap_save_tour_meta_box( $post_id ) {
    if (!isset( $_POST['seo_metabox_nonce'] )
        || !wp_verify_nonce( $_POST['seo_metabox_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
        return $post_id;
    }

    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    $post = get_post($post_id);
    if ($post->post_type == 'ap_tour') {
        update_post_meta($post_id, 'seo_title', esc_attr($_POST['seotitle']));
    }
    return $post_id;
}
