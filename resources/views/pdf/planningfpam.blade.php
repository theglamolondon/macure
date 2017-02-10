@include('pdf._style')
<style type="text/css" rel="stylesheet">
    th{
        width: 112px;
    }
    .titre{
        text-align: center;
        font-size: 1.4em;
        border: 1px solid #2a88bd;
        padding: 3px 7px;
    }
</style>

<div>
    <img src="images/logo-djera.jpg" alt="Djera-Services-logo" style="position: center ; height: 100px"/>
</div>

<h3 class="titre">Planning des Actions de Maintenance Curative du {{$dimanche->format('d/m/Y')}} au {{$samedi->format('d/m/Y')}} </h3>
<table class="table table-bordered  bulk_action">
    <thead>
    <tr class="headings">
        <th ><strong>Maintenance <br/> Curative</strong> </th>
        <th ><strong>Dimanche</strong><p>{{$dimanche->format('d/m/Y')}}</p></th>
        <th ><strong>Lundi</strong><p>{{$lundi->format('d/m/Y')}}</p></th>
        <th ><strong>Mardi</strong><p>{{$mardi->format('d/m/Y')}}</p></th>
        <th ><strong>Mercredi</strong><p>{{$mercredi->format('d/m/Y')}}</p></th>
        <th ><strong>Jeudi</strong><p>{{$jeudi->format('d/m/Y')}}</p></th>
        <th ><strong>Vendredi</strong><p>{{$vendredi->format('d/m/Y')}}</p></th>
        <th ><strong>Samedi</strong><p>{{$samedi->format('d/m/Y')}}</p></th>
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
                                <p>
                                    <span class="fa fa-map-marker"></span>
                                    <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">{{$plan->actionmaintenance->localisation}}</a>
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
                                <p>
                                    <span class="fa fa-map-marker"></span>
                                    <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">{{$plan->actionmaintenance->localisation}}</a>
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
                                <p>
                                    <span class="fa fa-map-marker"></span>
                                    <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">{{$plan->actionmaintenance->localisation}}</a>
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
                                <p>
                                    <span class="fa fa-map-marker"></span>
                                    <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">{{$plan->actionmaintenance->localisation}}</a>
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
                                <p>
                                    <span class="fa fa-map-marker"></span>
                                    <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">{{$plan->actionmaintenance->localisation}}</a>
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
                                <p>
                                    <span class="fa fa-map-marker"></span>
                                    <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">{{$plan->actionmaintenance->localisation}}</a>
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
                                <p>
                                    <span class="fa fa-map-marker"></span>
                                    <a href="{{route("pointopoint",["bt"=>$plan->actionmaintenance->bonTravaux->numerobon])}}">{{$plan->actionmaintenance->localisation}}</a>
                                </p>
                            </div>
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
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