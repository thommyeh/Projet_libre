<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Avatar;

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
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {

        $social = Socialite::driver($provider)->stateless()->user();
        $date = date('Y/m/d h:i:s', time());
        
        $user = User::where('email', $social->email)->first();
        if (!is_null($user)){
            auth()->login($user, true);
            auth()->user()->update([
                'provider' => $provider,
                'provider_id' => $social->id
            ]);
            return redirect('/')->with("primary", "Hey <strong>$user->name</strong>! bienvenue et amusez-vous bien: ;-)");
        }else{
                
           
            $user = User::create([
                'name' => $social->nickname,
                'email' => $social->email,
                'provider' => $provider,
                'provider_id' => $social->id,
                'email_verified_at' => $date,
                'published' => 'false',
                'avatar' => $social->avatar,
                

            ]);
            
          
            auth()->login($user, true);  // Je connecte l'utilisateur
            return redirect('/home')->with("royal", "Bienvenue $user->name, votre compte a bien été crée! Nous vous conseillons de choisir un mot de passe afin de sécuriser votre compte");
        }
    }
}
