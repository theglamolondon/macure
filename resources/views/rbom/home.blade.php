@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>RBOM</h1>
        @if(session('user')->hasRole(\App\Autorisation::AGENT_BE))
            <p>You have a Rigth</p>
        @endif
    </div>
@endsection