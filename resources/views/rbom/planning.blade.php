@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Table design <small>Custom design</small></h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-bordered  bulk_action">
                            <thead>
                            <tr class="headings">
                                <th valign="center" align="center" width="13%" class="column-title">Maintenance <br/> Curative </th>
                                <th width="17%" class="column-title"><h4>Lundi</h4><p>{{$lundi->format('d/m/Y')}}</p></th>
                                <th width="17%" class="column-title"><h4>Mardi</h4><p>{{$mardi->format('d/m/Y')}}</p></th>
                                <th width="17%" class="column-title"><h4>Mercredi</h4><p>{{$mercredi->format('d/m/Y')}}</p></th>
                                <th width="17%" class="column-title"><h4>Jeudi</h4><p>{{$jeudi->format('d/m/Y')}}</p></th>
                                <th width="17%" class="column-title"><h4>Vendredi</h4><p>{{$vendredi->format('d/m/Y')}}</p></th>
                            </tr>
                            </thead>
                            @if(!$planning->isEmpty())
                            <tbody>
                            @foreach($equipes as $equipe)
                                <tr class="odd pointer">
                                    @if($loop->index%2 ==0 )<td rowspan="2"><div><p>Chargé des équipes : </p> <strong>{{$equipe->chargeMaintenance->nom}} {{$equipe->chargeMaintenance->prenoms}}</strong></div></td>@endif
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$lundi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$mardi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$mercredi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$jeudi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class=" ">
                                        @foreach($planning->where("datedepannage",$vendredi->toDateString())->where("equipe_id",$equipe->id) as $plan)
                                            <div class="tile-stats">
                                                <p><span class="fa fa-users"></span> {{$plan->equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</p>
                                                <p><span class="fa fa-wrench"></span> {{$plan->actionmaintenance->naturetravaux}}</p>
                                                <p><span class="fa fa-user"></span> {{$plan->actionmaintenance->bonTravaux->nomabonne}}</p>
                                                <p><span class="fa fa-map-marker"></span> <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">
                                                    {{$plan->actionmaintenance->localisation}}</a>
                                                </p>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            @else
                                <tr>
                                    <td colspan="6">
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
    </div>
@endsection