<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Artist;
use App\Models\Album;

class artistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = DB::table('artists')
            ->leftJoin('albums', 'artists.id', '=', 'albums.artist_id')
            ->select('artists.id', 'albums.album_name', 'artists.artist_name','artists.img_path')
            ->get();

        return View::make('artist.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('artist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $input = $request->all();
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if($file = $request->hasFile('image')) {
            
            $file = $request->file('image') ;
            // $fileName = uniqid().'_'.$file->getClientOriginalName();
            $fileName = $file->getClientOriginalName();
            // dd($fileName);
            $request->image->storeAs('images', $fileName, 'public');
            $input['img_path'] = 'images/'.$fileName;
            $artist = Artist::create($input);
            // $file->move($destinationPath,$fileName);
        }
        return Redirect::to('artist');
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
        $artist = Artist::find($id);
        // dd($artists);
        return View::make('artist.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $artist = Artist::find($id);
        $artist->update($req->all());
        return Redirect::to('artist')->with('success', 'New Artist Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Album::where('artist_id', $id)->delete();
        Artist::destroy($id);
        return Redirect::to('/artist')->with('success', 'artist deleted!');
    }
}
