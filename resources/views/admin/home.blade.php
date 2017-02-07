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
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_details" id="user{{$utilisateur->id}}">
                            <div class="well profile_view">
                                <div class="col-sm-12">
                                    <h4 class="brief"><i>{{$utilisateur->typeIdentite->libelle}}</i></h4>
                                    <div class="left col-xs-7">
                                        <h2>{{$utilisateur->name()}}</h2>
                                        <p><strong>About: </strong> Web Designer / UI. </p>
                                        <ul class="list-unstyled">
                                            <li><i class="fa fa-building"></i> Address: </li>
                                            <li><i class="fa fa-phone"></i> Phone : {{$utilisateur->utilisateur->telephone ?? null}}</li>
                                        </ul>
                                    </div>
                                    <div class="right col-xs-5 text-center">
                                        <img src="{{request()->getBaseUrl()}}/images/profile/{{$utilisateur->profileimage}}" alt="" class="img-circle img-responsive">
                                    </div>
                                </div>
                                <div class="col-xs-12 bottom text-center">
                                    <div class="col-xs-12 col-sm-6 emphasis">
                                        <button type="button" class="btn btn-success btn-xs"> <i class="fa fa-user">
                                            </i> <i class="fa fa-comments-o"></i> </button>
                                        <a href="{{route('modif_utilisateur',['id'=>$utilisateur->id])}}" class="btn btn-primary btn-xs">
                                            <i class="fa fa-user"> </i> Modifier le profil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Top Profiles <small>Utilisateurs</small></h2>
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
            <div class="col-md-8 col-sm-8 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Graphe temps de connexion <small>Sessions</small></h2>
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