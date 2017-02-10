@extends('layouts.main')

@section('content')
    <div ng-app="app">
    <section ng-controller="planningCtrl" id="sectionMain">
        <div class="col-md-12 col-sm-12 col-xs-12">
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
                        <div class="bottom">
                            <a href="{{route('pdf_planning_bt')}}/{{$date}}" class="btn btn-info">
                                <i class="fa fa-file-pdf-o"> </i> Télécharger le PDF
                            </a>
                            @include('partials._comment',['user' => \Illuminate\Support\Facades\Auth::user()])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection

@section("scripts")
    <script>
        $("#go").click(function () {
            var URL = '{{route("plan_bt_directeur")}}';
            document.location = URL + "/" + $("#calendrier").val();
        });
    </script>
@endsection