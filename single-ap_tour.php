<?php if ( !is_user_logged_in( ) ):
    ap_show_error( 'low_rights' );
else:
    $is_to_delete = get_query_var( 'delete_tour' );
    if ( !empty( $is_to_delete ) ) {
        $tour = new AP_Tour();
        $tour->load( get_the_ID( ) );
        $tour->delete( );

        exit( );
    }

    if ( ap_is_view_mode( ) ):
        get_header( );
        ap_tour_view_edit( ap_get_the_tour( ) );
        get_footer( );
    else:
        $tour = new AP_Tour();
        $tour->load( get_the_ID( ) );

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
        ap_redirect_to( get_permalink( $tour->id ) );
    endif;
endif;
