var map;
var marker;

function initMap() {

    var defaultLatLng = { lat: 8.00, lng: 81.00 };

    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultLatLng,
        zoom: 7.6
    });

    marker = new google.maps.Marker({
        position: defaultLatLng,
        map: map,
        draggable: true
    });

    google.maps.event.addListener(marker, 'dragend', function (event) {
        var newLatLng = { lat: event.latLng.lat(), lng: event.latLng.lng() };
        console.log('New Location:', newLatLng);
    });
}

function getLocation() {

    var currentLatLng = { lat: marker.getPosition().lat(), lng: marker.getPosition().lng() };
    console.log('Selected Location:', currentLatLng);

    document.getElementById('latitudeInput').value = currentLatLng.lat;
    document.getElementById('longitudeInput').value = currentLatLng.lng;//


}

document.addEventListener('DOMContentLoaded', function () {
    var mainBottomMaps = document.querySelector('.main-bottom-maps');
    var mapPopup = document.getElementById('mapPopup');

    mainBottomMaps.addEventListener('click', function () {
        // Toggle the display property of mapPopup
        mapPopup.style.display = (mapPopup.style.display === 'flex') ? 'none' : 'flex';
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var cancelBtn = document.getElementById('cancelBtn');
    var mapPopup = document.getElementById('mapPopup');
    var map = document.getElementById('markLocationBtn');
    cancelBtn.addEventListener('click', function () {
        // Set display property of mapPopup to 'none'
        mapPopup.style.display = 'none';
    });
    map.addEventListener('click', function () {
        // Set display property of mapPopup to 'none'
        mapPopup.style.display = 'none';
    });
});