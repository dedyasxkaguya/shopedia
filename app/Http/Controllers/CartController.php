<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    public static function index()
    {
        return response()->json(Cart::all());
    }

    public static function show($id)
    {
        return response()->json(Cart::find($id));
    }
    public static function userCart($id){
        return response()->json(Cart::where('user_id',$id)->get());
    }
    public static function storeData(Request $request)
    {
        $allData = Cart::where("user_id",$request->user_id)->get();
        $quantities= 0;
        foreach($allData as $data){
            if($data->name == $request->name){
                $quantities = $data->quantities+1;
                $data->quantities = $quantities;

                $data->update();
                return response()->json($data);
            }
        }
        try {
            $data = new Cart;
            $data->name = $request->name;
            $data->category = $request->category;
            $data->user_id = $request->user_id;
            $data->price = $request->price;
            $data->quantities = 1;
            $data->image = $request->image;
            // $data->quantity = $request->quantity;

            $data->save();

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'data' => $e,
            ]);
        }
    }
}
