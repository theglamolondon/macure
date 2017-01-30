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
                    <div class="col-md-2 col-offset-7 col-sm-offset-7 col-sm-2 col-xs-12 left"><h3 class="">Année :</h3></div>
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
                    <th width="16%">Activité de maintenance</th>
                    <th width="7%">{{$mois['M1']}}</th>
                    <th width="7%">{{$mois['M2']}}</th>
                    <th width="7%">{{$mois['M3']}}</th>
                    <th width="7%">{{$mois['M4']}}</th>
                    <th width="7%">{{$mois['M5']}}</th>
                    <th width="7%">{{$mois['M6']}}</th>
                    <th width="7%">{{$mois['M7']}}</th>
                    <th width="7%">{{$mois['M8']}}</th>
                    <th width="7%">{{$mois['M9']}}</th>
                    <th width="7%">{{$mois['M10']}}</th>
                    <th width="7%">{{$mois['M11']}}</th>
                    <th width="7%">{{$mois['M12']}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Mise en conformité des ouvrages de BT</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                        <!-- 4eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M4_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /4eme mois -->
                        <!-- 5eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M5_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /5eme mois -->
                        <!-- 6eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M6_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /6eme mois -->
                        <!-- 7eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M7_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /7eme mois -->
                        <!-- 8eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M8_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /8eme mois -->
                        <!-- 9eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M9_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /9eme mois -->
                        <!-- 10eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M10_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /10eme mois -->
                        <!-- 11eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M11_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /11eme mois -->
                        <!-- 12eme mois -->
                        <td @if($loop->index == 0)bgcolor="#FFC4C4" @endif @if($loop->index == 1)bgcolor="#99DBFF" @endif >
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M12_'] ;
                                })
                            as $ov)
                                <span class="label label-default" style="background-color: {{$ov->couleur}}">{{$ov->libelle}}</span> @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /12eme mois -->
                    </tr>
                @endforeach
                <tr>
                    <td>Normalisation des postes H59.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M4_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M5_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M6_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M7_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M8_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M9_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M10_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M11_'])
                                <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                            @endif
                        </td>
                        <td>
                            @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M12_'])
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

        app.controller("trimestreCtrl", function($scope){
            $scope.trim = 1;
            $scope.annees = null;

            $scope.url = '{{route('planning_ouvrage_annuel',['annee'=>'_A'])}}';

            $scope.validate = function() {
                window.document.location.href =  ($scope.url.replace(regexA,$('#an').val()));
            }
        });
    </script>
@endsection