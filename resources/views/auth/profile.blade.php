@extends('layouts.main')
@php
$identite = \Illuminate\Support\Facades\Auth::user();
@endphp

@section('content')
    <!-- page content -->
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{\Illuminate\Support\Facades\Auth::user()->name()}}<small>Profil</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view" src="{{request()->getBaseUrl()}}/images/profile/{{\Illuminate\Support\Facades\Auth::user()->profileimage}}" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3>Samuel Doe</h3>

                            <ul class="list-unstyled user_data">
                                <li><i class="fa fa-map-marker user-profile-icon"></i> San Francisco, California, USA
                                </li>

                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                                </li>

                                <li class="m-top-xs">
                                    <i class="fa fa-external-link user-profile-icon"></i>
                                    <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                                </li>
                            </ul>

                            <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                            <br />

                            <!-- start skills -->
                            <h4>Skills</h4>
                            <ul class="list-unstyled user_data">
                                <li>
                                    <p>Web Applications</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Website Design</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>Automation & Testing</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                                    </div>
                                </li>
                                <li>
                                    <p>UI / UX</p>
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                    </div>
                                </li>
                            </ul>
                            <!-- end of skills -->

                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                                <form class="form-horizontal form-label-left" data-parsley-validate role="form" method="POST" action="{{route('maj_current_user')}}">
                                    {{ csrf_field() }}
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
                                            <input type="hidden" name="typeidentite_id" value="{{\App\TypeIdentite::TYPE_IDENTITE_UTILISATEUR}}"/>
                                        </div>
                                        @if($identite->typeidentite_id == \App\TypeIdentite::TYPE_IDENTITE_UTILISATEUR)
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
                                        @endif

                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="btn btn-primary">Valider</button>
                                                <button type="reset" class="btn btn-success">Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection

@section('scripts')
    <script type="application/javascript">
        var MEfromPHP = {
            id:'{{\Illuminate\Support\Facades\Auth::user()->id}}',
            login: '{{\Illuminate\Support\Facades\Auth::user()->login}}',
            autorisation: ('{{(\Illuminate\Support\Facades\Auth::user()->autorisation)}}'),
            totaltimeconnect: {{\Illuminate\Support\Facades\Auth::user()->totaltimeconnect}},
            lastlogin: moment('{{\Illuminate\Support\Facades\Auth::user()->lastlogin}}'),
            lastlogout:  moment('{{\Illuminate\Support\Facades\Auth::user()->lastlogout}}'),
            totalattemptconnect: {{\Illuminate\Support\Facades\Auth::user()->totalattemptconnect}},
            profileimage: '{{\Illuminate\Support\Facades\Auth::user()->profileimage}}',
            equipe_travaux: {
              @if(\Illuminate\Support\Facades\Auth::user()->equipe_travaux)
                nom: '{{\Illuminate\Support\Facades\Auth::user()->equipe_travaux->nom}}',
                chargemaintenance: {

                }
              @endif
            },
            utilisateur: {
              @if(\Illuminate\Support\Facades\Auth::user()->utilisateur)
                nom: '{{\Illuminate\Support\Facades\Auth::user()->utilisateur->nom}}',
                prenoms: '{{\Illuminate\Support\Facades\Auth::user()->utilisateur->prenoms}}',
                telephone: '{{\Illuminate\Support\Facades\Auth::user()->utilisateur->telephone}}',
                email: '{{\Illuminate\Support\Facades\Auth::user()->utilisateur->email}}'
              @endif
            }
        }
        console.log(MEfromPHP);
    </script>
@endsection