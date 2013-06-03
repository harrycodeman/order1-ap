<?php
/*
Template Name: Страница поиска туров
*/
?>

<?php get_header(); ?>
<?php ap_add_js_calendar_to_element( '#datepicker' ); ?>

<div class="toursearch-wrapper">
    <div id="toursearch">
        <form name="tour-search-form" action="<?php ap_print_search_tour_page_permalink( ); ?>"
              method="post">
            <div id="main-parameters">
                <span class="from-title">
                    <label for="from-form">Хочу поехать в</label>
                    <label style="display: none" for="to-form">Курорт</label>
                </span>
                <span class="date-title"><label for="datepicker">Дата вылета</label></span>
                <input id="from-form" type="text" autocomplete="off" placeholder="Любая страна">
                <input id="to-form" type="text" autocomplete="off" placeholder="Любой город">

                <div id="div-datepicker">
                    <input type="text" id="datepicker" autocomplete="off" placeholder="Любая">
                    <div id="calendar-image" onclick="$('#datepicker').focus()"></div>
                </div>

                <span style="top: 48px; left: 782px;">на</span>
                <input id="days-form" type="text" autocomplete="off" placeholder="Много дней">
            </div>
            <div id="additional-parameters" style="display: block !important;">
                <span class="cost-title">
                    <label for="startcost">Стоимость тура</label>
                    <label style="display: none" for="endcost">Максимальная стоимость тура</label>
                </span>

                <span class="starcount-title"><label for="starcount">Количество звезд</label></span>
                <input type="text" id="startcost" autocomplete="off" placeholder="Дешево">
                <span style="position: absolute; top: 46px; left: 132px; font-size: 10px; font-weight: bold;">&mdash;</span>
                <input type="text" id="endcost" autocomplete="off" placeholder="Дорого">
                <select id="starcount" class="dropdown">
                    <option value="0">Неважно</option>
                    <option value="1">1 (*)</option>
                    <option value="2">2 (**)</option>
                    <option value="3">3 (***)</option>
                    <option value="4">4 (****)</option>
                    <option value="5">5 (*****)</option>
                </select>
                <div class="buttons">
                    <button id="additionalparameters-clear" type="reset">ОЧИСТИТЬ</button>
                    <button id="additionalparameters-submit" type="submit">ПОДОБРАТЬ</button>
                </div>
            </div>
        </form>
    </div><!--#toursearch-->
</div><!--#toursearch-wrapper-->

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
            <img src="<?php ap_print_image_url('star.png'); ?>" alt="">
            <img src="<?php ap_print_image_url('star.png'); ?>" alt="">
            <img src="<?php ap_print_image_url('star.png'); ?>" alt="">
            <img src="<?php ap_print_image_url('star.png'); ?>" alt="">
            <img src="<?php ap_print_image_url('star.png'); ?>" alt="">
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
