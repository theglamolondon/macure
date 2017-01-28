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
                                    <tr class="odd pointer">
                                        <td class=" ">
                                            @foreach($planningbt->where('dateplannification',$dimanche->toDateString()) as $bt)
                                                BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}
                                            @endforeach
                                        </td>
                                        <td class=" ">
                                            @foreach($planningbt->where('dateplannification',$lundi->toDateString()) as $bt)
                                                BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}
                                            @endforeach
                                        </td>
                                        <td class=" ">
                                            @foreach($planningbt->where('dateplannification',$mardi->toDateString()) as $bt)
                                                BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}
                                            @endforeach
                                        </td>
                                        <td class=" ">
                                            @foreach($planningbt->where('dateplannification',$mercredi->toDateString()) as $bt)
                                                BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}
                                            @endforeach
                                        </td>
                                        <td class=" ">
                                            @foreach($planningbt->where('dateplannification',$jeudi->toDateString()) as $bt)
                                                BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}
                                            @endforeach
                                        </td>
                                        <td class=" ">
                                            @foreach($planningbt->where('dateplannification',$vendredi->toDateString()) as $bt)
                                                BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}
                                            @endforeach
                                        </td>
                                        <td class=" ">
                                            @foreach($planningbt->where('dateplannification',$samedi->toDateString()) as $bt)
                                                BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}
                                            @endforeach
                                        </td>
                                    </tr>
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
                            <td>@{{bt.numerobon}}</td>
                            <td>@{{bt.dateexecution}}</td>
                            <td>@{{bt.details}}</td>
                            <td align="center">
                                <a href="#" title="Plannifier le bon de travail" ng-click="plannifier(bt)" data-toggle="modal" data-target=".bs-example-modal-lg">
                                    <i class="fa fa-calendar-o"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade bs-example-modal-lg row" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="" style="margin: 7% 10%;">
                <div macure-planning>

                </div>
            </div>
        </div>

    </section>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function BonTravaux(id,numero,dateexecution,dateplannification,urgence_id,details,id_equipe,equipe_name){
            this.id = id;
            this.numerobon = numero;
            this.dateexecution = dateexecution;
            this.dateplannification = dateplannification;
            this.urgence_id = urgence_id;
            this.details = details;
            this.equipe = {
                id: id_equipe,
                nom: equipe_name
            }
        }

        var DateFromPHP = '{{$date}}';
        var BTofWeekUrl = '{{route('planning_bt_json',['annee'=>'_y_', 'mois' => '_m_', 'jour' => '_d_'])}}';
        var dd = new Date();
        var TemplatePlanninng = '{{route('template_angular')}}/'+dd.getDate()+'/'+(dd.getMonth()+1)+'/'+dd.getFullYear();

        //MAJ du prototypage des dates
        Date.prototype.toString = function(){
            return (this.getDay() < 10 ? '0'+this.getDay() : this.getDay())
                    +'/'+(this.getMonth()< 10 ? '0'+this.getMonth() : this.getMonth())
                    +'/'+this.getFullYear();
        };
        
        function WeekPlan() {
            //type Day
            this.dimanche = null;   this.lundi = null;  this.mardi = null;
            this.mercredi = null;   this.jeudi = null;  this.vendredi = null;
            this.samedi = null;
        }

        function Day(date, plan) {
            this.date = date;
            this.plan = plan;
        }
        
        function PlanDay(BT) {
            this.AM = null;
            this.PM = null;

            //BT est de type BonTravaux
            //10:45 = 10h*100 = 1000 + 45" = 1045 < 1200 (qui est 12h00) donc dans l'après midi
            //if((BT.dateplannification.getHours()*100)+BT.dateplannification.getMinutes() == 45)
            if(this.AM == null)
            {this.AM = BT;}
            else
            {this.PM = BT;}

            this.setBT = function (BT) {
                //10:45 = 10h*100 = 1000 + 45" = 1045 < 1200 (qui est 12h00) donc dans l'après midi
                if(this.AM == null){
                    this.AM = BT;
                } else if(this.PM == null) { //C'est dans l'après-midi
                    this.PM = BT;
                }else {
                    alert('Ce jour à déjà deux BT plannifiés ! Veuillez choisir un autre jour SVP');
                }
            }
        }

        //Tableau des BT de la semaine
        var BTofWeek = [
        @foreach($bonDeLaSemaine as $bt)
            new BonTravaux({{$bt->id}},
                {{$bt->numerobon}},
                {{\Carbon\Carbon::parse($bt->dateexecution)->format('d/m/Y')}},
                {{\Carbon\Carbon::parse($bt->dateplannification)->format('d/m/Y')}},
                {{$bt->urgence_id}},
                '{{$bt->descriptionpanne}}',
                '{{$bt->equipe ? $bt->equipe->id : null}}',
                '{{$bt->equipe ? $bt->equipe->nom : null}}'
            ),
        @endforeach
        ];

    </script>
    <script type="text/javascript" src="{{request()->getBaseUrl()}}/../node_modules/angular/angular.min.js"></script>
    <script type="text/javascript" src="{{request()->getBaseUrl()}}/js/angular.bt.planning.js"></script>
@endsection