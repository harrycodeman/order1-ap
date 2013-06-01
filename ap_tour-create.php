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
                        <center><h1>Добавить новый тур</h1></center>

                        <form name="create-tour-form" action="<?php ap_print_create_tour_page_permalink(); ?>"
                              method="post" enctype="multipart/form-data">
                            <div class="tour">
                                <div>
                                    <div>
                                        <p>Страна</p>
                                        <input name="ap_tour_country" type="text" id="country-addtour-form" required>
                                    </div>

                                    <div>
                                        <p>Название отеля:</p>
                                        <input name="ap_tour_hotel" type="text" id="hotelname-addtour-form" required>
                                    </div>

                                    <div>
                                        <p>Стоимость тура:</p>
                                        <input name="ap_tour_cost" type="text" id="cost-addtour-form" required>
                                    </div>
                                    <div>
                                        <span style="font-size: 18px; font-weight: bolder;">руб</span>
                                    </div>

                                </div>

                                <div>

                                    <div>
                                        <p>Курорт/Город:</p>
                                        <input name="ap_tour_resort" type="text" id="resortcity-addtour-form" required>
                                    </div>


                                    <div>
                                        <p>Дата заезда:</p>
                                        <input name="ap_tour_start_date" type="text" id="addtour-datepicker" required>
                                    </div>

                                    <div>
                                        <p>Количество ночей:</p>
                                        <input name="ap_tour_duration" type="text" id="nightcount-addtour-form"
                                               required>
                                    </div>

                                    <div>
                                        <br><br><br>
                                        <input name="ap_burning_tour" type="checkbox" value="is_burning">
                                        <span class="red" style="font-size: 18px; font-weight: bolder;" >
                                            Горящий тур
                                        </span>
                                    </div>

                                </div>
                            </div>

                            <br><br>

                            <div class="photo">
                                <div>
                                    <div>
                                        <p>Фотография (200x200px):</p>
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
                                        <p>Название акции:</p>
                                        <input name="ap_tour_offer_name" type="text" id="actionname-addtour-form"/>
                                    </div>
                                    <div>
                                        <p>Краткое описание:</p>
                                        <textarea name="ap_tour_offer_description" id="briefdescription-addtour-form" rows="5" cols="50"></textarea>
                                    </div>
                                    <div>
                                        <p>Фотография для слайдера(960x374px):</p>
                                        <input name="ap_tour_offer_banner" id="sliderphoto-addtour-file" type="file" name="">
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
