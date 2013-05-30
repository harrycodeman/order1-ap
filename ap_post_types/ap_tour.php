<?php

/*--- Content type registering ---*/
add_action( 'init', 'ap_create_post_type_tour' );
function ap_create_post_type_tour() {
    register_post_type( 'ap_tour',
        array(
            'labels' => array(
                'name' => __( 'Записи о турах' ),
                'singular_name' => __( 'Запись о туре' ),
                'add_new' => __('Добавление новой записи'),
                'add_new_item' => __('Добавить новую запись о Туре'),
                'edit_item' => __('Редактировать запись о Туре'),
                'new_item' => __('Новая запись о Туре'),
                'all_items' => __('Все записи о Турах'),
                'view_item' => __('Просмотреть запись о Туре'),
            ),
            'public' => true,
            'has_archive' => true,
            'menu_position' => 5,
        )
    );
}

//wp_nonce_field( basename( __FILE__ ), 'ap_tour_info_meta_box_nonce' );

//if (!isset( $_POST['ap_tour_info_meta_box_nonce'] )
//    || !wp_verify_nonce( $_POST['ap_tour_info_meta_box_nonce'], basename( __FILE__ )) ) {
//    return $post_id;
//}

class AP_Tour {
    const burning_meta_name = 'ap_burning_tour';
    const country_meta_name = 'ap_tour_country';
    const resort_meta_name = 'ap_tour_resort';
    const hotel_meta_name = 'ap_tour_hotel';
    const start_date_meta_name = 'ap_tour_start_date';
    const duration_meta_name = 'ap_tour_duration';
    const cost_meta_name = 'ap_tour_cost';
    const icon_meta_name = 'ap_tour_icon';
    const offer_name_meta_name = 'ap_tour_offer_name';
    const offer_description_meta_name = 'ap_tour_offer_description';
    const offer_banner_meta_name = 'ap_tour_offer_banner';

    public $id;

    public $country;
    public $resort;
    public $hotel;
    public $start_date;
    public $duration;
    public $cost;
    public $icon_attachment_id;
    public $is_burning;

    public $offer_name;
    public $offer_description;
    public $offer_banner_attachment_id;

    public function load( $tour_id ) {
        $this->id = $tour_id;
        $this->is_burning = $this->load_meta( self::burning_meta_name );
        $this->country = $this->load_meta( self::country_meta_name );
        $this->resort = $this->load_meta( self::resort_meta_name );
        $this->hotel = $this->load_meta( self::hotel_meta_name );
        $this->start_date = $this->load_meta( self::start_date_meta_name );
        $this->duration = $this->load_meta( self::duration_meta_name );
        $this->cost = $this->load_meta( self::cost_meta_name );
        $this->icon_attachment_id = $this->load_meta( self::icon_meta_name );
        $this->offer_name = $this->load_meta( self::offer_name_meta_name );
        $this->offer_description = $this->load_meta( self::offer_description_meta_name );
        $this->offer_banner_attachment_id = $this->load_meta( self::offer_banner_meta_name );
    }

    private function load_meta( $meta_name ) {
        return get_post_meta( $this->id, $meta_name, true );
    }

    public function save() {
        if ( !isset( $this->id ) ) {
            $this->create_post();
        }
        $this->save_info();
    }

    private function create_post()
    {
        $tour_title = join('_', array(
            $this->country,
            $this->resort,
            'выезд', $this->start_date,
            'на', $this->duration, 'дня'
        ));
        $tour_info = $new_post = array(
            'comment_status' => 'closed',
            'post_author' => get_current_user_id(),
            'post_content' => '',
            'post_excerpt' => '',
            'post_title' => $tour_title,
            'post_name' => $tour_title,
            'post_status' => 'publish',
            'post_type' => 'ap_tour',
        );
        $this->id = wp_insert_post($tour_info);
    }

    private function save_info() {
        $this->save_meta( self::burning_meta_name, $this->is_burning );
        $this->save_meta( self::country_meta_name, $this->country );
        $this->save_meta( self::resort_meta_name, $this->resort );
        $this->save_meta( self::hotel_meta_name, $this->hotel );
        $this->save_meta( self::start_date_meta_name, $this->start_date );
        $this->save_meta( self::duration_meta_name, $this->duration );
        $this->save_meta( self::cost_meta_name, $this->cost );
        $this->save_meta( self::icon_meta_name, $this->icon_attachment_id );
        $this->save_meta( self::offer_name_meta_name, $this->offer_name );
        $this->save_meta( self::offer_description_meta_name, $this->offer_description );
        $this->save_meta( self::offer_banner_meta_name, $this->offer_banner_attachment_id );
    }

    private function save_meta( $meta_name, $meta_value ) {
        if ( empty($meta_value) ) {
            delete_post_meta( $this-> id, $meta_name);
        }
        else {
            update_post_meta( $this->id, $meta_name, esc_attr($meta_value) );
        }
    }
}

/*-----View-----*/
function ap_get_tour() {
    $ap_tour = $GLOBALS['ap_tour_exemplar'];
    if ( empty( $ap_tour ) ) {
        $ap_tour = new AP_Tour( );
        $ap_tour->load( get_the_ID() );
    }
    return $ap_tour;
}
