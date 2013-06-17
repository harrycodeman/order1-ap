<?php

/*--- Регистрация типа контента ---*/
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

/*--- Модель ---*/
class AP_Tour {
    const burning_meta_name = 'ap_burning_tour';
    const country_meta_name = 'ap_tour_country';
    const resort_meta_name = 'ap_tour_resort';
    const hotel_meta_name = 'ap_tour_hotel';
    const hotel_rating_meta_name = 'ap_tour_hotel_rating';
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
    public $hotel_rating;
    public $start_date;
    public $duration;
    public $cost;
    private $icon;
    public $is_burning;

    public $offer_name;
    public $offer_description;
    private $offer_banner;

    public function set_icon( AP_Image $image = NULL ) {
        $this->icon = $image;
    }

    public function get_icon( ) {
        return AP_Image::cast( $this->icon );
    }

    public function set_offer_banner( AP_Image $image = NULL ) {
        $this->offer_banner = $image;
    }

    public function get_offer_banner( ) {
        return AP_Image::cast( $this->offer_banner );
    }

    public function load( $tour_id ) {
        $this->id = $tour_id;
        $this->is_burning = $this->load_meta( self::burning_meta_name );
        $this->country = $this->load_meta( self::country_meta_name );
        $this->resort = $this->load_meta( self::resort_meta_name );
        $this->hotel = $this->load_meta( self::hotel_meta_name );
        $this->hotel_rating = $this->load_meta( self::hotel_rating_meta_name );
        $this->start_date = $this->load_meta( self::start_date_meta_name );
        $this->duration = $this->load_meta( self::duration_meta_name );
        $this->cost = $this->load_meta( self::cost_meta_name );
        $this->icon = $this->load_image( self::icon_meta_name );
        $this->offer_name = $this->load_meta( self::offer_name_meta_name );
        $this->offer_description = $this->load_meta( self::offer_description_meta_name );
        $this->offer_banner = $this->load_image( self::offer_banner_meta_name );
    }

    private function load_image( $meta_name ) {
        $image_id = $this->load_meta( $meta_name );
        if ( !empty( $image_id ) ) {
            return AP_Image::load_from_id( $image_id );
        }
        return NULL;
    }

    private function load_meta( $meta_name ) {
        return get_post_meta( $this->id, $meta_name, true );
    }

    public function save( ) {
        if ( empty( $this->id ) ) {
            $this->create_post();
        }
        else {
            $this->update_post();
        }
        $this->save_info();
    }

    private function create_post( ) {
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

    private function update_post( ) {
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
        $this->id = wp_update_post($tour_info);
    }

    private function save_info( ) {
        $this->save_meta( self::burning_meta_name, $this->is_burning );
        $this->save_meta( self::country_meta_name, $this->country );
        $this->save_meta( self::resort_meta_name, $this->resort );
        $this->save_meta( self::hotel_meta_name, $this->hotel );
        $this->save_meta( self::hotel_rating_meta_name, $this->hotel_rating );
        $this->save_meta( self::start_date_meta_name, $this->start_date );
        $this->save_meta( self::duration_meta_name, $this->duration );
        $this->save_meta( self::cost_meta_name, $this->cost );
        $this->save_image( $this->icon, self::icon_meta_name, 200, 200 );
        $this->save_meta( self::offer_name_meta_name, $this->offer_name );
        $this->save_meta( self::offer_description_meta_name, $this->offer_description );
        $this->save_image( $this->offer_banner, self::offer_banner_meta_name, 960, 382 );
    }

    private function save_image( AP_Image $image = NULL, $meta_name, $width, $height ) {
        if ( !empty( $image ) ) {
            $image->save( $width, $height );
            update_post_meta( $this->id, $meta_name, esc_attr($image->id) );
        }
        else {
            delete_post_meta( $this-> id, $meta_name);
        }
    }

    private function save_meta( $meta_name, $meta_value ) {
        if ( empty( $meta_value ) ) {
            delete_post_meta( $this-> id, $meta_name);
        }
        else {
            update_post_meta( $this->id, $meta_name, esc_attr($meta_value) );
        }
    }

    public function delete( ) {
        wp_delete_post( $this->id, true );
    }
}

/*--- Отображение ---*/
function ap_load_tour_for_post( WP_Post $post ) {
    $GLOBALS['ap_tour_exemplar_id'] = $post->ID;
    unset( $GLOBALS['ap_tour_exemplar'] );
}

function ap_load_tour_for_id( $tour_id ) {
    $GLOBALS['ap_tour_exemplar_id'] = $tour_id;
    unset( $GLOBALS['ap_tour_exemplar'] );
}

function ap_get_the_tour_id( ) {
    if ( array_key_exists( 'ap_tour_exemplar_id', $GLOBALS ) ) {
        return $GLOBALS['ap_tour_exemplar_id'];
    }
    return get_the_ID();
}

function ap_get_the_tour( ) {
    if ( array_key_exists( 'ap_tour_exemplar', $GLOBALS ) ) {
        return $GLOBALS['ap_tour_exemplar'];
    }

    $tour = new AP_Tour( );
    $tour_id = ap_get_the_tour_id( );
    if ( !empty( $tour_id ) ) {
        $tour->load( $tour_id );
    }

    $GLOBALS['ap_tour_exemplar'] = $tour;
    return $tour;
}

function ap_the_tour_country( ) {
    echo ap_get_the_tour( )->country;
}

function ap_the_tour_resort( ) {
    echo ap_get_the_tour( )->resort;
}

function ap_the_tour_hotel( ) {
    echo ap_get_the_tour( )->hotel;
}

function ap_the_tour_hotel_rating( ) {
    echo ap_get_the_tour( )->hotel_rating;
}

function ap_the_tour_start_date( ) {
    echo ap_get_the_tour( )->start_date;
}

function ap_the_tour_duration( ) {
    echo ap_get_the_tour( )->duration;
}

function ap_the_tour_cost( ) {
    $cost_without_spaces = preg_replace( '/\s+/', '', ap_get_the_tour( )->cost );
    echo number_format( $cost_without_spaces, 0, '.', ' ' );
}

function ap_the_tour_icon( $width = 200, $height = 200 ) {
    $icon = ap_get_the_tour( )->get_icon( );
    if ( !empty( $icon ) ) { ?>
        <img class="image-circle" src="<?php echo $icon->get_url( ); ?>" width="<?= $width; ?>" height="<?= $height; ?>"
             alt="Изображение остутствует">
    <?php }
    else { ?>
        <img class="image-circle" src="<?php ap_print_image_url( 'tour-icon-missed.jpg' ); ?>" width="<?= $width; ?>"
             height="<?= $height; ?>" alt="Изображение остутствует">;
    <?php }
}

function ap_the_tour_burning( ) {
    if ( ap_get_the_tour()->is_burning ) {
        echo 'checked';
    }
}

function ap_the_tour_offer_name( ) {
    echo ap_get_the_tour( )->offer_name;
}

function ap_the_tour_offer_description( ) {
    echo ap_get_the_tour( )->offer_description;
}

function ap_the_tour_banner( $width = 960, $height = 382 ) {
    $offer_banner = ap_get_the_tour()->get_offer_banner( );
    if ( !empty( $offer_banner ) ) { ?>
        <img src="<?= $offer_banner->get_url( ); ?>" width="<?= $width; ?>" height="<?= $height; ?>"
             alt="Изображение остутствует">
    <?php }
    else { ?>
        <img src="<?php ap_print_image_url( 'tour-banner-missed.jpg' ); ?>" width="<?= $width; ?>"
             height="<?= $height; ?>" alt="Изображение остутствует">
    <?php }
}
