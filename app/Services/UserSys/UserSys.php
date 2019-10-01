<?php
namespace App\Services\UserSys;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Image;
use Latfur\Event\Models\Event;
use App\Filter;
use App\Url;
use App\Http\Requests\UrlRequest;


class UserSys {

	public function EditProfil($request) {
        $user = Auth::user();
        if ($request->input('name') != '') {
        $dir = 'Assistant/assistants/';
        $scan = scandir($dir);
        foreach ($scan as $item) {
            $name = explode('-', $item);
            if ($name[0] == $user->name) {
                rename($dir.$item, $dir.$request->input('name')."-". $name[1]);
            }
        }
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
            $user->avatar = 'storage/'.$user->name.'.'.$type;

        }
        $this->Synchronisation();
        $user->save();

    
}

    public function Delete(){


        $user = Auth::user();
        $dir = 'Assistant/assistants/';
        $scan = scandir($dir);
        foreach ($scan as $item) {
            $name = explode('-', $item);
            if ($name[0] == $user->name) {
                unlink($dir.$item);
            }
        }

        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/'. $user->avatar)) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/storage/'. $user->avatar);
        }
    

        
        $user->destroy($user->id);
        

    }

        public function Synchronisation()
    {
        $user = Auth::user();
        $username = array($user->name );

        $filtres_actus = $user->filters->where('type', 'actu')->pluck('name');
        $filtres_telechargements = $user->filters->where('type', 'telechargement')->pluck('name');
        $actus = $user->urls->where('type', 'actu')->pluck('url');
        $telechargements = $user->urls->where('type', 'telechargement')->pluck('url');
        $avatar = $user->characters->where('choosen', '(Personnage principal)')->pluck('name');
        $events = DB::table('events')->select('event_title', 'event_start_date', 'event_start_time', 'event_end_date', 'event_description')->get()->toArray();
        $raw = array(
            "avatar" => $avatar,
            "actus" => $actus,
            "telechargements" => $telechargements,
            "filtres_actus" => $filtres_actus,
            "filtres_telechargements" => $filtres_telechargements,
            'events' => $events);
        $data = json_encode($raw, JSON_UNESCAPED_SLASHES);

        $fp = fopen('Assistant/data/'.$user->name.'-rss.json', 'w');
        fwrite($fp, $data);
        fclose($fp);

        $userTab = array(
            "username" => $username
           );
        $userdata = json_encode($userTab, JSON_UNESCAPED_SLASHES);

        $fp1 = fopen('Assistant/data/username.json', 'w');
        fwrite($fp1, $userdata);
        fclose($fp1);
        
       


        
    }

}