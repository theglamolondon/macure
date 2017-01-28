@extends('layouts.main')
@php
    global $m; $m = $mois;
@endphp
@section('content')
    <div class="x_panel" ng-app="app">
        <div class="x_title">

            <div class="clearfix"></div>
        </div>
        <div class="x_content" ng-controller="CtrlPlanning">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th width="40%">Activité de maintenance</th>
                        <th width="20%" >{{$mois['M1']}}</th>
                        <th width="20%">{{$mois['M2']}}</th>
                        <th width="20%">{{$mois['M3']}}</th>
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
                        <td>{{$tache->id}} - {{$tache->libelle}}</td>
                        <!-- 1er mois -->
                        <td>
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month == $m['M1_'] ;
                                })
                            as $ov)
                                {{$ov->libelle}} @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /1er mois -->
                        <!-- 2eme mois -->
                        <td>
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M2_'];
                                })
                            as $ov)
                                {{$ov->libelle}} @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /2eme mois -->
                        <!-- 3eme mois -->
                        <td>
                            @foreach($ouvrages->where('tache_id',$tache->id)->filter(function ($item,$key){
                                global $m;
                                return \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M3_'] ;
                                })
                            as $ov)
                                {{$ov->libelle}} @if(!$loop->last)/@endif
                            @endforeach
                        </td>
                        <!-- /3eme mois -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection