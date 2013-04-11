<?php
/*
Template Name: Tourlist-page
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
    $("#tourlist-datepicker").datepicker();
  });
</script>
<!--END Скрипт обеспечивает вызов формы с календарем в div#toursearch-->

<div class="tourlist-wrapper">

  <div id="tourlist">
  
    
      <center><h1>Список туров</h1></center>
      
      <div class="parameters">      
      
          <div>
            <p>Страна:</p>
            <select id="country-tourlist-form" class="dropdown">
                <option value="">Египет</option>
                <option value="">Россия</option>
            </select>
          </div>
          
          <div>
            <p>Курорт/Город:</p>
            <select id="resortcity-tourlist-form" class="dropdown">
                <option value="">Томск</option>
                <option value="">Геленджик</option>
            </select>
          </div>
          
          <div>
            <p>Дата добавления:</p>
            <input type="text" id="tourlist-datepicker"/>
          </div>
          
    </div>
    
    <br><br>
    
    <div class="list">
      <div class="item">
        <div class="image">
          <img class="image-circle" src="<?php bloginfo('template_url'); ?>/images/2.jpg">
        </div>
        <div class="info">
          <h2>Тайланд, Патайя</h2>
          <p>Вылет 13.02.13 на 6 ночей (до 19.02.13)</p>
          <p><strong>Hot Palmas Hotel Resort</strong></p>
        </div>
        <div class="hotelrating">
          <img src="./wp-content/themes/imbalance2/images/star.png" alt="">
          <img src="./wp-content/themes/imbalance2/images/star.png" alt="">
          <img src="./wp-content/themes/imbalance2/images/star.png" alt="">
          <img src="./wp-content/themes/imbalance2/images/star.png" alt="">
          <img src="./wp-content/themes/imbalance2/images/star.png" alt="">
        </div>
        <div class="cost">
          <h2>34 000 руб</h2>
          <p>Цена за 1 путевку</p>
          <div class="editdelete-links">
            <a class="blue" href="" alt="">Редактировать</a>
            <a class="blue" href="" alt="">Удалить</a></p>
          </div>
        </div>
      </div>
      
      <div class="item">
        <div class="image">
          <img class="image-circle" src="<?php bloginfo('template_url'); ?>/images/3.jpg">
        </div>
        <div class="info">
          <h2>Тайланд, Патайя</h2>
          <p>Вылет 13.02.13 на 6 ночей (до 19.02.13)</p>
          <p><strong>Hot Palmas Hotel Resort</strong></p>
        </div>
        <div class="hotelrating">
          <img src="./wp-content/themes/imbalance2/images/star.png" alt="">
          <img src="./wp-content/themes/imbalance2/images/star.png" alt="">
          <img src="./wp-content/themes/imbalance2/images/star.png" alt="">
        </div>
        <div class="cost">
          <h2>34 000 руб</h2>
          <p>Цена за 1 путевку</p>
          <div class="editdelete-links">
            <a class="blue" href="" alt="">Редактировать</a>
            <a class="blue" href="" alt="">Удалить</a></p>
          </div>
        </div>
      </div>
  </div>
  
  <br><br>

</div>

<?php get_footer(); ?>