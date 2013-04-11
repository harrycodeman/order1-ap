<?php
/*
Template Name: Reservetour-page
*/
?>

<?php get_header(); ?>

<!--Подключение плагина для формы с календарем-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery.js" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>
<!--END Подключение формы с календарем-->

<!--Подключение плагина маски для формы #customer_phone "Контактный телефон"-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="./wp-content/themes/imbalance2/libs/jquery.inputmask.js" type="text/javascript"></script>
<script src="./wp-content/themes/imbalance2/libs/jquery.bind-first-0.1.min.js" type="text/javascript"></script>
<script src="./wp-content/themes/imbalance2/libs/jquery.inputmask-multi.js" type="text/javascript"></script>
<script src="./wp-content/themes/imbalance2/libs/jquery.inputmask-multi-config.js" type="text/javascript"></script>
<!--END Подключение плагина маски для формы #customer_phone "Контактный телефон"-->

<!--Скрипт обеспечивает вызов формы с календарем-->
<script>
  $(document).ready(function(){
    $.datepicker.setDefaults(
      $.extend($.datepicker.regional["ru"])
    );
    $("#reservtour-arrival-datepicker").datepicker();
    $("#reservtour-departure-datepicker").datepicker();
  });
</script>
<!--END Скрипт обеспечивает вызов формы с календарем-->

<div class="reservtour-wrapper">

  <div id="reservtour">
  
    <h1>Бронирование тура</h1>
    
    <div class="tour">
      <div>
        
        <div>
          <p>Страна</p>
          <select id="country-reservtour-form" class="dropdown">
              <option value="">Египет</option>
              <option value="">Россия</option>
          </select>
        </div>
        
        <div>
          <p>Название отеля:</p>
          <select id="hotelname-reservtour-form" class="dropdown">
              <option value="">Hotel Name 5*</option>
          </select>
        </div>
        
        <div>
          <p>Количество человек:</p>
          <select id="adultcount-reservtour-form" class="dropdown">
            <option value="">1 взрослый</option>
            <option value="">2 взрослх</option>
            <option value="">3 взрослх</option>
            <option value="">4 взрослх</option>
          </select>
        </div>
        
        <div>
          <p> </p>
          <select id="childrencount-reservtour-form" class="dropdown">
            <option value="">Без детей</option>
            <option value="">1 ребенок</option>
            <option value="">2 ребенок</option>
            <option value="">3 ребенок</option>
            <option value="">4 ребенок</option>
          </select>
        </div>
        
      </div>
         
      <div>
      
        <div>
          <p>Курорт/Город:</p>
          <select id="resortcity-reservtour-form" class="dropdown">
              <option value="">Хургада</option>
              <option value="">Томск</option>
          </select>
        </div>
      
        <div>
          <p>Дата заезда:</p>
          <input type="text" id="reservtour-arrival-datepicker"/>
        </div>
        
        <div>
          <p>Дата выезда:</p>
          <input type="text" id="reservtour-departure-datepicker"/>
        </div>
        
      </div>
      
    </div>
    
    <div class="client">
    
      <div>
        
        <div>
          <p>Фамилия:</p>
          <input type="text" id="surname-reservtour-form"/>
        </div>
        
        <div style="height: 120px;">
          <p>Контактный телефон:</p>
          <input type="radio" name="mode" id="is_world" value="world" checked><label for="is_world">Страны мира</label>
          <span style="width: 20px; display: inline-block;"></span>
          <input type="radio" name="mode" id="is_russia" value="ru"><label for="is_russia">Города России</label>
          <input type="text" id="customer_phone" value="7" size="25"><br>
          <input type="checkbox" id="phone_mask" checked><label id="descr" for="phone_mask">Маска ввода</label>         
        </div>
        
        <div>
          <p>E-mail:</p>
          <input type="text" id="email-reservtour-form"/>
        </div>
        
      </div>
         
      <div>
      
        <div>
          <p>Имя:</p>
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