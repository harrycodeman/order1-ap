<?php
// TODO: сформировать класс для каждого view (через наследование) и реализовать методы отображения полей в родительском классе
// TODO: разнести представления по разным файлам
class AP_TourView {
    private $tour;

    protected function __construct( AP_Tour $tour = null ) {
        $this->tour = $tour;
    }

    protected function get_the_id( ) {
        return $this->the_property_or_empty( 'id' );
    }

    protected function the_country( ) {
        echo $this->the_property_or_empty( 'country' );
    }

    protected function the_resort( ) {
        echo $this->the_property_or_empty( 'resort' );
    }

    protected function the_hotel( ) {
        echo $this->the_property_or_empty( 'hotel' );
    }

    protected function the_hotel_rating( ) {
        echo $this->the_property_or_empty( 'hotel_rating' );
    }

    protected function the_start_date( ) {
        echo $this->the_property_or_empty( 'start_date' );
    }

    protected function the_duration( ) {
        echo $this->the_property_or_empty( 'duration' );
    }

    protected function the_cost( ) {
        $cost = $this->the_property_or_empty( 'cost' );
        if ( !empty( $cost ) ) {
            $cost_without_spaces = preg_replace( '/\s+/', '', $cost );
            echo number_format( $cost_without_spaces, 0, '.', ' ' );
        }
    }

    protected function the_icon( $width = 200, $height = 200 ) {
        $icon = $this->the_method_result_or_empty( 'get_icon' );
        if ( !empty( $icon ) ) {
            $icon = AP_Image::cast( $icon ); ?>
            <img class="image-circle" src="<?php echo $icon->get_url( ); ?>" width="<?= $width; ?>" height="<?= $height; ?>"
                 alt="Изображение остутствует">
        <?php }
        else { ?>
            <img class="image-circle" src="<?php ap_print_image_url( 'tour-icon-missed.jpg' ); ?>" width="<?= $width; ?>"
                 height="<?= $height; ?>" alt="Изображение остутствует">;
        <?php }
    }

    protected function the_burning( ) {
        if ( $this->the_property_or_empty( 'is_burning' ) ) {
            echo 'checked';
        }
    }

    protected function the_offer_name( ) {
        echo $this->the_property_or_empty( 'offer_name' );
    }

    protected function the_offer_description( ) {
        echo $this->the_property_or_empty( 'offer_description' );
    }

    protected function ap_the_tour_banner( $width = 960, $height = 382 ) {
        $offer_banner = $this->the_method_result_or_empty( 'get_offer_banner' );
        if ( !empty( $offer_banner ) ) {
            $offer_banner = AP_Image::cast( $offer_banner ); ?>
            <img src="<?= $offer_banner->get_url( ); ?>" width="<?= $width; ?>" height="<?= $height; ?>"
                 alt="Изображение остутствует">
        <?php }
        else { ?>
            <img src="<?php ap_print_image_url( 'tour-banner-missed.jpg' ); ?>" width="<?= $width; ?>"
                 height="<?= $height; ?>" alt="Изображение остутствует">
        <?php }
    }

    protected function is_model_empty( ) {
        return empty( $this->tour );
    }

    private function the_property_or_empty( $property_name ) {
        if ( empty( $this->tour ) ) {
            return null;
        }
        return $this->tour->$property_name;
    }

    private function the_method_result_or_empty( $method_name ) {
        if ( empty( $this->tour ) ) {
            return null;
        }
        return $this->tour->$method_name();
    }
}

class AP_TourEditView extends AP_TourView {
    public function __construct( AP_Tour $tour = null ) {
        parent::__construct( $tour );
    }

    public function show( ) {
        if ( $this->is_model_empty( ) ) {
            $title = 'Добавить новый тур';
            $handler_permalink = ap_get_create_tour_page_permalink( );
            $submit_button_name = 'СОЗДАТЬ';
        }
        else {
            $title = 'Редактирование тура';
            $handler_permalink = ap_get_edit_tour_page_permalink( $this->get_the_id( ) );
            $submit_button_name = 'СОХРАНИТЬ';
        }?>

        <div id="content">
            <div class="addtour-wrapper">
                <div id="addtour">
                    <h1 class="moderating-header"><?= $title ?></h1>
                    <form name="create-tour-form" action="<?= $handler_permalink ?>" method="post"
                          enctype="multipart/form-data">
                        <div class="tour">
                            <div>
                                <div>
                                    <p><label for="country-addtour-form">Страна</label></p>
                                    <input name="ap_tour_country" type="text" id="country-addtour-form"
                                        value="<?php $this->the_country( ); ?>" required>
                                </div>
                                <div>
                                    <p><label for="hotelname-addtour-form">Название отеля</label></p>
                                    <input name="ap_tour_hotel" type="text" id="hotelname-addtour-form"
                                        value="<?php $this->the_hotel( ); ?>" required>
                                </div>
                                <div>
                                    <p><label for="hotel-rating-addtour-form">Уровень отеля</label></p>
                                    <input name="ap_tour_hotel_rating" type="number" id="hotel-rating-addtour-form"
                                        value="<?php $this->the_hotel_rating( ); ?>" min="1" max="5" required>
                                </div>
                                <div>
                                    <p><label for="cost-addtour-form">Стоимость тура</label></p>
                                    <input name="ap_tour_cost" type="text" id="cost-addtour-form"
                                        value="<?php $this->the_cost( ); ?>" required>
                                </div>
                                <div>
                                    <span style="font-size: 18px; font-weight: bolder;">руб</span>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <p><label for="resortcity-addtour-form">Курорт/Город</label></p>
                                    <input name="ap_tour_resort" type="text" id="resortcity-addtour-form"
                                           value="<?php $this->the_resort( ); ?>" required>
                                </div>
                                <div>
                                    <p><label for="addtour-datepicker">Дата заезда</label></p>
                                    <input name="ap_tour_start_date" type="text" id="addtour-datepicker"
                                        value="<?php $this->the_start_date( ); ?>" required>
                                    <div id="calendar-image" onclick="$('#addtour-datepicker').focus()"></div>
                                </div>
                                <div>
                                    <p><label for="nightcount-addtour-form">Количество ночей</label></p>
                                    <input name="ap_tour_duration" type="text" id="nightcount-addtour-form"
                                        value="<?php $this->the_duration( ); ?>" required>
                                </div>
                                <div>
                                    <br><br><br>
                                    <input name="ap_burning_tour" type="checkbox" id="ap_burning_tour_id"
                                           value="is_burning"  <?php $this->the_burning(); ?>>
                                <span class="red" style="font-size: 18px; font-weight: bolder;">
                                    <label for="ap_burning_tour_id">Горящий тур</label>
                                </span>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="photo">
                            <div>
                                <?php if ( $this->is_model_empty( ) ) { ?>
                                    <div>
                                        <p><label for="photo-addtour-file">Фотография (200x200px)</label></p>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                                        <input name="ap_tour_icon" id="photo-addtour-file" type="file" accept="image/*"
                                               required>
                                    </div>
                                <?php }
                                else { ?>
                                    <div>
                                        <div>
                                            <p>Текущяя фотография</p>
                                            <?php ap_the_tour_icon( ); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <p><label for="photo-addtour-file">Новая фотография (200x200px)</label></p>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                            <input name="ap_tour_icon" id="photo-addtour-file" type="file" accept="image/*">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <br><br>
                        <div class="sliderinfo">
                            <p>Информация для слайдера (не обязательно к заполнению)</p>
                            <div>
                                <div>
                                    <p><label for="actionname-addtour-form">Название акции</label></p>
                                    <input name="ap_tour_offer_name" type="text" id="actionname-addtour-form"
                                        value="<?php $this->the_offer_name( ); ?>">
                                </div>
                                <div>
                                    <p><label for="briefdescription-addtour-form">Краткое описание</label></p>
                                    <textarea name="ap_tour_offer_description" id="briefdescription-addtour-form"
                                              rows="5" cols="50"><?php $this->the_offer_description( ); ?></textarea>
                                </div>

                                <?php if ( $this->is_model_empty( ) ) { ?>
                                    <div>
                                        <p>
                                            <label for="sliderphoto-addtour-file">
                                                Фотография для слайдера(960x374px)
                                            </label>
                                        </p>
                                        <input name="ap_tour_offer_banner" id="sliderphoto-addtour-file" type="file">
                                    </div>
                                <?php }
                                else { ?>
                                    <div class="slider-photo">
                                        <div>
                                            <p>Текущяя фотография для слайдера</p>
                                            <?php ap_the_tour_banner( 640, 255 ); ?>
                                        </div>
                                    </div>
                                    <div class="slider-photo">
                                        <div>
                                            <p>
                                                <label for="sliderphoto-addtour-file">
                                                    Новая фотография для слайдера (940x382px)
                                                </label>
                                            </p>
                                            <input name="ap_tour_offer_banner" id="sliderphoto-addtour-file"
                                                   type="file" name="">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <br><br>
                        <div class="submitbuttons">
                            <div>
                                <button id="cancel-addtour-button" type="reset">ОТМЕНИТЬ</button>
                                <button name="create-tour-submit-button" id="create-addtour-button" type="submit">
                                    <?= $submit_button_name; ?>
                                </button>
                            </div>
                        </div>
                        <br><br>
                    </form><!--create-tour-form-->
                </div><!--addtour-->
            </div><!--addtour-wrapper-->
        </div><!-- #content -->
        <?php ap_add_js_calendar_to_element( '#addtour-datepicker' );
    }

    public static function show_for( AP_Tour $tour = null ) {
        $view = new AP_TourEditView( $tour );
        $view->show( );
    }
}













































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
