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
        return view('welcome');
    }

    public function editeur()
    {
        $imgArray =  File::files('./img/');
        $imgPath = [];
        $imgLoader = [];
        foreach ($imgArray as $path) {
            $imgPath = pathinfo($path);
            $imgName = $imgPath['filename'];
            $imgLoader[] = $imgName;
        }

        return View::make('editeur', array('imgLoader' => $imgLoader));
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
    //Renvoi les events d'un user en Json
    public function test()
    {

        /*$user = Auth::user();

        $comments = $user->events;

        $test = json_encode($comments);
        return $test;*/
        return view('test');
    }
    public function profileAccount()
    {
        return View('profileAccount');
    }
    public function pageProfil()
    {
        return View('pageProfil');
    }

    public function ProfilData()
    {
        $user = Auth::user()->toArray();

        return $user;
    }
}
