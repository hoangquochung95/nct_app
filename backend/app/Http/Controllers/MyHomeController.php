<?php

namespace App\Http\Controllers;

use Helpers;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB as DB;

class MyHomeController extends BaseController
{
    public function index()
    {
        $mediaItems = DB::table('media_items')->limit(9)->get();
        $playlists = DB::table('playlist_items')->limit(9)->get();

        return response()->json(['mediaItems'=>$mediaItems,'playlist'=>$playlists]);
    }

    public function create(Request $request)
    {
        // $product = new Product;
        // $product->name = $request->name;
        // $product->price = $request->price;
        // $product->description = $request->description;

        // $product->save();
        return response()->json('{action:"create"}');
    }
    public function show($id)
    {
        // $product = Product::find($id);
        return response()->json('{action:"show"}');
    }
    public function update(Request $request, $id)
    {
        // $product = Product::find($id);

        // $product->name = $request->input('name');
        // $product->price = $request->input('price');
        // $product->description = $request->input('description');
        // $product->save();
        return response()->json('{action:"update"}');
    }
    public function destroy($id)
    {
        // $product = Product::find($id);
        // $product->delete();
        return response()->json('product removed successfully');
    }
}
