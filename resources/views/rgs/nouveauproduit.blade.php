@extends('layouts.main')

@section('content')
    <form class="form-horizontal form-label-left" role="form" method="POST" action="{{route("nouveau_produit")}}">
        {{ csrf_field() }}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Nouveau Produit</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <div class="form-group">
                        <label for="famille" class="control-label col-md-3 col-sm-3 col-xs-12">Famille du Produit<span class="required"> *</span> </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="select2_single form-control col-md-7 col-xs-12" name="famille_id" tabindex="-1" >
                                @foreach($familles as $famille)
                                <option value="{{$famille->id}}" @if(old('famille_id') == $famille->id) selected @endif>{{$famille->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="reference">Référence du Produit<span class="required"> *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="reference"  placeholder="Entrer la référence du produit" required="required" class="form-control col-md-7 col-xs-12" value="{{old('reference')}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="libelle">Libéllé du produit<span class="required"> *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="libelle" placeholder="Entrer le libellé du produit" value="{{old('libelle')}}" required="required" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="quantite">Quantité<span class="required"> *</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="quantite" placeholder="entrer la quantité" required="required" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <button type="reset" class="btn btn-success">Annuler</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')

@endsection