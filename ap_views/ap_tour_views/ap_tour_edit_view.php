<?php
class AP_TourEditView extends AP_TourView {
    public function __construct( array $tours = null ) {
        parent::__construct( $tours );
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
                                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                        <input name="ap_tour_icon" id="photo-addtour-file" type="file" accept="image/*"
                                               required>
                                        <input name="ap_tour_icon_crop_x" id="photo-addtour-file_crop_x" type="hidden">
                                        <input name="ap_tour_icon_crop_y" id="photo-addtour-file_crop_y" type="hidden">
                                        <input name="ap_tour_icon_crop_width" id="photo-addtour-file_crop_width" type="hidden">
                                        <input name="ap_tour_icon_crop_height" id="photo-addtour-file_crop_height" type="hidden">
                                    </div>
                                <?php }
                                else { ?>
                                    <div>
                                        <div>
                                            <p>Текущяя фотография</p>
                                            <?php $this->the_icon( ); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <p><label for="photo-addtour-file">Новая фотография (200x200px)</label></p>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                            <input name="ap_tour_icon" id="photo-addtour-file" type="file"
                                                   accept="image/*">
                                            <input name="ap_tour_icon_crop_x" id="photo-addtour-file_crop_x" type="hidden">
                                            <input name="ap_tour_icon_crop_y" id="photo-addtour-file_crop_y" type="hidden">
                                            <input name="ap_tour_icon_crop_width" id="photo-addtour-file_crop_width" type="hidden">
                                            <input name="ap_tour_icon_crop_height" id="photo-addtour-file_crop_height" type="hidden">
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
                                        <input name="ap_tour_offer_banner" id="sliderphoto-addtour-file" type="file"
                                            accept="image/*">
                                        <input name="ap_tour_offer_banner_crop_x"  id="sliderphoto-addtour-file_crop_x" type="hidden">
                                        <input name="ap_tour_offer_banner_crop_y" id="sliderphoto-addtour-file_crop_y" type="hidden">
                                        <input name="ap_tour_offer_banner_crop_width" id="sliderphoto-addtour-file_crop_width" type="hidden">
                                        <input name="ap_tour_offer_banner_crop_height" id="sliderphoto-addtour-file_crop_height" type="hidden">
                                    </div>
                                <?php }
                                else { ?>
                                    <div class="slider-photo">
                                        <div>
                                            <p>Текущяя фотография для слайдера</p>
                                            <?php $this->the_banner( 640, 255 ); ?>
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
                                                   type="file" accept="image/*">
                                            <input name="ap_tour_offer_banner_crop_x"  id="sliderphoto-addtour-file_crop_x" type="hidden">
                                            <input name="ap_tour_offer_banner_crop_y" id="sliderphoto-addtour-file_crop_y" type="hidden">
                                            <input name="ap_tour_offer_banner_crop_width" id="sliderphoto-addtour-file_crop_width" type="hidden">
                                            <input name="ap_tour_offer_banner_crop_height" id="sliderphoto-addtour-file_crop_height" type="hidden">
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

        ap_init_image_cropper( );
        ap_add_image_cropper_to_element( '#photo-addtour-file', 1 );
        ap_add_image_cropper_to_element( '#sliderphoto-addtour-file', 2.5 );
    }

    public static function show_for( AP_Tour $tour = null ) {
        $tours = null;
        if ( !empty( $tour ) ) {
            $tours = array( $tour );
        }
        $view = new AP_TourEditView( $tours );
        $view->show( );
    }
}
