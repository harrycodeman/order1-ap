<?php
/*
Template Name: Создание тура
*/
?>
<?php ap_add_js_calendar_to_element( '#addtour-datepicker' ); ?>


<?php if ( !is_user_logged_in( ) ):
    ap_show_error( 'low_rights' );
else:
    if ( empty( $_POST ) ):
        get_header( ); ?>
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
                                        <select name="ap_tour_country" id="country-addtour-form" class="dropdown">
                                            <option>Египет</option>
                                            <option>Россия</option>
                                            <option>США</option>
                                            <option>Англия</option>
                                            <option>Турция</option>
                                            <option>Германия</option>
                                            <option>Болгария</option>
                                            <option>Аргентина</option>
                                        </select>
                                    </div>

                                    <div>
                                        <p>Название отеля:</p>
                                        <select name="ap_tour_hotel" id="hotelname-addtour-form" class="dropdown">
                                            <option>Хилтон (5 звезд)</option>
                                            <option>Новая Гвинея (3 звезды)</option>
                                            <option>Полтава (4 звезды)</option>
                                            <option>Академия отдыха (5 звезд)</option>
                                            <option>Campus (2 звезды)</option>
                                        </select>
                                    </div>

                                    <div>
                                        <p>Стоимость тура:</p>
                                        <input name="ap_tour_cost" type="text" id="cost-addtour-form" />
                                    </div>
                                    <div>
                                        <span style="font-size: 18px; font-weight: bolder;">руб</span>
                                    </div>

                                </div>

                                <div>

                                    <div>
                                        <p>Курорт/Город:</p>
                                        <select name="ap_tour_resort" id="resortcity-addtour-form" class="dropdown">
                                            <option>Хургада</option>
                                            <option>Томск</option>
                                            <option>Шерегеш</option>
                                            <option>Мехико</option>
                                            <option>Прага</option>
                                            <option>Лос-Анжелес</option>
                                            <option>Бостон</option>
                                            <option>Париж</option>
                                            <option>Выборг</option>
                                            <option>Калуга</option>
                                            <option>Пхукет</option>
                                            <option>Сочи</option>
                                        </select>
                                    </div>


                                    <div>
                                        <p>Дата заезда:</p>
                                        <input name="ap_tour_start_date" type="text" id="addtour-datepicker" style="position: static;" />
                                    </div>

                                    <div>
                                        <p>Количество ночей:</p>
                                        <select name="ap_tour_duration" id="nightcount-addtour-form" class="dropdown">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                            <option>13</option>
                                            <option>14</option>
                                        </select>
                                    </div>

                                    <div>
                                        <br><br><br>
                                        <input name="ap_burning_tour" type="checkbox" value="is_burning">
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
