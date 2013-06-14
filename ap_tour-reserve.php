<?php
/*
Template Name: Бронирование тура
*/
?>

<?php
if ( empty( $_POST ) || !empty( $_GET['ap_tour_id'] ) ) { ?>

    <?php get_header(); ?>
    <?php ap_add_js_calendar_to_element( '#reservtour-arrival-datepicker' ) ?>
    <?php ap_add_js_calendar_to_element( '#reservtour-departure-datepicker' ) ?>

    <?php
    $tour_id = $_GET["ap_tour_id"];
    ap_load_tour_for_id( $tour_id );
    ?>

    <div class="reservtour-wrapper">
        <div id="reservtour">
            <form id="reservtour-form" action="<?php ap_print_reserve_tour_page_permalink( $tour_id ); ?>"
                  method="post">
                <h1 style="text-align: center;">Бронирование тура</h1>
                <div class="tour">
                    <div>

                        <div>
                            <p><label for="country-reservtour-form">Страна</label></p>
                            <input name="ap_tour_country" id="country-reservtour-form" type="text"
                                   value="<?php ap_the_tour_country( ); ?>" placeholder="Любая страна">
                        </div>
                        <div>
                            <p><label for="hotelname-reservtour-form">Название отеля</label></p>
                            <input name="ap_tour_hotel" id="hotelname-reservtour-form" type="text"
                                   value="<?php ap_the_tour_hotel( ); ?>" placeholder="Любой отель">
                        </div>
                        <div>
                            <p><label for="hotel-rating-reservtour-form">Уровень отеля</label></p>
                            <input name="ap_tour_hotel_rating" type="number" id="hotel-rating-reservtour-form"
                                   value="<?php ap_the_tour_hotel_rating( ); ?>" min="1" max="5" placeholder="5*" required>
                        </div>
                        <div>
                            <p><label for="adultcount-reservtour-form">Количество человек</label></p>
                            <input name="ap_adults_count" id="adultcount-reservtour-form" type="number"
                                   placeholder="Взрослые" min="1">
                        </div>
                        <div>
                            <p><label for="childrencount-reservtour-form" style="display: none;">Количество детей</label></p>
                            <input name="ap_children_count" id="childrencount-reservtour-form" type="number"
                                   placeholder="Дети" min="1">
                        </div>
                    </div>
                    <div>
                        <div>
                            <p><label for="resortcity-reservtour-form">Курорт/Город</label></p>
                            <input name="ap_tour_resort" id="resortcity-reservtour-form" type="text"
                                   value="<?php ap_the_tour_resort( ); ?>" placeholder="Любой город">
                        </div>
                        <div>
                            <p><label for="reservtour-arrival-datepicker">Дата заезда</label></p>
                            <input name="ap_tour_start_date" id="reservtour-arrival-datepicker" type="text"
                                   value="<?php ap_the_tour_start_date( ); ?>" placeholder="Пораньше">
                            <div id="calendar-image" onclick="$('#reservtour-arrival-datepicker').focus()"></div>
                        </div>
                        <div>
                            <p><label for="reservtour-departure-datepicker">Дата выезда</label></p>
                            <input name="ap_tour_end_date" id="reservtour-departure-datepicker" type="text"
                                   placeholder="Попозже">
                            <div id="calendar-image" onclick="$('#reservtour-departure-datepicker').focus()"></div>
                        </div>

              </div>

            </div>

            <div class="client">

              <div>

                <div>
                  <p><label for="surname-reservtour-form">Фамилия</label></p>
                  <input name="ap_customer_last_name" type="text" id="surname-reservtour-form">
                </div>

                <div>
                  <p><label for="customer_phone">Контактный телефон</label></p>
                  <input name="ap_customer_phone" type="text" id="customer_phone" size="25">
                </div>

                <div>
                  <p><label for="email-reservtour-form">E-mail</label></p>
                  <input name="ap_customer_email" type="text" id="email-reservtour-form">
                </div>

              </div>

              <div>

                <div>
                  <p><label for="name-reservtour-form">Имя</label></p>
                  <input name="ap_customer_first_name" type="text" id="name-reservtour-form">
                </div>

              </div>

            </div>

            <br><br>

            <div class="submitbuttons">

              <div>
                <button id="reserve-reservtour-button" type="submit">ЗАБРОНИРОВАТЬ</button>
              </div>

            </div>

            <br><br>
        </form>
      </div> <!--#reservtour-->

    </div> <!--.reservtour-wrapper-->

    <?php get_footer(); ?>

<?php }
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
