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
use App\DefaultFilters;
use App\Http\Requests\UrlRequest;
use App\Character;

class RssController extends Controller
{
    public function urls()
    {
        return view('rss');
    }

    public function filtres()
    {
        return view('rssfiltre');
    }

    public function suggestions()
    {
        return view('defaultFilters');
    }

    public function newUrl(UrlRequest $request)
    {
        $valid = $request->validated();

        $url = new Url();
        $url->name = $valid['name'];
        $url->url = $valid['url'];
        $url->user_id = Auth::user()->id;
        $url->type = $valid['type'];
        $url->save();

        return 'Le flux a été correctement ajouté';
    }

    public function addUrl()
    {
        $id = request('id');
        $default = DefaultFilters::find($id);

        $url = new Url();
        $url->name = $default->name;
        $url->url = $default->url;
        $url->user_id = Auth::user()->id;
        $url->type = $default->type;
        $url->save();

        return 'Le flux a été correctement ajouté';
    }

    public function createFilter()
    {
        $filters = new Filter();
        $filters->name = request('filtres');
        $filters->type = request('type');
        $filters->user_id = Auth::user()->id;
        $filters->save();

        return true;
    }

    public function urlData()
    {
        $user = Auth::user();

        $urls = $user->urls;

        return $urls;
    }

    public function filtersData()
    {
        $user = Auth::user();

        $filters = $user->filters;

        return $filters;
    }

    public function defaultFilters()
    {
        $defaultfilters = DefaultFilters::all();

        return $defaultfilters;
    }

    public function synchro()
    {
        UserSys::Synchronisation();
    }

    public function deleteflux()
    {
        $id = request('id');

        $res = Url::where('id', $id)->delete();

        return true;
    }

    public function deletefilter()
    {
        $id = request('id');

        $res = Filter::where('id', $id)->delete();

        return true;
    }
}
