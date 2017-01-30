@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Graphe des BT et FPAM <small>2017</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <canvas id="mybarChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Chart.js -->
    <script src="{{request()->getBaseUrl()}}/vendors/Chart.js/dist/Chart.min.js"></script>
    <script type="text/javascript">
        var BT = new Array(12);
        var FPAM = new Array(12);

        var ctx = document.getElementById("mybarChart");
        var mybarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                datasets: [{
                    label: 'Bon de Travaux',
                    backgroundColor: "#26B99A",
                    data: [51, 30, 40, 28, 92, 50, 45, 20, 45, 89, 78, 45]
                }, {
                    label: 'FPAM',
                    backgroundColor: "#03586A",
                    data: [41, 56, 25, 48, 72, 34, 12, 55, 69, 78, 20, 101]
                }]
            },

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection