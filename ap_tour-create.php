<?php
/*
Template Name: Создание тура
*/
?>

<?php if ( !is_user_logged_in( ) ):
    ap_show_error( 'low_rights' );
else:
    if ( empty( $_POST ) ):
        get_header( );
        ap_tour_view_edit( );
        get_footer( );
    else:
        $tour = new AP_Tour();
        $tour->is_burning = $_POST['ap_burning_tour'];
        $tour->country = $_POST['ap_tour_country'];
        $tour->resort = $_POST['ap_tour_resort'];
        $tour->hotel = $_POST['ap_tour_hotel'];
        $tour->hotel_rating = $_POST['ap_tour_hotel_rating'];
        $tour->start_date = $_POST['ap_tour_start_date'];
        $tour->duration = $_POST['ap_tour_duration'];
        $tour->cost = $_POST['ap_tour_cost'];
        if ( is_uploaded_file( $_FILES['ap_tour_icon']['tmp_name'] ) ) {
            $tour->set_icon(
                AP_Image::load_from_file_object( $_FILES['ap_tour_icon'] )
            );
        }
        $tour->offer_name = $_POST['ap_tour_offer_name'];
        $tour->offer_description = $_POST['ap_tour_offer_description'];
        if ( is_uploaded_file( $_FILES['ap_tour_offer_banner']['tmp_name'] ) ) {
            $tour->set_offer_banner(
                AP_Image::load_from_file_object( $_FILES['ap_tour_offer_banner'] )
            );
        }

        $tour->save();
        ap_redirect_to( ap_get_create_tour_page_permalink( ) );
    endif;
endif;
