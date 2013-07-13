<?php
class AP_TourInterestingOfferView extends AP_TourView {
    public function __construct( array $tours = null ) {
        parent::__construct( $tours );
    }

    public function show( ) { ?>
        <div class="interestingoffers-wrapper">
            <div id="interestingoffers">
                <h1 class="red">Интересные предложения</h1>
                <?php while ( $this->has_current( ) ) { ?>
                    <a href="<?php ap_print_reserve_tour_page_permalink( $this->get_the_id( ) ); ?>">
                        <div class="interestingoffer">
                            <?php $this->the_icon( ); ?>
                            <span class="offername">
                            <?php $this->the_country( ); echo ' - '; $this->the_resort( ); ?>
                        </span>
                            <span class="offerprice"><?php $this->the_cost( ); ?></span>
                        </div>
                    </a>
                <?php $this->next( );
                } ?>
            </div>
        </div>
        <div class="snipping"></div>
    <?php }

    public static function show_for( array $tours = null ) {
        $view = new AP_TourInterestingOfferView( $tours );
        $view->show( );
    }
}
