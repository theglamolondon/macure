@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Liste des fiches de préparation d'actionde maintenance<small>(FPAM)</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>N° FPAM</th>
                                        <th>N° BT</th>
                                        <th>Type opération</th>
                                        <th>Titre opération</th>
                                        <th>Nom abonne</th>
                                        <th>Localisation</th>
                                        <th width="18%">Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($data as $fpam)
                                        <tr>
                                            <td>{{$fpam->numerofpam}}</td>
                                            <td>{{$fpam->bonTravaux->numerobon}}</td>
                                            <td>{{$fpam->typeOperation->libelle}}</td>
                                            <td>{{$fpam->titreOperation->libelle}}</td>
                                            <td>{{$fpam->nomabonne}}</td>
                                            <td>{{$fpam->localisation}}</td>
                                            <td>
                                                <a href="{{route("modifier_fpam" ,["initiateur" => $fpam->numerofpam])}}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Voir </a>
                                                <a href="{{route("pointopoint" ,["initiateur" => $fpam->numerofpam])}}" class="btn btn-primary btn-xs"><i class="fa fa-map-marker"></i> Carte </a>
                                                <a href="#" data-toggle="modal" onclick="fpam(this)" data-donnee="{{$fpam->id}}" data-target=".bs-example-modal-lg" class="btn btn-info btn-xs"><i class="fa fa-calendar-o"></i> Plannifier </a>
                                                <a onclick="return confirmDelete();" href="{{route("supprimer_fpam" ,["initiateur" => $fpam->numerofpam])}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Supprimer </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$data->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{route('save_planning')}}" method="post" class="form-label-left form-horizontal">
                <div class="modal-content">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h3 class="modal-title">Plannification | FPAM <span id="fpam"></span></h3>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Date dépannage</label>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" class="form-control datepicker" name="datedepannage" value="{{old('datedepannage')}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Equipe <span class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" name="actionmaintenance_id" id="actionmaintenance_id">
                                <select class="form-control select2_single" name="equipe_id">
                                    @foreach($equipes as $equipe)
                                        <option value="{{$equipe->id}}" @if(old('equipe_id')) selected @endif>{{$equipe->nom}} | {{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        function confirmDelete() {
            return confirm('Voulez-vous vraiment supprimer cette FPAM ? Attention, cette action est irreversible.');
        }

        //récupération du numéro du FPAM
        function fpam(noeud)
        {
            var td = $(noeud).parent().siblings()[0];
            $("#fpam").html($(td).text());
            $("#actionmaintenance_id").val($(noeud).data("donnee"));

        }
    </script>
@endsection