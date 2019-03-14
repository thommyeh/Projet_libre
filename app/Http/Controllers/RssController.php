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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();
        $urls = $user->urls;
        $filters = array();

foreach ($urls as $url) {
      
        foreach ( $url->filters as $filter) {
            array_push($filters, $filter->name);
        }
        
}

        return json_encode($filters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return "ça marche";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rss  $rss
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filter = Filter::where('id', $id)->get();

        return view('filter', ['filter' => $filter]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rss  $rss
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rss  $rss
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rss $rss)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rss  $rss
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rss $rss)
    {
        //
    }

    public function testou(){

         $user = Auth::user();

        $urls = Url::where('user_id', $user->id)->with('filters')->get();

         $select = Url::where('user_id',$user->id)->pluck('name','id');

        return view('rss', ['fluxs' => $urls, 'select' => $select]);
    }

    public function Urls(){

        $user = Auth::user();
        
       $urls = Url::where('user_id', $user->id)->with('filters')->get()->toArray();


return $urls;
        


       
    }

    public function newfilter()
    {
        $filters = new Filter();
        $filters->name = request('filter');
        $filters->url_id = $url->id;
        $filters->save();

        return $filters;
    }

    public function deleteflux(){

        $id = request('id');
        
        $res= Url::where('id',$id)->delete();

        return $res;

    }
}
