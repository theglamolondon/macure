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
                                <p> <small>{{(new \Carbon\Carbon($utilisateur->lastlogin))->format("d/m/Y H:i:s")}}</small>
                                <p> <small>
                                        @if((new Carbon\Carbon($utilisateur->lastlogout))->diffInMinutes(new Carbon\Carbon($utilisateur->lastlogin),false) < 0 )
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
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Weekly Summary <small>Activity shares</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                            <div class="col-md-7" style="overflow:hidden;">
                        <span class="sparkline_one" style="height: 160px; padding: 10px 25px;">
                                      <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                  </span>
                                <h4 style="margin:18px">Weekly sales progress</h4>
                            </div>

                            <div class="col-md-5">
                                <div class="row" style="text-align: center;">
                                    <div class="col-md-4">
                                        <canvas id="canvas1i" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                        <h4 style="margin:0">Bounce Rates</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <canvas id="canvas1i2" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                        <h4 style="margin:0">New Traffic</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <canvas id="canvas1i3" height="110" width="110" style="margin: 5px 10px 10px 0"></canvas>
                                        <h4 style="margin:0">Device Share</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <article class="media event">
                            <a class="pull-left date">
                                <p class="month">April</p>
                                <p class="day">23</p>
                            </a>
                            <div class="media-body">
                                <a class="title" href="#">Item One Title</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </article>
                        <article class="media event">
                            <a class="pull-left date">
                                <p class="month">April</p>
                                <p class="day">23</p>
                            </a>
                            <div class="media-body">
                                <a class="title" href="#">Item Two Title</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </article>
                        <article class="media event">
                            <a class="pull-left date">
                                <p class="month">April</p>
                                <p class="day">23</p>
                            </a>
                            <div class="media-body">
                                <a class="title" href="#">Item Two Title</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </article>
                        <article class="media event">
                            <a class="pull-left date">
                                <p class="month">April</p>
                                <p class="day">23</p>
                            </a>
                            <div class="media-body">
                                <a class="title" href="#">Item Two Title</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </article>
                        <article class="media event">
                            <a class="pull-left date">
                                <p class="month">April</p>
                                <p class="day">23</p>
                            </a>
                            <div class="media-body">
                                <a class="title" href="#">Item Three Title</a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>>
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
    <!-- Doughnut Chart -->
    <script>
        $(document).ready(function() {
            var canvasDoughnut,
                    options = {
                        legend: false,
                        responsive: false
                    };

            new Chart(document.getElementById("canvas1i"), {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: [
                        "Symbian",
                        "Blackberry",
                        "Other",
                        "Android",
                        "IOS"
                    ],
                    datasets: [{
                        data: [15, 20, 30, 10, 30],
                        backgroundColor: [
                            "#BDC3C7",
                            "#9B59B6",
                            "#E74C3C",
                            "#26B99A",
                            "#3498DB"
                        ],
                        hoverBackgroundColor: [
                            "#CFD4D8",
                            "#B370CF",
                            "#E95E4F",
                            "#36CAAB",
                            "#49A9EA"
                        ]

                    }]
                },
                options: options
            });

            new Chart(document.getElementById("canvas1i2"), {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: [
                        "Symbian",
                        "Blackberry",
                        "Other",
                        "Android",
                        "IOS"
                    ],
                    datasets: [{
                        data: [15, 20, 30, 10, 30],
                        backgroundColor: [
                            "#BDC3C7",
                            "#9B59B6",
                            "#E74C3C",
                            "#26B99A",
                            "#3498DB"
                        ],
                        hoverBackgroundColor: [
                            "#CFD4D8",
                            "#B370CF",
                            "#E95E4F",
                            "#36CAAB",
                            "#49A9EA"
                        ]

                    }]
                },
                options: options
            });

            new Chart(document.getElementById("canvas1i3"), {
                type: 'doughnut',
                tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                data: {
                    labels: [
                        "Symbian",
                        "Blackberry",
                        "Other",
                        "Android",
                        "IOS"
                    ],
                    datasets: [{
                        data: [15, 20, 30, 10, 30],
                        backgroundColor: [
                            "#BDC3C7",
                            "#9B59B6",
                            "#E74C3C",
                            "#26B99A",
                            "#3498DB"
                        ],
                        hoverBackgroundColor: [
                            "#CFD4D8",
                            "#B370CF",
                            "#E95E4F",
                            "#36CAAB",
                            "#49A9EA"
                        ]

                    }]
                },
                options: options
            });
        });
    </script>
    <!-- /Doughnut Chart -->
@endsection