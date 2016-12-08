@extends('layouts.main')
@section('content')
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        #map {
            height: 900px;
            min-width: 200px;
        }
    </style>
    <div id="map"></div>
    <script>
        var directionsDisplay;
        var directionsService = null;
        var map;
        var djeraPosition = null;
        var pannePosition = null;

        function initialize() {
            directionsService = new google.maps.DirectionsService();
            djeraPosition  = new google.maps.LatLng(5.3057055, -3.9910777);
            pannePosition = new google.maps.LatLng(5.3178887, -3.9641001);

            directionsDisplay = new google.maps.DirectionsRenderer();
            var mapOptions = {
                zoom: 13,
                center: djeraPosition
            }
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            directionsDisplay.setMap(map);

            //Calcul et affichage de la route
            calcRoute();
        }

        function calcRoute() {
            var request = {
                origin: djeraPosition,
                destination: pannePosition,
                // Note that Javascript allows us to access the constant
                // using square brackets and a string value as its
                // "property."
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                }
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7nl4IYZVJCWievWF7yv8xu8-WFind8CM&callback=initialize"
            async defer>
    </script>
@endsection