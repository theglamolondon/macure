<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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

            @if($errors->has('policy'))
              <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <span>{{$errors->first('policy')}}.</span>
              </div>
            @endif

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
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1>Macure</h1>
                  <p>©2016 Tous droits Reservé. SOFTN'FIX Technology! Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
