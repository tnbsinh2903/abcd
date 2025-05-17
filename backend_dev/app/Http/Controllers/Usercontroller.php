<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    //
    public function index()
    {
        // $users = User::all();
        return "ahahah";
    }
    public function create(Request $request)
    {
        try {
            $data = $request->all();
            // dd($data);
            $data['password'] = bcrypt($data['mat_khau']); // hoặc 'password' nếu sửa key JSON

            User::create($data);

            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
