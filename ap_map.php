<?php
/*
Template Name: Гид
*/

get_header( ); ?>

<div id="map" style="width: 100%;"></div>
<div id="legend" style="background: #B72537; height: 30px;">
    <div class="clearfix" style="margin: 0 auto; width: 250px; color: #ffffff; font-size: 14px;">
        <img src="<?php ap_print_image_url( 'map/article-icon.png' ); ?>" style="float: left; padding: 7px;">
        <div style="float: left; padding: 3px 20px 0 0; line-height: 25px;">Статьи</div>
        <img src="<?php ap_print_image_url( 'map/tour-icon.png' ); ?>" style="float: left; padding: 7px;">
        <div style="float: left; padding: 3px 20px 0 0; line-height: 25px;">Вылеты/Туры</div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var styles = [{
            url: '<?php ap_print_image_url( 'map/cluster-icon-total.png' ); ?>',
            height: 32,
            width: 32,
            textColor: '#ffffff',
            textSize: 13,
            className: 'cluster-tours'
        }, {
            url: '<?php ap_print_image_url( 'map/cluster-icon-total.png' ); ?>',
            height: 32,
            width: 32,
            textColor: '#ffffff',
            textSize: 13,
            className: 'cluster-articles'
        }, {
            url: '<?php ap_print_image_url( 'map/cluster-icon-total.png' ); ?>',
            height: 32,
            width: 32,
            textColor: '#ffffff',
            textSize: 13,
            className: 'cluster-all'
        }];

        const headerHeight = 195;
        const footerHeight = 147;
        const legendHeight = 30;
        var mapDiv = $("#map");
        mapDiv.height($(window).height() - headerHeight - footerHeight - legendHeight);
        $(window).on("resize", function() {
            mapDiv.height($(window).height() - headerHeight - footerHeight - legendHeight);
        });

        var mapSettings = {
            center: new google.maps.LatLng(30.0, 0.0),
            zoom: 3,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), mapSettings);
        var searchService = new google.maps.places.PlacesService(map);
        var clustererOptions = { 'averageCenter': true, 'styles': styles, zoomOnClick: false };
        var clusterer = new MarkerClusterer(map, [], clustererOptions);
        clusterer.setCalculator(function (markers) {
            var articlesCount = 0;
            var toursCount = 0;
            for (var i = 0; i < markers.length; i++) {
                if (markers[i].type === 'article') {
                    articlesCount++;
                }
                else if (markers[i].type === 'tour') {
                    toursCount++;
                }
            }

            if (articlesCount == 0) {
                return {
                    text: '<p class="total" style="margin-top: 0;">' + markers.length + '</p>'
                        + '<p class="part" style="display: none; margin-top: 8px; margin-left: 15px;">' + toursCount + '</p>',
                    index: 1
                };
            }
            if (toursCount == 0) {
                return {
                    text: '<p class="total" style="margin-top: 0;">' + markers.length + '</p>'
                        + '<p class="part" style="display: none; margin-top: 8px; margin-left: 15px;">' + articlesCount + '</p>',
                    index: 2
                };
            }
            return {
                text: '<p class="total" style="margin-top: 0;">' + markers.length + '</p>'
                    + '<p class="part" style="display: none; margin-top: 8px; margin-left: 15px;">' + articlesCount  + '</p>'
                    +'<p class="part" style="display: none; margin-top: -20px; margin-left: 15px">' + toursCount + '</p>',
                index: 3
            };
        });

        <?php
        $articles = ap_get_articles(
            array(
                'numberposts' => -1
            )
        );
        foreach ($articles as $article) {
            if ( $article->has_location( ) ) { ?>
                createArticleMarkerByLatLng(<?= $article->latitude; ?>, <?= $article->longitude; ?>, '<?php ap_print_article_permalink( $article->id ); ?>', <?= $article->id; ?>);
            <?php }
            else if ( !empty( $article->resort ) ) { ?>
                createMarkerForArticle('<?= $article->resort; ?>', '<?php ap_print_article_permalink( $article->id ); ?>', <?= $article->id; ?>);
            <?php }
            else if ( !empty( $article->country ) ) { ?>
                createMarkerForArticle('<?= $article->country; ?>', '<?php ap_print_article_permalink( $article->id ); ?>', <?= $article->id; ?>);
            <?php }
        } ?>

        function createMarkerForArticle(queryString, articleUrl, articleId) {
            var request = { query: queryString };
            searchService.textSearch(request, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK && results.length >= 1) {
                    var place = results[0].geometry.location;
                    createArticleMarkerByLocation(place, articleUrl, articleId)

                    $.ajax({
                        type : "post",
                        url : '<?= admin_url( 'admin-ajax.php' ); ?>',
                        data: {
                            action: "ap_save_article_location",
                            nonce: '<?= wp_create_nonce("ap_save_article_location_nonce"); ?>',
                            post_id: articleId,
                            latitude: place.lat(),
                            longitude: place.lng()
                        },
                        success: function() {
                            console.log('Article ' + articleId + ' location updated to lat:' + place.lat()
                                + ' and lng:' + place.lng());
                        },
                        fail: function() {
                            console.log('ERROR: article ' + articleId + 'location does not updated!');
                        }
                    });
                }
                else if (status == google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
                    setTimeout(function() {
                        createMarkerForArticle(queryString, articleUrl, articleId);
                    }, 1500);
                }
            });
        }

        function createArticleMarkerByLatLng(lat, lng, articleUrl, articleId) {
            var place = new google.maps.LatLng(lat, lng);
            createArticleMarkerByLocation(place, articleUrl, articleId);
        }

        function createArticleMarkerByLocation(place, articleUrl, articleId) {
            var marker = new google.maps.Marker({
                icon: '<?php ap_print_image_url('map/article.png'); ?>',
                position: place,
                map: map,
                type: 'article',
                postId: articleId
            });
            google.maps.event.addListener(marker, 'mousedown', function(event) {
                window.location.href = articleUrl;
            });
            clusterer.addMarker(marker);
        }

        <?php
        $tours = ap_get_tours(array(
            'numberposts' => -1
        ));
        foreach ($tours as $tour) {
            if ( $tour->has_location( ) ) { ?>
                createTourMarkerByLatLng(<?= $tour->latitude; ?>, <?= $tour->longitude; ?>, '<?php ap_print_reserve_tour_page_permalink( $tour->id ); ?>', <?= $tour->id; ?>);
            <?php }
            else if ( !empty( $tour->resort ) ) { ?>
                createMarkerForTour('<?= $tour->resort; ?>', '<?php ap_print_reserve_tour_page_permalink( $tour->id ); ?>', <?= $tour->id; ?>);
            <?php }
            else if ( !empty( $tour->country ) ) { ?>
                createMarkerForTour('<?= $tour->country; ?>', '<?php ap_print_reserve_tour_page_permalink( $tour->id ); ?>', <?= $tour->id; ?>);
            <?php }
        } ?>

        function createMarkerForTour(queryString, tourUrl, tourId) {
            var request = { query: queryString };
            searchService.textSearch(request, function(results, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK && results.length >= 1) {
                    var place = results[0].geometry.location;
                    var marker = new google.maps.Marker({
                        icon: '<?php ap_print_image_url('map/tour.png'); ?>',
                        position: place,
                        map: map,
                        type: 'tour',
                        postId: tourId
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        window.location.href = tourUrl;
                    });
                    clusterer.addMarker(marker);

                    $.ajax({
                        type : "post",
                        url : '<?= admin_url( 'admin-ajax.php' ); ?>',
                        data: {
                            action: "ap_save_tour_location",
                            nonce: '<?= wp_create_nonce("ap_save_tour_location_nonce"); ?>',
                            post_id: tourId,
                            latitude: place.lat(),
                            longitude: place.lng()
                        },
                        success: function() {
                            console.log('Tour ' + tourId + ' location updated to lat:' + place.lat()
                                + ' and lng:' + place.lng());
                        },
                        fail: function() {
                            console.log('ERROR: tour ' + tourId + 'location does not updated!');
                        }
                    });
                }
                else if (status == google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
                    setTimeout(function() {
                        createMarkerForTour(queryString, tourUrl, tourId);
                    }, 1500);
                }
            });
        }

        function createTourMarkerByLatLng(lat, lng, tourUrl, tourId) {
            var place = new google.maps.LatLng(lat, lng);
            createTourMarkerByLocation(place, tourUrl, tourId);
        }

        function createTourMarkerByLocation(place, tourUrl, tourId) {
            var marker = new google.maps.Marker({
                icon: '<?php ap_print_image_url('map/tour.png'); ?>',
                position: place,
                map: map,
                type: 'tour',
                postId: tourId
            });
            google.maps.event.addListener(marker, 'click', function () {
                window.location.href = tourUrl;
            });
            clusterer.addMarker(marker);
        }

        var infoWindow = new google.maps.InfoWindow({
            maxWidth: 387.2
        });

        google.maps.event.addListener(infoWindow, 'domready', function(c) {
            var stab = $('#stab');
            var infoWindowInnerDiv = stab.parent('div');
            var infoWindowMiddleDiv = infoWindowInnerDiv.parent('div');
            infoWindowMiddleDiv.addClass('map-infowindow-middle');

            $.ajax({
                type : "post",
                dataType : "html",
                url : '<?= admin_url( 'admin-ajax.php' ); ?>',
                data: {
                    action: "ap_get_posts_for_map_popup",
                    post_ids: {
                        tour_ids: infoWindow.tours,
                        article_ids: infoWindow.articles
                    },
                    nonce: '<?= wp_create_nonce("ap_get_posts_for_map_popup_nonce"); ?>'
                },
                success: function(toursAndArticlesHtml) {
                    infoWindowInnerDiv.html(toursAndArticlesHtml);
                    var tourListWrapper = infoWindowInnerDiv.find('.tourlist-wrapper');
                    tourListWrapper.scrollpanel();
                }
            });
        });

        google.maps.event.addListener(clusterer, 'click', function(c) {
            var markers = c.getMarkers();
            infoWindow.tours = [];
            infoWindow.articles = [];
            for (var i in markers) {
                var marker = markers[i];
                if (marker.type == 'tour') {
                    infoWindow.tours.push(marker.postId);
                }
                else {
                    infoWindow.articles.push(marker.postId);
                }
            }

            infoWindow.setContent('<div id="stab" style="width: 390px; height: 300px;"></div>');
            infoWindow.setPosition(c.getCenter());
            infoWindow.open(map);
        });
    });
</script>

<?php get_footer( );
