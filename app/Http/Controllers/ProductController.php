<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public static function index()
    {
        return response()->json(Product::all(),200);
    }

    public static function show($id)
    {
        return response()->json(Product::find($id));
    }
}
