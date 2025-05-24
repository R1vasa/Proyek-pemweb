<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Like;

class PostsController extends Controller
{
    public function index()
    {
        $postData = Post::with('user')->latest()->get();
        return view('pages.index', compact('postData'));
    }

    public function get_posts()
    {
        $posts = Post::with('user')->get();
        if (request()->wantsJson()) {
            return response()->json($posts);
        }
        return $posts;
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:2200',
            'image' => 'nullable|image|max:2048',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $post->img_content = $path;
        }

        $post->save();

        return redirect()->back()->with('success', 'Post created!');
    }

    public function destroy($id)
{
    $post = Post::findOrFail($id);
    if (Auth::user()->role !== 'admin' && $post->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }
    if ($post->img_content && Storage::disk('public')->exists($post->img_content)) {
        Storage::disk('public')->delete($post->img_content);
    }

    $post->delete();

    return redirect()->back()->with('success', 'Post deleted!');
}



    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:2200',
            'image' => 'nullable|image|max:5000',
        ]);

        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->content = $request->content;

        if ($request->hasFile('image')) {

            if ($post->img_content && Storage::disk('public')->exists($post->img_content)) {
                Storage::disk('public')->delete($post->img_content);
            }
            $path = $request->file('image')->store('posts', 'public');
            $post->img_content = $path;
        }

        $post->save();

        return redirect()->back()->with('success', 'Post updated!');
    }


    public function like($id)
    {
        $post = Post::findOrFail($id);
        $userId = Auth::id();

        // Check if the user already liked this post
        $like = Like::where('user_id', $userId)->where('post_id', $id)->first();

        if ($like) {
            // Unlike
            $like->delete();
            $liked = false;
        } else {
            // Like
            Like::create([
                'user_id' => $userId,
                'post_id' => $id,

            ]);
            $liked = true;
        }

        // Return the updated like count and status
        return response()->json([
            'liked' => $liked,
            'likes_count' => Like::where('post_id', $id)->count(),
        ]);
    }

    public function get_post_by_id($id)
    {
        $post = Post::find($id);
        if (request()->wantsJson()) {
            return response()->json($post);
        }
        return $post;
    }
}
