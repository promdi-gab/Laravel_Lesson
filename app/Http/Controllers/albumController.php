<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Album;
use \App\Models\Artist;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class albumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = DB::table('artists')->join('albums', 'artists.id', 'albums.artist_id')->get();
        return View::make('album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Artist::pluck('artist_name', 'id');
        return View::make('album.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //option1
        //dd($request->title);

        //====================================
        //option2

        // $title = $request->title;
        // $artist = $request->artist;
        // $genre = $request->genre;
        // $year = $request->year;

        // $album = New Album;
        // $album->title = $title;
        // $album->artist = $artist;
        // $album->genre = $genre;
        // $album->year = $year;
        // $album->save();
        // return Redirect::to('/album');  
        //====================================
        //option3
        //dd($request->all());
        $input = $request->all();
        $request->validate([
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
        ]);

        if($request->hasFile('image')) {
            $file = $request->file('image') ;
            // $fileName = uniqid().'_'.$file->getClientOriginalName();
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            // dd($fileName);
            $input['img_path'] = 'images/'.$fileName;
            $album = Album::create($input);
            $file->move($destinationPath,$fileName);
        }
        return Redirect::to('/album')->with('success', 'New Album Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);
        $artists = Artist::pluck('artist_name', 'id');
        return View::make('album.edit', compact('album', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $album = Album::find($id);
        $album->update($request->all());
        return Redirect::to('album')->with('success', 'New Album Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$album = Album::find($id);
        //$album->delete();
        Album::destroy($id);
        return Redirect::to('album')->with('success', 'Album deleted!');
    }
}
