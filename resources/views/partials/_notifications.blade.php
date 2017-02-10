@php
 \Carbon\Carbon::setLocale('fr');
 $notifs = $user->unreadNotifications;
@endphp
<li role="presentation" class="dropdown">
    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope-o"></i>
        <span class="badge bg-green">{{count($notifs) ==! null ? count($notifs):''}}</span>
    </a>
    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
        @foreach($notifs as $notification)
        <li>
            <a href="{{route('lire_notification',["notification" => $notification])}}">
                <span class="image">
                    <img src="{{request()->getBaseUrl()}}/images/profile/{{(\App\IdentiteAcces::with('utilisateur','equipeTravaux')->find($notification->data['from']))->profileimage}}" alt="Profile Image" />
                </span>
                <span>
                  <span>{{(\App\IdentiteAcces::with('utilisateur','equipeTravaux')->find($notification->data['from']))->name()}}</span>
                  <span class="time">{{(new Carbon\Carbon($notification->updated_at))->diffForHumans()}}</span>
                </span>
                <span class="message">
                  {{substr($notification->data['message'],0,50)}}...
                </span>
            </a>
            @if ($user->number == 10) @break @endif
        </li>
        @endforeach
        <li>
            <div class="text-center">
                <a href="{{route('mes_notifications')}}">
                    <strong>Lire toutes les notifications</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </li>
    </ul>
</li>