<?php

namespace App\Http\Controllers;

use Helpers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB as DB;

class PlaylistController extends BaseController
{
    public function index()
    {
        
        $playlists = DB::table('playlist_items')->limit(20)->get();
        return response()->json( $playlists);
    }

    public function create(Request $request)
    {
        return response()->json('{action:"create"}');
    }
    public function show($id)
    {
        
        $playlists = DB::table('playlist_items')->where('id',$id)->first();
        $medias = json_decode($playlists->medias);
        $mediaList = array();
        foreach($medias as $media){
            $item = DB::table('media_items')->where('id',$media)->first();
            $mediaList[] = array("id"=>$item->id,"title" => $item->title, "artists" => $item->artists);
        }
        return response()->json([$playlists,$mediaList]);
    }
    public function update(Request $request, $id)
    {
        return response()->json('{action:"update"}');
    }
    public function destroy($id)
    {
        return response()->json('product removed successfully');
    }
}
