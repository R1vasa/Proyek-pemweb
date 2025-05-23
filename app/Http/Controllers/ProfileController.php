<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)
                     ->with('user')
                     ->latest()
                     ->get();

         return view('pages.profile', compact('posts'));

    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)
                     ->latest()
                     ->get();

        $request->validate([
            'username' => 'required|string|max:255',
            'bio' => 'nullable|string|max:255',
            'profile' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile')) {
            if ($user->profile) {
                Storage::delete('public/' . $user->profile);
            }
            $user->profile = $request->file('profile')->store('profiles', 'public');
        }

        $user->username = $request->username;
        $user->bio = $request->bio;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        // Logout user first
        auth()->logout();

        if ($user->profile) {
            Storage::delete('public/' . $user->profile);
        }

        $user->delete();

        return redirect('/')->with('success', 'Account deleted.');
    }
    
}
