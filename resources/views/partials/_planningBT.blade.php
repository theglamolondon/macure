<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Programation</h4>
        <div class="form-group">
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="bt" ng-model="btSelected.numerobon" class="form-control" disabled/>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input id="btDay" type="text" class="form-control datepicker" value="{{$date}}" ng-model="btDay"/>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="form-control" name="equipetravaux_id" id="equipetravaux_id">
                    @foreach($equipes as $equipe)
                        <option value="{{$equipe->id}}" @if(old('equipetravaux_id') == $equipe->id) selected @endif>{{$equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <button type="button" class="btn btn-primary" id="btnAddBT" ng-click="programBT(btSelected);">Programmer</button>
            </div>
        </div>
    </div>

    <div class="modal-body">
        <h3>Planning de la semaine du @{{ btDay }}</h3>
        <table class="table table-bordered  bulk_action">
            <thead>
            <tr class="headings">
                <th width="14.28%" class="alignment-center column-title"><h4>Dimanche</h4><p>@{{planning.dimanche.date}}</p></th>
                <th width="14.28%" class="alignment-center column-title"><h4>Lundi</h4><p>@{{planning.lundi.date}}</p></th>
                <th width="14.28%" class="alignment-center column-title"><h4>Mardi</h4><p>@{{planning.mardi.date}}</p></th>
                <th width="14.28%" class="alignment-center column-title"><h4>Mercredi</h4><p>@{{planning.mercredi.date}}</p></th>
                <th width="14.28%" class="alignment-center column-title"><h4>Jeudi</h4><p>@{{planning.jeudi.date}}</p></th>
                <th width="14.28%" class="alignment-center column-title"><h4>Vendredi</h4><p>@{{planning.vendredi.date}}</p></th>
                <th width="14.28%" class="alignment-center column-title"><h4>Samedi</h4><p>@{{planning.samedi.date}}</p></th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>BT : @{{ planning.dimanche.plan ? planning.dimanche.plan.AM.numerobon : '' }} <br/> Equipe : @{{ planning.dimanche.plan ? planning.dimanche.plan.AM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.lundi.plan ? planning.lundi.plan.AM.numerobon : '' }} <br/> Equipe : @{{ planning.lundi.plan ? planning.lundi.plan.AM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.mardi.plan ? planning.mardi.plan.AM.numerobonbon : '' }} <br/> Equipe : @{{ planning.mardi.plan ? planning.mardi.plan.AM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.mercredi.plan ? planning.mercredi.plan.AM.numerobon : '' }} <br/> Equipe : @{{ planning.mercredi.plan ? planning.mercredi.plan.AM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.jeudi.plan ? planning.jeudi.plan.AM.numerobon : '' }} <br/> Equipe : @{{ planning.jeudi.plan ? planning.jeudi.plan.AM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.vendredi.plan ? planning.vendredi.plan.AM.numerobon : '' }} <br/> Equipe : @{{ planning.vendredi.plan ? planning.vendredi.plan.AM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.samedi.plan ? planning.samedi.plan.AM.numerobon : '' }} <br/> Equipe : @{{ planning.samedi.plan ? planning.samedi.plan.AM.equipe.nom : '' }}</td>
            </tr>

            <tr>
                <td>BT : @{{ planning.dimanche.plan ? planning.dimanche.plan.PM.numerobon : '' }} <br/> Equipe : @{{ planning.dimanche.plan ? planning.dimanche.plan.PM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.lundi.plan ? planning.lundi.plan.PM.numerobon : '' }} <br/> Equipe : @{{ planning.lundi.plan ? planning.lundi.plan.PM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.mardi.plan ? planning.mardi.plan.PM.numerobon : '' }} <br/> Equipe : @{{ planning.mardi.plan ? planning.mardi.plan.PM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.mercredi.plan ? planning.mercredi.plan.PM.numerobon : '' }} <br/> Equipe : @{{ planning.mercredi.plan ? planning.mercredi.plan.PM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.jeudi.plan ? planning.jeudi.plan.PM.numerobon : '' }} <br/> Equipe : @{{ planning.jeudi.plan ? planning.jeudi.plan.PM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.vendredi.plan ? planning.vendredi.plan.PM.numerobon : '' }} <br/> Equipe : @{{ planning.vendredi.plan ? planning.vendredi.plan.PM.equipe.nom : '' }}</td>
                <td>BT : @{{ planning.samedi.plan ? planning.samedi.plan.PM.numerobon : '' }} <br/> Equipe : @{{ planning.samedi.plan ? planning.samedi.plan.PM.equipe.nom : '' }}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary">Valider</button>
    </div>
</div>