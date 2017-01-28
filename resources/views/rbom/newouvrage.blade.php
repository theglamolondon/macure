@extends('layouts.main');

@section('content')
    <section ng-app="app">
        <div ng-controller="OuvrageCtrl">
            <div class="x_panel">
                <div class="x_title">
                    <h3>Nouvel ouvrage : @{{msg}} </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" method="post" action="{{route('nouveau_ouvrage')}}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Titre de l'ouvrage</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control" placeholder="Titre de l'ouvrage" ng-model="msg" name="libelle" value="{{old('libelle')}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Type d'ouvrage</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2_single" name="typeouvrage_id">
                                    @foreach($typeouvrages as $typeouvrage)
                                        <option value="{{$typeouvrage->id}}" @if(old('typeouvrage_id')== $typeouvrage->id) selected @endif>{{$typeouvrage->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Direction</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2_single" name="direction_id">
                                    @foreach($directions as $direction)
                                        <option value="{{$direction->id}}" @if(old('direction_id')== $direction->id) selected @endif>{{$direction->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date de début d'étude</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input name="datedebutetude" class="date-picker datepicker form-control col-md-4 col-xs-12" required type="text" value="{{old('datedebutetude')}}" />
                                </div>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date de fin d'étude</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input name="datefinetude" class="date-picker datepicker form-control col-md-4 col-xs-12" required type="text" value="{{old('datefinetude')}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date de début d'exécution</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input name="datedebutexecution" class="date-picker datepicker form-control col-md-7 col-xs-12" required type="text" value="{{old('datedebutexecution')}}" />
                                </div>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date de fin d'exécution</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input name="datefinexecution" class="date-picker datepicker form-control col-md-7 col-xs-12" required type="text" value="{{old('datefinexecution')}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12">Taches</label>
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <select class="select2_multiple form-control" multiple name="taches[]">
                                        @foreach($taches as $tache)
                                            <option value="{{$tache->id}}" @if(old('direction_id')== $tache->id) selected @endif>{{$tache->libelle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="reset" class="btn btn-primary">Annuler</button>
                                <button type="submit" class="btn btn-success">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{request()->getBaseUrl()}}/../node_modules/angular/angular.min.js"></script>
    <script type="text/javascript">
        function Tache(_id, _libelle) {
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
                @foreach($taches as $t)
                    new Tache({{$t->id}},'{{$t->libelle}}'),
                @endforeach
            ];
            $scope.msg = '{{old('libelle') ? old('libelle') : 'Nouveau titre'}}';
        });
    </script>
@endsection