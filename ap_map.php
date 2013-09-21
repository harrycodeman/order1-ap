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

        var mapProp = {
            center: new google.maps.LatLng(30.0, 0.0),
            zoom: 3,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), mapProp);

//        function createMarkerForArticle() {
//            var request = { query: "Париж" };
//            service = new google.maps.places.PlacesService(map);
//            service.textSearch(request, createMarkersForSearchResults);
//
//            function createMarkersForSearchResults(results, status) {
//                if (status == google.maps.places.PlacesServiceStatus.OK && results.length >= 1) {
//                    var place = results[0].geometry.location;
//                    createMarker(place);
//                }
//            }
//
//            function createMarker(position) {
//                var marker = new google.maps.Marker({ position: position });
//                marker.setMap(map);
//            }
//        }
    });
</script>

<?php get_footer( );
