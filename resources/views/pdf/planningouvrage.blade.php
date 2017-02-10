@include('pdf._style')
<style type="text/css" rel="stylesheet">
    th{
        width: 50px;
    }
    .titre{
        text-align: center;
        font-size: 1.4em;
        border: 1px solid #2a88bd;
        padding: 3px 7px;
    }
    td{
        font-size: 0.85em;
    }
</style>

<div>
    <img src="images/logo-djera.jpg" alt="Djera-Services-logo" style="position: center ; height: 100px"/>
</div>

<h3 class="titre">Planning Annuel des Ouvrages de {{$annee}} </h3>

<table class="table table-bordered ">
    <thead>
    <tr>
        <th style="width: 120px">Activité de maintenance</th>
        <th >{{$mois['M1']}}</th>
        <th >{{$mois['M2']}}</th>
        <th >{{$mois['M3']}}</th>
        <th >{{$mois['M4']}}</th>
        <th >{{$mois['M5']}}</th>
        <th >{{$mois['M6']}}</th>
        <th >{{$mois['M7']}}</th>
        <th >{{$mois['M8']}}</th>
        <th >{{$mois['M9']}}</th>
        <th >{{$mois['M10']}}</th>
        <th >{{$mois['M11']}}</th>
        <th >{{$mois['M12']}}</th>
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M2_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M2_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M3_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M3_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M4_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M4_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M5_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M5_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M6_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M6_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M7_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M7_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M8_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M8_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M9_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M9_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M10_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M10_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M11_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M11_'];
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
                    return
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datefinetude)->month >= $m['M12_'] &&
                        \Carbon\Carbon::createFromFormat('Y-m-d',$item->datedebutetude)->month <= $m['M12_'];
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
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M2_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M2_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M3_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M3_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M4_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M4_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M5_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M5_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M6_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M6_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M7_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M7_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M8_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M8_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M9_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M9_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M10_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M10_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M11_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M11_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
            <td>
                @if(\Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datefinexecution)->month >= $m['M12_'] &&
                    \Carbon\Carbon::createFromFormat('Y-m-d',$ouvrageExec->datedebutexecution)->month <= $m['M12_'])
                    <span class="label label-default" style="background-color: {{$ouvrageExec->direction->couleur}}">{{$ouvrageExec->libelle}}</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>