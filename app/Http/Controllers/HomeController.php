<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;


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
        $user = Auth::user();
        if ($request->input('name') != '') {
            $user->name = $request->input('name');
        }
        if ($request->input('email') != '') {
            $user->email = $request->input('email');
        }
       
        if ($request->input('password') != '') {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('avatar')) {

        	$type = $request->file('avatar')->extension();
            $img = Image::make(realpath($request->file('avatar')));
            $img->resize(320, 240);
            $img->save('img/'.$request->input('name').'.'.$type);
            $user->avatar = $request->input('name').'.'.$type;

    
}
        $user->save();
        return View('welcome');
    }
}
