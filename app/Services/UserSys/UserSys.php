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

        $user->save();

    
}

    public function Delete(){


        $user = Auth::user();

        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/storage/'. $user->avatar)) {
            unlink($_SERVER['DOCUMENT_ROOT'].'/storage/'. $user->avatar);
        }
        
        $user->destroy($user->id);
        

    }

        public function GenerateData()
    {
        $user = Auth::user();
        $filters = Filter::where('user_id', $user->id)->pluck('name')->toArray();
        $urls = Url::where('user_id', $user->id)->pluck('url')->toArray();
        $events = DB::table('events')->select('event_title', 'event_start_date', 'event_start_time', 'event_end_date', 'event_description')->get()->toArray();
        $raw = array(
            'urls' => $urls,
            'filters' => $filters,
            'events' => $events);
        $data = json_encode($raw, JSON_UNESCAPED_SLASHES);

        $fp = fopen(storage_path('rss.json'), 'w');
        fwrite($fp, $data);
        fclose($fp);


        
    }

        public function Synchronisation()
    {
        $user = Auth::user();
        $username = array($user->name );

        $filters = $user->filters->pluck('name');
        $urls = $user->urls->pluck('url');
        $avatar = $user->characters->where('choosen', '(Personnage principal)')->pluck('name');
        $events = DB::table('events')->select('event_title', 'event_start_date', 'event_start_time', 'event_end_date', 'event_description')->get()->toArray();
        $raw = array(
            "avatar" => $avatar,
            'urls' => $urls,
            'filters' => $filters,
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