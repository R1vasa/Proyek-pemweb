<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Insert a new comment
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }

    // Update a comment
    public function update(Request $request, $id)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    $comment = Comment::findOrFail($id);

    if ($comment->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
        abort(403, 'Unauthorized action.');
    }

    $comment->comment = $request->comment;
    $comment->save();

    return redirect()->back()->with('success', 'Comment updated!');
}


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('home')->with('success', 'Komentar berhasil dihapus.');
    }
}