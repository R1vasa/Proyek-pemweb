<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('post.comments', ['id' => $request->post_id])
                     ->with('success', 'Comment added!');
    }

    // Update comment
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:2200',
        ]);

        $comment = Comment::findOrFail($id);

        // Cek hak akses user (hanya pemilik komentar atau admin)
        if (Auth::id() !== $comment->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', 'Komentar berhasil diperbarui');
    }

    // Delete comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Cek hak akses user (hanya pemilik komentar atau admin)
        if (Auth::id() !== $comment->user_id && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Hapus gambar jika ada
        if ($comment->img_content && Storage::disk('public')->exists($comment->img_content)) {
            Storage::disk('public')->delete($comment->img_content);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
