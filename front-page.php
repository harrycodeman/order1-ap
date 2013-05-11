<?php
/*
Template Name: Front-page
*/
?>

<?php get_header(); ?>
<?php ap_add_js_calendar_to_element( '#datepicker' ); ?>

<!--Подключение bootstrap-->
<link href="./wp-content/themes/imbalance2/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="./wp-content/themes/imbalance2/bootstrap/js/bootstrap.js"></script>

<!--Скрипт обеспечивает вызов форм с дополнительными параметрами в div#toursearch-->
<script>
    $(document).ready(function () {
        $("#additionalparameters-hideshow").click(function () {
            if ($("div#additional-parameters").css("display") != "none") {
                $("div#additional-parameters").css("display", "none");
                $("#additionalparameters-hideshow").css("top", "160px").text("Указать дополнительные параметры");
                $("#additionalparameters-submit").css("top", "143px");
            } else {
                $("div#additional-parameters").css("display", "block");
                $("#additionalparameters-hideshow").css("top", "220px").text("Скрыть дополнительные параметры");
                $("#additionalparameters-submit").css("top", "203px");
            }
        });
    });
</script>

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

                        <p class="hotel-title"><img src="<?php ap_get_image_url('star.png'); ?>" alt="">Hot Palmas Hotel
                            Resot</p>

                        <p class="nightcount-title"><img src="<?php ap_get_image_url('plane-dark.png'); ?>" alt="">13.02.2013
                            - 7 ночей</p>

                        <p class="remainingtour-title">Осталось 4</p>
                        <button type="button">КУПИТЬ ТУР</button>
                    </div>
                    <img src="<?php ap_get_image_url('banner.png'); ?>" width="960px" height="374px" alt="">
                </div>
                <div class="item">
                    <div class="banner-info">
                        <h2>День влюбленных в Турции</h2>

                        <p class="shortannouncement-title">19 000 руб. за 7 дней вдвоем в сказочном Стамбуле</p>

                        <p class="hotel-title"><img src="<?php ap_get_image_url('star.png'); ?>" alt="">Hot Palmas Hotel
                            Resot</p>

                        <p class="nightcount-title"><img src="<?php ap_get_image_url('plane-dark.png'); ?>" alt="">13.02.2013
                            - 7 ночей</p>

                        <p class="remainingtour-title">Осталось 4</p>
                        <button type="button">КУПИТЬ ТУР</button>
                    </div>
                    <img src="<?php ap_get_image_url('banner.png'); ?>" width="960px" height="374px" alt="">
                </div>
            </div>
            <!-- Carousel nav -->
            <a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
            <div class="carousel-control divider"></div>
            <a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
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
            <!--           <div class="detailsItem InputWCalendar"><span class="sh_calendar"><img src="/images/forma/dateicon.png" id="buttonDate" alt=""></span><div class="calen-cont"></div><input tabindex="3" title="Дата" size="16" id="date0" maxlength="10" type="text"><span class="date-arrow left"><img src="/images/date_inc.gif" onclick="stepDate(0,-1)" alt="-"></span><span class="date-arrow right"><img src="/images/date_inc.gif" onclick="stepDate(0,1)" alt="+"></span></div>-->
            <div id="div-datepicker">
                <input type="text" id="datepicker">

                <div id="calendar-image" onclick="$('#datepicker').focus()"></div>
            </div>

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
                <option value="">2 взрослых</option>
                <option value="">3 взрослых</option>
                <option value="">4 взрослых</option>
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

        <h1 class="red">Интересные предложения</h1>

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
    <div id="content" class="homepage" role="main">
        <div class="triparticles-wrapper">
            <div id="triparticles">

                <div class="title">
                    <h1>Статьи о путешествиях</h1>
                    <a href="<?php ap_get_blog_url(); ?>">Другие статьи</a>
                </div>

                <div id="articlethumbnail">
                    <div class="image">
                        <img src="<?php ap_get_image_url('paris-by-night.jpg'); ?>" alt="">
                    </div>
                    <div id="left-arrow">
                        <a href="/"></a>
                    </div>
                    <div class="announcement">
                        <h1>Вид на Париж с высоты птичьего полета или гений Эйфеля</h1>

                        <p>Ниезменные границы города, его чёткий план устройства и нехватка места для нового
                            строительства постепенно превратили город в действующий и живущий музей.</p>
                    </div>
                    <div id="right-arrow" class="horizontal-flip">
                        <a href="/"></a>
                    </div>
                </div>

                <div id="content" class="homepage" role="main">
                    <?php query_posts('posts_per_page=1'); ?>
                    <?php if (have_posts()) : the_post(); ?>

                        <!-- Display the Post's content in a div box. -->
                        <div id="article" class="entry">
                            <article>
                                <?php the_content(); ?>
                            </article>
                        </div>

                        <div class="links">
                            <a class="left" href="/"><img src="<?php ap_get_image_url('plane.png'); ?>">Путевки
                                в Париж</a>
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

                            //Display the list of comments d.m.Y
                            wp_list_comments(
                                array(
                                    'per_page' => 5, //Allow comment pagination
                                    'reverse_top_level' => true, //Show not the latest comments at the top of the list
                                    'style' => 'ul',
                                    'avatar_size' => 80,
                                    'callback' => 'ap_dirty_comments_list_start_el'
                                ),
                                $comments);
                            ?>
                        </ol>

                    <?php else: ?>
                        <p>Sorry, no posts matched your criteria.</p>
                    <?php endif; ?>

                </div>
                <!-- #content -->

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
