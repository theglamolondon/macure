@extends('layouts.main')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h3> Liste des équipes d'intervention </h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Nom de l'équipe</th>
                    <th>Chargé de maintenance</th>
                    <th>Chef d'équipe</th>
                    <th width="10%">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($equipes as $equipe)
                <tr>
                    <td>{{$equipe->nom}}</td>
                    <td>{{$equipe->chargeMaintenance->nom}} {{$equipe->chargeMaintenance->prenoms}}</td>
                    <td>{{$equipe->chefEquipe->nom}} {{$equipe->chefEquipe->prenoms}}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Voir </a>
                        <a href="{{route('modifier_equipe',["id" => $equipe->id])}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Modifier </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection