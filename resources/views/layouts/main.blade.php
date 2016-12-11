<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
              <a href="{{route(\Illuminate\Support\Facades\Auth::user()->getHomeUrl())}}" class="site_title"><i class="fa fa-paw"></i> <span>Marcure !</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="{{request()->getBaseUrl()}}/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bonjour,</span>
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
                  <li><a><i class="fa fa-home"></i> Administration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="#">Utilisateur</a>
                        <ul class="nav child_menu">
                          <li><a href="#level1_1">Nouveau</a>
                          <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li class="sub_menu"><a href="../gentelella/level2.html">Level Two</a>
                              </li>
                              <li><a href="#level2_1">Level Two</a>
                              </li>
                              <li><a href="#level2_2">Level Two</a>
                              </li>
                            </ul>
                          </li>
                          <li><a href="#level1_2">Level One</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="#">Dashboard2</a></li>
                      <li><a href="#">Dashboard3</a></li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::RBOM))
                  <li><a><i class="fa fa-edit"></i> RBOM <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="javascript:void(0);">Bon de travaux</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('nouveau_bt')}}">Nouveau</a>
                          <li><a href="{{route('liste_bt')}}">Liste</a>
                          </li>
                        </ul>
                      </li>
                      <li><a href="javascript:void(0);">Actions de maintenance</a>
                        <ul class="nav child_menu">
                          <li><a href="{{route('liste_fpam')}}">Liste</a></li>
                        </ul>
                      </li>
                      <li><a href="{{route('planning')}}">Planing</a></li>
                      <li><a href="{{route('map')}}">Cartographie</a></li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::RTM))
                  <li><a><i class="fa fa-desktop"></i>RTM <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../gentelella/general_elements.html">General Elements</a></li>
                      <li><a href="../gentelella/media_gallery.html">Media Gallery</a></li>
                      <li><a href="../gentelella/typography.html">Typography</a></li>
                      <li><a href="../gentelella/icons.html">Icons</a></li>
                      <li><a href="../gentelella/glyphicons.html">Glyphicons</a></li>
                      <li><a href="../gentelella/widgets.html">Widgets</a></li>
                      <li><a href="../gentelella/invoice.html">Invoice</a></li>
                      <li><a href="../gentelella/inbox.html">Inbox</a></li>
                      <li><a href="../gentelella/calendar.blade.php">Calendar</a></li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::EQUIPE_TRAVAUX))
                  <li><a><i class="fa fa-table"></i> EQUIPE TRAVAUX <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../gentelella/tables.html">Tables</a></li>
                      <li><a href="../gentelella/tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::CIE))
                  <li><a><i class="fa fa-bar-chart-o"></i> CIE <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../gentelella/chartjs.html">Chart JS</a></li>
                      <li><a href="../gentelella/chartjs2.html">Chart JS2</a></li>
                      <li><a href="../gentelella/morisjs.html">Moris JS</a></li>
                      <li><a href="../gentelella/echarts.html">ECharts</a></li>
                      <li><a href="../gentelella/other_charts.html">Other Charts</a></li>
                    </ul>
                  </li>
                  @endif
                  @if( \Illuminate\Support\Facades\Auth::user()->hasRole(\App\Autorisation::DIRECTEUR))
                  <li><a><i class="fa fa-clone"></i> DIRECTEUR <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../gentelella/fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="../gentelella/fixed_footer.html">Fixed Footer</a></li>
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
                    <img src="{{request()->getBaseUrl()}}/images/img.jpg" alt="">{{ \Illuminate\Support\Facades\Auth::user()->name() }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{route( \Illuminate\Support\Facades\Auth::user()->getProfileUrl())}}"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
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
            Macure - Djera project &copy;2016 <a href="https://colorlib.com">Colorlib</a>
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


        @if(session()->has('success'))
        @foreach(session('success') as $message)
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
  </body>
</html>