<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DJERA Services | Macure </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <img src="images/logo-djera.jpg" alt="Djera-Services-logo"/>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
              {{ csrf_field() }}

              <h1>Connexion utilisateur</h1>

              @if ($errors->has('login'))
                <span class="help-block ">
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <span>{{ $errors->first('login') }}</span>
                  </div>
                  </span>
              @endif

              <div>
                <input type="text" class="form-control" placeholder="Nom d'utilisateur" value="{{old('login')}}" required="" name="login" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Mot de passe" required="" name="password"/>
                @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
              <div>
                <input type="submit" class="btn btn-default submit" value="Connexion" />
                <a class="reset_pass" href="#">Mot de passe oublié ?</a>
                <input type="hidden" name="remember" value="1"/>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Nouvel utilisateur ?
                  <a href="#signup" class="to_register"> Créer un nouveau compte </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-leaf"></i> Macure</h1>
                  <p>©2016 Tous droits Reservé. GLAMO Corporation! GLAMO Création! Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Créer un nouveau compte</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="../gentelella/index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Se souvenir de moi ?
                  <a href="#signin" class="to_register"> Connexion </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
