<?php

namespace App\Http\Controllers;

use App\Models\User;


class UserController extends Controller
{
    
    public function index(){
        $users = User::all();
        return response()->json(compact('users'));
    }
    

    public function show($id)
{
    $user = User::where('id_user', $id)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json(compact('user'), 200);
}

}
