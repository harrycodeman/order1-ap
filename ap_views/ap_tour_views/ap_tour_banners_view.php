<?php
class AP_TourBannersView extends AP_TourView {
    public function __construct( $tours ) {

    }
}


function ap_tour_view_banners( $tours ) { ?>
    <div class="banner-wrapper">
        <div id="banner">
            <div id="banners_carousel" class="carousel slide">
                <div class="carousel-inner">
                    <?php
                    $is_first = true;
                    foreach ($tours as $tour) {
                        ap_load_tour_for_post( $tour ) ?>
                        <div class="<?php if ( $is_first ) { $is_first = false; echo 'active'; } ?> item">
                            <div class="banner-info">
                                <h2><?php echo ap_get_the_tour()->offer_name; ?></h2>
                                <p class="shortannouncement-title"><?php echo ap_get_the_tour()->offer_description; ?></p>
                                <p class="hotel-title"><img src="<?php ap_print_image_url('star.png'); ?>" alt="">
                                    <?php echo ap_get_the_tour()->hotel; ?>
                                </p>
                                <p class="nightcount-title">
                                    <img src="<?php ap_print_image_url('plane-dark.png'); ?>"
                                         alt="">
                                    <?php echo ap_get_the_tour()->start_date . ' - ' . ap_get_the_tour()->duration
                                        . ' ночей(и)'; ?>
                                </p>
                                <?php ap_print_reserve_tour_page_go_button( ap_get_the_tour_id( ) ); ?>
                            </div>
                            <div class="indent"></div>
                            <?php ap_the_tour_banner( ); ?>
                        </div>
                    <?php } ?>
                </div>
                <a class="carousel-control left" href="#banners_carousel" data-slide="prev"></a>
                <div class="carousel-control divider"></div>
                <a class="carousel-control right" href="#banners_carousel" data-slide="next"></a>
            </div>
        </div>
    </div>
<?php }
