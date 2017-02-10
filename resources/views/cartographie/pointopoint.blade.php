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
    <div class="rows">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="">
                <label>
                    <input type="checkbox" class="js-switch" id="myPosition" onclick="switchPosition();"/> Calculer en fonction de ma position
                </label>
            </div>
        </div>
    </div>
    <div class="clear" id="map"></div>
    <script>
        var directionsDisplay;
        var directionsService = null;
        var map;
        var djeraPosition = null;
        var pannePosition = null;

        function initialize() {
            directionsService = new google.maps.DirectionsService();
            djeraPosition  = new google.maps.LatLng({{\App\Http\Controllers\Map\MapsApiController::DJERA_POSITION_LATTITUDE}},{{\App\Http\Controllers\Map\MapsApiController::DJERA_POSITION_LONGITUDE}});
            pannePosition = new google.maps.LatLng({{$fpam->lattitude}},{{$fpam->longitude}});

            directionsDisplay = new google.maps.DirectionsRenderer();
            var mapOptions = {
                zoom: 13,
                center: djeraPosition
            }
            map = new google.maps.Map(document.getElementById("map"), mapOptions);
            directionsDisplay.setMap(map);

            //Calcul et affichage de la route
            calcRoute(djeraPosition);
        }

        function calcRoute(_origine) {
            var request = {
                origin: _origine,
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
        
        function switchPosition() {
            var chk = document.getElementById("myPosition");
            if(chk.checked)
            {
                if(navigator.geolocation)
                {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        myPlace = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                        //console.log(myPlace);
                        calcRoute(myPlace);
                    });
                }else{ alert('Impossible d\'avoir accès à votre position !'); }
            } else {
                calcRoute(djeraPosition);
            }
        }

        function getCoordonnees() {
            var myPlace = null;
            if(navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(function(position) {
                    myPlace = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

                    console.log(myPlace);
                });
            }else{
                alert('Impossible d\'avoir accès à votre position !');
                return null;
            }
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7nl4IYZVJCWievWF7yv8xu8-WFind8CM&callback=initialize"
            async defer>
    </script>
@endsection