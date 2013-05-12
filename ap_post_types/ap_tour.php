<?php

/*--- Content type registering ---*/
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
                'all_items' => __('All Tours'),
                'view_item' => __('View Tour'),
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
        )
    );
}

/*--- Adding Meta-Box for Tour content type ---*/
add_action( 'add_meta_boxes', 'ap_add_tours_meta_boxes' );
function ap_add_tours_meta_boxes() {
    add_meta_box('ap_tour_info_meta_box', 'Информация о туре', 'ap_print_tour_info_meta_box', 'ap_tour', 'normal', 'high');
}

function ap_print_tour_info_meta_box( $post ) {
    global $html;
    wp_nonce_field( basename( __FILE__ ), 'ap_tour_info_meta_box_nonce' );
    $html .= '<p><label>Страна <input type="text" name="ap_tour_country" value="'
        . get_post_meta( $post->ID, 'ap_tour_country', true ) . '" /></label></p>';
    $html .= '<p><label>Курорт/Город <input type="text" name="ap_tour_resort" value="'
        . get_post_meta( $post->ID, 'ap_tour_resort', true ) . '" /></label></p>';
    $html .= '<p><label>Название отеля <input type="text" name="ap_tour_hotel" value="'
        . get_post_meta( $post->ID, 'ap_tour_hotel', true ) . '" /></label></p>';
    $html .= '<p><label>Дата заезда <input id="ap_tour_start_date_picker" type="text" name="ap_tour_start_date" value="'
        . get_post_meta( $post->ID, 'ap_tour_start_date', true ) . '" /></label></p>';
    ap_add_js_calendar_to_element('#ap_tour_start_date_picker');
    $html .= '<p><label>Количество ночей <input type="text" name="ap_tour_duration" value="'
        . get_post_meta( $post->ID, 'ap_tour_duration', true ) . '" /></label></p>';
    $html .= '<p><label>Стоимость тура <input type="text" name="ap_tour_cost" value="'
        . get_post_meta( $post->ID, 'ap_tour_cost', true ) . '" /></label></p>';
    $html .= '<p><label>Горящая путевка <input type="checkbox" name="ap_burning_tour" value="is_burning" '
        . (get_post_meta( $post->ID, 'ap_burning_tour', true ) ? 'checked' : '') . ' /></label></p>';
    echo $html;
}

add_action( 'save_post', 'ap_save_tour_meta_box' );
function ap_save_tour_meta_box( $post_id ) {
    if (!isset( $_POST['ap_tour_info_meta_box_nonce'] )
        || !wp_verify_nonce( $_POST['ap_tour_info_meta_box_nonce'], basename( __FILE__ ) )) {
        return $post_id;
    }

    if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) {
        return $post_id;
    }

    if (!current_user_can( 'edit_post', $post_id )) {
        return $post_id;
    }

    $post = get_post( $post_id );
    if ($post->post_type == 'ap_tour') {
        update_post_meta( $post_id, 'ap_burning_tour', esc_attr($_POST['ap_burning_tour']) );
        update_post_meta( $post_id, 'ap_tour_country', esc_attr($_POST['ap_tour_country']) );
        update_post_meta( $post_id, 'ap_tour_resort', esc_attr($_POST['ap_tour_resort']) );
        update_post_meta( $post_id, 'ap_tour_hotel', esc_attr($_POST['ap_tour_hotel']) );
        update_post_meta( $post_id, 'ap_tour_start_date', esc_attr($_POST['ap_tour_start_date']) );
        update_post_meta( $post_id, 'ap_tour_duration', esc_attr($_POST['ap_tour_duration']) );
        update_post_meta( $post_id, 'ap_tour_cost', esc_attr($_POST['ap_tour_cost']) );
    }
    return $post_id;
}

/*--- Create, Save and Delete methods ---*/
function ap_create_tour_from_post() {
    $post_content = esc_attr($_POST['ap_tour_country']) . ' ' . esc_attr($_POST['ap_tour_resort']) . ' '
        . esc_attr($_POST['ap_tour_hotel']) . ' ' . esc_attr($_POST['ap_tour_start_date']) . ' '
        . esc_attr($_POST['ap_tour_duration']) . ' ' . esc_attr($_POST['ap_tour_cost']);
    $new_post = array(
        'comment_status' => 'closed',
        'post_author'    => get_current_user_id(),
        'post_content'   => $post_content,
        'post_excerpt'   => $post_content,
        'post_name'      => $post_content,
        'post_title'     => $post_content,
        'post_status'    => 'publish',
        'post_type'      => 'ap_tour',
    );
    $new_post_id = wp_insert_post( $new_post );
    update_post_meta( $new_post_id, 'ap_burning_tour', esc_attr($_POST['ap_burning_tour']) );
    update_post_meta( $new_post_id, 'ap_tour_country', esc_attr($_POST['ap_tour_country']) );
    update_post_meta( $new_post_id, 'ap_tour_resort', esc_attr($_POST['ap_tour_resort']) );
    update_post_meta( $new_post_id, 'ap_tour_hotel', esc_attr($_POST['ap_tour_hotel']) );
    update_post_meta( $new_post_id, 'ap_tour_start_date', esc_attr($_POST['ap_tour_start_date']) );
    update_post_meta( $new_post_id, 'ap_tour_duration', esc_attr($_POST['ap_tour_duration']) );
    update_post_meta( $new_post_id, 'ap_tour_cost', esc_attr($_POST['ap_tour_cost']) );
    return $new_post_id;
}
