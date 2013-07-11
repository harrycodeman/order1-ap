<?php
// TODO: сформировать класс для каждого view (через наследование) и реализовать методы отображения полей в родительском классе
// TODO: разнести представления по разным файлам

function ap_load_tour_for_post( WP_Post $post ) {
    $GLOBALS['ap_tour_exemplar_id'] = $post->ID;
    unset( $GLOBALS['ap_tour_exemplar'] );
}

function ap_load_tour_for_id( $tour_id ) {
    $GLOBALS['ap_tour_exemplar_id'] = $tour_id;
    unset( $GLOBALS['ap_tour_exemplar'] );
}

function ap_load_tour( AP_Tour $tour ) {
    $GLOBALS['ap_tour_exemplar'] = $tour;
}

function ap_get_the_tour_id( ) {
    if ( array_key_exists( 'ap_tour_exemplar_id', $GLOBALS ) ) {
        return $GLOBALS['ap_tour_exemplar_id'];
    }
    return get_the_ID();
}

function ap_get_the_tour( ) {
    if ( array_key_exists( 'ap_tour_exemplar', $GLOBALS ) ) {
        return $GLOBALS['ap_tour_exemplar'];
    }

    $tour = new AP_Tour( );
    $tour_id = ap_get_the_tour_id( );
    if ( !empty( $tour_id ) ) {
        $tour->load( $tour_id );
    }

    $GLOBALS['ap_tour_exemplar'] = $tour;
    return $tour;
}

function ap_the_tour_country( ) {
    echo ap_get_the_tour( )->country;
}

function ap_get_the_tour_country( ) {
    return ap_get_the_tour( )->country;
}

function ap_the_tour_resort( ) {
    echo ap_get_the_tour( )->resort;
}

function ap_get_the_tour_resort( ) {
    return ap_get_the_tour( )->resort;
}

function ap_the_tour_hotel( ) {
    echo ap_get_the_tour( )->hotel;
}

function ap_get_the_tour_hotel( ) {
    return ap_get_the_tour( )->hotel;
}

function ap_the_tour_hotel_rating( ) {
    echo ap_get_the_tour( )->hotel_rating;
}

function ap_get_the_tour_hotel_rating( ) {
    return ap_get_the_tour( )->hotel_rating;
}

function ap_the_tour_start_date( ) {
    echo ap_get_the_tour( )->start_date;
}

function ap_get_the_tour_start_date( ) {
    return ap_get_the_tour( )->start_date;
}

function ap_the_tour_duration( ) {
    echo ap_get_the_tour( )->duration;
}

function ap_get_the_tour_duration( ) {
    return ap_get_the_tour( )->duration;
}

function ap_the_tour_cost( ) {
    $cost_without_spaces = preg_replace( '/\s+/', '', ap_get_the_tour( )->cost );
    echo number_format( $cost_without_spaces, 0, '.', ' ' );
}

function ap_get_the_tour_cost( ) {
    $cost_without_spaces = preg_replace( '/\s+/', '', ap_get_the_tour( )->cost );
    return number_format( $cost_without_spaces, 0, '.', ' ' );
}

function ap_the_tour_icon( $width = 200, $height = 200 ) {
    $icon = ap_get_the_tour( )->get_icon( );
    if ( !empty( $icon ) ) { ?>
        <img class="image-circle" src="<?php echo $icon->get_url( ); ?>" width="<?= $width; ?>" height="<?= $height; ?>"
             alt="Изображение остутствует">
    <?php }
    else { ?>
        <img class="image-circle" src="<?php ap_print_image_url( 'tour-icon-missed.jpg' ); ?>" width="<?= $width; ?>"
             height="<?= $height; ?>" alt="Изображение остутствует">;
    <?php }
}

function ap_the_tour_burning( ) {
    if ( ap_get_the_tour()->is_burning ) {
        echo 'checked';
    }
}

function ap_get_the_tour_burning( ) {
    if ( ap_get_the_tour()->is_burning ) {
        return 'checked';
    }
    return '';
}

function ap_the_tour_offer_name( ) {
    echo ap_get_the_tour( )->offer_name;
}

function ap_get_the_tour_offer_name( ) {
    return ap_get_the_tour( )->offer_name;
}

function ap_the_tour_offer_description( ) {
    echo ap_get_the_tour( )->offer_description;
}

function ap_get_the_tour_offer_description( ) {
    return ap_get_the_tour( )->offer_description;
}

function ap_the_tour_banner( $width = 960, $height = 382 ) {
    $offer_banner = ap_get_the_tour()->get_offer_banner( );
    if ( !empty( $offer_banner ) ) { ?>
        <img src="<?= $offer_banner->get_url( ); ?>" width="<?= $width; ?>" height="<?= $height; ?>"
             alt="Изображение остутствует">
    <?php }
    else { ?>
        <img src="<?php ap_print_image_url( 'tour-banner-missed.jpg' ); ?>" width="<?= $width; ?>"
             height="<?= $height; ?>" alt="Изображение остутствует">
    <?php }
}

function ap_tour_view_banners( $tours ) { ?>
    <div class="banner-wrapper">
        <div id="banner">
            <div id="banners_carousel" class="carousel slide">
                <div class="carousel-inner">
                    <?php
                    $is_first = true;
                    foreach ($tours as $tour) {
                        ap_load_tour_for_post( $tour ) ?>
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

    <?php ap_add_js_calendar_to_element( '#datepicker' ); ?>
<?php }

function ap_tour_view_interesting_offers( $nearest_tours ) { ?>
    <div class="interestingoffers-wrapper">
        <div id="interestingoffers">
            <h1 class="red">Интересные предложения</h1>
            <?php foreach ($nearest_tours as $tour) {
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
?>

<!--                                        <img id="cropper" src="--><?php //ap_print_image_url( 'paris-by-night.jpg' ); ?><!--">-->
<!--                                        <script type="text/javascript">-->
<!--                                            jQuery(function($) {-->
<!--                                                var jcrop_api;-->
<!--                                                function readUrl(input) {-->
<!--                                                    if (jcrop_api) {-->
<!--                                                        jcrop_api.destroy();-->
<!--                                                    }-->
<!---->
<!--                                                    if (input.files-->
<!--                                                            && input.files[0]) {-->
<!--                                                        var reader = new FileReader();-->
<!--                                                        reader.onload = function (e) {-->
<!--                                                            $('#cropper').attr('src', e.target.result);-->
<!---->
<!--//                                                            $('#cropper').Jcrop({-->
<!--//                                                                    boxWidth: 640,-->
<!--//                                                                    boxHeight: 255-->
<!--//                                                                },-->
<!--//                                                                function() {-->
<!--//                                                                    jcrop_api = this;-->
<!--//                                                                }-->
<!--//                                                            );-->
<!--                                                        }-->
<!--                                                        reader.readAsDataURL(input.files[0]);-->
<!--                                                    }-->
<!--                                                }-->
<!---->
<!--                                                $("#sliderphoto-addtour-file").change(function(){-->
<!--                                                    readUrl(this);-->
<!--                                                });-->
<!--                                            });-->
<!--                                        </script>-->
<?php
