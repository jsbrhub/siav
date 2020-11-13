<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 30/11/2017
 * Time: 16:27
 */
?>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD5KsVxGlg5vrtQr1F9oeft4K8hKE2aPyc"></script>
<script>
    var geocoder;
    var map;
    var marker;

    function initialize() {
        var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
        var options = {
            zoom: 5,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("mapa"), options);

        geocoder = new google.maps.Geocoder();

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });

        marker.setPosition(latlng);
    }

    $(document).ready(function () {
        initialize();
    });

    $(document).ready(function () {
        function carregarNoMapa(endereco) {
            geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();

                        $('#txtLatitude').val(latitude);
                        $('#txtLongitude').val(longitude);

                        var location = new google.maps.LatLng(latitude, longitude);
                        marker.setPosition(location);
                        map.setCenter(location);
                        map.setZoom(16);
                    }
                }
            });
        }
        google.maps.event.addListener(marker, 'drag', function () {
            geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('#txtLatitude').val(marker.getPosition().lat());
                        $('#txtLongitude').val(marker.getPosition().lng());
                    }
                }
            });
        });

        $("#txtEndereco").blur(function() {
            if($(this).val() != "")
                carregarNoMapa($(this).val());
        })

    });
</script>
<form method="post" action="" id="">
    <fieldset>
        <legend>Google Maps</legend>

        <div>
            <label for="txtEndereco">Endereço:</label>
            <input type="text" id="txtEndereco" name="txtEndereco" />

        </div>
        <div>
            <label for="txtNumero">Num.:</label>
            <input type="text" id="txtNumero" name="txtNumero" />
        </div>
        <div>
            <label for="txtLatitude">Latitude:</label>
            <input type="text" id="txtLatitude" name="txtLatitude" />
            <label for="txtLongitude">Longitude:</label>
            <input type="text" id="txtLongitude" name="txtLongitude" />
        </div>

        <div id="mapa" style="height: 300px; width: 500px">
        </div>


        </div>


    </fieldset>
</form>