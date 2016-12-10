@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Plus Table Design</h2>
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
                <p class="text-muted font-13 m-b-30">
                    DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                </p>
                <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="check-all" class="flat"></th>
                        <th>Libellé</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td><input type="checkbox" class="flat" name="table_records"></td>
                        <td>Tiger Nixon</td>
                        <td>
                            <div class="">
                                <label>
                                    <input type="checkbox" class="js-switch" id="myPosition" onclick="switchPosition();"/> Calculer en fonction de ma position
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="">
                                <label>
                                    <input type="checkbox" class="js-switch" id="myPosition" onclick="switchPosition();"/> Calculer en fonction de ma position
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="flat" name="table_records"></td>
                        <td>Garrett Winters</td>
                        <td>
                            <div class="">
                                <label>
                                    <input type="checkbox" class="js-switch" id="myPosition" onclick="switchPosition();"/> Calculer en fonction de ma position
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="">
                                <label>
                                    <input type="checkbox" class="js-switch" id="myPosition" onclick="switchPosition();"/> Calculer en fonction de ma position
                                </label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection