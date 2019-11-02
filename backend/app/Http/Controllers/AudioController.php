<?php

namespace App\Http\Controllers;

use Helpers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB as DB;

class AudioController extends BaseController
{
    public function index()
    {
        
        $mediaItems = DB::table('media_items')->limit(20)->get();
        return response()->json($mediaItems);
    }

    public function create(Request $request)
    {
        return response()->json('{action:"create"}');
    }
    public function show($id)
    {
        $mediaItems = DB::table('media_items')->where('id', $id)->first();
        return response()->json($mediaItems);
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
