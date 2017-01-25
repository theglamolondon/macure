@extends('layouts.main');

@section('content')
    <section ng-app="app">
        <div ng-controller="OuvrageCtrl">
            @{{msg}}
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{request()->getBaseUrl()}}/../node_modules/angular/angular.min.js"></script>
    <script type="text/javascript">
        function Taches(_id, _libelle) {
            this.id = _id;
            this.libelle = _libelle;
        }

        function Ouvrage(id){
            this.id = id;
            this.datedebutetude = moment();
            this.datefinetude = moment();
            this.datedebutexecution = null;
            this.datefinexecution = null;

            this.direction = null;
            this.taches = [];
        }
        
        function Direction(id,libelle,couleur) {
            this.id = id;
            this.libelle = libelle;
            this.couleur = couleur;
        }

        var app = angular.module("app", []);

        app.controller('OuvrageCtrl',function ($scope) {
            $scope.taches = [
                @foreach($t as $taches)
                new Tache({{$t->id}},'{{$t->libelle}}')
                @endforeach
            ];
           $scope.msg = 'bonjour';
        });
    </script>
@endsection