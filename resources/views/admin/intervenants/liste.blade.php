@extends('layouts.main')

@section('content')
    <div class="x_content">
        <h4>Liste des intervenants</h4>
        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>Niveau</th>
                <th>Equipe</th>
                <th width="15%">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($intervenants as $intervenant)
                <tr>
                    <td>{{$intervenant->nom}}</td>
                    <td>{{$intervenant->prenoms}}</td>
                    <td>{{$intervenant->niveau}}</td>
                    <td>{{$intervenant->equipe->nom}}</td>
                    <td>
                        <a href="{{route('modif_intervenant',['id'=>$intervenant->id])}}"> <i class="fa fa-edit"> </i>Modifier</a>
                        <a href="#"> <i class="fa fa-trash"> </i>Supprimer</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

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