<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;
use Image;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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

    public function uploadAvatar()
    {

    $user = Auth::user();
    define('UPLOAD_DIR', 'Assistant/assistants/');
    $img = request('imgBase64');
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = UPLOAD_DIR .$user->name."-". request('name').'.png';
    $success = file_put_contents($file, $data);

    return redirect()->route('home');
    }
}
