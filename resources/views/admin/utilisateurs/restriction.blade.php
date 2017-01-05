@extends('layouts.main')

@section('content')
    <form class="form-horizontal form-label-left" data-parsley-validate role="form" method="POST" action="{{route('restriction_utilisateur',['id' =>'#'])}}">
        {{ csrf_field() }}
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Restrictions</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
@endsection