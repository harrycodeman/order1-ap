<?php
function ap_tour_view_banners( ) { ?>
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
                            ),
                            'orderby' => 'rand'
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
                                <?php ap_print_reserve_tour_page_go_button( ap_get_the_tour_id( ) ); ?>
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
<?php }

function ap_tour_view_search( ) { ?>
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
                    <input name="ap_tour_country" id="from-form" type="text" autocomplete="off"
                           placeholder="Любая страна" value="<?= $_POST['ap_tour_country']; ?>" class="search-input">
                    <input name="ap_tour_resort" id="to-form" type="text" autocomplete="off" placeholder="Любой город"
                           value="<?= $_POST['ap_tour_resort']; ?>" class="search-input">

                    <div id="div-datepicker">
                        <input name="ap_tour_start_date" type="text" id="datepicker" autocomplete="off"
                               placeholder="Любая" value="<?= $_POST['ap_tour_start_date']; ?>" class="search-input">
                        <div id="calendar-image" onclick="$('#datepicker').focus()"></div>
                    </div>

                    <span style="top: 48px; left: 782px;"><label for="days-form">на</label></span>
                    <input name="ap_tour_duration" id="days-form" type="text" autocomplete="off" placeholder="Долго"
                           value="<?= $_POST['ap_tour_duration']; ?>" class="search-input">
                </div>
                <div id="additional-parameters" style="display: block !important;">
                    <span class="cost-title">
                        <label for="startcost">Стоимость тура</label>
                        <label style="display: none" for="endcost">Максимальная стоимость тура</label>
                    </span>

                    <span class="starcount-title"><label for="starcount">Количество звезд</label></span>
                    <input name="ap_tour_cost_min" id="startcost" type="text" autocomplete="off" placeholder="Дешево"
                           value="<?= $_POST['ap_tour_cost_min']; ?>" class="search-input">
                    <span style="position: absolute; top: 46px; left: 132px; font-size: 10px; font-weight: bold;">
                        &mdash;
                    </span>
                    <input name="ap_tour_cost_max" id="endcost" type="text"  autocomplete="off" placeholder="Дорого"
                           value="<?= $_POST['ap_tour_cost_max']; ?>" class="search-input">
                    <select name="ap_tour_hotel_rating" id="starcount" class="dropdown search-select">
                        <option value="0">Неважно</option>
                        <option value="1">1 (*)</option>
                        <option value="2">2 (**)</option>
                        <option value="3">3 (***)</option>
                        <option value="4">4 (****)</option>
                        <option value="5">5 (*****)</option>
                    </select>
                    <div class="buttons">
                        <button id="additionalparameters-clear" type="button">ОЧИСТИТЬ</button>
                        <button id="additionalparameters-submit" type="submit">ПОДОБРАТЬ</button>
                    </div>
                </div>
            </form>
        </div><!--#toursearch-->
    </div><!--#toursearch-wrapper-->
    <div class="toursearch-bottom-line"></div>

    <!-- Кнопка очистки + установка значения для рейтинга отеля -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#additionalparameters-clear').on('click', function() {
                    $('.search-input').val('');
                    $('.search-select').val('0');
                }
            );
        });
        $('#starcount').val('<?= $_POST['ap_tour_hotel_rating'] ? $_POST['ap_tour_hotel_rating'] : 0; ?>');
    </script>
<?php }

function ap_tour_view_interesting_offers( ) { ?>
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

            foreach ($nearest_tours as $tour) {
                ap_load_tour_for_post( $tour ) ?>
                <a href="<?php ap_print_reserve_tour_page_permalink( ap_get_the_tour_id( ) ); ?>">
                    <div class="interestingoffer">
                        <?php ap_the_tour_icon(); ?>
                        <span class="offername">
                            <?php echo ap_get_the_tour()->country . ' - ' . ap_get_the_tour()->resort; ?>
                        </span>
                        <span class="offerprice"><?php echo ap_get_the_tour()->cost; ?></span>
                    </div>
                </a>
            <?php } ?>
    </div>
    </div>
    <div class="snipping"></div>
<?php }
