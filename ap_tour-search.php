<?php
/*
Template Name: Страница поиска туров
*/
?>

<?php get_header(); ?>
<?php AP_TourSearchPanelView::show_for( ); ?>
<br><br>

<?php
$page_number = (get_query_var('paged')) ? get_query_var('paged') : 1;
$filter_title = 'Все доступные туры';
$filter_args = array(
    'post_type' => 'ap_tour',
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
?>

<div class="tourlist-wrapper">
    <div id="tourlist">
        <h1 class="red"><?= $filter_title; ?></h1>
        <div id="tours" class="list">
            <?php
            $posts_of_tours = get_posts( $filter_args );
            foreach ( $posts_of_tours as $post_of_tour ) {
                ap_load_tour_for_post( $post_of_tour ); ?>
                <div class="item">
                    <div class="image">
                        <?php ap_the_tour_icon( 100, 100 ); ?>
                    </div>
                    <div class="info">
                        <h2><?php ap_the_tour_country( ); ?>, <?php ap_the_tour_resort( ); ?></h2>
                        <p>Вылет <?php ap_the_tour_start_date( ); ?> на <?php ap_the_tour_duration( ); ?> ночей(и)</p>
                        <p><strong><?php ap_the_tour_hotel( ); ?></strong></p>
                    </div>
                    <div class="hotelrating">
                        <?php for ( $i = 0; $i < ap_get_the_tour()->hotel_rating; $i++ ) { ?>
                            <img src="<?php ap_print_image_url( 'star.png' ); ?>" alt="">
                        <?php } ?>
                    </div>
                    <div class="cost">
                        <h2><?php ap_the_tour_cost( ); ?> руб.</h2>
                        <p>Цена за 1 путевку</p>
                        <div class="editdelete-links">
                            <?php if ( is_user_logged_in( ) ) { ?>
                                <a class="blue" href="<?php ap_print_edit_tour_page_permalink( ap_get_the_tour_id() ); ?>">
                                    Редактировать
                                </a>
                                <a class="blue delete-tour-link"
                                   href="<?php ap_print_edit_tour_page_permalink( ap_get_the_tour_id() ); ?>?delete_tour=1">
                                    Удалить
                                </a>
                            <?php }
                            else { ?>
                                <a class="blue"
                                   href="<?php ap_print_reserve_tour_page_permalink( ap_get_the_tour_id( ) ); ?>">
                                    <img src="<?php ap_print_image_url( 'shopping-cart.png' ) ?>" alt="Корзина покупок"
                                        width="13px" height="13px">
                                    Купить
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div><!--.item-->
            <?php }

            $loaded_tours_count = count( $posts_of_tours );
            if ( empty( $loaded_tours_count ) ) { ?>
                <h2>К сожалению, не найдено ни одного тура, соответствующего текущим условиям поиска.</h2>
            <?php } ?>
        </div><!--.list-->
    </div><!--.tourlist-->
</div><!--.tourlist-wrapper-->
<br><br>

<!-- Удаление тура -->
<script type="text/javascript">
    $('.delete-tour-link').on('click', function(e) {
            e.preventDefault();
            $.ajax( $(this).attr('href') )
                .done(function() {
                    $('#additionalparameters-submit').click();
                })
                .fail(function() {
                    alert('При удалении тура произошла ошибка!');
                });
        }
    );
</script>
<?php get_footer(); ?>
