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
                        <label for="famille" class="control-label col-md-2 col-sm-2 col-xs-12">Nom de l'équipe </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input name="nom" disabled class="form-control" type="text" value="{{$equipe->nom}}"/>
                        </div>
                        <label for="famille" class="control-label col-md-2 col-sm-2 col-xs-12"> Chef d'équipe <span class="required"> *</span> </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input name="chefequipe" disabled class="form-control" type="text" value="{{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection