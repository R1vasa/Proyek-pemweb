<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        return view('pages/index');
    }

    public function get_user()
    {
        $users = User::all();
        if (request()->wantsJson()) {
            return response()->json($users);
        }
        return $users;
    }

    public function get_user_by_id($id)
    {
        $user = User::find($id);
        if (request()->wantsJson()) {
            return response()->json($user);
        }
        return $user;
    }
}
