<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Image;
use UserSys;
use Latfur\Event\Models\Event;
use App\Filter;
use App\Url;
use App\Http\Requests\UrlRequest;

class RssFiltreController extends Controller
{
    public function index()
    {
        return view('rssfiltre');
    }

    public function createRss(UrlRequest $request)
    {
        $valid = $request->validated();

        $url = new Url();
        $url->name = $valid['name'];
        $url->url = $valid['url'];
        $url->user_id = Auth::user()->id;
        $url->save();


        return 'Le flux a été correctement ajouté';
    }

    public function createFilter()
    {
        $filters = new Filter();
        $filters->name = request('filtres');
        $filters->user_id = Auth::user()->id;
        $filters->save();

        return true;
    }


    public function RssData()
    {
        $user = Auth::user();

        $urls = $user->urls;

        


        return $urls;
    }

    public function FiltersData()
    {
        $user = Auth::user();

        $filters = $user->filters;

        


        return $filters;
    }

    public function Synchro()
    {
        $user = Auth::user();
        $filters = $user->filters->pluck('name');
        $urls = $user->urls->pluck('url');
        $events = DB::table('events')->select('event_title', 'event_start_date', 'event_start_time', 'event_end_date', 'event_description')->get()->toArray();
        $raw = array(
            'urls' => $urls,
            'filters' => $filters,
            'events' => $events);
        $data = json_encode($raw, JSON_UNESCAPED_SLASHES);

        $fp = fopen(storage_path('rss.json'), 'w');
        fwrite($fp, $data);
        fclose($fp);
        
        return true;


        
    }


    public function deleteflux()
    {
        $id = request('id');

        $res= Url::where('id', $id)->delete();

        return true;
    }

    public function deletefilter()
    {
        $id = request('id');

        $res= Filter::where('id', $id)->delete();

        return true;
    }
}
