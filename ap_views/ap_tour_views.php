<?php
// TODO: сформировать класс для каждого view (через наследование) и реализовать методы отображения полей в родительском классе
// TODO: разнести представления по разным файлам

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
