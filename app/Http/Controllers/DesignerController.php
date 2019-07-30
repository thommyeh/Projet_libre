<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user->character_name = request('name');
        $user->character_date = date('Y-m-d H:i:s');
        $user->save();
    }
}
