@extends('layouts.main')

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Liste des bons de travaux <small>(BT)</small></h2>
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
                                    <th>N° Bon</th>
                                    <th width="7%">Urgence</th>
                                    <th>Nom Abonné</th>
                                    <th>Panne signalée</th>
                                    <th>Date et heure</th>
                                    <th>Etat du bon</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($bons as $bt)
                                     <tr>
                                         <td>{{ $bt->numerobon }}</td>
                                         <td>{{ $bt->urgence->libelle }}</td>
                                         <td>{{ $bt->nomabonne }}</td>
                                         <td>{{ $bt->descriptionpanne }}</td>
                                         <td>{{ (new \Carbon\Carbon($bt->dateheurepanne))->format('d/m/Y H:i') }}</td>
                                         <td>{{ $bt->etatbon->libelle }}</td>
                                         <td>
                                             <a href="{{route("modifier_bt" ,["initiateur" => $bt->numerobon])}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Modifier </a>
                                             <a href="{{route("nouveau_fpam",["initiateur" => $bt->numerobon])}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> FPAM </a>
                                             <a onclick="return confirmDelete();" href="{{route("supprimer_bt" ,["bt" => $bt->numerobon])}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Supprimer </a>
                                             <a href="{{route("nouveau_bt",["reference" => $bt->numerobon])}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Bon Voisin </a>
                                         </td>
                                     </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$bons->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function confirmDelete() {
            return confirm('Voulez-vous vraiment supprimer ce bon de travaux ? Attention, cette action est irreversible');
        }
    </script>
@endsection