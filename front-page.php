<?php
/*
Template Name: Front-page
*/
?>

<?php
get_header();
ap_tour_view_banners(
    get_posts(
        array(
            'post_type' => 'ap_tour',
            'meta_query' => array(
                array('key' => AP_Tour::offer_name_meta_name),
                array('key' => AP_Tour::offer_description_meta_name),
                array('key' => AP_Tour::offer_banner_meta_name)
            ),
            'orderby' => 'rand'
        )
    )
);
ap_tour_view_search( );
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
