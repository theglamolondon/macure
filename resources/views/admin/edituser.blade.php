@extends('layouts.main')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{route('nouveau_user')}}">
        {{ csrf_field() }}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
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
                                <input type="text" name="login" placeholder="Adresse email ou nom d'équipe" required="required" class="form-control col-md-7 col-xs-12" value="{{old('login')}}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mot de passe<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" name="password" placeholder="Saisir un mot de passe fort" required="required" class="form-control col-md-7 col-xs-12" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Confirmation<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe ci-dessus" required="required" class="form-control col-md-7 col-xs-12" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Type d'identité d'accès</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="select2_single form-control col-md-7 col-xs-12" name="typeidentite_id" tabindex="-1" onchange="Switch(this);">
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}" @if(old('typeidentite_id') == $type->id) selected @endif>{{$type->libelle}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Autorisations</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::RBOM}}" class="flat"> RBOM
                                    </label>
                                    <label>
                                        <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::RTM}}" class="flat"> RTM
                                    </label>
                                    <label>
                                        <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::EQUIPE_TRAVAUX}}" class="flat"> Equipe
                                    </label>
                                    <label>
                                        <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::CIE}}" class="flat"> CIE
                                    </label>
                                    <label>
                                        <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::DIRECTEUR}}"  class="flat"> Directeur
                                    </label>
                                    <label>
                                        <input type="checkbox" name="autorisation[]" value="{{\App\Autorisation::ADMIN}}" class="flat" checked="checked"> Administrateur
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Utilisateur</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nom</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input placeholder="Nom de l'utilisateur" class="form-control col-md-7 col-xs-12 utilisateur" type="text" name="nom" value="{{old('nom')}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Prénoms</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input placeholder="Prénoms de l'utilisateur" class="form-control col-md-7 col-xs-12 utilisateur" type="text" name="prenoms" value="{{old('prenoms')}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Téléphone</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input placeholder="00 00 00 00 ou 12-34-56-78" class="form-control col-md-7 col-xs-12 utilisateur" type="text" name="telephone" value="{{old('telephone')}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email <small>(secondaire)</small></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input placeholder="tom.jean@xyz.com" class="form-control col-md-7 col-xs-12 utilisateur" type="email" name="email" value="{{old('telephone')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Equipe</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Nom</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input placeholder="Nom de l'équipe" class="form-control col-md-7 col-xs-12 equipe" type="text" name="nom" value="{{old('nom')}}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Chargé de maintenance</label>
                                    <div class="col-md-6 col-xs-12">
                                        <select class="select2_single form-control equipe" name="chargemaintenance" tabindex="-1">
                                            @foreach($intervenants as $intervenant)
                                                <option value="{{$intervenant->id}}" @if(old('chargemaintenance') == $intervenant->id) selected @endif>
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
                                                <option value="{{$intervenant->id}}" @if(old('chefequipe') == $intervenant->id) selected @endif>
                                                    {{$intervenant->nom}} {{$intervenant->prenoms}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br/><br/>
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
    <script>
        $(document).ready(function () {
            Switch(document.getElementsByName('typeidentite_id'));
        });

        function Switch(arg) {
            if($(arg).val() == 1){
                $('.utilisateur').removeAttr('disabled');
                $('.equipe').attr('disabled','disabled');
            }else {
                $('.equipe').removeAttr('disabled');
                $('.utilisateur').attr('disabled','disabled');
            }
        }
    </script>
@endsection

