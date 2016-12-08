@extends('layouts.main')

@section('content')
    <div class="rows">
        <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-1 col-xs-12">
            <form class="form-horizontal form-label-left input_mask" method="post" action="{{route("nouveau_fpam",["initiateur"=>$bon->numerobon])}}">
                {{csrf_field()}}
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Bon de travaux</h3>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input name="dateprepa" class="date-picker datepicker form-control col-md-7 col-xs-12" required type="text" value="{{$today}}" />
                                </div>
                            </div>

                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Equipe <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2_single" name="equipe_travaux_id">
                                    @foreach($equipes as $equipe)
                                        <option value="{{$equipe->id}}" @if(old('equipe_travaux_id')) selected @endif>{{$equipe->nom}} | {{$equipe->chargeEquipe->nom}} {{$equipe->chargeEquipe->prenoms}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Numéro FPAM <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control" placeholder="_ _ _ _ _ _ _ _ _ _ _" name="numerofpam" value="{{old('numerofpam')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title ">
                        <h3>Identification du chantier</h3>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Localisation</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control" placeholder="Localisation du client" name="localisation" value="{{old('localisation')}}"/>
                            </div>

                            <label class="control-label col-md-2 col-sm-2 col-xs-12 ">Code initiateur</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input disabled type="text" class="form-control" name="codeinitiateur" value="{{$bon->numerobon}}"/>
                                <input type="hidden" name="bon_travaux_id" value="{{$bon->id}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Equipement</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" class="form-control" placeholder="Equipement" name="equipement" value="{{old('equipement')}}"/>
                                <input type="hidden" name=""/>
                            </div>
                        </div>
                    </div>

                    <div class="x_title">
                        <h3>Définition de l'action de maintenance</h3>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Cause du chantier <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2_single" name="cause_chantier_id">
                                    @foreach($causes as $cause)
                                        <option value="{{$cause->id}}" @if(old('cause_chantier_id') == $cause->id) selected @endif>{{$cause->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Type opération <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2_single" name="type_operation_id">
                                    @foreach($types as $type)
                                        @continue($type->id < 3)
                                        <option value="{{$type->id}}" @if(old('type_operation_id') == $type->id) selected @endif>{{$type->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Titre opération <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2_single" name="titre_operation_id">
                                    @foreach($types as $titre)
                                        @continue($titre->id > 2)
                                        <option value="{{$titre->id}}" @if(old('titre_operation_id') == $titre->id) selected @endif>{{$titre->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Urgence <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2_single" name="urgence_id">
                                    @foreach($urgences as $urgence)
                                        <option value="{{$urgence->id}}" @if(old('urgence_id') == $urgence->id) selected @endif>{{$urgence->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Pricipales recommendations</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <textarea class="form-control" placeholder="Principales récommendations" name="recommendation" rows="3">{{old('recommendation')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Natures des travaux</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <textarea class="form-control" placeholder="Nature des travaux" name="naturetravaux" rows="3">{{old('naturetravaux')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Type de gamme à utiliser <span class="required">*</span></label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2_single" name="gamme">
                                    @foreach($gammes as $gamme)
                                        <option value="{{$gamme->id}}" @if(old('gamme') == $gamme->id) selected @endif>{{$gamme->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-12">
                                <div class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date et heure début</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" name="dateheuredebutprevi" class="form-control datepicker-time" value="{{old('dateheuredebutprevi') or $today}}" />
                                </div>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date et heure fin</label>
                            <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" name="dateheurefinprevi" class="form-control datepicker-time" value="{{old('dateheurefinprevi') or $today}}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Considerations de mise en oeuvre</h3>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Ouvrages à consigner</label>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <textarea class="form-control" placeholder="Ouvrages à consigner" name="ouvrageaconsigner" rows="3">{{old('ouvrageaconsigner')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="x_title">
                        <h3>Moyens Humains Necessaire</h3>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre de cadres</label>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <input type="number"  class="form-control" name="nbrecadre" value="{{old('nbrecadre')}}"/>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre d'agents de Maitrise</label>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <input type="number"  class="form-control" name="nbreagentdemaitrise" value="{{old('nbreagentdemaitrise')}}"/>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre d'employés</label>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <input type="number"  class="form-control" name="nbreagentemploye" value="{{old('nbreagentemploye')}}"/>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre d'ouvriers</label>
                            <div class="col-md-1 col-sm-1 col-xs-12">
                                <input type="number"  class="form-control" name="nbreagentouvrier" value="{{old('nbreagentouvrier')}}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div >
                                <div class="checkbox">
                                    <label class="col-md-offset-2 col-md-2 col-sm-offset-2 col-sm-2 col-xs-12">
                                        <input type="checkbox" class="flat" name="disponibiliteagentcie" @if(old('disponibiliteagentcie'))checked="checked" @endif> Disponibilité agen CIE ?
                                    </label>
                                    <label class="col-md-3 col-sm-3 col-xs-12">
                                        <input type="radio" class="flat" @if(old('ressoucedisponible') == 1)checked="checked" @endif name="ressoucedisponible" value="1"/> Ressources suffisantes et disponibles
                                    </label>
                                    <label class="col-md-3 col-sm-3 col-xs-12">
                                        <input type="radio" class="flat" @if(old('ressoucedisponible') == 0)checked="checked" @endif name="ressoucedisponible" value="0"/> Sinon, négocier ressources extérieures
                                    </label>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="x_title">
                        <h3>Sollicitation pour Prestations Extérieures</h3>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Interlocuteur</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text"  class="form-control" name="interllocuteur" value=""/>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Date de contact</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" name="datecontact" class="form-control datepicker" value="{{old('datecontact') or $today}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Sollicitation exprimée</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text"  class="form-control" name="solliciationexprimee" value="{{ $fpam->solliciationexprimee or old('solliciationexprimee') }}"/>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Rendez-vous</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" name="rdv" class="form-control datepicker" value="{{old('rdv') or $today}}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-md-offset-6 col-sm-2 col-sm-offset-6 col-xs-12">Conclusion</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea  class="form-control" name="conclusion" maxlength="255" rows="3">{{old('conclusion')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="x_title">
                        <h3>Prévention sécurité et environnement</h3>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Matériels spécials de sécurité disponible</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea  class="form-control" name="materielspecialdispo" maxlength="255" rows="3">{{old('materielspecialdispo')}}</textarea>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Mésures particulières de sécurité disponible</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea  class="form-control" name="mesurepartdispo" maxlength="255" rows="3">{{old('mesurepartdispo')}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Moyens de remise en etat</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea  class="form-control" name="moyenderemiseetatdispo" maxlength="255" rows="3">{{old('moyenderemiseetatdispo')}}</textarea>
                            </div>
                            <label class="control-label col-md-2 col-sm-2 col-xs-12">Remarques et observations</label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <textarea  class="form-control" name="remarqueobs" maxlength="255" rows="3">{{old('remarqueobs')}}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Documents joints</h3>
                    </div>
                    <div class="x_content">
                        <div id="joints">
                            <label class="fa fa-upload"></label>
                            <input name="document[]" type="file" multiple/>
                        </div>
                    </div>
                </div>

                <div>
                    <input type="hidden" id="longitude" name="longitude" value="{{old('longitude')}}"/>
                    <input type="hidden" id="lattitude" name="lattitude" value="{{old('lattitude')}}"/>
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

@section('scripts')
<script>
    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(function(position){
            $("#lattitude").val(position.coords.latitude);
            $("#longitude").val(position.coords.longitude);
        })
    }else {
        alert('Impossible de déterminer vos coordonnées GPS ')
    }
</script>
@endsection