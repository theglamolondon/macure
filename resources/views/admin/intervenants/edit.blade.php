@extends('layouts.main')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h3>Nouveau intervenant</h3>
        </div>
        <div class="x_content">
        <form class="form-horizontal" role="form" method="POST" action="{{route('nouveau_intervenant')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="nom">Nom<span class="required"> *</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" name="nom" placeholder="Nom de l'intervenant" required="required" class="form-control"value="{{old('nom')}}" />
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="prenoms">Prénoms<span class="required"> *</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" name="prenoms" placeholder="Prénoms de l'intervenant" required="required" class="form-control"value="{{old('prenoms')}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="niveau">Niveau</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" name="niveau" placeholder="Niveau de l'intervenant" class="form-control"value="{{old('nom')}}" />
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="equipetravaux_id">Equipe<span class="required"> *</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <select class="select2_single form-control" name="equipetravaux_id" tabindex="-1">
                        @foreach($equipes as $equipe)
                            <option value="{{$equipe->id}}" @if($equipe->id == old('equipetravaux_id')) selected @endif>{{$equipe->nom}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <button type="reset" class="btn btn-success">Annuler</button>
                </div>
            </div>
        </form>
        </div>
    </div>
@endsection

@section('scripts')

@endsection