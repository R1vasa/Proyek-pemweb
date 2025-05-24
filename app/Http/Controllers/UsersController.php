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
       try {
           $user = User::findOrFail($id);
           $user->role = 'admin';
           $user->save();
           return redirect()->back()->with('success', 'User  has been promoted to admin successfully.');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors('Failed to promote user: ' . $e->getMessage());
       }
   }

   public function ban($id)
   {
       try {
           $user = User::findOrFail($id);
           $user->role = 'banned';
           $user->save();
           return redirect()->back()->with('success', 'User  has been banned successfully.');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors('Failed to ban user: ' . $e->getMessage());
       }
   }

   public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->save();
        return redirect()->back()->with('success', 'User has been unbanned successfully.');
    }
   public function destroy($id)
   {
       try {
           $user = User::findOrFail($id);
           $user->delete();
           return redirect()->back()->with('success', 'User  has been deleted successfully.');
       } catch (\Exception $e) {
           return redirect()->back()->withErrors('Failed to delete user: ' . $e->getMessage());
       }
   }
   
}
