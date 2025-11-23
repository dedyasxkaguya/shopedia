<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static function storeData(Request $request)
    {
        $image = $request->file('image')->store('post-images');
        $data = new Product();
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->image = $image;
        $data->category = 'local';
        $data->rating_rate = 5;
        $data->rating_count = 100;

        $data->save();
        return response()->json([
            "status"=>true,
            "data"=>$data
        ]);
    }

    public static function index()
    {
        return response()->json(Product::all(), 200);
    }

    public static function show($id)
    {
        return response()->json(Product::find($id));
    }
}
