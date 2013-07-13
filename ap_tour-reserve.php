<?php
/*
Template Name: Бронирование тура
*/
?>

<?php
if ( empty( $_POST ) ) {
    get_header();
    AP_TourReserveView::show_for(
        ap_get_tour_by_id( $_GET["ap_tour_id"] )
    );
    get_footer();
}
else {
    $hotel_rating = "";
    if ( !empty( $_POST['ap_tour_hotel_rating'] ) ) {
        $hotel_rating_int = $_POST['ap_tour_hotel_rating'];
        for ( $i = 0; $i < $hotel_rating_int; $i++ ) {
            $hotel_rating .= "*";
        }
        $hotel_rating = empty( $hotel_rating ) ? "" : " (" . $hotel_rating . ")";
    }

    $email_content =
        "КОНТАКТНЫЕ ДАННЫЕ ПОКУПАТЕЛЯ\n"
        . "Имя Фамилия: " . $_POST['ap_customer_first_name'] . " " . $_POST['ap_customer_last_name'] . "\n"
        . "Телефон: " . $_POST['ap_customer_phone'] . "\n"
        . "E-Mail: " . $_POST['ap_customer_email'] . "\n"
        . "\n"
        . "ПОЖЕЛАНИЯ\n"
        . "Страна: " . $_POST['ap_tour_country'] . "\n"
        . "Город/Курорт: " . $_POST['ap_tour_resort'] . "\n"
        . "Отель: " . $_POST['ap_tour_hotel'] . $hotel_rating . "\n"
        . "Даты: c " . $_POST['ap_tour_start_date'] . " по " . $_POST['ap_tour_end_date'] . "\n"
        . "В составе: " . $_POST['ap_adults_count'] . " взрослых и " . $_POST['ap_children_count'] . " детей.";

    $email_headers[] = 'From: Туристичесоке бюро АЛЫЕ ПАРУСА <mail@alyeparusa.info>';

    $manager_users = get_users( array( 'role' => 'subscriber' ) );
    foreach ($manager_users as $user) {
        $manager_emails[] = $user->user_email;
    }

    if ( !empty( $manager_emails ) ) {
        wp_mail( $manager_emails, 'Заявка на покупку тура', $email_content, $email_headers );
    }

    ap_redirect_to( home_url( ) );
} ?>
