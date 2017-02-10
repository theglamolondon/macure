@php
    \Carbon\Carbon::setLocale('fr');
@endphp
@extends('layouts.main')

@section('content')
<div class="x_panel">
    <div class="x_title">
        <h3>Mes notifications</h3>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <ul class="messages">
        @foreach($notifications as $notification)
            <li>
                <img src="{{request()->getBaseUrl()}}/images/profile/{{(\App\IdentiteAcces::with('utilisateur','equipeTravaux')->find($notification->data['from']))->profileimage}}" class="avatar" alt="Avatar">
                <div class="message_date">
                    {{(new Carbon\Carbon($notification->updated_at))->diffForHumans()}}
                </div>
                <div class="message_wrapper">
                    <h4 class="heading">{{(\App\IdentiteAcces::with('utilisateur','equipeTravaux')->find($notification->data['from']))->name()}}</h4>
                    <blockquote class="message">{{$notification->data['message']}}.</blockquote>
                    <br />
                    <p class="url">
                        <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                        <a href="{{route('lire_notification',["notification" => $notification])}}"><i class="fa fa-paperclip"></i> Acceder au contenu ... </a>
                    </p>
                </div>
            </li>
        @endforeach
        </ul>
    </div>
</div>
@endsection