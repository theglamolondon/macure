@extends('layouts.main')
@php
    global $m; $m = $mois;
@endphp
@section('content')
    <div class="x_panel" ng-app="app">
        <div class="x_title">
            <div class="clearfix"></div>
        </div>
        <div class="x_content" ng-controller="trimestreCtrl">
            <div>
                <div class="btn-toolbar row" >
                    <div class="col-md-2 col-offset-5 col-sm-offset-5 col-sm-2 col-xs-12 left"><h3 class="">Trimestres :</h3></div>
                    <div class="btn-group col-md-2 col-sm-2 col-xs-12">
                        <button class="btn btn-info" type="button" ng-click="trimestre(1)">1</button>
                        <button class="btn btn-info " type="button" ng-click="trimestre(2)">2</button>
                        <button class="btn btn-info" type="button" ng-click="trimestre(3)">3</button>
                        <button class="btn btn-info" type="button" ng-click="trimestre(4)">4</button>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" id="an">
                            @for($i=2017;$i <= \Carbon\Carbon::now()->year ; $i++ )
                            <option>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-info" ng-click="validate()">OK</button>
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th width="40%" class="column-title">Activité de maintenance</th>
                        <th width="20%" class="column-title">{{$mois['M1']}}</th>
                        <th width="20%" class="column-title">{{$mois['M2']}}</th>
                        <th width="20%" class="column-title">{{$mois['M3']}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mise en conformité des ouvrages de BT</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Postes : H59. @foreach($ouvrages->unique() as $ouvrage) {{$ouvrage->libelle}} @if(!$loop->last)-@endif @endforeach</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($taches as $tache)
                    <tr>
                        <td>{{$loop->index+1}} - {{$tache->libelle}}</td>
                        <!-- 1er mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M1_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /1er mois -->
                        <!-- 2eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M2_'];
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /2eme mois -->
                        <!-- 3eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M3_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /3eme mois -->
                    </tr>
                    @endforeach
                    <tr>
                        <td>Normalisation des postes H59.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach($ouvragesExecutes as $ouvrageExec)
                    <tr>
                        <td>{{$ouvrageExec->typeOuvrage->libelle}} : {{$ouvrageExec->libelle}}</td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M1_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M2_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M3_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{request()->getBaseUrl()}}/../node_modules/angular/angular.min.js"></script>
    <script type="text/javascript">
        var app = angular.module("app", []);
        var regexA = new RegExp("(_A)","g");
        var regexT = new RegExp("(_T)","g");

        app.controller("trimestreCtrl", function($scope){
            $scope.trim = 1;
            $scope.annees = null;

            $scope.url = '{{route('planning_ouvrage_trimestriel',['trimestre'=>'_T','annee'=>'_A'])}}';
            $scope.trimestre = function (arg) {
                $scope.trim = arg;
            }

            $scope.validate = function() {
                window.document.location.href =  ($scope.url.replace(regexA,$('#an').val()).replace(regexT,$scope.trim));
            }
        });
    </script>
@endsection