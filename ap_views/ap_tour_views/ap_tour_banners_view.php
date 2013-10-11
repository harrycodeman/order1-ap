<?php
class AP_TourBannersView extends AP_TourView {
    public function __construct( array $tours = null ) {
        parent::__construct( $tours );
    }

    public function show( ) {
        if ( $this->is_model_empty( ) ) {
            return;
        } ?>

        <div class="banner-wrapper">
            <div id="banner">
                <div id="banners_carousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                        $is_first = true;
                        while ( $this->has_current( ) ) { ?>
                            <div class="<?php if ( $is_first ) { $is_first = false; echo 'active'; } ?> item">
                                <div class="banner-info">
                                    <h2><?php $this->the_offer_name( ); ?></h2>
                                    <p class="shortannouncement-title">
                                        <?php $this->the_offer_description( ); ?>
                                    </p>
                                    <p class="hotel-title"><img src="<?php ap_print_image_url('star.png'); ?>" alt="*">
                                        <?php $this->the_hotel( ); ?>
                                    </p>
                                    <p class="nightcount-title">
                                        <img src="<?php ap_print_image_url('plane-dark.png'); ?>"
                                             alt="">
                                        <?php $this->the_start_date( ); echo ' - '; $this->the_duration( );
                                        echo ' ночей(и)'; ?>
                                    </p>
                                    <?php ap_print_reserve_tour_page_go_button( $this->get_the_id( ) ); ?>
                                </div>
                                <div class="indent"></div>
                                <?php $this->the_banner( ); ?>
                            </div>
                        <?php $this->next( );
                        } ?>
                    </div>
                    <a class="carousel-control left" href="#banners_carousel" data-slide="prev"></a>
                    <div class="carousel-control divider"></div>
                    <a class="carousel-control right" href="#banners_carousel" data-slide="next"></a>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#banners_carousel').carousel({
                                cycle: true,
                                animation: 1000,
                                itemFallbackDimension: 960
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    <?php }

    public static function show_for( array $tours = null ) {
        $view = new AP_TourBannersView( $tours );
        $view->show( );
    }
}
