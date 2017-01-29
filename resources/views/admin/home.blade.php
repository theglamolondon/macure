@extends('layouts.main')
<style type="text/css">
    .x_content .media:first-child {
        margin-top: 15px;
    }
</style>
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Liste des utilisateurs</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @foreach($utilisateurs as $utilisateur)
                        <div class="media event col-md-2 col-sm-4 col-xs-12 fontmeuser" id="user{{$utilisateur->id}}">
                            <a class="pull-left border-aero profile_thumb">
                                <i class="fa fa-user aero"></i>
                            </a>
                            <div class="media-body">
                                <a class="title" href="#">{{$utilisateur->name()}}</a>
                                <p> <small>{{$utilisateur->lastlogin ? \Carbon\Carbon::parse($utilisateur->lastlogin)->format("d/m/Y H:i") : ''}}</small></p>
                                <p> <small>
                                        @if(Carbon\Carbon::parse($utilisateur->lastlogin)->diffInMinutes(Carbon\Carbon::parse($utilisateur->lastlogout),false) < 0 )
                                            Connecté
                                        @else
                                            Déconnecté
                                        @endif
                                    </small>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Top Profiles <small>Sessions</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        @foreach($utilisateurs->sortByDesc('totaltimeconnect') as $utilisateur)
                        <article class="media event">
                            <a class="pull-left date">
                                <p class="day"><span class="fa fa-tachometer"></span></p>

                            </a>
                            <div class="media-body">
                                <a class="title" href="#">{{$utilisateur->name()}}</a>
                                <p>{{intval($utilisateur->totaltimeconnect/60)}} Heures {{$utilisateur->totaltimeconnect%60}} Minutes</p>
                            </div>
                        </article>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Top Profiles <small>Sessions</small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <style type="text/css">
            .connected{
                background: #009926;
            }
            .disconnected{
                background: #942a25;
            }
            .fontmeuser{background: #f7f7f7;}
        </style>
@endsection

@section('scripts')

    <!-- Chart.js -->
    <script src="{{request()->getBaseUrl()}}/vendors/Chart.js/dist/Chart.min.js"></script>

    <script>
        $(document).ready(function() {
            // Pie chart
            var ctx = document.getElementById("pieChart");
            var data = {
                datasets: [{
                    data: [
                    @foreach($utilisateurs as $user)
                        {{$user->totaltimeconnect}},
                    @endforeach
                    ],
                    backgroundColor: [
                        "#455C73",
                        "#9B59B6",
                        "#BDC3C7",
                        "#26B99A",
                        "#3498DB"
                    ],
                    label: 'My dataset' // for legend
                }],
                labels: [
                    @foreach($utilisateurs as $user)
                    "{{$user->name()}}",
                    @endforeach
                ]
            };

            var pieChart = new Chart(ctx, {
                data: data,
                type: 'pie',
                otpions: {
                    legend: false
                }
            });
        });
    </script>
    <!-- /Doughnut Chart -->
@endsection