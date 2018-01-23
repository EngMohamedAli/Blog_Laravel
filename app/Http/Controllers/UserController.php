<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Hashing\BcryptHasher;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    public function view($userID)
    {
        $user = User::find($userID);
        return response()->json($user);
    }

    public function create(Request $request)
    {
        $request['password'] = app('hash')->make($request['password']);
        $request['api_token'] = str_random(60);
        $user = User::create($request->all());
        return response()->json($user);
    }

    public function update(Request $request , $userID)
    {
        $user = User::find($userID);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = app('hash')->make($request['password']);
        $user->save();
        return response()->json($user);
    }

    public function delete($userID)
    {
        $user = User::find($userID);
        $user->delete();
        return response()->json('Removed Succssefully');
    }
}