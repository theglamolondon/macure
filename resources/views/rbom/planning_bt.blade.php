@extends('layouts.main')

@section('content')
    <div ng-app="app">
    <section ng-controller="planningCtrl" id="sectionMain">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Planning</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @{{planning}}
                    <aside class="col-md-offset-9 col-md-3 col-sm-offset-9 col-sm-3 col-xs-12">
                    <div class="input-group">
                        <input id="calendrier" type="text" class="form-control datepicker" value="{{$date}}" ng-model="dateOfWeek"/>
                        <span class="input-group-btn">
                                <button type="button" id="go" class="form-control btn btn-primary">Go!</button>
                            </span>
                    </div>
                    </aside>
                    <div class="clearfix"></div>

                    <div class="table-responsive">
                        <table class="table table-bordered  bulk_action">
                            <thead>
                            <tr class="headings">
                                <th width="14.28%" class="alignment-center column-title"><h4>Dimanche</h4><p>{{$dimanche->format('d/m/Y')}}</p></th>
                                <th width="14.28%" class="alignment-center column-title"><h4>Lundi</h4><p>{{$lundi->format('d/m/Y')}}</p></th>
                                <th width="14.28%" class="alignment-center column-title"><h4>Mardi</h4><p>{{$mardi->format('d/m/Y')}}</p></th>
                                <th width="14.28%" class="alignment-center column-title"><h4>Mercredi</h4><p>{{$mercredi->format('d/m/Y')}}</p></th>
                                <th width="14.28%" class="alignment-center column-title"><h4>Jeudi</h4><p>{{$jeudi->format('d/m/Y')}}</p></th>
                                <th width="14.28%" class="alignment-center column-title"><h4>Vendredi</h4><p>{{$vendredi->format('d/m/Y')}}</p></th>
                                <th width="14.28%" class="alignment-center column-title"><h4>Samedi</h4><p>{{$samedi->format('d/m/Y')}}</p></th>
                            </tr>
                            </thead>
                            @if(!$planningbt->isEmpty())
                                <tbody>
                                @foreach($equipes as $equipe)
                                    <tr class="odd pointer">
                                        <td class=" ">

                                        </td>
                                        <td class=" ">

                                        </td>
                                        <td class=" ">

                                        </td>
                                        <td class=" ">

                                        </td>
                                        <td class=" ">

                                        </td>
                                        <td class=" ">

                                        </td>
                                        <td class=" ">

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            @else
                                <tr>
                                    <td colspan="7">
                                        <div class="bs-example" data-example-id="simple-jumbotron">
                                            <div class="jumbotron">
                                                <h1 style="text-align: center">Djera Services - MACURE</h1>
                                                <p style="text-align: center">Aucun planning disponible pour cette semaine.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Liste des BT non palnnifiés du @{{dateOfWeek}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>N° BT</th>
                            <th>Exécution</th>
                            <th>Détails</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="bt in bonsTravaux">
                            <td>@{{bt.numero}}</td>
                            <td>@{{bt.dateexecution.toString()}}</td>
                            <td>@{{bt.details}}</td>
                            <td align="center">
                                <a href="#" title="Plannifier le bon de travail" ng-click="plannifier(@{{ bt }})" data-toggle="modal" data-target="">
                                    <i class="fa fa-calendar-o"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-12 modal fade bs-example-modal-lg" ng-show="showPlanning" id="planningToShow">
            <h1>Planning TADA !!! (^_^)</h1>
        </div>

    </section>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function BonTravaux(id,numero,dateexecution,dateplannification,urgence_id,details){
            this.id = id;
            this.numero = numero;
            this.dateexecution = dateexecution;
            this.dateplannification = dateplannification;
            this.urgence_id = urgence_id;
            this.details = details;
        }

        //MAJ du prototypage des dates
        Date.prototype.toString = function(){
            return (this.getDay() < 10 ? '0'+this.getDay() : this.getDay())
                    +'/'+(this.getMonth()< 10 ? '0'+this.getMonth() : this.getMonth())
                    +'/'+this.getFullYear();
        }

        //var ab = new BonTravaux(1,new Date(2017,01,06),new Date(2017,01,06),1);
        //ab.example(455);

        var BTofWeek = [
        @foreach($bonDeLaSemaine as $bt)
            new BonTravaux({{$bt->id}},
                {{$bt->numerobon}},
                new Date({{\Carbon\Carbon::parse($bt->dateexecution)->format('Y,m,d')}}),
                new Date({{\Carbon\Carbon::parse($bt->dateplannification)->format('Y,m,d')}}),
                {{$bt->urgence_id}},
                '{{$bt->descriptionpanne}}'
            ),
        @endforeach
        ];

        console.log(BTofWeek);

    </script>
    <script type="text/javascript" src="{{request()->getBaseUrl()}}/../node_modules/angular/angular.min.js"></script>
    <script type="text/javascript" src="{{request()->getBaseUrl()}}/js/angular.bt.planning.js"></script>
@endsection