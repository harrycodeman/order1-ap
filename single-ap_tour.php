<?php if ( !is_user_logged_in( ) ):
    ap_show_error( 'low_rights' );
else:
    if ( ap_is_view_mode( ) ):
        get_header( );
        ap_add_js_calendar_to_element( '#addtour-datepicker' ); ?>

        <div id="content">
            <div class="addtour-wrapper">
                <div id="addtour">
                    <center><h1>Редактирование тура</h1></center>

                    <form name="create-tour-form" action="<?php ap_print_edit_tour_page_permalink( get_the_ID() ); ?>"
                          method="post" enctype="multipart/form-data">
                        <div class="tour">
                            <div>
                                <div>
                                    <p>Страна</p>
                                    <input name="ap_tour_country" type="text" id="country-addtour-form"
                                        value="<?php echo ap_get_tour()->country; ?>" required>
                                </div>

                                <div>
                                    <p>Название отеля:</p>
                                    <input name="ap_tour_hotel" type="text" id="hotelname-addtour-form"
                                        value="<?php echo ap_get_tour()->hotel; ?>" required>
                                </div>

                                <div>
                                    <p>Стоимость тура:</p>
                                    <input name="ap_tour_cost" type="text" id="cost-addtour-form"
                                           value="<?php echo ap_get_tour()->cost; ?>" required>
                                </div>
                                <div>
                                    <span style="font-size: 18px; font-weight: bolder;">руб</span>
                                </div>

                            </div>

                            <div>
                                <div>
                                    <p>Курорт/Город:</p>
                                    <input name="ap_tour_resort" type="text" id="resortcity-addtour-form"
                                        value="<?php echo ap_get_tour()->resort; ?>" required>
                                </div>

                                <div>
                                    <p>Дата заезда:</p>
                                    <input name="ap_tour_start_date" type="text" id="addtour-datepicker"
                                           value="<?php echo ap_get_tour()->start_date; ?>" required>
                                </div>

                                <div>
                                    <p>Количество ночей:</p>
                                    <input name="ap_tour_duration" type="text" id="nightcount-addtour-form"
                                           value="<?php echo ap_get_tour()->duration; ?>" required>
                                </div>

                                <div>
                                    <br><br><br>
                                    <input name="ap_burning_tour" type="checkbox" value="is_burning"
                                        <?php if ( ap_get_tour()->is_burning ) echo 'checked'; ?>>
                                    <span class="red" style="font-size: 18px; font-weight: bolder;" >Горящий тур</span>
                                </div>

                            </div>
                        </div>

                        <br><br>

                        <div class="photo">
                            <div>
                                <div>
                                    <p>Текущяя фотография:</p>
                                    <img src="<?php echo ap_get_tour_icon_url(); ?>" width="200px" height="200px"
                                         alt="Изображение отсутствует">
                                </div>
                            </div>
                            <div>
                                <div>
                                    <p>Новая фотография (200x200px):</p>
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
                                    <input name="ap_tour_offer_name" type="text" id="actionname-addtour-form"
                                        value="<?php echo ap_get_tour()->offer_name; ?>">
                                </div>
                                <div>
                                    <p>Краткое описание:</p>
                                    <textarea name="ap_tour_offer_description" id="briefdescription-addtour-form"
                                              rows="5" cols="50"><?php echo ap_get_tour()->offer_description; ?></textarea>
                                </div>
                                <div class="slider-photo">
                                    <div>
                                        <p>Текущяя фотография для слайдера:</p>
                                        <img src="<?php echo ap_get_tour_banner_url(); ?>" width="500px" height="195px" alt="Изображение отсутствует">
                                    </div>
                                </div>
                                <div class="slider-photo">
                                    <div>
                                        <p>Новая фотография для слайдера(960x374px):</p>
                                        <input name="ap_tour_offer_banner" id="sliderphoto-addtour-file" type="file" name="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="submitbuttons">
                            <div>
                                <button id="cancel-addtour-button" type="reset">ОТМЕНИТЬ</button>
                                <button name="create-tour-submit-button" id="create-addtour-button" type="submit">СОХРАНИТЬ</button>
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
        $tour->load( get_the_ID( ) );

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
        ap_redirect_to( get_permalink( $tour->id ) );
    endif;
endif;
