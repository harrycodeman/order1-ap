<?php
function ap_print_create_tour_page_permalink() {
    echo get_permalink( 13 );
}

function ap_get_create_tour_page_permalink() {
    return get_permalink( 13 );
}

function ap_print_edit_tour_page_permalink( $tour_id ) {
    echo get_permalink( $tour_id );
}

function ap_print_search_tour_page_permalink(  ) {
    echo get_permalink( 83 );
}

function ap_get_search_tour_page_permalink(  ) {
    return get_permalink( 83 );
}

function ap_print_page_under_development_permalink( ) {
    echo get_permalink( 252 );
}

function ap_print_back_office_main_page_permalink( ) {
    echo get_permalink( 247 );
}

function ap_get_back_office_main_page_permalink( ) {
    return get_permalink( 247 );
}

function ap_print_reserve_tour_page_permalink( $tour_id = 0 ) {
    $permalink = get_permalink( 284 );
    if ( !empty( $tour_id ) ) {
        if ( strpos( $permalink, '?' ) === FALSE ) {
            $permalink .= '?';
        }
        else {
            $permalink .= '&';
        }
        $permalink .= "ap_tour_id=$tour_id";
    }
    echo $permalink;
}

function ap_print_reserve_tour_page_go_button( $tour_id = 0 ) { ?>
    <form action="<?php home_url( ); ?>">
        <input type="hidden" name="ap_tour_id" value="<?= $tour_id; ?>" />
        <input type="hidden" name="page_id" value="284" />
        <button type="submit">КУПИТЬ ТУР</button>
    </form>
<?php }

function ap_redirect_to( $link ) {
    header("Location: " . $link );
    exit( );
}

function ap_print_blog_url() {
    if( get_option( 'show_on_front' ) == 'page' ){
        echo get_permalink( get_option( 'page_for_posts' ) );
    } else {
        bloginfo( 'url' );
    }
}

function ap_print_image_url( $image_sub_path ) {
    echo bloginfo( 'template_url' ) . "/images/$image_sub_path";
}

function ap_print_script_url( $script_sub_path ) {
    echo bloginfo( 'template_url' ) . "/libs/$script_sub_path";
}

function ap_get_script_url( $script_sub_path ) {
    return get_bloginfo( 'stylesheet_directory' ) . "/libs/$script_sub_path";
}
