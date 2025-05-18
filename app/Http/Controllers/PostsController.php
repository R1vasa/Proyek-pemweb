<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return view('pages/index');
    }

    public function get_posts()
    {
        $posts = posts::with('user')->get();
        if (request()->wantsJson()) {
            return response()->json($posts);
        }
        return $posts;
    }

    public function get_post_by_id($id)
    {
        $post = posts::find($id);
        if (request()->wantsJson()) {
            return response()->json($post);
        }
        return $post;
    }
}
