<?php
/*
Template Name: Гид
*/

get_header( ); ?>

<div id="map" style="width: 100%;"></div>
<script>
    $(document).ready(function() {
        const headerHeight = 195;
        const footerHeight = 147;
        var mapDiv = $("#map");
        mapDiv.height($(window).height() - headerHeight - footerHeight);
        $(window).on("resize", function() {
            mapDiv.height($(window).height() - headerHeight - footerHeight)
        });

        var mapSettings = {
            center: new google.maps.LatLng(30.0, 0.0),
            zoom: 3,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), mapSettings);
        var searchService = new google.maps.places.PlacesService(map);

        <?php
        $articles = ap_get_articles(array(
            'numberposts' => -1
        ));
        foreach ($articles as $article) {
            if ( !empty( $article->resort ) ) { ?>
                createMarkerForArticle('<?= $article->resort; ?>', '<?php ap_print_article_permalink( $article->id ); ?>');
            <?php }
            else if ( !empty( $article->country ) ) { ?>
                createMarkerForArticle('<?= $article->country; ?>', '<?php ap_print_article_permalink( $article->id ); ?>');
            <?php }
        } ?>

        function createMarkerForArticle(queryString, articleUrl) {
            var request = { query: queryString };
            searchService.textSearch(request, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK && results.length >= 1) {
                    var place = results[0].geometry.location;
                    var marker = new google.maps.Marker({
                        icon: '<?php ap_print_image_url('map-pin-article.png'); ?>',
                        position: place,
                        map: map
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        window.location.href = articleUrl;
                    });
                }
            });
        }

        <?php
        $tours = ap_get_tours(array(
            'numberposts' => -1
        ));
        foreach ($tours as $tour) {
            if ( !empty( $tour->resort ) ) { ?>
                createMarkerForTour('<?= $tour->resort; ?>', '<?php ap_print_reserve_tour_page_permalink( $tour->id ); ?>');
            <?php }
            else if ( !empty( $tour->country ) ) { ?>
                createMarkerForTour('<?= $tour->country; ?>', '<?php ap_print_reserve_tour_page_permalink( $tour->id ); ?>');
            <?php }
        } ?>

        function createMarkerForTour(queryString, tourUrl) {
            var request = { query: queryString };
            searchService.textSearch(request, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK && results.length >= 1) {
                    var place = results[0].geometry.location;
                    var marker = new google.maps.Marker({
                        icon: '<?php ap_print_image_url('map-pin-tour.png'); ?>',
                        position: place,
                        map: map
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        window.location.href = tourUrl;
                    });
                }
            });
        }
    });
</script>

<?php get_footer( );
