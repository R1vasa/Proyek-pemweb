<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua post milik user
        $posts = posts::where('user_id', $user->id)->latest()->get();

        return view('pages.profile', [
            'posts' => $posts,
            'postCount' => $posts->count(),
            'followerCount' => 120,  // Contoh data statis
            'followingCount' => 80   // Contoh data statis
        ]);
    }
}
