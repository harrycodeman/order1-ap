<?php
class AP_TourListViewSmall extends AP_TourView {
    public function __construct( array $tours = null ) {
        parent::__construct( $tours );
    }

    public function show( ) { ?>
        <div class="tourlist-wrapper overview" style="width: 390px; margin-right: 30px;">
            <div id="tourlist" style="width: 390px;">
                <h1 class="red">Туры</h1>
                <div id="tours" class="list">
                    <?php while ( $this->has_current( ) ) { ?>
                        <a href="<?php ap_print_reserve_tour_page_permalink( $this->get_the_id( ) ); ?>"
                            style="color: #535349;">
                            <div class="item">
                                <div class="image" style="text-align: center;">
                                    <?php $this->the_icon( 100, 100, true, 36, 36 ); ?>
                                </div>
                                <div class="info" style="width: 260px;">
                                    <h2><?php $this->the_country( ); ?>, <?php $this->the_resort( ); ?></h2>
                                    <p>
                                        Вылет <?php $this->the_start_date( ); ?> на <?php $this->the_duration( ); ?>
                                        ночей(и)
                                    </p>
                                    <p><strong><?php $this->the_hotel( ); ?></strong></p>
                                </div>
                            </div><!--.item-->
                        </a>
                        <?php $this->next();
                    } ?>
                </div><!--#tours-->
            </div><!--#tourlist-->
        </div><!--.tourlist-wrapper-->
    <?php }

    public static function show_for( array $tours = null ) {
        $view = new AP_TourListViewSmall( $tours );
        $view->show( );
    }
}