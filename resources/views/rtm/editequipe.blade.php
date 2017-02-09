@extends('layouts.main')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{route("modifier_equipe",["id" => $equipe->id])}}">
        {{ csrf_field() }}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Nouvelle équipe</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group">
                        <label for="nom" class="control-label col-md-2 col-sm-2 col-xs-12">Nom de l'équipe </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input name="nom" disabled class="form-control" type="text" value="{{$equipe->nom}}"/>
                        </div>
                        <label for="chefequipe" class="control-label col-md-2 col-sm-2 col-xs-12"> Chef d'équipe </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input name="chefequipe" disabled class="form-control" type="text" value="{{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="chargemaintenance" class="control-label col-md-2 col-sm-2 col-xs-12"> Chargé de maintenance </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input name="chargemaintenance" disabled class="form-control" type="text" value="{{$equipe->chargeMaintenance->nom}} {{$equipe->chargeMaintenance->prenoms}}"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Membres</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <select class="select2_multiple form-control" multiple name="intervenants[]">
                            @if(old('intervenants'))
                                @foreach($intervenants as $intervenant)
                                    <option value="{{$intervenant->id}}" @if(array_search($intervenant->id,old('intervenants')) !== false) selected @endif>
                                        {{$intervenant->nom}} {{$intervenant->prenoms}}
                                    </option>
                                @endforeach
                            @else
                                @foreach ($intervenants as $intervenant)
                                    <option value="{{$intervenant->id}}" @if($intervenant->equipetravaux_id == $equipe->id) selected @endif>
                                        {{$intervenant->nom}} {{$intervenant->prenoms}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                        <button type="reset" class="btn btn-primary">Annuler</button>
                        <button type="submit" class="btn btn-success">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection