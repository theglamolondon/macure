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
                            <a href="{{route('modifier_famille',['id'=>$famille->id])}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Modifier </a>
                            <a onclick="return confirmDelete()" href="{{route("supprimer_famille",["id"=>$famille->id])}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Supprimer </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function confirmDelete() {
            return confirm('Voulez-vous vraiment supprimer cette famille ? Attention, cette action est irreversible.');
        }
    </script>
@endsection