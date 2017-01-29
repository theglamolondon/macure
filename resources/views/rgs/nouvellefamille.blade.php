@extends('layouts.main')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="">
        {{ csrf_field() }}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
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
                                <input type="text" name="libelle"  placeholder="Entrer la famille de produit" required="required" class="form-control col-md-7 col-xs-12" value="{{old('libelle')}}" />
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
            </form>
        </div>
    </form>
@endsection

@section('scripts')

@endsection