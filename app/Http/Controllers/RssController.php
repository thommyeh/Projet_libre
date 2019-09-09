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
use App\Character;

class RssController extends Controller
{
    public function index()
    {
        return view('rss');
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
        UserSys::Synchronisation();
        
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

    public function chooseAvatar($id)
    {
        $user = Auth::user();
        $characters = Character::where('id', '>', 0)->update(['choosen'=>'']);
        $character = Character::find($id);
        $character->choosen = '(Personnage principal)';
        $character->save();
        UserSys::Synchronisation();
        return redirect()->route('pageProfil');
       

    }
}
