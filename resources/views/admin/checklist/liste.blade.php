@extends('layouts.main')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <div class="col-md-5 col-sm-5 col-xs-12"><h4>Liste des check-lists</h4></div>
            <div class="col-md-5 col-md-offset-2 col-sm-5 col-sm-offset-2 col-xs-12">
                <select class="select2_single form-control" id="typegamme_id" name="typegamme_id" tabindex="-1">
                    <option value="-1">Veuillez sélectionner la Gamme</option>
                    @foreach($typegammes as $typegamme)
                        <option value="{{$typegamme->id}}" @if(old('typegamme_id') == $typegamme->id) selected @endif>{{$typegamme->libelle}}</option>
                    @endforeach
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="10%">Numéro</th>
                    <th>Libelle</th>
                    <th width="15%">Actions</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var URL = "{{route('json_checklist',['id'=>'_id_'])}}";
        var reg = new RegExp("(_id_)","g");
        var regNum = new RegExp("(_numero_)","g");
        var regLibelle = new RegExp("(_libelle_)","g");
        var regAction = new RegExp("(_action_)","g");
        var template = '<tr><td>_numero_</td><td>_libelle_</td><td>'
                        + '<a href="{{route("modif_ckecklist",['id'=>'_action_'])}}"> <i class="fa fa-edit"> </i>Modifier</a>'
                        +'<a href="#"> <i class="fa fa-trash"> </i>Supprimer</a></td></tr>';

        $(document).ready(function(){
            $("#typegamme_id").change(function(){
                $.getJSON(URL.replace(reg,$("#typegamme_id").val()),function (data) {
                    var HTML = '';
                    for(var d in data){
                        //console.log(data[d]);
                        HTML += template.replace(regNum,(parseInt(d)+1)).replace(regLibelle,data[d].libelle).replace(regAction,data[d].id);
                    }
                    $('#datatable tbody tr').remove();
                    $('#datatable tbody').append(HTML);
                });
            });
        });

        function deleteCkeclistElement(arg) {

        }
    </script>
@endsection