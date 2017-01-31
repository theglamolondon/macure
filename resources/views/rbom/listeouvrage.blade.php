@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Liste des ouvrages</h2>
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
                                        <th rowspan="2" class="center">N° Ordre</th>
                                        <th rowspan="2">Nom de l'ouvrage</th>
                                        <th colspan="2">Etude</th>
                                        <th colspan="2">Exécution</th>
                                        <th rowspan="2">Direction</th>
                                        <th rowspan="2">Type d'ouvrage</th>
                                        <th rowspan="2" width="12%">Actions</th>
                                    </tr>
                                    <tr>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ouvrages as $ouvrage)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$ouvrage->libelle}}</td>
                                        <td>{{(new \Carbon\Carbon($ouvrage->datedebutetude))->format('d/m/Y')}}</td>
                                        <td>{{(new \Carbon\Carbon($ouvrage->datefinetude))->format('d/m/Y')}}</td>
                                        <td>{{(new \Carbon\Carbon($ouvrage->datedebutexecution))->format('d/m/Y')}}</td>
                                        <td>{{(new \Carbon\Carbon($ouvrage->datefinexecution))->format('d/m/Y')}}</td>
                                        <td>{{$ouvrage->typeOuvrage->libelle}}</td>
                                        <td>{{$ouvrage->direction->libelle}}</td>
                                        <td>
                                            <a href="{{route("modifier_ouvrage" ,["id" => $ouvrage->id])}}"> Modifier <span class="fa fa-edit"> </span></a> |
                                            <a onclick="return confirmDelete();" href="#"> Supprimer <span class="fa fa-trash"> </span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$ouvrages->links()}}
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
            return confirm('Voulez-vous vraiment supprimer cet ouvrage ? Attention, cette action est irreversible.');
        }
    </script>
@endsection