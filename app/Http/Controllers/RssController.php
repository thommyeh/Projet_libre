<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
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

         $user = Auth::user();

        $urls = Url::where('user_id', $user->id)->with('filters')->get();

         $select = Url::where('user_id',$user->id)->pluck('name','id');

        return view('rss', ['fluxs' => $urls, 'select' => $select]);
    }

         public function create()
    {
        $url = new Url();
        $url->name = request('name');
        $url->url = request('url');
        $url->user_id = Auth::user()->id;
        $url->save();
        $filters = new Filter();
        $filters->name = request('filtres');
        $filters->url_id = $url->id;
        $filters->save();

        return true;
    }

   
        public function RssData(){

        $user = Auth::user();
        
        $urls = Url::where('user_id', $user->id)->with('filters')->get()->toArray();


        return $urls;
        
    }


    public function deleteflux(){

        $id = request('id');
        
        $res= Url::where('id',$id)->delete();

        return true;

    }
}
