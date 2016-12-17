@extends('layouts.main')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h3>Modification du type de gamme</h3>
        </div>
        <div class="x_content">
            <form class="form-horizontal" role="form" method="POST" action="{{route('modif_typegamme',['id'=> $typegamme->id])}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="libelle">Titre<span class="required"> *</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" name="libelle" placeholder="Titre du type de la gamme" required="required" class="form-control"value="{{old('libelle')?old('libelle'):$typegamme->libelle}}" />
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="reference">Référence<span class="required"> *</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" name="reference" placeholder="Référence du type de la gamme" required="required" class="form-control"value="{{old('reference')?old('reference'):$typegamme->reference}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-offset-1 col-sm-offset-1 control-label col-md-1 col-sm-1 col-xs-6" for="indice">Indice</label>
                    <div class="col-md-1 col-sm-1 col-xs-6">
                        <input type="number" name="indice" placeholder="Indice" class="form-control"value="{{old('indice')?old('indice'):$typegamme->indice}}" />
                    </div>
                    <label class="col-md-offset-1 col-sm-offset-1 control-label col-md-1 col-sm-1 col-xs-6" for="niveau">Niveau</label>
                    <div class="col-md-1 col-sm-1 col-xs-6">
                        <input type="number" name="niveau" placeholder="Niveau" class="form-control"value="{{old('niveau')?old('niveau'):$typegamme->niveau}}" />
                    </div>
                    <label class="col-md-offset-1 col-sm-offset-1 control-label col-md-1 col-sm-1 col-xs-6" for="temps">Temps</label>
                    <div class="col-md-1 col-sm-1 col-xs-6 ">
                        <input type="number" name="temps" placeholder="Temps" class="form-control" value="{{old('temps')?old('temps'):$typegamme->temps}}" />
                    </div>
                    <label class="col-md-offset-1 col-sm-offset-1 control-label col-md-1 col-sm-1 col-xs-6" for="nbreagents">Nombre agent</label>
                    <div class="col-md-1 col-sm-1 col-xs-6">
                        <input type="number" name="nbreagents" placeholder="Nombre d'agents" class="form-control"value="{{old('nbreagents')?old('nbreagents'):$typegamme->nbreagents}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="periodicite">Périodicité</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" name="periodicite" placeholder="Périodicité de la gamme" class="form-control"value="{{old('periodicite')? old('periodicite'):$typegamme->periodicite}}" />
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="habilitation">Habilitation</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" name="habilitation" placeholder="Habilitation de la gamme" class="form-control"value="{{old('habilitation')? old('habilitation'):$typegamme->habilitation}}" />
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