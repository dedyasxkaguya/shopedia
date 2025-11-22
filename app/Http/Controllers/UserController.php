<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\error;

class UserController extends Controller
{
    public static function index()
    {
        return response()->json(User::all());
    }

    public static function register(Request $request)
    {
        try{

            $data = new User;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);
            
            $data->save();
            return response()->json([
                "status"=>true,
                "message"=>"berhasil menambahkan akun dengan username " . $data->name,
                "data"=>$data
            ]);
        }catch(Exception $e){
            return response()->json([
                "status"=>false,
                "message"=>"gagal menambahkan akun",
                "data"=>$e
            ]);
        }
    }
    public static function show($id) {
        return response()->json(User::find($id));
    }
    public static function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $data = Auth::attempt($credentials);
        if(!$data){
            return response()->json("Akun tidak ditemukan");
        }
        $account = User::where('email' ,  $request->email)->first();
        return response()->json([
            "status"=>$data,
            "data"=> $account
            ]
        );
    }
}
