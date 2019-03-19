<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Image;
use UserSys;
use Latfur\Event\Models\Event;
use App\Filter;
use App\Url;

class RssController extends Controller
{
    
        public function index(){

      

        return view('rss');
    }

         public function createRss()
    {
        $url = new Url();
        $url->name = request('name');
        $url->url = request('url');
        $url->user_id = Auth::user()->id;
        $url->save();
      

        return true;
    }

        public function createFilter()
    {
   
        $filters = new Filter();
        $filters->name = request('filtres');
        $filters->user_id = Auth::user()->id;
        $filters->save();

        return true;
    }

   
        public function RssData(){

        $user = Auth::user();
        
        $urls = Url::where('user_id', $user->id)->get()->toArray();


        return $urls;
        
    }

        public function FiltersData(){

        $user = Auth::user();
        
        $filters = Filter::where('user_id', $user->id)->get()->toArray();


        return $filters;
        
    }

        public function GenerateData(){

        $user = Auth::user();
        $filters = Filter::where('user_id', $user->id)->pluck('name')->toArray();
        $urls = Url::where('user_id', $user->id)->pluck('url')->toArray();
        //$events = Event::where('user_id', $user->id)->get()->toArray();
        $events = DB::table('events')->select('event_title', 'event_start_date','event_start_time', 'event_end_date', 'event_description')->get()->toArray();
        $raw = array(
            'urls' => $urls,
            'filters' => $filters,
            'events' => $events);
        $data = json_encode($raw, JSON_UNESCAPED_SLASHES);

        $fp = fopen(storage_path('rss.json'), 'w');
        fwrite($fp, $data);
        fclose($fp);


        return $data;
        
    }


    public function deleteflux(){

        $id = request('id');
        
        $res= Url::where('id',$id)->delete();

        return true;

    }

        public function deletefilter(){

        $id = request('id');
        
        $res= Filter::where('id',$id)->delete();

        return true;

    }
}
