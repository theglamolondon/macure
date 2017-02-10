@include('pdf._style')
<style type="text/css" rel="stylesheet">
    th{
        width: 130px;
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
<h3 class="titre">Planning des Bon travaux du {{$dimanche->format('d/m/Y')}} au {{$samedi->format('d/m/Y')}} </h3>
<div class="table-responsive">
    <table class="table table-bordered  bulk_action">
        <thead>
        <tr class="headings">
            <th class="alignment-center column-title"><strong>Dimanche</strong><p>{{$dimanche->format('d/m/Y')}}</p></th>
            <th class="alignment-center column-title"><strong>Lundi</strong><p>{{$lundi->format('d/m/Y')}}</p></th>
            <th class="alignment-center column-title"><strong>Mardi</strong><p>{{$mardi->format('d/m/Y')}}</p></th>
            <th class="alignment-center column-title"><strong>Mercredi</strong><p>{{$mercredi->format('d/m/Y')}}</p></th>
            <th class="alignment-center column-title"><strong>Jeudi</strong><p>{{$jeudi->format('d/m/Y')}}</p></th>
            <th class="alignment-center column-title"><strong>Vendredi</strong><p>{{$vendredi->format('d/m/Y')}}</p></th>
            <th class="alignment-center column-title"><strong>Samedi</strong><p>{{$samedi->format('d/m/Y')}}</p></th>
        </tr>
        </thead>
        @if(!$planningbt->isEmpty())
            <tbody>
            <tr class="odd pointer">
                <td class=" ">
                    @foreach($planningbt->where('dateplannification',$dimanche->toDateString()) as $bt)
                        <p>BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}</p>
                    @endforeach
                </td>
                <td class=" ">
                    @foreach($planningbt->where('dateplannification',$lundi->toDateString()) as $bt)
                        <p>BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}</p>
                    @endforeach
                </td>
                <td class=" ">
                    @foreach($planningbt->where('dateplannification',$mardi->toDateString()) as $bt)
                        <p>BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}</p>
                    @endforeach
                </td>
                <td class=" ">
                    @foreach($planningbt->where('dateplannification',$mercredi->toDateString()) as $bt)
                        <p>BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}</p>
                    @endforeach
                </td>
                <td class=" ">
                    @foreach($planningbt->where('dateplannification',$jeudi->toDateString()) as $bt)
                        <p>BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}</p>
                    @endforeach
                </td>
                <td class=" ">
                    @foreach($planningbt->where('dateplannification',$vendredi->toDateString()) as $bt)
                        <p>BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}</p>
                    @endforeach
                </td>
                <td class=" ">
                    @foreach($planningbt->where('dateplannification',$samedi->toDateString()) as $bt)
                        <p>BT : {{$bt->numerobon}} <br/> Equipe : {{$bt->equipe->nom}}</p>
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