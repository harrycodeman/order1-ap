<?php
/*
Template Name: Страница поиска туров
*/

get_header();
AP_TourSearchPanelView::show_for( );

$page_number = (get_query_var('paged')) ? get_query_var('paged') : 1;
$filter_title = 'Все доступные туры';
$filter_args = array(
    'numberposts' => -1,
    'paged' => $page_number
);
$meta_query_args = array();
if ( !ap_is_view_mode( ) ) {
    /* Местоположение */
    if ( !empty( $_POST['ap_tour_country'] ) ) {
        array_push(
            $meta_query_args,
            array(
                'key' => 'ap_tour_country',
                'value' => $_POST['ap_tour_country'],
                'compare' => 'LIKE'
            )
        );
        $inner_filter_part .= ' в ' . $_POST['ap_tour_country'];
    }
    if ( !empty( $_POST['ap_tour_resort'] ) ) {
        array_push(
            $meta_query_args,
            array(
                'key' => 'ap_tour_resort',
                'value' => $_POST['ap_tour_resort'],
                'compare' => 'LIKE'
            )
        );
        if ( empty( $inner_filter_part ) ) {
            $inner_filter_part .= ' в ' . $_POST['ap_tour_resort'];
        }
        else {
            $inner_filter_part .= ', ' . $_POST['ap_tour_resort'];
        }
    }

    /* Рейтинг отеля */
    if ( !empty( $_POST['ap_tour_hotel_rating'] ) ) {
        array_push(
            $meta_query_args,
            array(
                'key' => 'ap_tour_hotel_rating',
                'value' => $_POST['ap_tour_hotel_rating']
            )
        );
        if ( !empty( $inner_filter_part ) ) {
            $inner_filter_part .= ' ';
        }
        $inner_filter_part .= 'c ' . $_POST['ap_tour_hotel_rating'] . '-звездным отелем';
    }

    /* Цена */
    if ( !empty( $_POST['ap_tour_cost_min'] )
            || !empty( $_POST['ap_tour_cost_max'] ) ) {
        $cost_min = empty( $_POST['ap_tour_cost_min'] ) ? 0 : $_POST['ap_tour_cost_min'];
        $cost_max = empty( $_POST['ap_tour_cost_max'] ) ? 1000000000 : $_POST['ap_tour_cost_max'];
        array_push(
            $meta_query_args,
            array(
                'key' => 'ap_tour_cost',
                'value' => array( $cost_min, $cost_max ),
                'type' => 'NUMERIC',
                'compare' => 'BETWEEN'
            )
        );
        if ( !empty( $inner_filter_part ) ) {
            $inner_filter_part .= ' ';
        }
        $inner_filter_part .= 'по цене';
        if ( !empty( $_POST['ap_tour_cost_min'] ) ) {
            $inner_filter_part .= ' от ' . number_format( $cost_min, 0, '.', ' ' ) . ' руб';
        }
        if ( !empty( $_POST['ap_tour_cost_max'] ) ) {
            $inner_filter_part .= ' до ' . number_format( $cost_max, 0, '.', ' ' ) . ' руб';
        }
    }

    /* Дата */
    if ( !empty( $_POST['ap_tour_start_date'] ) ) {
        array_push(
            $meta_query_args,
            array(
                'key' => 'ap_tour_start_date',
                'value' => $_POST['ap_tour_start_date']
            )
        );
        if ( !empty( $inner_filter_part ) ) {
            $inner_filter_part .= ' ';
        }
        $inner_filter_part .= 'с вылетом ' . $_POST['ap_tour_start_date'];
    }

    /* Продолжительность */
    if ( !empty( $_POST['ap_tour_duration'] ) ) {
        array_push(
            $meta_query_args,
            array(
                'key' => 'ap_tour_duration',
                'value' => $_POST['ap_tour_duration']
            )
        );
        if ( !empty( $inner_filter_part ) ) {
            $inner_filter_part .= ' ';
        }
        $inner_filter_part .= 'на ' . $_POST['ap_tour_duration'] . ' ночей(и)';
    }

    if ( !empty( $meta_query_args ) ) {
        $filter_args['meta_query'] = $meta_query_args;
    }
    if ( !empty( $inner_filter_part ) ) {
        $filter_title = 'Туры ' . $inner_filter_part;
    }
}

AP_TourListView::show_for(
    $filter_title,
    ap_get_tours( $filter_args )
); ?>
<br>
<?php get_footer(); ?>
