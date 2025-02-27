<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = new Comments();
        $comment->user_id = Auth::id();
        $comment->post_id = $postId;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('posts.show', $postId)->with('success', 'Comment added successfully.');
    }
}