<?php
class AP_TourEditView extends AP_TourView {
    public function __construct( array $tours = null ) {
        parent::__construct( $tours );
    }

    public function show( ) {
        if ( $this->is_model_empty( ) ) {
            $title = 'Добавить новый тур';
            $handler_permalink = ap_get_create_tour_page_permalink( );
            $submit_button_name = 'СОЗДАТЬ';
        }
        else {
            $title = 'Редактирование тура';
            $handler_permalink = ap_get_edit_tour_page_permalink( $this->get_the_id( ) );
            $submit_button_name = 'СОХРАНИТЬ';
        }?>

        <div id="content">
            <div class="addtour-wrapper">
                <div id="addtour">
                    <h1 class="moderating-header"><?= $title ?></h1>
                    <form name="create-tour-form" action="<?= $handler_permalink ?>" method="post"
                          enctype="multipart/form-data">
                        <div class="tour">
                            <div style="width: 620px; margin-left: 20px;">
                                <p><label for="location-addtour-form">Место назначения (не отображается)</label></p>
                                <input name="ap_tour_location" type="text" id="location-addtour-form"
                                       value="" style="width: 620px;">
                                <input type="hidden" id="latitude" name="ap_tour_latitude" value="<?php $this->the_latitude( ); ?>">
                                <input type="hidden" id="longitude" name="ap_tour_longitude" value="<?php $this->the_longitude( ); ?>">
                            </div>
                            <div id="mapContainer" class="clear" style="margin-left: 20px; width: 634px; height: 400px;">
                                <div id="map" style="width: 430px; height: 400px; float: left;"></div>
                                <div id="listing" style="width: 204px; height: 400px; float: right; overflow: auto;">
                                    <table id="resultsTable">
                                        <tbody id="results"></tbody>
                                    </table>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    var markers = [];
                                    var MARKER_PATH = 'https://maps.gstatic.com/intl/en_us/mapfiles/marker_green';
                                    var mapSettings = {
                                        center: new google.maps.LatLng(30.0, 0.0),
                                        zoom: 3,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                                        mapTypeControl: false,
                                        panControl: false,
                                        zoomControl: false,
                                        streetViewControl: false
                                    };
                                    var map = new google.maps.Map(document.getElementById("map"), mapSettings);

                                    var input = document.getElementById('location-addtour-form');
                                    var autoComplete = new google.maps.places.Autocomplete(input);

                                    var placesService = new google.maps.places.PlacesService(map);
                                    var geocoder = new google.maps.Geocoder();

                                    google.maps.event.addListener(autoComplete, 'place_changed', function() {
                                        var place = autoComplete.getPlace();
                                        if (!place.geometry) {
                                            console.log('В autocomplete ничего не выбрано!');
                                        }
                                        else {
                                            var latLng = place.geometry.location;
                                            map.panTo(latLng);
                                            map.setZoom(10);
                                            codeLatLng(latLng);
                                            search();
                                        }
                                    });

                                    if(!Array.prototype.indexOf) {
                                        Array.prototype.indexOf = function(needle) {
                                            for(var i = 0; i < this.length; i++) {
                                                if(this[i] === needle) {
                                                    return i;
                                                }
                                            }
                                            return -1;
                                        };
                                    }

                                    function codeLatLng(latLng) {
                                        $('#latitude').val(latLng.lat());
                                        $('#longitude').val(latLng.lng());

                                        $('#country-addtour-form').val('');
                                        $('#resortcity-addtour-form').val('');
                                        $('#hotelname-addtour-form').val('');

                                        var country = '';
                                        var resort = '';

                                        geocoder.geocode({'latLng': latLng}, function(results, status) {
                                            if (status == google.maps.GeocoderStatus.OK) {
                                                var mostDetailedResult = results[1];
                                                var addressComponents = mostDetailedResult['address_components'];

                                                for (var key in addressComponents) {
                                                    var component = addressComponents[key];
                                                    for (var i = 0; i < component.types.length; i++) {
                                                        var type = component.types[i];
                                                        if (type == 'locality' || type == 'city' ) {
                                                            resort = component.long_name;
                                                        }
                                                        if (resort == '' && type == 'political') {
                                                            resort = component.long_name;
                                                        }
                                                        if (type == 'country') {
                                                            country = component.long_name;
                                                        }
                                                    }
                                                }
                                            } else {
                                                console.log("Goecoder сламался со статусом: " + status);
                                            }
                                            $('#country-addtour-form').val(country);
                                            $('#resortcity-addtour-form').val(resort);
                                        });
                                    }

                                    // Search for hotels in the selected city, within the viewport of the map.
                                    function search() {
                                        var search = {
                                            bounds: map.getBounds(),
                                            types: ['lodging']
                                        };

                                        placesService.search(search, function(results, status) {
                                            clearResults();
                                            clearMarkers();

                                            if (status == google.maps.places.PlacesServiceStatus.OK) {
                                                clearResults();
                                                clearMarkers();
                                                // Create a marker for each hotel found, and
                                                // assign a letter of the alphabetic to each marker icon.
                                                for (var i = 0; i < results.length; i++) {
                                                    var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
                                                    var markerIcon = MARKER_PATH + markerLetter + '.png';
                                                    // Use marker animation to drop the icons incrementally on the map.
                                                    markers[i] = new google.maps.Marker({
                                                        position: results[i].geometry.location,
                                                        animation: google.maps.Animation.DROP,
                                                        icon: markerIcon
                                                    });
                                                    // If the user clicks a hotel marker, select hotel on the form.
                                                    markers[i].placeResult = results[i];
                                                    google.maps.event.addListener(markers[i], 'click', selectHotel);
                                                    setTimeout(dropMarker(i), i * 100);
                                                    addResult(results[i], i);
                                                }
                                            }
                                        });
                                    }

                                    function clearMarkers() {
                                        for (var i = 0; i < markers.length; i++) {
                                            if (markers[i]) {
                                                markers[i].setMap(null);
                                            }
                                        }
                                        markers = [];
                                    }

                                    function dropMarker(i) {
                                        return function() {
                                            markers[i].setMap(map);
                                        };
                                    }

                                    function addResult(result, i) {
                                        var results = document.getElementById('results');
                                        var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
                                        var markerIcon = MARKER_PATH + markerLetter + '.png';

                                        var tr = document.createElement('tr');
                                        tr.style.backgroundColor = (i % 2 == 0 ? '#F0F0F0' : '#FFFFFF');
                                        tr.onclick = function() {
                                            google.maps.event.trigger(markers[i], 'click');
                                        };

                                        var iconTd = document.createElement('td');
                                        var nameTd = document.createElement('td');
                                        var icon = document.createElement('img');
                                        icon.src = markerIcon;
                                        icon.setAttribute('class', 'placeIcon');
                                        icon.setAttribute('className', 'placeIcon');
                                        var name = document.createTextNode(result.name);
                                        iconTd.appendChild(icon);
                                        nameTd.appendChild(name);
                                        tr.appendChild(iconTd);
                                        tr.appendChild(nameTd);
                                        results.appendChild(tr);
                                    }

                                    function clearResults() {
                                        var results = document.getElementById('results');
                                        while (results.childNodes[0]) {
                                            results.removeChild(results.childNodes[0]);
                                        }
                                    }

                                    function selectHotel() {
                                        var marker = this;
                                        placesService.getDetails({reference: marker.placeResult.reference},
                                            function(place, status) {
                                                if (status != google.maps.places.PlacesServiceStatus.OK) {
                                                    return;
                                                }
                                                fillHotelField(place);
                                            });
                                    }

                                    function fillHotelField(place) {
                                        $('#hotelname-addtour-form').val(place.name);
                                        var rating = 1;
                                        if (place.rating) {
                                            rating = Math.round(place.rating);
                                        }
                                        $('#hotel-rating-addtour-form').val(rating);
                                    }

                                    // Предотвращение сохранения на нажатие Enter'а при выборе местоположения
                                    $('#location-addtour-form').keypress(function (e) {
                                        if (e.keyCode == '13') {
                                            e.preventDefault();
                                        }
                                    });
                                });
                            </script>
                            <div>
                                <div>
                                    <p><label for="country-addtour-form">Страна</label></p>
                                    <input name="ap_tour_country" type="text" id="country-addtour-form"
                                           value="<?php $this->the_country( ); ?>" required>
                                </div>
                                <div>
                                    <p><label for="hotelname-addtour-form">Название отеля</label></p>
                                    <input name="ap_tour_hotel" type="text" id="hotelname-addtour-form"
                                           value="<?php $this->the_hotel( ); ?>" required>
                                </div>
                                <div>
                                    <p><label for="hotel-rating-addtour-form">Уровень отеля</label></p>
                                    <input name="ap_tour_hotel_rating" type="number" id="hotel-rating-addtour-form"
                                           value="<?php $this->the_hotel_rating( ); ?>" min="1" max="5" required>
                                </div>
                                <div>
                                    <p><label for="cost-addtour-form">Стоимость тура</label></p>
                                    <input name="ap_tour_cost" type="text" id="cost-addtour-form"
                                           value="<?php $this->the_cost( ); ?>" required>
                                </div>
                                <div>
                                    <span style="font-size: 18px; font-weight: bolder;">руб</span>
                                </div>
                            </div>
                            <div>
                                <div>
                                    <p><label for="resortcity-addtour-form">Курорт/Город</label></p>
                                    <input name="ap_tour_resort" type="text" id="resortcity-addtour-form"
                                           value="<?php $this->the_resort( ); ?>" required>
                                </div>
                                <div>
                                    <p><label for="addtour-datepicker">Дата заезда</label></p>
                                    <input name="ap_tour_start_date" type="text" id="addtour-datepicker"
                                           value="<?php $this->the_start_date( ); ?>" required>
                                    <div id="calendar-image" onclick="$('#addtour-datepicker').focus()"></div>
                                </div>
                                <div>
                                    <p><label for="nightcount-addtour-form">Количество ночей</label></p>
                                    <input name="ap_tour_duration" type="text" id="nightcount-addtour-form"
                                           value="<?php $this->the_duration( ); ?>" required>
                                </div>
                                <div>
                                    <br><br><br>
                                    <input name="ap_burning_tour" type="checkbox" id="ap_burning_tour_id"
                                           value="is_burning"  <?php $this->the_burning(); ?>>
                                <span class="red" style="font-size: 18px; font-weight: bolder;">
                                    <label for="ap_burning_tour_id">Горящий тур</label>
                                </span>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="photo">
                            <div>
                                <?php if ( $this->is_model_empty( ) ) { ?>
                                    <div>
                                        <p><label for="photo-addtour-file">Фотография (200x200px)</label></p>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                        <input name="ap_tour_icon" id="photo-addtour-file" type="file" accept="image/*"
                                               required>
                                        <input name="ap_tour_icon_crop_x" id="photo-addtour-file_crop_x" type="hidden">
                                        <input name="ap_tour_icon_crop_y" id="photo-addtour-file_crop_y" type="hidden">
                                        <input name="ap_tour_icon_crop_width" id="photo-addtour-file_crop_width" type="hidden">
                                        <input name="ap_tour_icon_crop_height" id="photo-addtour-file_crop_height" type="hidden">
                                    </div>
                                <?php }
                                else { ?>
                                    <div>
                                        <div>
                                            <p>Текущяя фотография</p>
                                            <?php $this->the_icon( 200, 200, false ); ?>
                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            <p><label for="photo-addtour-file">Новая фотография (200x200px)</label></p>
                                            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                                            <input name="ap_tour_icon" id="photo-addtour-file" type="file"
                                                   accept="image/*">
                                            <input name="ap_tour_icon_crop_x" id="photo-addtour-file_crop_x" type="hidden">
                                            <input name="ap_tour_icon_crop_y" id="photo-addtour-file_crop_y" type="hidden">
                                            <input name="ap_tour_icon_crop_width" id="photo-addtour-file_crop_width" type="hidden">
                                            <input name="ap_tour_icon_crop_height" id="photo-addtour-file_crop_height" type="hidden">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <br><br>
                        <div class="sliderinfo">
                            <p>Информация для слайдера (не обязательно к заполнению)</p>
                            <div>
                                <div>
                                    <p><label for="actionname-addtour-form">Название акции</label></p>
                                    <input name="ap_tour_offer_name" type="text" id="actionname-addtour-form"
                                           value="<?php $this->the_offer_name( ); ?>">
                                </div>
                                <div>
                                    <p><label for="briefdescription-addtour-form">Краткое описание</label></p>
                                    <textarea name="ap_tour_offer_description" id="briefdescription-addtour-form"
                                              rows="5" cols="50"><?php $this->the_offer_description( ); ?></textarea>
                                </div>

                                <?php if ( $this->is_model_empty( ) ) { ?>
                                    <div>
                                        <p>
                                            <label for="sliderphoto-addtour-file">
                                                Фотография для слайдера(960x374px)
                                            </label>
                                        </p>
                                        <input name="ap_tour_offer_banner" id="sliderphoto-addtour-file" type="file"
                                            accept="image/*">
                                        <input name="ap_tour_offer_banner_crop_x"  id="sliderphoto-addtour-file_crop_x" type="hidden">
                                        <input name="ap_tour_offer_banner_crop_y" id="sliderphoto-addtour-file_crop_y" type="hidden">
                                        <input name="ap_tour_offer_banner_crop_width" id="sliderphoto-addtour-file_crop_width" type="hidden">
                                        <input name="ap_tour_offer_banner_crop_height" id="sliderphoto-addtour-file_crop_height" type="hidden">
                                    </div>
                                <?php }
                                else { ?>
                                    <div class="slider-photo">
                                        <div>
                                            <p>Текущяя фотография для слайдера</p>
                                            <?php $this->the_banner( 640, 255 ); ?>
                                        </div>
                                    </div>
                                    <div class="slider-photo">
                                        <div>
                                            <p>
                                                <label for="sliderphoto-addtour-file">
                                                    Новая фотография для слайдера (940x382px)
                                                </label>
                                            </p>
                                            <input name="ap_tour_offer_banner" id="sliderphoto-addtour-file"
                                                   type="file" accept="image/*">
                                            <input name="ap_tour_offer_banner_crop_x"  id="sliderphoto-addtour-file_crop_x" type="hidden">
                                            <input name="ap_tour_offer_banner_crop_y" id="sliderphoto-addtour-file_crop_y" type="hidden">
                                            <input name="ap_tour_offer_banner_crop_width" id="sliderphoto-addtour-file_crop_width" type="hidden">
                                            <input name="ap_tour_offer_banner_crop_height" id="sliderphoto-addtour-file_crop_height" type="hidden">
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <br><br>
                        <div class="submitbuttons">
                            <div>
                                <button id="cancel-addtour-button" type="reset">ОТМЕНИТЬ</button>
                                <button name="create-tour-submit-button" id="create-addtour-button" type="submit">
                                    <?= $submit_button_name; ?>
                                </button>
                            </div>
                        </div>
                        <br><br>
                    </form><!--create-tour-form-->
                </div><!--addtour-->
            </div><!--addtour-wrapper-->
        </div><!-- #content -->

        <?php ap_add_js_calendar_to_element( '#addtour-datepicker' );

        ap_add_image_cropper_to_element( 'photo-addtour-file', 1 );
        ap_add_image_cropper_to_element( 'sliderphoto-addtour-file', 2.5 );
    }

    public static function show_for( AP_Tour $tour = null ) {
        $tours = null;
        if ( !empty( $tour ) ) {
            $tours = array( $tour );
        }
        $view = new AP_TourEditView( $tours );
        $view->show( );
    }
}
