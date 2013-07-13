<?php
class AP_TourReserveView extends AP_TourView {
    public function __construct( array $tours = null ) {
        parent::__construct( $tours );
    }

    public function show( ) { ?>
        <div class="reservtour-wrapper">
            <div id="reservtour">
                <form id="reservtour-form"
                      action="<?php ap_print_reserve_tour_page_permalink( $this->get_the_id( ) ); ?>" method="post">
                    <h1 style="text-align: center;">Бронирование тура</h1>
                    <div class="tour">
                        <div>
                            <div>
                                <p><label for="country-reservtour-form">Страна</label></p>
                                <input name="ap_tour_country" id="country-reservtour-form" type="text"
                                       value="<?php $this->the_country( ); ?>" placeholder="Любая страна">
                            </div>
                            <div>
                                <p><label for="hotelname-reservtour-form">Название отеля</label></p>
                                <input name="ap_tour_hotel" id="hotelname-reservtour-form" type="text"
                                       value="<?php $this->the_hotel( ); ?>" placeholder="Любой отель">
                            </div>
                            <div>
                                <p><label for="hotel-rating-reservtour-form">Уровень отеля</label></p>
                                <input name="ap_tour_hotel_rating" type="number" id="hotel-rating-reservtour-form"
                                       value="<?php $this->the_hotel_rating( ); ?>" min="1" max="5" placeholder="5*">
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
                                       value="<?php $this->the_resort( ); ?>" placeholder="Любой город">
                            </div>
                            <div>
                                <p><label for="reservtour-arrival-datepicker">Дата заезда</label></p>
                                <input name="ap_tour_start_date" id="reservtour-arrival-datepicker" type="text"
                                       value="<?php $this->the_start_date( ); ?>" placeholder="Пораньше">
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
                                <input name="ap_customer_last_name" type="text" id="surname-reservtour-form" required>
                            </div>
                            <div>
                                <p><label for="customer_phone">Контактный телефон</label></p>
                                <input name="ap_customer_phone" type="text" id="customer_phone" size="25" required>
                            </div>
                            <div>
                                <p><label for="email-reservtour-form">E-mail</label></p>
                                <input name="ap_customer_email" type="text" id="email-reservtour-form" required>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p><label for="name-reservtour-form">Имя</label></p>
                                <input name="ap_customer_first_name" type="text" id="name-reservtour-form" required>
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
        <?php ap_add_js_calendar_to_element( '#reservtour-arrival-datepicker' );
        ap_add_js_calendar_to_element( '#reservtour-departure-datepicker' );
    }

    public static function show_for( AP_Tour $tour = null ) {
        $tours = null;
        if ( !empty( $tour ) ) {
            $tours = array( $tour );
        }
        $view = new AP_TourReserveView( $tours );
        $view->show( );
    }
}
