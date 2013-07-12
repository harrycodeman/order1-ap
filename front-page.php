<?php
/*
Template Name: Front-page
*/
?>

<?php
get_header();
AP_TourBannersView::show_for(
    ap_get_tours(
        array(
            'meta_query' => array(
                array('key' => AP_Tour::offer_name_meta_name),
                array('key' => AP_Tour::offer_description_meta_name),
                array('key' => AP_Tour::offer_banner_meta_name)
            ),
            'orderby' => 'rand'
        )
    )
);
AP_TourSearchPanelView::show_for( );
//ap_tour_view_search( );
ap_tour_view_interesting_offers(
    get_posts(
        array(
            'posts_per_page' => 4,
            'post_type' => 'ap_tour',
            'orderby' => 'post_date',
            'order' => 'DESC'
        )
    )
);
ap_article_view_single_with_links(
    get_posts(
        array(
            'posts_per_page' => 1,
            'orderby' => 'rand'
        )
    )
);
get_footer();
