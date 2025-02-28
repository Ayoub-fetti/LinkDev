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

        $post = Posts::findOrFail($postId);

        $comment = new Comments();
        $comment->user_id = Auth::id();
        $comment->post_id = $postId; 
        $comment->content = $request->input('content');
        $comment->date_commentaire = now();
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    public function destroy($commentId)
    {
        $comment = Comments::findOrFail($commentId);

        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
   
}
