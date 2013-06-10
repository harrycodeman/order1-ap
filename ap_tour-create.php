<?php
/*
Template Name: Создание тура
*/
?>

<?php if ( !is_user_logged_in( ) ):
    ap_show_error( 'low_rights' );
else:
    if ( empty( $_POST ) ):
        get_header( );
        ap_add_js_calendar_to_element( '#addtour-datepicker' ); ?>
            <div id="content">
                <div class="addtour-wrapper">
                    <div id="addtour">
                        <h1 class="moderating-header">Добавить новый тур</h1>

                        <form name="create-tour-form" action="<?php ap_print_create_tour_page_permalink(); ?>"
                              method="post" enctype="multipart/form-data">
                            <div class="tour">
                                <div>
                                    <div>
                                        <p><label for="country-addtour-form">Страна</label></p>
                                        <input name="ap_tour_country" type="text" id="country-addtour-form" required>
                                    </div>

                                    <div>
                                        <p><label for="hotelname-addtour-form">Название отеля</label></p>
                                        <input name="ap_tour_hotel" type="text" id="hotelname-addtour-form" required>
                                    </div>

                                    <div>
                                        <p><label for="hotel-rating-addtour-form">Уровень отеля</label></p>
                                        <input name="ap_tour_hotel_rating" type="number" id="hotel-rating-addtour-form"
                                               value="1" min="1" max="5" required>
                                    </div>

                                    <div>
                                        <p><label for="cost-addtour-form">Стоимость тура</label></p>
                                        <input name="ap_tour_cost" type="text" id="cost-addtour-form" required>
                                    </div>
                                    <div>
                                        <span style="font-size: 18px; font-weight: bolder;">руб</span>
                                    </div>

                                </div>

                                <div>

                                    <div>
                                        <p><label for="resortcity-addtour-form">Курорт/Город</label></p>
                                        <input name="ap_tour_resort" type="text" id="resortcity-addtour-form" required>
                                    </div>


                                    <div>
                                        <p><label for="addtour-datepicker">Дата заезда</label></p>
                                        <input name="ap_tour_start_date" type="text" id="addtour-datepicker" required>
                                        <div id="calendar-image" onclick="$('#addtour-datepicker').focus()"></div>
                                    </div>

                                    <div>
                                        <p><label for="nightcount-addtour-form">Количество ночей</label></p>
                                        <input name="ap_tour_duration" type="text" id="nightcount-addtour-form"
                                               required>
                                    </div>

                                    <div>
                                        <br><br><br>
                                        <input name="ap_burning_tour" type="checkbox" id="ap_burning_tour_id"
                                               value="is_burning">
                                        <span class="red" style="font-size: 18px; font-weight: bolder;" >
                                            <label for="ap_burning_tour_id">Горящий тур</label>
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <br><br>

                            <div class="photo">
                                <div>
                                    <div>
                                        <p><label for="photo-addtour-file">Фотография (200x200px)</label></p>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                        <input name="ap_tour_icon" id="photo-addtour-file" type="file" accept="image/*"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <br><br>

                            <div class="sliderinfo">

                                <p>Информация для слайдера (не обязательно к заполнению)</p>
                                <div>
                                    <div>
                                        <p><label for="actionname-addtour-form">Название акции</label></p>
                                        <input name="ap_tour_offer_name" type="text" id="actionname-addtour-form"/>
                                    </div>
                                    <div>
                                        <p><label for="briefdescription-addtour-form">Краткое описание</label></p>
                                        <textarea name="ap_tour_offer_description" id="briefdescription-addtour-form"
                                                  rows="5" cols="50"></textarea>
                                    </div>
                                    <div>
                                        <p>
                                            <label for="sliderphoto-addtour-file">
                                                Фотография для слайдера(960x374px)
                                            </label>
                                        </p>
                                        <input name="ap_tour_offer_banner" id="sliderphoto-addtour-file" type="file">
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
                        </form><!--create-tour-form-->
                    </div><!--addtour-->
                </div><!--addtour-wrapper-->
            </div><!-- #content -->
        <?php get_footer( );
    else:
        $tour = new AP_Tour();
        $tour->is_burning = $_POST['ap_burning_tour'];
        $tour->country = $_POST['ap_tour_country'];
        $tour->resort = $_POST['ap_tour_resort'];
        $tour->hotel = $_POST['ap_tour_hotel'];
        $tour->hotel_rating = $_POST['ap_tour_hotel_rating'];
        $tour->start_date = $_POST['ap_tour_start_date'];
        $tour->duration = $_POST['ap_tour_duration'];
        $tour->cost = $_POST['ap_tour_cost'];
        if ( is_uploaded_file( $_FILES['ap_tour_icon']['tmp_name'] ) ) {
            $tour->set_icon(
                AP_Image::load_from_file_object( $_FILES['ap_tour_icon'] )
            );
        }
        $tour->offer_name = $_POST['ap_tour_offer_name'];
        $tour->offer_description = $_POST['ap_tour_offer_description'];
        if ( is_uploaded_file( $_FILES['ap_tour_offer_banner']['tmp_name'] ) ) {
            $tour->set_offer_banner(
                AP_Image::load_from_file_object( $_FILES['ap_tour_offer_banner'] )
            );
        }

        $tour->save();
        ap_redirect_to( ap_get_create_tour_page_permalink( ) );
    endif;
endif;
