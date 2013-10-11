<?php
class AP_TourView {
    private $tour_iterator;

    protected function __construct( array $tours = null ) {
        if ( !empty( $tours ) ) {
            $tours = new ArrayObject( $tours );
            $this->tour_iterator = $tours->getIterator( );
        }
    }

    protected function get_the_id( ) {
        return $this->the_property_or_empty( 'id' );
    }

    protected function get_the_hotel_rating( ) {
        return $this->the_property_or_empty( 'hotel_rating' );
    }

    protected function the_country( ) {
        echo $this->the_property_or_empty( 'country' );
    }

    protected function the_resort( ) {
        echo $this->the_property_or_empty( 'resort' );
    }

    protected function the_hotel( ) {
        echo $this->the_property_or_empty( 'hotel' );
    }

    protected function the_hotel_rating( ) {
        echo $this->the_property_or_empty( 'hotel_rating' );
    }

    protected function the_start_date( ) {
        echo $this->the_property_or_empty( 'start_date' );
    }

    protected function the_duration( ) {
        echo $this->the_property_or_empty( 'duration' );
    }

    protected function the_cost( ) {
        $cost = $this->the_property_or_empty( 'cost' );
        if ( !empty( $cost ) ) {
            $cost_without_spaces = preg_replace( '/\s+/', '', $cost );
            echo number_format( $cost_without_spaces, 0, '.', ' ' );
        }
    }

    protected function the_icon( $width = 200, $height = 200, $with_burning_icon = true, $burning_icon_width = 72,
                                 $burning_icon_height = 72) { ?>
        <div style="width: <?= $width; ?>px; height: <?= $height; ?>px;">
            <?php $icon = $this->the_method_result_or_empty( 'get_icon' );
            if ( !empty( $icon ) ) {
                $icon = AP_Image::cast( $icon ); ?>
                <img class="image-circle" src="<?php echo $icon->get_url( ); ?>" width="<?= $width; ?>"
                     height="<?= $height; ?>" alt="Изображение остутствует">
            <?php }
            else { ?>
                <img class="image-circle" src="<?php ap_print_image_url( 'tour-icon-missed.jpg' ); ?>"
                     width="<?= $width; ?>" height="<?= $height; ?>" alt="Изображение остутствует">;
            <?php }

            if ( $with_burning_icon && $this->has_current( ) && $this->tour_iterator->current( )->is_burning  ) { ?>
                <img src="<?php ap_print_image_url( 'hot-tour.png' ); ?>" alt="Изображение остутствует"
                    style="height: <?= $burning_icon_height; ?>px; width: <?= $burning_icon_width; ?>px;
                        position: relative; left: <?= $width/2; ?>px;
                        top: <?= -($height + $burning_icon_height)/2 ; ?>px;">
            <?php } ?>
        </div>
    <? }

    protected function the_burning( ) {
        if ( $this->the_property_or_empty( 'is_burning' ) ) {
            echo 'checked';
        }
    }

    protected function the_offer_name( ) {
        echo $this->the_property_or_empty( 'offer_name' );
    }

    protected function the_offer_description( ) {
        echo $this->the_property_or_empty( 'offer_description' );
    }

    protected function the_banner( $width = 960, $height = 382 ) {
        $offer_banner = $this->the_method_result_or_empty( 'get_offer_banner' );
        if ( !empty( $offer_banner ) ) {
            $offer_banner = AP_Image::cast( $offer_banner ); ?>
            <img src="<?= $offer_banner->get_url( ); ?>" width="<?= $width; ?>" height="<?= $height; ?>"
                 alt="<?php $this->the_resort( ); ?>">
        <?php }
        else { ?>
            <img src="<?php ap_print_image_url( 'tour-banner-missed.jpg' ); ?>" width="<?= $width; ?>"
                 height="<?= $height; ?>" alt="Изображение остутствует">
        <?php }
    }

    protected function the_latitude( ) {
        echo $this->the_property_or_empty( 'latitude' );
    }

    protected function the_longitude( ) {
        echo $this->the_property_or_empty( 'longitude' );
    }

    protected function is_model_empty( ) {
        return empty( $this->tour_iterator );
    }

    private function the_property_or_empty( $property_name ) {
        if ( $this->is_model_empty( ) ) {
            return null;
        }
        return $this->tour_iterator->current( )->$property_name;
    }

    private function the_method_result_or_empty( $method_name ) {
        if ( $this->is_model_empty( ) ) {
            return null;
        }
        return $this->tour_iterator->current( )->$method_name( );
    }

    protected function has_current( ) {
        if ( $this->is_model_empty( ) ) {
            return false;
        }
        return $this->tour_iterator->valid( );
    }

    protected function next( ) {
        if ( !$this->is_model_empty( ) ) {
            $this->tour_iterator->next( );
        }
    }

    protected function rewind( ) {
        if ( !$this->is_model_empty( ) ) {
            $this->tour_iterator->rewind( );
        }
    }
}
