<?php
/*
Template Name: Бронирование тура
*/
?>

<?php get_header(); ?>
<?php ap_add_js_calendar_to_element( '#reservtour-arrival-datepicker' ) ?>
<?php ap_add_js_calendar_to_element( '#reservtour-departure-datepicker' ) ?>

<?php
$tour_id = get_query_var( 'ap_tour_id' );
ap_load_tour_for_id( $tour_id );
?>

<div class="reservtour-wrapper">
    <div id="reservtour">
        <h1 style="text-align: center;">Бронирование тура</h1>
        <div class="tour">
            <div>

                <div>
                    <p><label for="country-reservtour-form">Страна</label></p>
                    <input id="country-reservtour-form" type="text" value="<?php ap_the_tour_country( ); ?>"
                        placeholder="Любая страна">
                </div>
                <div>
                    <p><label for="hotelname-reservtour-form">Название отеля</label></p>
                    <input id="hotelname-reservtour-form" type="text" value="<?php ap_the_tour_hotel( ); ?>"
                        placeholder="Любой отель">
                </div>
                <div>
                    <p><label for="hotel-rating-reservtour-form">Уровень отеля</label></p>
                    <input name="ap_tour_hotel_rating" type="number" id="hotel-rating-reservtour-form"
                           value="<?php ap_the_tour_hotel_rating( ); ?>" min="1" max="5" placeholder="5*" required>
                </div>
                <div>
                    <p><label for="adultcount-reservtour-form">Количество человек</label></p>
                    <input id="adultcount-reservtour-form" type="number" placeholder="Взрослые" min="1">
                </div>
                <div>
                    <p><label for="childrencount-reservtour-form" style="display: none;">Количество детей</label></p>
                    <input id="childrencount-reservtour-form" type="number" placeholder="Дети" min="1">
                </div>
            </div>
            <div>
                <div>
                    <p><label for="resortcity-reservtour-form">Курорт/Город</label></p>
                    <input id="resortcity-reservtour-form" type="text" value="<?php ap_the_tour_resort( ); ?>"
                           placeholder="Любой город">
                </div>
                <div>
                    <p><label for="reservtour-arrival-datepicker">Дата заезда</label></p>
                    <input type="text" id="reservtour-arrival-datepicker" placeholder="Пораньше">
                    <div id="calendar-image" onclick="$('#reservtour-arrival-datepicker').focus()"></div>
                </div>
                <div>
                    <p><label for="reservtour-departure-datepicker">Дата выезда</label></p>
                    <input type="text" id="reservtour-departure-datepicker" placeholder="Попозже">
                    <div id="calendar-image" onclick="$('#reservtour-departure-datepicker').focus()"></div>
                </div>
        
      </div>
      
    </div>
    
    <div class="client">
    
      <div>
        
        <div>
          <p>Фамилия</p>
          <input type="text" id="surname-reservtour-form"/>
        </div>
        
        <div>
          <p>Контактный телефон</p>
          <input type="text" id="customer_phone" size="25"><br>
        </div>
        
        <div>
          <p>E-mail</p>
          <input type="text" id="email-reservtour-form"/>
        </div>
        
      </div>
         
      <div>
      
        <div>
          <p>Имя</p>
          <input type="text" id="name-reservtour-form"/>
        </div>
        
      </div>
      
    </div>
    
    <br><br>
    
    <div class="submitbuttons">
    
      <div>
        <button id="reserve-reservtour-button" type="button">ЗАБРОНИРОВАТЬ</button>
      </div>
      
    </div>
    
    <br><br>
    
  </div>
    
</div>

<?php get_footer(); ?>
