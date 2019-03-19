<?php
namespace App\Services\UserSys;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;


class UserSys {

	public function EditProfil($request) {
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

            if (file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/'. $user->avatar)) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/storage/'. $user->avatar);
        }

        	$type = $request->file('avatar')->extension();
            $img = Image::make(realpath($request->file('avatar')));
            $img->resize(320, 240);
            $img->save('storage/'.$user->name.'.'.$type);
            $user->avatar = $user->name.'.'.$type;

        }

        $user->save();

    
}

    public function Delete(){


        $user = Auth::user();

        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/'. $user->avatar)) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/storage/'. $user->avatar);
        }
        
        $user->destroy($user->id);
        

    }

}