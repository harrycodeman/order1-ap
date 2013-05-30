<?php if ( !is_user_logged_in( ) ):
    ap_show_error( 'low_rights' );
else:
    if ( ap_is_view_mode( ) ):
        get_header( );
        ap_add_js_calendar_to_element( '#addtour-datepicker' ); ?>

        <div id="content">
            <div class="addtour-wrapper">
                <div id="addtour">
                    <center><h1>Редактирование тура под номером <?php the_ID(); ?></h1></center>

                    <form name="create-tour-form" action="<?php ap_print_edit_tour_page_permalink( get_the_ID() ); ?>"
                          method="post" enctype="multipart/form-data">
                        <div class="tour">
                            <div>
                                <div>
                                    <p>Страна</p>
                                    <select name="ap_tour_country" id="country-addtour-form" class="dropdown">
                                        <option <?php if ( ap_get_tour()->country === 'Египет' ) echo 'selected'; ?>>
                                            Египет
                                        </option>
                                        <option <?php if ( ap_get_tour()->country === 'Россия' ) echo 'selected'; ?>>
                                            Россия
                                        </option>
                                        <option <?php if ( ap_get_tour()->country === 'США' ) echo 'selected'; ?>>
                                            США
                                        </option>
                                        <option <?php if ( ap_get_tour()->country === 'Англия' ) echo 'selected'; ?>>
                                            Англия
                                        </option>
                                        <option <?php if ( ap_get_tour()->country === 'Турция' ) echo 'selected'; ?>>
                                            Турция
                                        </option>
                                        <option <?php if ( ap_get_tour()->country === 'Германия' ) echo 'selected'; ?>>
                                            Германия
                                        </option>
                                        <option <?php if ( ap_get_tour()->country === 'Болгария' ) echo 'selected'; ?>>
                                            Болгария
                                        </option>
                                        <option <?php if ( ap_get_tour()->country === 'Аргентина' ) echo 'selected'; ?>>
                                            Аргентина
                                        </option>
                                    </select>
                                </div>

                                <div>
                                    <p>Название отеля:</p>
                                    <select name="ap_tour_hotel" id="hotelname-addtour-form" class="dropdown">
                                        <option <?php if ( ap_get_tour()->hotel === 'Хилтон (5 звезд)' ) echo 'selected'; ?>>
                                            Хилтон (5 звезд)
                                        </option>
                                        <option <?php if ( ap_get_tour()->hotel === 'Новая Гвинея (3 звезды)' ) echo 'selected'; ?>>
                                            Новая Гвинея (3 звезды)
                                        </option>
                                        <option <?php if ( ap_get_tour()->hotel === 'Полтава (4 звезды)' ) echo 'selected'; ?>>
                                            Полтава (4 звезды)
                                        </option>
                                        <option <?php if ( ap_get_tour()->hotel === 'Академия отдыха (5 звезд)' ) echo 'selected'; ?>>
                                            Академия отдыха (5 звезд)
                                        </option>
                                        <option <?php if ( ap_get_tour()->hotel === 'Campus (2 звезды)' ) echo 'selected'; ?>>
                                            Campus (2 звезды)
                                        </option>
                                    </select>
                                </div>

                                <div>
                                    <p>Стоимость тура:</p>
                                    <input name="ap_tour_cost" type="text" id="cost-addtour-form"
                                           value="<?php echo ap_get_tour()->cost; ?>" />
                                </div>
                                <div>
                                    <span style="font-size: 18px; font-weight: bolder;">руб</span>
                                </div>

                            </div>

                            <div>

                                <div>
                                    <p>Курорт/Город:</p>
                                    <select name="ap_tour_resort" id="resortcity-addtour-form" class="dropdown">
                                        <option <?php if ( ap_get_tour()->resort === 'Хургада' ) echo 'selected'; ?>>
                                            Хургада
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Томск' ) echo 'selected'; ?>>
                                            Томск
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Шерегеш' ) echo 'selected'; ?>>
                                            Шерегеш
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Мехико' ) echo 'selected'; ?>>
                                            Мехико
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Прага' ) echo 'selected'; ?>>
                                            Прага
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Лос-Анжелес' ) echo 'selected'; ?>>
                                            Лос-Анжелес
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Бостон' ) echo 'selected'; ?>>
                                            Бостон
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Париж' ) echo 'selected'; ?>>
                                            Париж
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Выборг' ) echo 'selected'; ?>>
                                            Выборг
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Калуга' ) echo 'selected'; ?>>
                                            Калуга
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Пхукет' ) echo 'selected'; ?>>
                                            Пхукет
                                        </option>
                                        <option <?php if ( ap_get_tour()->resort === 'Сочи' ) echo 'selected'; ?>>
                                            Сочи
                                        </option>
                                    </select>
                                </div>


                                <div>
                                    <p>Дата заезда:</p>
                                    <input name="ap_tour_start_date" type="text" id="addtour-datepicker"
                                           style="position: static;" value="<?php echo ap_get_tour()->start_date; ?>" />
                                </div>

                                <div>
                                    <p>Количество ночей:</p>
                                    <select name="ap_tour_duration" id="nightcount-addtour-form" class="dropdown">
                                        <option <?php if ( ap_get_tour()->duration === '1' ) echo 'selected'; ?>>
                                            1
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '2' ) echo 'selected'; ?>>
                                            2
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '3' ) echo 'selected'; ?>>
                                            3
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '4' ) echo 'selected'; ?>>
                                            4
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '5' ) echo 'selected'; ?>>
                                            5
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '6' ) echo 'selected'; ?>>
                                            6
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '7' ) echo 'selected'; ?>>
                                            7
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '8' ) echo 'selected'; ?>>
                                            8
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '9' ) echo 'selected'; ?>>
                                            9
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '10' ) echo 'selected'; ?>>
                                            10
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '11' ) echo 'selected'; ?>>
                                            11
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '12' ) echo 'selected'; ?>>
                                            12
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '13' ) echo 'selected'; ?>>
                                            13
                                        </option>
                                        <option <?php if ( ap_get_tour()->duration === '14' ) echo 'selected'; ?>>
                                            14
                                        </option>
                                    </select>
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
                                <p>Фотография (200x200px):</p>
                                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                <input name="ap_tour_icon" id="photo-addtour-file" type="file" accept="image/*">
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
        $tour->id = get_the_ID();
        $tour->is_burning = $_POST['ap_burning_tour'];
        $tour->country = $_POST['ap_tour_country'];
        $tour->resort = $_POST['ap_tour_resort'];
        $tour->hotel = $_POST['ap_tour_hotel'];
        $tour->start_date = $_POST['ap_tour_start_date'];
        $tour->duration = $_POST['ap_tour_duration'];
        $tour->cost = $_POST['ap_tour_cost'];
        if ( is_uploaded_file( $_FILES['ap_tour_icon']['tmp_name'] ) ) {
            $tour->icon_attachment_id = ap_attach_image( $_FILES['ap_tour_icon'] );
        }

        $tour->offer_name = $_POST['ap_tour_offer_name'];
        $tour->offer_description = $_POST['ap_tour_offer_description'];
        if ( is_uploaded_file( $_FILES['ap_tour_offer_banner']['tmp_name'] ) ) {
            $tour->offer_banner_attachment_id = ap_attach_image( $_FILES['ap_tour_offer_banner'] );
        }

        $tour->save();
        ap_redirect_to( get_permalink( $tour->id ) );
    endif;
endif;
