<?php
/*
Template Name: Serchresult-page
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
    $("#datepicker").datepicker();
  });
</script>
<!--END Скрипт обеспечивает вызов формы с календарем в div#toursearch-->

<!--Скрипт обеспечивает отображение дополнительных параметров при загрузке страницы в div#toursearch-->
<script>
  $(document).ready(function(){
      $("div#additional-parameters").css("display", "block");
      $("#additionalparameters-hideshow").css("top", "220px");
      $("#additionalparameters-submit").css("top", "203px");
    });
</script>
<!--END Скрипт обеспечивает отображение дополнительных параметров при загрузке страницы в div#toursearch-->


      
  <div class="toursearch-wrapper">
    <div id="toursearch">
      <div id="main-parameters">
        <span class="from-title">Хочу поехать в:</span>
        <span class="date-title">Дата вылета:</span>
        <select id="from-form" class="dropdown">
          <option value="">Патайя</option>
          <option value="">Тайланд</option>
        </select>
        <select id="to-form" class="dropdown">
          <option value="">Патайя</option>
          <option value="">Тайланд</option>
        </select>
        <input type="text" id="datepicker"/>
        <span style="top: 45px; left: 780px;">на</span>
        <select id="days-form" class="dropdown">
          <option value="">1 день</option>
          <option value="">2 дня</option>
          <option value="">3 дня</option>
          <option value="">4 дня</option>
          <option value="">5 дней</option>
          <option value="">6 дней</option>
          <option value="">7 дней</option>
        </select>
      </div>
      <div id="additional-parameters">
        <span class="cost-title">Стоимость тура:</span>
        <span class="starcount-title">Количество звезд:</span>
        <span class="peoplecount-title">Сколько вас:</span>
        
        <input type="text" id="startcost"/>
        <span style="position: absolute; top: 40px; left: 125px;">&mdash;</span>
        <input type="text" id="endcost"/>
        <select id="starcount" class="dropdown">
          <option value="">Неважно</option>
        </select>
        <select id="adultcount" class="dropdown">
          <option value="">1 взрослый</option>
          <option value="">2 взрослх</option>
          <option value="">3 взрослх</option>
          <option value="">4 взрослх</option>
        </select>
        <select id="childrencount" class="dropdown">
          <option value="">Без детей</option>
          <option value="">1 ребенок</option>
          <option value="">2 ребенок</option>
          <option value="">3 ребенок</option>
          <option value="">4 ребенок</option>
        </select>
      </div>
      <div class="buttons">
        <button id="additionalparameters-submit">ПОДОБРАТЬ</button>
      </div>
    </div>
  </div>
    
  <br><br>
    
  <div class="tourlist-wrapper">
    <div id="tourlist">
      
      <h1 class="red">Туры в Тайланд, Патайя с 13.02.2013</h1>
      
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
    </div>
  </div>
  <br><br>



<?php get_footer(); ?>