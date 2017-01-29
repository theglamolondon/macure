<?php

namespace App\Http\Controllers\Auth;

use App\Autorisation;
use App\Http\Controllers\Controller;
use App\IdentiteAcces;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function logout(Request $request)
    {
        $error = session('errors') ? session('errors')->first('policy'):null;

        Auth::user()->totaltimeconnect += Carbon::now()->diffInMinutes(Carbon::parse(Auth::user()->lastlogin));
        Auth::user()->lastlogout = Carbon::now()->toDateTimeString();
        Auth::user()->save();
        //dd(Auth::user());

        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('login')->withErrors(['policy' => $error]);
    }

    public function username()
    {
        return 'login';
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);

        //MAJ des informations de l'identité d'accès
        $this->guard()->user();

        //routage des utilisateurs
        //$request->session()->put("user", $this->guard()->user()->getComplement());
        $authorizations = json_decode($this->guard()->user()->autorisation);

        //directeur
        if (array_search(Autorisation::DIRECTEUR, $authorizations) !== false) {
            $this->redirectTo = "/" . Autorisation::DIRECTEUR;
        } //admin
        elseif (array_search(Autorisation::ADMIN, $authorizations) !== false) {
            $this->redirectTo = "/" . Autorisation::ADMIN;
        } //rbom
        elseif (array_search(Autorisation::RBOM, $authorizations) !== false) {
            $this->redirectTo = "/" . Autorisation::RBOM;
        } //rtm
        elseif (array_search(Autorisation::RTM, $authorizations) !== false) {
            $this->redirectTo = "/" . Autorisation::RTM;
        } //equipe
        elseif (array_search(Autorisation::EQUIPE_TRAVAUX, $authorizations) !== false) {
            $this->redirectTo = "/" . Autorisation::EQUIPE_TRAVAUX;
        } //cie
        elseif (array_search(Autorisation::CIE, $authorizations) !== false) {
            $this->redirectTo = "/" . Autorisation::CIE;
        } //rgs
        elseif (array_search(Autorisation::RGS, $authorizations) !== false) {
            $this->redirectTo = "/" . Autorisation::RGS;
        }

        return $this->authenticated($request, $this->guard()->user()) ?: redirect()->intended($this->redirectPath());
    }

    public function login(Request $request)
    {
        try{
            $this->validateLogin($request);

            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            if ($this->attemptLogin($request)) {
                Auth::user()->lastlogin = Carbon::now()->toDateTimeString();
                Auth::user()->totalattemptconnect += 1;
                Auth::user()->save();
                return $this->sendLoginResponse($request);
            }

            // If the login attempt was unsuccessful we will increment the number of attempts
            // to login and redirect the user back to the login form. Of course, when this
            // user surpasses their maximum number of attempts they will get locked out.
            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        }catch(TokenMismatchException $e)
        {
            back()->withInput()->withErrors([$this->username() => "Le formulaire a expiré! Veuillez vous reconnecter à nouveau"]);
        }
    }
}
