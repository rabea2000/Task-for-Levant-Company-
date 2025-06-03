<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])->get();

        return response()->json([
            'success' => true,
            'message' => ' list of posts ',
            'data' => $posts
        ]);
    }

    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('image')) {
            $filepath = Storage::disk('public')->put('/PostPictures', $request->file("image"));
        }

        $post = $request->user()->posts()->create([
            "title" => $request->title ,
            "content" => $request->content, 
            "image" => $filepath ?? null 
        ]);

        // Trigger PostCreated event

        event(new PostCreated($post));

        return response()->json([
            'success' => true,
            "message" => " post has add successfuly",
            'data' => $post
        ], 200);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {


        $post->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Post update successfully',
            'data' => $post
        ]);
    }

    public function destroy(Post $post)
    {

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully'
        ]);
    }
}
