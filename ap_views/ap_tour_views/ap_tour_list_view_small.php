<?php
class AP_TourListViewSmall extends AP_TourView {
    private $articles;

    public function __construct( array $tours = null, array $articles = null ) {
        parent::__construct( $tours );
        $this->articles = $articles;
    }

    public function show( ) { ?>
        <div class="tourlist-wrapper" style="width: 410px; height: 300px;">
            <div id="tourlist" style="width: 390px;">
                <?php if ( $this->has_current( ) ) {
                    if ( $this->count( ) > 1 || count( $this->articles ) != 0 ) { ?>
                        <h1 class="red">Туры</h1>
                    <?php } ?>
                    <div id="tours" class="list">
                        <?php while ( $this->has_current( ) ) { ?>
                                <div class="item">
                                    <a href="<?php ap_print_reserve_tour_page_permalink( $this->get_the_id( ) ); ?>">
                                        <div class="image" style="text-align: center;">
                                            <?php $this->the_icon( 100, 100, true, 36, 36 ); ?>
                                        </div>
                                    </a>
                                    <div class="info" style="width: 260px;">
                                        <a href="<?php ap_print_reserve_tour_page_permalink( $this->get_the_id( ) ); ?>"
                                           style="color: #535349;">
                                            <h2><?php $this->the_country( ); ?>, <?php $this->the_resort( ); ?></h2>
                                        </a>
                                        <p>
                                            Вылет <?php $this->the_start_date( ); ?> на <?php $this->the_duration( ); ?>
                                            ночей(и)
                                        </p>
                                        <p><strong><?php $this->the_hotel( ); ?></strong></p>
                                    </div>
                                </div><!--.item-->
                            <?php $this->next();
                        } ?>
                    </div><!--#tours-->
                <?php }

                if ( count( $this->articles ) > 0 ) {
                    ap_articles_list_view_for_map( $this->articles,
                        count( $this->articles ) > 1 || $this->count( ) != 0 );
                } ?>
            </div><!--#tourlist-->
        </div><!--.tourlist-wrapper-->
    <?php }

    public static function show_for( array $tours = null, array $articles = null ) {
        $view = new AP_TourListViewSmall( $tours, $articles );
        $view->show( );
    }
}
