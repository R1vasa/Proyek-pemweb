<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
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

    public function makeAdmin($id)
    {
        $user = User::findOrFail($id); 
        $user->role = 'admin'; 
        $user->save(); // 
        return redirect()->back()->with('success', 'User  has been promoted to admin successfully.'); 
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);
        // Set role to 'banned'
        $user->role = 'banned';
        $user->save();
        return redirect()->back()->with('success', 'User has been banned successfully.');
    }
    public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->save();
        return redirect()->back()->with('success', 'User has been unbanned successfully.');
    }
}
