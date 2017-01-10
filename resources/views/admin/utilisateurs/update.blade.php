@extends('layouts.main')

@section('content')
    <form class="form-horizontal form-label-left" data-parsley-validate role="form" method="POST" action="{{route('modif_utilisateur',['id' =>$identite->id])}}">
        {{ csrf_field() }}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Identité d'accès</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Login<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="_login" disabled placeholder="Adresse email ou nom d'équipe" required="required" class="form-control col-md-7 col-xs-12" value="{{old('_login') ? old('_login') : $identite->login}}" />
                            <input type="hidden" name="login" value="{{$identite->login}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mot de passe<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" name="password" placeholder="Saisir un mot de passe fort" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirmation<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe ci-dessus" class="form-control col-md-7 col-xs-12" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Type d'identité d'accès</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="select2_single form-control col-md-7 col-xs-12" name="typeidentite_id" tabindex="-1" onchange="Switch(this);">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}" @if((old('typeidentite_id')? old('typeidentite_id'):$identite->typeidentite_id) == $type->id) selected @endif>{{$type->libelle}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Horaires de connexion<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="horaires" placeholder="Horaires de connexion" required="required" class="form-control col-md-7 col-xs-12" value="{{old('horaires') ? old('horaires') : '00:00-23:59'}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jours de connexion</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="jours[]" value="0" class="flat"> Dimanche
                                </label>
                                <label>
                                    <input type="checkbox" name="jours[]" value="1" class="flat" checked="checked"> Lundi
                                </label>
                                <label>
                                    <input type="checkbox" name="jours[]" value="2" class="flat" checked="checked"> Mardi
                                </label>
                                <label>
                                    <input type="checkbox" name="jours[]" value="3" class="flat" checked="checked"> Mercredi
                                </label>
                                <label>
                                    <input type="checkbox" name="jours[]" value="4"  class="flat" checked="checked"> Jeudi
                                </label>
                                <label>
                                    <input type="checkbox" name="jours[]" value="5" class="flat" checked="checked"> Vendredi
                                </label>
                                <label>
                                    <input type="checkbox" name="jours[]" value="6" class="flat" > Samedi
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Autorisations</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::RBOM}}" @if(array_search(\App\Autorisation::RBOM,json_decode($identite->autorisation)) !== false) checked @endif class="flat" /> RBOM
                                </label>
                                <label>
                                    <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::RTM}}" @if(array_search(\App\Autorisation::RTM,json_decode($identite->autorisation)) !== false) checked @endif class="flat" /> RTM
                                </label>
                                <label>
                                    <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::EQUIPE_TRAVAUX}}" @if(array_search(\App\Autorisation::EQUIPE_TRAVAUX,json_decode($identite->autorisation)) !== false) checked @endif class="flat" /> Equipe
                                </label>
                                <label>
                                    <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::CIE}}" @if(array_search(\App\Autorisation::CIE,json_decode($identite->autorisation)) !== false) checked @endif class="flat" /> CIE
                                </label>
                                <label>
                                    <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::DIRECTEUR}}" @if(array_search(\App\Autorisation::DIRECTEUR,json_decode($identite->autorisation)) !== false) checked @endif class="flat" /> Directeur
                                </label>
                                <label>
                                    <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::ADMIN}}" @if(array_search(\App\Autorisation::ADMIN,json_decode($identite->autorisation)) !== false) checked @endif class="flat" /> Administrateur
                                </label>
                            </div>
                        </div>
                    </div>
                    @if($identite->typeidentite_id == \App\TypeIdentite::TYPE_IDENTITE_UTILISATEUR)
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Utilisateur</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nom</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input placeholder="Nom de l'utilisateur" class="form-control col-md-7 col-xs-12 utilisateur" type="text" name="nom" value="{{old('nom') ? old('nom') : $identite->utilisateur->nom}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Prénoms</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input placeholder="Prénoms de l'utilisateur" class="form-control col-md-7 col-xs-12 utilisateur" type="text" name="prenoms" value="{{old('prenoms') ? old('prenoms') : $identite->utilisateur->prenoms}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Téléphone</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input placeholder="00 00 00 00 ou 12-34-56-78" class="form-control col-md-7 col-xs-12 utilisateur" type="text" name="telephone" value="{{old('telephone') ? old('telephone') : $identite->utilisateur->telephone}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <small>(secondaire)</small></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input placeholder="tom.jean@xyz.com" class="form-control col-md-7 col-xs-12 utilisateur" type="email" name="email" value="{{old('email') ? old('email') : $identite->utilisateur->email}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($identite->typeidentite_id == \App\TypeIdentite::TYPE_IDENTITE_EQUIPE_TRAVAUX)
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Equipe</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nom</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input placeholder="Nom de l'équipe" class="form-control col-md-7 col-xs-12 equipe" type="text" name="nom" value="{{old('nom') ? old('nom') : $identite->equipeTravaux->nom}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Chargé de maintenance</label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="select2_single form-control equipe" name="chargemaintenance" tabindex="-1">
                                        @foreach($intervenants as $intervenant)
                                            <option value="{{$intervenant->id}}" @if((old('chargemaintenance') ? old('chargemaintenance') : $identite->equipeTravaux->chargemaintenance ) == $intervenant->id) selected @endif>
                                                {{$intervenant->nom}} {{$intervenant->prenoms}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Chef d'équipe</label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="select2_single form-control equipe" name="chefequipe" tabindex="-1">
                                        @foreach($intervenants as $intervenant)
                                            <option value="{{$intervenant->id}}" @if((old('chefequipe')? old('chefequipe') : $identite->equipeTravaux->chefequipe) == $intervenant->id) selected @endif>
                                                {{$intervenant->nom}} {{$intervenant->prenoms}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br/><br/>
                        </div>
                    </div>
                    @endif
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