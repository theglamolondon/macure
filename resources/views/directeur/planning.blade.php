@extends('layouts.main')
<style>
    .alignment-center{
        text-align: center;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 class="col-md-8 col-sm-8 col-xs-12">Planning hebdomadaire des Actions de Maintenance Curative <small>Semaine du {{$lundi->format('d/m/Y')}} au {{$vendredi->format('d/m/Y')}}</small></h2>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Date du planning</label>
                    <div class="input-group">
                        <input id="calendrier" type="text" class="form-control datepicker" value="{{$date}}"/>
                        <span class="input-group-btn">
                            <button type="button" id="go" class="form-control btn btn-primary">Go!</button>
                        </span>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-bordered  bulk_action">
                            <thead>
                            <tr class="headings">
                                <th width="12.5%" class="alignment-center column-title"><h4>Maintenance </h4> <p>Curative</p> </th>
                                <th width="12.5%" class="alignment-center column-title"><h4>Dimanche</h4><p>{{$dimanche->format('d/m/Y')}}</p></th>
                                <th width="12.5%" class="alignment-center column-title"><h4>Lundi</h4><p>{{$lundi->format('d/m/Y')}}</p></th>
                                <th width="12.5%" class="alignment-center column-title"><h4>Mardi</h4><p>{{$mardi->format('d/m/Y')}}</p></th>
                                <th width="12.5%" class="alignment-center column-title"><h4>Mercredi</h4><p>{{$mercredi->format('d/m/Y')}}</p></th>
                                <th width="12.5%" class="alignment-center column-title"><h4>Jeudi</h4><p>{{$jeudi->format('d/m/Y')}}</p></th>
                                <th width="12.5%" class="alignment-center column-title"><h4>Vendredi</h4><p>{{$vendredi->format('d/m/Y')}}</p></th>
                                <th width="12.5%" class="alignment-center column-title"><h4>Samedi</h4><p>{{$samedi->format('d/m/Y')}}</p></th>
                            </tr>
                            </thead>
                            @if(!$planning->isEmpty())
                            <tbody>
                            @foreach($equipes as $equipe)
                                <tr class="odd pointer">
                                    @if($loop->index%2 ==0 )
                                        <td class="alignment-center" valign="middle" rowspan="2">
                                            <br><br><br>
                                            Chargé des équipes : <br/> <strong>{{$equipe->chargeMaintenance->nom}} {{$equipe->chargeMaintenance->prenoms}}</strong>
                                        </td>
                                    @endif
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$dimanche->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            @if($plan->actionmaintenance)
                                                <div class="tile-stats">
                                                    <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                    <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                    <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                    <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                            {{$plan->actionmaintenance->localisation}}</a>
                                                    </p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$lundi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            @if($plan->actionmaintenance)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$mardi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            @if($plan->actionmaintenance)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$mercredi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            @if($plan->actionmaintenance)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$jeudi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            @if($plan->actionmaintenance)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$vendredi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            @if($plan->actionmaintenance)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$samedi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            @if($plan->actionmaintenance)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            @else
                                <tr>
                                    <td colspan="8">
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
                            <a href="{{route('pdf_planning_fpam')}}/{{$date}}" class="btn btn-info">
                                <i class="fa fa-file-pdf-o"> </i> Télécharger le PDF
                            </a>
                            @include('partials._comment',['user' => \Illuminate\Support\Facades\Auth::user()])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        $("#go").click(function () {
            var URL = '{{route("plan_fpam_directeur")}}';
            document.location = URL + "/" + $("#calendrier").val();
        });

    </script>
@endsection