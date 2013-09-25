<?php
/*
Template Name: Гид
*/

get_header( ); ?>

<div id="map" style="width: 100%;"></div>
<div id="legend" style="background: #B72537; height: 30px;">
    <div class="clearfix" style="margin: 0 auto; width: 240px; color: #ffffff; font-size: 14px;">
        <img src="<?php ap_print_image_url( 'map-icon-article.png' ); ?>" style=" float: left; padding: 7px;">
        <div style="float: left; padding: 3px 20px 0 0; line-height: 25px;">Статьи</div>
        <img src="<?php ap_print_image_url( 'map-icon-tour.png' ); ?>" style=" float: left; padding: 7px;">
        <div style="float: left; padding: 3px 20px 0 0; line-height: 25px;">Вылеты/Туры</div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var styles = [{
            url: '<?php ap_print_image_url( 'map/cluster-icon.png' ); ?>',
            height: 50,
            width: 55,
            anchor: [1, 35],
            textColor: '#ffffff',
            textSize: 13
        }];

        const headerHeight = 195;
        const footerHeight = 147;
        const legendHeight = 30;
        var mapDiv = $("#map");
        mapDiv.height($(window).height() - headerHeight - footerHeight - legendHeight);
        $(window).on("resize", function() {
            mapDiv.height($(window).height() - headerHeight - footerHeight - legendHeight)
        });

        var mapSettings = {
            center: new google.maps.LatLng(30.0, 0.0),
            zoom: 3,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), mapSettings);
        var searchService = new google.maps.places.PlacesService(map);
        var clusterer = new MarkerClusterer(map, [], { averageCenter: true, styles: styles });
        var calculator = clusterer.getCalculator();
        clusterer.setCalculator(function (markers, numStyles) {
            var result = calculator(markers, numStyles);

            var articlesCount = 0;
            var toursCount = 0;
            for (var i in markers) {
                if (markers[i].type === 'article') {
                    articlesCount++;
                }
                else if (markers[i].type === 'tour') {
                    toursCount++;
                }
            }
            result.text = '<p style="margin-top: 5px;">' + toursCount + '</p><p style="margin-top: -8px;">' + articlesCount + '</p>';

            return result;
        });

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
                        map: map,
                        type: 'article'
                    });
                    google.maps.event.addListener(marker, 'mousedown', function(event) {
                        window.location.href = articleUrl;
                    });
                    clusterer.addMarker(marker);
                }
                else if (status == google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
                    setTimeout(function() {
                        createMarkerForArticle(queryString, articleUrl);
                    }, 1500);
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
                        map: map,
                        type: 'tour'
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        window.location.href = tourUrl;
                    });
                    clusterer.addMarker(marker);
                }
                else if (status == google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
                    setTimeout(function() {
                        createMarkerForTour(queryString, tourUrl);
                    }, 1500);
                }
            });
        }
    });
</script>

<?php get_footer( );
