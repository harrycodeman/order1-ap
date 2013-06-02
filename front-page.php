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

<!--Скрыть/показать параметры-->
<script type="text/javascript">
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
        <div id="banners_carousel" class="carousel slide">
            <div class="carousel-inner">

                <?php
                $tours_with_offer = get_posts(
                    array(
                        'post_type' => 'ap_tour',
                        'meta_query' => array(
                            array('key' => AP_Tour::offer_name_meta_name),
                            array('key' => AP_Tour::offer_description_meta_name),
                            array('key' => AP_Tour::offer_banner_meta_name)
                        )
                    )
                );

                $is_first = true;
                foreach ($tours_with_offer as $tour_with_offer) {
                    ap_load_tour_for_post( $tour_with_offer ) ?>

                    <div class="<?php if ( $is_first ) { $is_first = false; echo 'active'; } ?> item">
                        <div class="banner-info">
                            <h2><?php echo ap_get_the_tour()->offer_name; ?></h2>

                            <p class="shortannouncement-title"><?php echo ap_get_the_tour()->offer_description; ?></p>

                            <p class="hotel-title"><img src="<?php ap_print_image_url('star.png'); ?>" alt="">
                                <?php echo ap_get_the_tour()->hotel; ?>
                            </p>

                            <p class="nightcount-title"><img src="<?php ap_print_image_url('plane-dark.png'); ?>" alt="">
                                <?php echo ap_get_the_tour()->start_date . ' - ' . ap_get_the_tour()->duration . ' ночи(ей)'; ?>
                            </p>

                            <button type="button">КУПИТЬ ТУР</button>
                        </div>
                        <?php ap_the_tour_banner(); ?>
                    </div>

                <?php } ?>
            </div>
            <a class="carousel-control left" href="#banners_carousel" data-slide="prev"></a>
            <div class="carousel-control divider"></div>
            <a class="carousel-control right" href="#banners_carousel" data-slide="next"></a>
        </div>
    </div>
</div>

<!--Запуск слайдера-->
<script type="text/javascript">
    $(document).ready(function () {
        $('#banners_carousel').carousel({
            cycle: true,
            animation: 1000,
            itemFallbackDimension: 960
        });
    });
</script>

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

        <?php
        $nearest_tours = get_posts(
            array(
                'posts_per_page' => 4,
                'post_type' => 'ap_tour',
                'orderby' => 'post_date',
                'order' => 'DESC'
            )
        );

        $is_first = true;
        foreach ($nearest_tours as $tour) {
            ap_load_tour_for_post( $tour ) ?>

        <a href="<?php echo get_permalink( $tour->ID ) ?>">
            <div class="interestingoffer">
                <?php ap_the_tour_icon(); ?>
                <span class="offername"><?php echo ap_get_the_tour()->country . ' - ' . ap_get_the_tour()->resort; ?></span>
                <span class="offerprice"><?php echo ap_get_the_tour()->cost; ?></span>
            </div>
        </a>

        <?php } ?>

    </div>

</div>

<div class="snipping"></div>

<div class="triparticles-wrapper">
    <div id="content" class="homepage" role="main">
        <div class="triparticles-wrapper">
            <div id="triparticles">

                <div class="title">
                    <h1>Статьи о путешествиях</h1>
                    <a href="<?php ap_print_blog_url(); ?>">Другие статьи</a>
                </div>

                <div id="articlethumbnail">
                    <div class="image">
                        <img src="<?php ap_print_image_url('paris-by-night.jpg'); ?>" alt="">
                    </div>
                    <div id="left-arrow">
                        <a href="/"></a>
                    </div>
                    <div class="announcement">
                        <h1>Вид на Париж с высоты птичьего полета или гений Эйфеля</h1>

                        <p>Неизменные границы города, его чёткий план устройства и нехватка места для нового
                            строительства постепенно превратили город в действующий и живущий музей.</p>
                    </div>
                    <div id="right-arrow" class="horizontal-flip">
                        <a href="/"></a>
                    </div>
                </div>

                <div id="content" class="homepage" role="main">
                    <?php query_posts('posts_per_page=1'); ?>
                    <?php if (have_posts()) : the_post(); ?>
                        <div id="article" class="entry">
                            <article>
                                <?php the_content(); ?>
                            </article>
                        </div>

                        <div class="links">
                            <a class="left" href="/"><img src="<?php ap_print_image_url('plane.png'); ?>">Путевки
                                в Париж</a>
                            <br>
                            <a class="left" href="/">Похожие направления</a>
                        </div>
                    <?php else: ?>
                        <p>К сожалению, на текущий момент не опубликовано ни одной статьи.</p>
                    <?php endif; ?>

                </div><!-- #content -->

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
