/**
 * Created by Root on 31/03/2017.
 */

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



/*$("#txtEndereco").autocomplete({
    source: function (request, response) {
        geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function (results, status) {
            response($.map(results, function (item) {
                return {
                    label: item.formatted_address,
                    value: item.formatted_address,
                    latitude: item.geometry.location.lat(),
                    longitude: item.geometry.location.lng()
                }
            }));
        })
    },
    select: function (event, ui) {
        $("#txtLatitude").val(ui.item.latitude);
        $("#txtLongitude").val(ui.item.longitude);
        var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
        marker.setPosition(location);
        map.setCenter(location);
        map.setZoom(16);
    }
});*/