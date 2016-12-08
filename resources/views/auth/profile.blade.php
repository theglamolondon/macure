@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>USER PROFILE</h1>
        <p>
            {{session('user')}}
        </p>
    </div>
@endsection