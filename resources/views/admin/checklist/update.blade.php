@extends('layouts.main')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h4>Modification d'une ligne de check-list</h4>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form class="form-horizontal form-label-left" method="POST" action="{{route('modif_ckecklist',['id' => $check->id])}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-2">Gamme <span class="requi"> *</span></label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <select class="select2_single form-control col-md-7 col-xs-12" name="typegamme_id" tabindex="-1">
                            @foreach($typegammes as $typegamme)
                                <option value="{{$typegamme->id}}" @if((old('typegamme_id')?old('typegamme_id'):$check->typegamme_id) == $typegamme->id) selected @endif>{{$typegamme->libelle}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="control-label col-md-2 col-sm-2 col-xs-2">Libélle</label>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <input type="text" name="libelle" class="form-control" placeholder="Libellé de la check-list" value="{{old('libelle')?old('libelle'):$check->libelle}}">
                    </div>
                </div>

                <div class="ln_solid clearfix"></div>
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