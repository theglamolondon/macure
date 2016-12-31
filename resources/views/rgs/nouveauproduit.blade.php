@extends('layouts.main')

@section('content')
    <form>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Multiple</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="select2_multiple form-control" multiple="multiple">
                    <option>Choose option</option>
                    <option>Option one</option>
                    <option>Option two</option>
                    <option>Option three</option>
                    <option>Option four</option>
                    <option>Option five</option>
                    <option>Option six</option>
                </select>
            </div>
        </div>
    </form>
@endsection

@section('scripts')

@endsection