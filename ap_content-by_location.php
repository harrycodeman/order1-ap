<?php
/*
Template Name: Страница поиска туров
*/

get_header();

AP_TourListView::show_for(
    "Туры",
    ap_get_tours( $filter_args )
); ?>
<br>
<?php get_footer(); ?>
