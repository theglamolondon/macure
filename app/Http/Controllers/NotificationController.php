<?php

namespace App\Http\Controllers;

use App\Autorisation;
use App\Http\HelperFunctions;
use App\IdentiteAcces;
use App\Notifications\WorkFlow;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    use HelperFunctions;
    /**
     * Display a listing notifications.
     *
     * @param  IdentiteAcces $user
     * @return \Illuminate\Http\Response
     */
    public function index()
    {//IdentiteAcces $user
        dd(Auth::user());
        return view('back.notifications.index', compact('user'));
    }

    /**
     * Update the notification.
     *
     * @param  Request $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DatabaseNotification $notification)
    {
        //Notification de l'utilisateur
        $this->withNotification($notification->data['message']);

        $notification->markAsRead();
        return redirect($notification->data['link']);
    }

    private function sendNotification(Collection $users, string $message, string $link)
    {
        Notification::send($users,new WorkFlow($message,$link));
    }

    public function addNewCommentForUser(Request $request)
    {
        $this->validate($request,["message" => "required"],["message.required" => "Votre message est requis pour la notification aux utilisateurs"]);

        //CIE -> DIRECTEUR
        if(Auth::user()->hasRole(Autorisation::CIE)){
            $users = IdentiteAcces::where('autorisation','like','%'.Autorisation::DIRECTEUR.'%')->get();
            $this->sendNotification($users,$request->input('message'),back()->getTargetUrl());
            $this->withSuccess('Notification envoyé avec succès');
            return back();
        }

        //Directeur -> RBOM & RTM
        if(Auth::user()->hasRole(Autorisation::DIRECTEUR)){
            $users = IdentiteAcces::where('autorisation','like','%'.Autorisation::RTM.'%')->orWhere('autorisation','like','%'.Autorisation::RBOM.'%')->get();
            $this->sendNotification($users,$request->input('message'),back()->getTargetUrl());
            $this->withSuccess('Notification envoyé avec succès');
            return back();
        }

        //RBOM -> RTM || RTM -> RBOM
        if(Auth::user()->hasRole(Autorisation::RTM) || Auth::user()->hasRole(Autorisation::RBOM)){
            $users = IdentiteAcces::where('autorisation','like','%'.Autorisation::RTM.'%')->orWhere('autorisation','like','%'.Autorisation::RBOM.'%')->get();
            $this->sendNotification($users,$request->input('message'),back()->getTargetUrl());
            $this->withSuccess('Notification envoyé avec succès');
            return back();
        }
    }

}
