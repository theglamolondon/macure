@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{$typegamme->libelle}}</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form name="checlistgamme" class="form-horizontal" action="{{route('save_checklist')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="gamme_id" value="{{$IDgamme}}">
                <table id="datatable-checkbox" class="table table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Libellé</th>
                        <th>Réalisation</th>
                        <th>Résultat</th>
                        <th>Observation ou action à mener</th>
                    </tr>
                    </thead>
                    @if($checklists)
                    <tbody>
                    @foreach($checklists as $check)
                    <tr>
                        <td><h4>{{$loop->index+1}}</h4></td>
                        <td><h4>{{$check->libelle}}</h4></td>
                        <td class="form-group">
                            <select class="select2_single form-control" name="realisation[]" tabindex="-1">
                                <option value="1">Exécuté</option>
                                <option value="0">Non exécuté</option>
                            </select>
                        </td>
                        <td class="form-group">
                            <select class="select2_single form-control" name="resultat[]" tabindex="-1">
                                <option value="1">Bon</option>
                                <option value="0">Mauvais</option>
                            </select>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="hidden" name="checklist_id[]" value="{{$check->id}}">
                                <textarea class="form-control" name="observation[]" placeholder="Observations" rows="1"></textarea>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    @endif

                </table>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                            <button type="reset" class="btn btn-primary">Annuler</button>
                            <button type="submit" class="btn btn-success">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection