<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Character;
use Image;
use Illuminate\Support\Facades\Storage;
use File;
use View;
use App\Http\Requests\characterNameRequest;

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

    public function store(characterNameRequest $request)
    {
        $valid = $request->validated();
        $user = Auth::user();
        $perso = Character::where('user_id', $user->id)->get();
        $character = new Character();
        $character->name = $valid['name'];
        $character->user_id = $user->id;
        if ($perso->isEmpty()) {
            $character->choosen = "(Personnage principal)";
        }
        else{
             $character->choosen = null;
        }
       
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
