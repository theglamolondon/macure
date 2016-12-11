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
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <!-- Dynamisé par Javascript -->
                                    </tbody>
                                </table>
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
                                        <option value="{{$equipe->id}}" @if(old('equipe_id')) selected @endif>{{$equipe->nom}} | {{$equipe->chargeEquipe->nom}} {{$equipe->chargeEquipe->prenoms}}</option>
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
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>

    <script>
        $(document).ready(function() {
            var regex = new RegExp("(_number_)","g");

            $('#datatable-responsive').DataTable({
                processing : true,
                serverSide : true,
                aLengthMenu : [20,50,100],
                ajax : {
                    url : "{{route('liste_fpam_json')}}",
                    type : "get",
                    error : function () {
                        alert('Aucune données sur le serveur')
                    },
                    pages : 5,
                    dataSrc : function (json) {
                        var link_ = null;
                        for(var i=0; i<json.data.length; i++)
                        {
                            link_ = '<a href="{{route("modifier_bt" ,["initiateur" => "_number_"])}}">Voir <span class="fa fa-eye"> </span></a> | '
                                    +'<a href="{{route("pointopoint" ,["initiateur" => "_number_"])}}">Carte <span class="fa fa-map-marker"> </span></a> |'
                                    +'<a href="#" data-toggle="modal" onclick="fpam(this)" data-donnee="'+json.data[i].id+'" data-target=".bs-example-modal-lg">Planning <span class="fa fa-calendar"></span></a>';
                            json.data[i].lien_ = link_.replace(regex,json.data[i].numerofpam);
                        }
                        return json.data;
                    }
                },
                columns : [
                    {"data" : "numerofpam"},
                    {"data" : "bontravaux.numerobon"},
                    {"data" : "typeoperation.libelle"},
                    {"data" : "titreoperation.libelle"},
                    {"data" : "bontravaux.nomabonne"},
                    {"data" : "localisation"},
                    {"data" : "lien_"},
                ],
                language : {
                    decimal : " ",
                    emptyTable : "Aucune données disponible à afficher",
                    info : "Affichage de _START_ à _END_ de _TOTAL_ lignes",
                    infoEmpty : "0 ligne de 0",
                    infoFiltered : " (filtre de _MAX_ lignes au total)",
                    infoPostFix : "",
                    thousands : "",
                    lengthMenu : "",
                    loadingRecords : "Chargement encours ...",
                    processing : "traitement encours ...",
                    search : " Recherche :",
                    zeroRecords : "Aucun enregistrement trouvé",
                    paginate : {
                        first : "Premier",
                        last : "Dernier",
                        next : "Suivant",
                        previous : "Précédent",
                    },
                    aria : {
                        sortAscending : "Tri ascendant activé",
                        sortDescending : "Tri déscédent activé",
                    }
                },
            });


        });

        //récupération du numéro du FPAM
        function fpam(noeud)
        {
            var td = $(noeud).parent().siblings()[0];
            $("#fpam").html($(td).text());
            $("#actionmaintenance_id").val($(noeud).data("donnee"));

        }
    </script>
@endsection