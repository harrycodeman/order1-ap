<?php ap_add_js_calendar_to_element( '#addtour-datepicker' ); ?>

<div class="addtour-wrapper">

  <div id="addtour">
    <center><h1>Добавить новый тур</h1></center>

      <form name="create-tour-form" action="http://79.136.153.126/order1-ap/?page_id=13" method="post">
    <div class="tour">
      <div>
        <div>
          <p>Страна</p>
          <select name="ap_tour_country" id="country-addtour-form" class="dropdown">
              <option>Египет</option>
              <option>Россия</option>
              <option>США</option>
              <option>Англия</option>
              <option>Турция</option>
              <option>Германия</option>
              <option>Болгария</option>
              <option>Аргентина</option>
          </select>
        </div>

        <div>
          <p>Название отеля:</p>
          <select name="ap_tour_hotel" id="hotelname-addtour-form" class="dropdown">
              <option>Хилтон (5 звезд)</option>
              <option>Новая Гвинея (3 звезды)</option>
              <option>Полтава (4 звезды)</option>
              <option>Академия отдыха (5 звезд)</option>
              <option>Campus (2 звезды)</option>
          </select>
        </div>
        
        <div>
          <p>Стоимость тура:</p>
          <input name="ap_tour_cost" type="text" id="cost-addtour-form" />
        </div>
        <div>
          <span style="font-size: 18px; font-weight: bolder;">руб</span>
        </div>
        
      </div>
         
      <div>
      
        <div>
          <p>Курорт/Город:</p>
          <select name="ap_tour_resort" id="resortcity-addtour-form" class="dropdown">
              <option>Хургада</option>
              <option>Томск</option>
              <option>Шерегеш</option>
              <option>Мехико</option>
              <option>Прага</option>
              <option>Лос-Анжелес</option>
              <option>Бостон</option>
              <option>Париж</option>
              <option>Выборг</option>
              <option>Калуга</option>
              <option>Пхукет</option>
              <option>Сочи</option>
          </select>
        </div>
      
      
        <div>
          <p>Дата заезда:</p>
          <input name="ap_tour_start_date" type="text" id="addtour-datepicker" />
        </div>
        
        <div>
          <p>Количество ночей:</p>
          <select name="ap_tour_duration" id="nightcount-addtour-form" class="dropdown">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>5</option>
              <option>6</option>
              <option>7</option>
              <option>8</option>
              <option>9</option>
              <option>10</option>
              <option>11</option>
              <option>12</option>
              <option>13</option>
              <option>14</option>
          </select>
        </div>
        
        <div>
          <br><br><br>          
          <input type="checkbox" name="" value="Горящий тур">
          <span class="red" style="font-size: 18px; font-weight: bolder;" >Горящий тур</span>
        </div>
        
      </div>
    </div>
    
    <br><br>
    
    <div class="photo">
      <div>
        <p>Фотография (200x200px):</p>
        <input id="photo-addtour-file" type="file" name="">
      </div>
    </div>
    
    <br><br>
    
    <div class="sliderinfo">
    
      <p>Информация для слайдера (не обязательно к заполнению)</p>
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
          <p>Фотография для слайдера(960x374px):</p>
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
        <button id="cancel-addtour-button" type="reset">ОТМЕНИТЬ</button>
        <button name="create-tour-submit-button" id="create-addtour-button" type="submit">СОЗДАТЬ</button>
      </div>
    </div>
    
    <br><br>

    </form>

</div><!--addtour-->

<?php get_footer(); ?>
