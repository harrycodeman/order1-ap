<?php
/*
Template Name: Front-page
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

<!--Подключение bootstrap-->
<link href="./wp-content/themes/imbalance2/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="./wp-content/themes/imbalance2/bootstrap/js/bootstrap.js"></script>
<!--END Подключение bootstrap-->

<!--Скрипт обеспечивает вызов форм с дополнительными параметрами в div#toursearch-->
<script>
  $(document).ready(function(){
    $("#additionalparameters-hideshow").click(function(){
              if ($("div#additional-parameters").css("display") != "none") {
                $("div#additional-parameters").css("display", "none");
                $("#additionalparameters-hideshow").css("top", "160px");
                $("#additionalparameters-submit").css("top", "143px");
              } else {
                $("div#additional-parameters").css("display", "block");
                $("#additionalparameters-hideshow").css("top", "220px");
                $("#additionalparameters-submit").css("top", "203px");
              }
    });
  });
</script>
<!--END Скрипт обеспечивает вызов форм с дополнительными параметрами в div#toursearch-->

    <div class="banner-wrapper">
      <div id="banner">
        <div id="myCarousel" class="carousel slide">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
          </ol>
          <!-- Carousel items -->
          <div class="carousel-inner">
            <div class="active item">
              <div class="banner-info">
                <h2>День влюбленных в Турции</h2>
                <p class="shortannouncement-title">12 000 руб. за 7 дней вдвоем в сказочном Стамбуле</p>
                <p class="hotel-title"><img src="./wp-content/themes/imbalance2/images/star.png" alt="">Hot Palmas Hotel Resot</p>
                <p class="nightcount-title">13.02.2013 - 7 ночей</p>
                <p class="remainingtour-title">Осталось 4</p>
                <button type="button">КУПИТЬ ТУР</button>
              </div>
              <img src="./wp-content/themes/imbalance2/images/banner.png" width="960px" height="374px" alt="">
            </div>
            <div class="item">
              <div class="banner-info">
                <h2>День влюбленных в Турции</h2>
                <p class="shortannouncement-title">19 000 руб. за 7 дней вдвоем в сказочном Стамбуле</p>
                <p class="hotel-title"><img src="./wp-content/themes/imbalance2/images/star.png" alt="">Hot Palmas Hotel Resot</p>
                <p class="nightcount-title">13.02.2013 - 7 ночей</p>
                <p class="remainingtour-title">Осталось 4</p>
                <button type="button">КУПИТЬ ТУР</button>
              </div>
              <img src="./wp-content/themes/imbalance2/images/banner.png" width="960px" height="374px" alt="">
            </div>
          </div>
          <!-- Carousel nav -->
          <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#myCarousel').carousel({
                  cycle: true,
                  animation: 1000,
                  itemFallbackDimension: 960
                });
          });
        </script>
      </div>
    </div>

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
          <button id="additionalparameters-hideshow">Указать дополнительные параметры</button>
          <button id="additionalparameters-submit">ПОДОБРАТЬ</button>
        </div>
      </div>
    </div>
    
    <div class="interestingoffers-wrapper">
      <div id="interestingoffers">
        <h1>Интересные предложения</h1>
        <a href="/">
          <div class="interestingoffer">
            <img class="image-circle" src="<?php bloginfo('template_url'); ?>/images/1.jpg" alt="">
            <span class="offername">Турция - Алания</span>
            <span class="offerprice">32 000</span>
          </div>
        </a>
        <a href="/">
          <div class="interestingoffer">
            <img class="image-circle" src="<?php bloginfo('template_url'); ?>/images/2.jpg" alt="">
            <span class="offername">Тайланд - Патайя</span>
            <span class="offerprice">23 000</span>
          </div>
        </a>
        <a href="/">
          <div class="interestingoffer">
            <img class="image-circle" src="<?php bloginfo('template_url'); ?>/images/3.jpg" alt="">
            <span class="offername">Испания - Майорка</span>
            <span class="offerprice">32 000</span>
          </div>
        </a>
        <a href="/">
          <div class="interestingoffer">
            <img class="image-circle" src="<?php bloginfo('template_url'); ?>/images/4.jpg" alt="">
            <span class="offername">Тайланд - Патайя</span>
            <span class="offerprice">32 000</span>
          </div>
        </a>
      </div>
    </div>
    
    <div class="snipping"></div>
    
    <div class="triparticles-wrapper">
      <div id="triparticles">
      
        <div class="title">
          <h1>Статьи о путешествиях</h1>
          <a href="/">Другие статьи</a>
        </div>

        <div id="articlethumbnail">
          <div class="image">
            <img src="<?php bloginfo('template_url'); ?>/images/paris-by-night.jpg" alt="">
          </div>
          <div id="left-arrow">
            <a href="/"></a>
          </div>
          <div class="announcement">
            <h1>Вид на Париж с высоты птичьего полета или гений Эйфеля</h1>
            <p>Ниезменные границы города, его чёткий план устройства и нехватка места для новго строительства постепенно превратили город в действующий и живущий музей.</p>
          </div>
          <div id="right-arrow" class="horizontal-flip">
            <a href="/"></a>
          </div>
        </div>
        
        <div id="content" class="homepage" role="main">
        <?php query_posts('posts_per_page=1'); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <!-- Display the Post's content in a div box. -->
            <div  id="article" class="entry">
              <article>
              <?php the_content(); ?>
              </article>
            </div>
            
            <div class="links">
              <a class="left" href="/"><img src="<?php bloginfo('template_url'); ?>/images/plane.png">Путевки в Париж</a>
              <br>
              <a class="left" href="/">Похожие направления</a>
            </div>
            
            
            <h2>Комментарии</h2>
            <ol class="commentlist">
              <?php
                //Gather comments for a specific page/post 
                $comments = get_comments(array(
                  'post_id' => get_the_ID(),
                  'status' => 'approve' //Change this to the type of comments to be displayed
                ));

                //Display the list of comments
                wp_list_comments(array(
                  'per_page' => 5, //Allow comment pagination
                  'reverse_top_level' => true, //Show not the latest comments at the top of the list
                  'style' => 'ul',
                  'avatar_size' => 80,
                ), $comments);
              ?>
            </ol>

        <!-- Stop The Loop (but note the "else:" - see next line). -->
        <?php endwhile; else: ?>

          <!-- The very first "if" tested to see if there were any Posts to -->
          <!-- display.  This "else" part tells what do if there weren't any. -->
          <p>Sorry, no posts matched your criteria.</p>

        <!-- REALLY stop The Loop. -->
        <?php endif; ?>
        </div><!-- #content -->
      </div>
    </div>
    
<?php get_footer(); ?>