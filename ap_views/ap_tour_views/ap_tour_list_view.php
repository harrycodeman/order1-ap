<?php
class AP_TourListView extends AP_TourView {
    private $filter_title;

    public function __construct( $filter_title, array $tours = null ) {
        parent::__construct( $tours );
        $this->filter_title = $filter_title;
    }

    public function show( ) { ?>
        <div class="tourlist-wrapper">
            <div id="tourlist">
                <h1 class="red"><?= $this->filter_title; ?></h1>
                <div id="tours" class="list">
                    <?php
                    if ( !$this->has_current( ) ) { ?>
                        <h2>К сожалению, не найдено ни одного тура, соответствующего текущим условиям поиска.</h2>
                    <?php }
                    else {
                        while ( $this->has_current( ) ) { ?>
                            <div class="item">
                                <div class="image" style="text-align: center;">
                                    <?php $this->the_icon( 100, 100, true, 36, 36 ); ?>
                                </div>
                                <div class="info">
                                    <h2><?php $this->the_country( ); ?>, <?php $this->the_resort( ); ?></h2>
                                    <p>
                                        Вылет <?php $this->the_start_date( ); ?> на <?php $this->the_duration( ); ?>
                                        ночей(и)
                                    </p>
                                    <p><strong><?php $this->the_hotel( ); ?></strong></p>
                                </div>
                                <div class="hotelrating">
                                    <?php for ( $i = 0; $i < $this->get_the_hotel_rating( ); $i++ ) { ?>
                                        <img src="<?php ap_print_image_url( 'star.png' ); ?>" alt="">
                                    <?php } ?>
                                </div>
                                <div class="cost">
                                    <h2><?php $this->the_cost( ); ?> руб.</h2>
                                    <p>Цена за 1 путевку</p>
                                    <div class="editdelete-links">
                                        <?php if ( is_user_logged_in( ) ) { ?>
                                            <a class="blue"
                                               href="<?php ap_print_edit_tour_page_permalink(
                                                   $this->get_the_id( )
                                               ); ?>">
                                                Редактировать
                                            </a>
                                            <a class="blue delete-tour-link"
                                               href="<?php ap_print_edit_tour_page_permalink(
                                                   $this->get_the_id( )
                                               ); ?>?delete_tour=1">
                                                Удалить
                                            </a>
                                            <script type="text/javascript">
                                                $('.delete-tour-link').on('click', function(e) {
                                                        e.preventDefault();
                                                        $.ajax( $(this).attr('href') )
                                                            .done(function() {
                                                                $('#additionalparameters-submit').click();
                                                            })
                                                            .fail(function() {
                                                                alert('При удалении тура произошла ошибка!');
                                                            });
                                                    }
                                                );
                                            </script>
                                        <?php }
                                        else { ?>
                                            <a class="blue"
                                               href="<?php ap_print_reserve_tour_page_permalink(
                                                   $this->get_the_id( )
                                               ); ?>">
                                                <img src="<?php ap_print_image_url( 'shopping-cart.png' ) ?>"
                                                     alt="Корзина покупок" width="13px" height="13px">
                                                Купить
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><!--.item-->
                        <?php $this->next();
                        }
                    } ?>
                </div><!--#tours-->
            </div><!--#tourlist-->
        </div><!--.tourlist-wrapper-->
    <?php }

    public static function show_for( $filter_title, array $tours = null ) {
        $view = new AP_TourListView( $filter_title, $tours );
        $view->show( );
    }
}