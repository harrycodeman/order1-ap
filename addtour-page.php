<?php
/*
Template Name: Addtour-page
*/
?>

<?php get_header(); ?>

<!--Подключение формы с календарем в div#toursearch "Data Picker"-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/i18n/jquery-ui-i18n.min.js"></script>
<!--END Подключение формы с календарем в div#toursearch "Data Picker"-->

<!--Скрипт обеспечивает вызов формы с календарем в div#toursearch-->
<script>
  $(document).ready(function(){
    $.datepicker.setDefaults(
      $.extend($.datepicker.regional["ru"])
    );
    $("#addtour-datepicker").datepicker();
  });
</script>
<!--END Скрипт обеспечивает вызов формы с календарем в div#toursearch-->

<div class="addtour-wrapper">

  <div id="addtour">
  
    <center><h1>Добавить новый тур</h1></center>
    
    <div class="tour">
      <div>
        
        <div>
          <p>Страна</p>
          <select id="country-addtour-form" class="dropdown">
              <option value="">Египет</option>
              <option value="">Россия</option>
          </select>
        </div>
        
        <div>
          <p>Название отеля:</p>
          <select id="hotelname-addtour-form" class="dropdown">
              <option value="">Hotel Name 5*</option>
          </select>
        </div>
        
        <div>
          <p>Стоимость тура:</p>
          <input type="text" id="cost-addtour-form"/>
        </div>
        <div>
          <span style="font-size: 18px; font-weight: bolder;">руб</span>
        </div>
        
      </div>
         
      <div>
      
        <div>
          <p>Курорт/Город:</p>
          <select id="resortcity-addtour-form" class="dropdown">
              <option value="">Хургада</option>
              <option value="">Томск</option>
          </select>
        </div>
      
      
        <div>
          <p>Дата заезда:</p>
          <input type="text" id="addtour-datepicker"/>
        </div>
        
        <div>
          <p>Количество ночей:</p>
          <select id="nightcount-addtour-form" class="dropdown">
              <option value="">1 ночей</option>
              <option value="">2 ночей</option>
              <option value="">3 ночей</option>
          </select>
        </div>
        
        <div>
          <br><br><br>          
          <input type="checkbox" name="" value="Горящий тур"> <span class="red" style="font-size: 18px; font-weight: bolder;" >Горящий тур</span>
        </div>
        
      </div>
    </div>
    
    <br><br>
    
    <div class="photo">
      <div>
        <p>Фотография (64x64px):</p>
        <input id="photo-addtour-file" type="file" name="">
      </div>
    </div>
    
    <br><br>
    
    <div class="sliderinfo">
    
      <p>Инфо для слайдера (не обязательно к заполнению)</p>
      <div>
        <div>
          <p>Название акции:</p>
          <input type="text" id="actionname-addtour-form"/>
        </div>
        <div>
          <p>Краткое описание:</p>
          <textarea id="briefdescription-addtour-form" rows="5" cols="50"></textarea>
        </div>
        <div>
          <p>Фотография для слайдера(300x200px):</p>
          <input id="sliderphoto-addtour-file" type="file" name="">
        </div>
      </div>
      <div>
        <div>
          <p>Осталось путевок:</p>
          <select id="staycount-addtour-form" class="dropdown">
              <option value="">1 путевок</option>
              <option value="">2 путевок</option>
              <option value="">3 путевок</option>
          </select>
        </div>
      </div>
      
    </div>
    
    <br><br>
    
    <div class="submitbuttons">
      <div>
        <button id="cancel-addtour-button" type="button">ОТМЕНИТЬ</button>
        <button id="create-addtour-button" type="button">СОЗДАТЬ</button>
      </div>
    </div>
    
    <br><br>

</div>

<?php get_footer(); ?>