<?php
/*
Template Name: Горящие предложения
*/

get_header();
AP_TourListView::show_for(
    "Горящие предложения",
    ap_get_tours(
        array(
            'numberposts' => -1,
            'meta_query' => array(
                array(
                    'key' => 'ap_burning_tour',
                    'compare' => 'LIKE',
                    'value' => 'is_burning'
                )
            )
        )
    )
);
get_footer();
