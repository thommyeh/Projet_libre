<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use UserSys;


class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {
		return view('welcome');
	}

	public function profil() {

		$name = Auth::user()->name;
		$email = Auth::user()->email;

		return View('profil', ['name' => $name, 'email' => $email]);
	}

    public function edit(Request $request) {
    
    	 UserSys::EditProfil($request);

        return View('welcome');
    }
}
