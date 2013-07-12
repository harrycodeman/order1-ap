<?php
class AP_TourSearchPanelView extends AP_TourView {
    public function __construct( ) {
        parent::__construct( );
    }

    public function show( ) { ?>
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
                               placeholder="Любая страна" value="<?= $_POST['ap_tour_country']; ?>"
                               class="search-input">
                        <input name="ap_tour_resort" id="to-form" type="text" autocomplete="off"
                               placeholder="Любой город" value="<?= $_POST['ap_tour_resort']; ?>" class="search-input">

                        <div id="div-datepicker">
                            <input name="ap_tour_start_date" type="text" id="datepicker" autocomplete="off"
                                   placeholder="Любая" value="<?= $_POST['ap_tour_start_date']; ?>"
                                   class="search-input">
                            <div id="calendar-image" onclick="$('#datepicker').focus()"></div>
                        </div>

                        <span style="top: 48px; left: 782px;"><label for="days-form">на</label></span>
                        <input name="ap_tour_duration" id="days-form" type="text" autocomplete="off"
                               placeholder="Долго" value="<?= $_POST['ap_tour_duration']; ?>" class="search-input">
                    </div>
                    <div id="additional-parameters" style="display: block !important;">
                    <span class="cost-title">
                        <label for="startcost">Стоимость тура</label>
                        <label style="display: none" for="endcost">Максимальная стоимость тура</label>
                    </span>

                        <span class="starcount-title"><label for="starcount">Количество звезд</label></span>
                        <input name="ap_tour_cost_min" id="startcost" type="text" autocomplete="off"
                               placeholder="Дешево" value="<?= $_POST['ap_tour_cost_min']; ?>" class="search-input">
                    <span style="position: absolute; top: 46px; left: 132px; font-size: 10px; font-weight: bold;">
                        &mdash;
                    </span>
                        <input name="ap_tour_cost_max" id="endcost" type="text"  autocomplete="off"
                               placeholder="Дорого" value="<?= $_POST['ap_tour_cost_max']; ?>" class="search-input">
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

    public static function show_for( ) {
        $view = new AP_TourSearchPanelView( );
        $view->show( );
    }
}
