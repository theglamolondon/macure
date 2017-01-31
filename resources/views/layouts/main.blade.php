<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.ico" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script>
      window.Laravel = <?php echo json_encode([
              'csrfToken' => csrf_token(),
      ]); ?>
    </script>

    <title>Macure | DJERA Services</title>

    <!-- Bootstrap -->
    <link href="{{request()->getBaseUrl()}}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{request()->getBaseUrl()}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{request()->getBaseUrl()}}/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{request()->getBaseUrl()}}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{request()->getBaseUrl()}}/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{request()->getBaseUrl()}}/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{request()->getBaseUrl()}}/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="{{request()->getBaseUrl()}}/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{request()->getBaseUrl()}}/vendors/switchery/dist/switchery.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{request()->getBaseUrl()}}/build/css/custom.min.css" rel="stylesheet">

    <!-- PNotify -->
    <link href="{{request()->getBaseUrl()}}/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="{{request()->getBaseUrl()}}/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="{{request()->getBaseUrl()}}/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route(\Illuminate\Support\Facades\Auth::user()->getHomeUrl())}}" class="site_title"><i class="fa fa-leaf"></i> <span>Marcure !</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{request()->getBaseUrl()}}/images/profile/{{\Illuminate\Support\Facades\Auth::user()->profileimage}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Salut,</span>
                <h2>{{ \Illuminate\Support\Facades\Auth::user()->name() }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::ADMIN))
                  <li><a><i class="fa fa-home"></i> ADMIN <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Utilisateurs</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('nouveau_user')}}">Nouveau</a>
                          <li><a href="{{route('liste_users')}}">Liste</a></li>
                        </ul>
                      </li>
                      @if(1==2)
                      <li><a href="#">Equipes</a>
                        <ul class="nav child_menu">
                          <li><a href="#">Nouveau</a></li>
                          <li><a href="#">Liste</a></li>A
                        </ul>
                      </li>
                      @endif
                      <li><a href="#">Intervenants</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('nouveau_intervenant')}}">Nouveau</a></li>
                          <li><a href="{{route('liste_intervenants')}}">Liste</a></li>
                        </ul>
                      </li>
                      <li><a href="#">Gamme</a>
                        <ul class="nav child_menu">
                          <li><a href="javascript:void(0);">Type de gamme</a>
                            <ul class="nav child_menu">
                              <li><a href="{{route('nouveau_typegamme')}}">Nouveau</a>
                              <li><a href="{{route('liste_typegamme')}}">Liste</a></li>
                            </ul>
                          </li>
                          <li><a href="#">Check-list</a>
                            <ul class="nav child_menu">
                              <li><a href="{{route('nouveau_checklist')}}">Nouveau</a>
                              <li><a href="{{route('liste_checklist')}}">Liste</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::RBOM))
                  <li><a><i class="fa fa-edit"></i> RBOM <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="javascript:void(0);">Ouvrage</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('nouveau_ouvrage')}}">Nouveau</a></li>
                          <li><a href="{{route('liste_ouvrage')}}">Liste</a></li>
                          <li><a href="javascript:void(0);">Planning d'ouvrage</a>
                            <ul class="nav child_menu">
                              <li><a href="{{route('planning_ouvrage_annuel')}}">Annuel</a></li>
                              <li><a href="{{route('planning_ouvrage_trimestriel')}}">Trimestriel</a></li>
                              <li><a href="{{route('planning_ouvrage_mensuel')}}">Mensuel</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li><a href="javascript:void(0);">Bon de travaux</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('nouveau_bt')}}">Nouveau</a></li>
                          <li><a href="{{route('liste_bt')}}">Liste</a></li>
                          <li><a href="{{route('planning_bt')}}">Planning BT</a></li>
                        </ul>
                      </li>
                      <li><a href="javascript:void(0);">Actions de maintenance</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('liste_fpam')}}">Liste</a></li>
                        </ul>
                      </li>
                      <li><a href="{{route('planning')}}">Planning</a></li>
                      <li><a href="{{route('map')}}">Cartographie</a></li>
                    </ul>
                  </li>
                  @endif
                  @if(\Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::RGS))
                  <li><a><i class="fa fa-database"></i> STOCK <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="javascript:void(0);">Famille</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('nouvelle_famille')}}">Nouvelle</a>
                          <li><a href="{{route('liste_famille')}}">Liste</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="javascript:void(0);">Matériel</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('nouveau_produit')}}">Nouveau</a>
                          <li><a href="{{route('liste_produit')}}">Liste</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::RTM))
                  <li><a><i class="fa fa-desktop"></i>RTM <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Nouvelle équipe</a></li>
                      <li><a href="#">Liste des équipes</a></li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::EQUIPE_TRAVAUX))
                  <li><a><i class="fa fa-table"></i> EQUIPE TRAVAUX <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Planning du jour</a></li>
                      <li><a href="#">Commande de matériel</a></li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::CIE))
                  <li><a><i class="fa fa-bar-chart-o"></i> CIE <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('planning_ouvrage_annuel')}}">Planning</a></li>
                      <li><a href="#">Bon de travaux</a></li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::DIRECTEUR))
                  <li><a><i class="fa fa-clone"></i> DIRECTEUR <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('tableau_bord')}}">Tableau de bord</a></li>
                      <li><a href="{{route('statistiques')}}">Statistiques</a></li>
                    </ul>
                  </li>
                  @endif
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{request()->getBaseUrl()}}/images/profile/{{\Illuminate\Support\Facades\Auth::user()->profileimage}}" alt="">{{ \Illuminate\Support\Facades\Auth::user()->name() }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{route( \Illuminate\Support\Facades\Auth::user()->getProfileUrl())}}"> Profile</a></li>
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Déconnexion</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="{{request()->getBaseUrl()}}/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{request()->getBaseUrl()}}/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{request()->getBaseUrl()}}/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="{{request()->getBaseUrl()}}/images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Macure - Djera - Services &copy;2016 <a href="http://softnfix.com" target="_blank">SOFTN'FIX Technology</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
      </ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <!-- jQuery -->
    <script src="{{request()->getBaseUrl()}}/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{request()->getBaseUrl()}}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{request()->getBaseUrl()}}/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{request()->getBaseUrl()}}/vendors/nprogress/nprogress.js"></script>
    <!-- gauge.js -->
    <script src="{{request()->getBaseUrl()}}/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{request()->getBaseUrl()}}/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="{{request()->getBaseUrl()}}/vendors/iCheck/icheck.min.js"></script>
    <!-- Switchery -->
    <script src="{{request()->getBaseUrl()}}/vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="{{request()->getBaseUrl()}}/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Skycons -->
    <script src="{{request()->getBaseUrl()}}/vendors/skycons/skycons.js"></script>
    <!-- DateJS -->
    <script src="{{request()->getBaseUrl()}}/vendors/DateJS/build/date.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/DateJS/build/date-fr-FR.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{request()->getBaseUrl()}}/vendors/moment/min/moment-with-locales.min.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- PNotify -->
    <script src="{{request()->getBaseUrl()}}/vendors/pnotify/dist/pnotify.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="{{request()->getBaseUrl()}}/vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <!-- Scripts dynamiques -->
    @yield('scripts')

    <!-- Custom Theme Scripts -->
    <script src="{{request()->getBaseUrl()}}/build/js/custom.min.js"></script>
    <!-- Macure Scripts -->
    <script src="{{request()->getBaseUrl()}}/js/macure.js"></script>

    <!-- PNotify -->
    <script>
      $(document).ready(function() {
        @foreach($errors->all() as $message)
        new PNotify({
          title: 'Erreur',
          text: '{{$message}}',
          type: '{{\App\Helper\Message::TYPE_ERREUR}}', //error | info | alert | success
          styling: 'bootstrap3'
        });
        @endforeach

        @if(session()->has('status'))
        @foreach(session('status')->all() as $message)
        new PNotify({
          title: 'Succès',
          text: '{{$message}}',
          type: '{{\App\Helper\Message::TYPE_SUCCESS}}', //error | info | alert | success
          styling: 'bootstrap3'
        });
        @endforeach
        @endif
      });


    </script>
    <!-- PNotify -->

    <!-- Skycons -->
    <script>
      $(document).ready(function() {
        var icons = new Skycons({
            "color": "#73879C"
          }),
          list = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
          ],
          i;

        for (i = list.length; i--;)
          icons.set(list[i], list[i]);

        icons.play();
      });
    </script>
    <!-- /Skycons -->

    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {

        var cb = function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        };

        var optionSet1 = {
          startDate: moment().subtract(29, 'days'),
          endDate: moment(),
          minDate: '01/01/2012',
          maxDate: '12/31/2015',
          dateLimit: {
            days: 60
          },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          opens: 'left',
          buttonClasses: ['btn btn-default'],
          applyClass: 'btn-small btn-primary',
          cancelClass: 'btn-small',
          format: 'MM/DD/YYYY',
          separator: ' to ',
          locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Clear',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
            firstDay: 1
          }
        };
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function() {
          console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function() {
          console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
          console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
          console.log("cancel event fired");
        });
        $('#options1').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function() {
          $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function() {
          $('#reportrange').data('daterangepicker').remove();
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->


    <!-- SOCKET IO -->
    <script type="application/javascript" src="{{request()->getBaseUrl()}}/../node_modules/socket.io-client/dist/socket.io.js"></script>
    <script type="text/javascript">
      var LISTENER = '{{request()->getBaseUrl()}}:5390';
      var MY = {
        id : '{{\Illuminate\Support\Facades\Auth::user()->id}}',
        fullname: '{{\Illuminate\Support\Facades\Auth::user()->name()}}',
        isAdmin: {{\Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::ADMIN)?'true':'false'}}
      }
    </script>
    <script type="application/javascript" src="{{request()->getBaseUrl()}}/js/liveClient.js"></script>
    <!-- /SOCKET IO -->

  </body>
</html>