<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;

class DesignerController extends Controller
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
    public function designer()
    {
        return view('designer');
    }

    public function store()
    {
        $user = Auth::user();
        $character = new Character();
        $character->name = request('name');
        $character->user_id = $user->id;
        $character->save();
    }

    public function uploadAvatar(Request $request)
    {
        $image = Image::make($request->get('imgBase64'));
        $image->save('public/avatar.jpg');
    }
}
