<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use UserSys;
use File;
use View;
use Latfur\Event\Models\Event;
use App\Character;
use App\Article;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
       return view('home');
    }

    public function RGPD()
    {
        return view('RGPD');
    }

    public function legals()
    {
        return view('legals');
    }


    public function profil()
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;

        return View('profil', ['name' => $name, 'email' => $email]);
    }

    public function edit(Request $request)
    {
        UserSys::EditProfil($request);

        return View('welcome');
    }

    public function delete()
    {
        UserSys::Delete();
        Auth::logout();

        return View('DeleteConfirm');
    }

    public function profileAccount()
    {
        return View('profileAccount');
    }
    public function pageProfil()
    {
        $user = Auth::user();
        $characters = $user->characters;

        return view('pageProfil', ['characters' => $characters, 'user'=> $user]);
    }


        public function deleteCharacter($id)
    {
        $user = Auth::user();
        $username = $user->name;
        $character = Character::find($id);

        $character->delete();
        unlink('Assistant/assistants/'.$user->name."-".$character->name.'.png');

        return redirect()->route('pageProfil');


    }

    public function useCharacter($id)
    {

        $user = Auth::user();
        $username = $user->name;
        $character = Character::find($id);
        $user->avatar = 'Assistant/assistants/'.$user->name."-".$character->name.'.png';
        $user->save();
        return redirect()->route('pageProfil');

    }

        public function chooseCharacter($id)
    {
        $user = Auth::user();
        $characters = Character::where('id', '>', 0)->update(['choosen'=>'']);
        $character = Character::find($id);
        $character->choosen = '(Personnage principal)';
        $character->save();
        UserSys::Synchronisation();
        return redirect()->route('pageProfil');
       

    }


}
