<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        return view('index');
        // $user = Auth::user();
        // $posts = posts::where('user_id', $user->id)->latest()->get();
        // return view('pages.profile', compact('posts'));
    }

    public function get_posts()
    {
        $posts = Post::with('user')->get();
        if (request()->wantsJson()) {
            return response()->json($posts);
        }
        return $posts;
    }

    public function get_post_by_id($id)
    {
        $post = Post::find($id);
        if (request()->wantsJson()) {
            return response()->json($post);
        }
        return $post;
    }

    public function myPosts()
    {
        $user = Auth::user();

        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('pages.profile', compact('posts'));
    }


}