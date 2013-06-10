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

                            <p class="nightcount-title">
                                <img src="<?php ap_print_image_url('plane-dark.png'); ?>"
                                     alt="">
                                <?php echo ap_get_the_tour()->start_date . ' - ' . ap_get_the_tour()->duration
                                    . ' ночей(и)'; ?>
                            </p>

                            <button type="button">КУПИТЬ ТУР</button>
                        </div>
                        <div class="indent"></div>
                        <?php ap_the_tour_banner( ); ?>

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
        <form name="tour-search-form" action="<?php ap_print_search_tour_page_permalink( ); ?>"
              method="post">
            <div id="main-parameters">
                <span class="from-title">
                    <label for="from-form">Хочу поехать в</label>
                    <label style="display: none" for="to-form">Курорт</label>
                </span>
                <span class="date-title"><label for="datepicker">Дата вылета</label></span>
                <input name="ap_tour_country" id="from-form" type="text" autocomplete="off" placeholder="Любая страна">
                <input name="ap_tour_resort" id="to-form" type="text" autocomplete="off" placeholder="Любой город">

                <div id="div-datepicker">
                    <input name="ap_tour_start_date" type="text" id="datepicker" autocomplete="off" placeholder="Любая">
                    <div id="calendar-image" onclick="$('#datepicker').focus()"></div>
                </div>

                <span style="top: 48px; left: 782px;"><label for="days-form">на</label></span>
                <input name="ap_tour_duration" id="days-form" type="text" autocomplete="off" placeholder="Много ночей">
            </div>
            <div id="additional-parameters" style="display: block !important;">
                <span class="cost-title">
                    <label for="startcost">Стоимость тура</label>
                    <label style="display: none" for="endcost">Максимальная стоимость тура</label>
                </span>

                <span class="starcount-title"><label for="starcount">Количество звезд</label></span>
                <input name="ap_tour_cost_min" id="startcost" type="text" autocomplete="off" placeholder="Дешево">
                <span style="position: absolute; top: 46px; left: 132px; font-size: 10px; font-weight: bold;">&mdash;</span>
                <input name="ap_tour_cost_max" id="endcost" type="text"  autocomplete="off" placeholder="Дорого">
                <select name="ap_tour_hotel_rating" id="starcount" class="dropdown">
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
<div class="toursearch-bottom-line">
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

                <?php
                $article_posts = get_posts(
                    array(
                        'posts_per_page' => 1,
                        'orderby' => 'rand'
                    )
                );
                foreach ( $article_posts as $article_post ) { ?>
                    <div id="articlethumbnail">
                        <div class="image">
                            <?php $url = wp_get_attachment_url( get_post_thumbnail_id( $article_post->ID ) ); ?>
                            <img src="<?= $url; ?>" alt="" width="940px" height="370px">
                        </div>
                        <div id="left-arrow">
                            <a href="/"></a>
                        </div>
                        <div class="announcement">
                            <h1><?= $article_post->post_title; ?></h1>

                            <p>Неизменные границы города, его чёткий план устройства и нехватка места для нового
                                строительства постепенно превратили город в действующий и живущий музей.</p>
                        </div>
                        <div id="right-arrow" class="horizontal-flip">
                            <a href="/"></a>
                        </div>
                    </div>

                    <div id="content" class="homepage" role="main">
                            <div id="article" class="entry">
                                <article>
                                    <?= $article_post->post_content; ?>
                                </article>
                            </div>

                            <div class="links">
                                <a class="left" href="<?php ap_print_page_under_development_permalink( ); ?>">
                                    <img src="<?php ap_print_image_url('plane.png'); ?>">Путевки в Париж
                                </a>
                                <br>
                                <a class="left" href="<?php ap_print_page_under_development_permalink( ); ?>">
                                    Похожие направления
                                </a>
                            </div>
                    </div><!-- #content -->

                <?php }
                if ( count( $article_posts ) < 1 ) { ?>
                    <p>К сожалению, на текущий момент не опубликовано ни одной статьи.</p>
                <?php } ?>

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>
