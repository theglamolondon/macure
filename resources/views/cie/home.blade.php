@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>CIE</h1>
        @if(session('user')->hasRole(\App\Autorisation::RTM))
            <p>You have a Rigth</p>
        @endif
    </div>
@endsection