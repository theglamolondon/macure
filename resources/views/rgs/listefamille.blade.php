@extends('layouts.main')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h4>Liste des familles</h4>
        </div>
        <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Libellé</th>
                    <th width="15%">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($familles as $famille)
                    <tr>
                        <td>{{$famille->libelle}}</td>
                        <td>
                            <a href="{{route('modifier_famille',['id'=>$famille->id])}}"> <i class="fa fa-edit"> </i>Modifier</a>
                            <a  onclick="return confirmDelete()" href="{{route("supprimer_famille",["id"=>$famille->id])}}"> <i class="fa fa-trash"> </i>Supprimer</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script>

        function confirmDelete() {
            return confirm('Voulez-vous vraiment supprimer cette famille ? Attention, cette action est irreversible.');
        }
        $(document).ready(function () {
            $('#datatable').DataTable({
                processing: true,
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
    </script>
@endsection