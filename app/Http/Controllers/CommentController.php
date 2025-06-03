<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|min:1|max:2000',
        ]);
        
        $comment = $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
            "post_id" => $post->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'comment added  successfully', 
            'data' => $comment
        ], 201);
    }
}
