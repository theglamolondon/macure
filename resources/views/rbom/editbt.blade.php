@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
        <form class="form-horizontal form-label-left input_mask" method="POST" action="{{route('nouveau_bt')}}">
        {{csrf_field()}}

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Ouvert par <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                <input type="text" class="form-control has-feedback-left" name="ouvertpar" placeholder="Personne ayant ouvert la fiche" required value="{{old('ouvertpar')}}"/>
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12">Urgence <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="form-control select2_single" name="urgence_id">
                    @foreach($urgences as $urgence)
                        <option value="{{$urgence->id}}" @if(old('urgence_id')== $urgence->id) selected @endif>{{$urgence->libelle}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <strong>Infos Abonné</strong>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nom abonné <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" placeholder="Nom et adresse" name="nomabonne" value="{{old('nomabonne')}}" required/>
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Référence abonné <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
                        <input type="text" class="form-control has-feedback-left" name="referenceabonne" placeholder="Référence abonné" value="{{old('referenceabonne')}}" required/>
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <strong>Détails panne</strong>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Date et heure panne</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                            <input type="text" name="dateheurepanne" class="form-control datepicker-time" value="{{old('dateheurepanne')}}" />
                        </div>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Date et heure dép.</label>
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                            <input type="text" class="form-control datepicker-time" name="dateheuredep" value="{{old('dateheuredep')}}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Panne signalée <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <textarea class="form-control" rows="5" required name="descriptionpanne" placeholder="description de la panne signalée">{{old('descriptionpanne')}}</textarea>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Observation Abonné <span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <textarea class="form-control" rows="5"  name="observationabonne" placeholder="Observation de l'abonné">{{old('observationabonne')}}</textarea>
                    </div>
                </div>
            </div>

            <div class="x_title">
                <strong>Chef dépanneur</strong>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nom chef dépanneur <span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input type="text" class="form-control has-feedback-left" name="chefdepanneur" placeholder="Nom chef dépanneur" value="{{old('chefdepanneur')}}"/>
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Le dépannage est <span class="required">*</span></label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="typedepannage" value="1" @if(old('typedepannage') === 1) checked @endif /> Définitif
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" name="typedepannage" value="2" @if(old('typedepannage') === 2) checked @endif/> Provisoire
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Des abonnés restent en panne</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="checkbox" class="js-switch" name="abonnepanne" @if(old('abonnepanne'))checked @endif/>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Abonné Absent</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="checkbox" class="js-switch" name="abonneabsent" @if(old('abonneabsent'))checked @endif/>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Abonné Non trouvé</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="checkbox" class="js-switch" name="abonnetrouve" @if(old('abonnetrouve'))checked @endif />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Observation dépanneur</label>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <textarea class="form-control" rows="5"  name="observationdepanneur" placeholder="Observation du dépanneur">{{old('observationdepanneur')}}</textarea>
                    </div>
                </div>
            </div>

            <div class="x_title">
                <strong>Travaux</strong>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Chargé de consigne</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input name="chargeconsigne" type="text" class="form-control" placeholder="Nom du chargé de consigne" value="{{old('chargeconsigne')}}"/>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Chargé de travaux</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input name="chargetravaux" type="text" class="form-control" placeholder="Nom du chargé de travaux" value="{{old('chargetravaux')}}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Imputation</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input name="imputation" type="text" class="form-control" placeholder="Imputation" maxlength="14" value="{{old('imputation')}}"/>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Responsable BT</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input name="responsablebt" type="text" class="form-control" placeholder="Responsable du bon de travaux" value="{{old('responsablebt')}}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Code UO</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input name="codeuo" type="text" class="form-control" placeholder="Code UO" value="{{old('codeuo')}}"/>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre UO</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input name="nbreuo" type="number" class="form-control" placeholder="Nombre UO" value="{{old('nbreuo')}}"/>
                    </div>
                </div>
            </div>

            <div class="x_title">
                <strong>Fin du document</strong>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">N° du bon</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input name="numerobon" required type="text" class="form-control" placeholder="N° du bon" value="{{old('numerobon')}}"/>
                    </div>

                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Date d'exécution</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                            <input name="dateexecution" class="date-picker datepicker form-control col-md-7 col-xs-12" required type="text" value="{{old('dateexecution')}}" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Bon voisin</label>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <input disabled type="text" class="form-control" placeholder="N° du bon voisin" value="{{$reference}}"/>
                        <input type="hidden" name="bonvoisin" value="{{$reference}}"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                <button type="reset" class="btn btn-primary">Annuler</button>
                <button type="submit" class="btn btn-success">Ajouter</button>
            </div>
        </div>

    </form>
    </div>
</div>
@endsection