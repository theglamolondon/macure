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
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.
    var FPAM_DATA = [@foreach($fpamCoord as $coord){coord :{lat:{{$coord->lattitude}},lng:{{$coord->longitude}} },id:'{{$coord->id}}', numerofpam:'{{$coord->numerofpam}}'  },@endforeach];

    function initMap() {
        var djeraPosition  = new google.maps.LatLng({{\App\Http\Controllers\Map\MapsApiController::DJERA_POSITION_LATTITUDE}},{{\App\Http\Controllers\Map\MapsApiController::DJERA_POSITION_LONGITUDE}});

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 13
        });
        var markerDjera = new google.maps.Marker({
            position: djeraPosition,
            map:map,
            title: 'Djera Service',
            icon :'{{request()->getBaseUrl()}}/images/djera-office.png'
        });
        var infoDjera = new google.maps.InfoWindow({
            content: '<div><h3>Djera Services</h3><p>Entreprise spécialisée dans la '+
            'maintenance currative du réseau basse tension. '+
            '</p></div>',
        });
        markerDjera.addListener('click',function () {
           infoDjera.open(map,markerDjera);
        });

        //var infoWindow = new google.maps.InfoWindow({map: map});

        for(var i=0; i < FPAM_DATA.length; i++)
        {
            var marker = new google.maps.Marker({
                position: FPAM_DATA[i].coord,
                map:map,
                title: 'FPAM '+FPAM_DATA[i].numerofpam,
                icon: '{{request()->getBaseUrl()}}/images/cone_11.png'
            });
            attachSecretMessage(marker, FPAM_DATA[i].id);
        }

        function attachSecretMessage(marker, id) {
            var infowindow = new google.maps.InfoWindow({
                content: 'AJKLM%LKJHJHKLM%MLKJKLM%MLKJML%%ML'
            });

            marker.addListener('click',function () {
                infowindow.open(map,marker);
            })
        }

        map.setCenter(djeraPosition);
       
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7nl4IYZVJCWievWF7yv8xu8-WFind8CM&callback=initMap"
        async defer>
</script>
@endsection