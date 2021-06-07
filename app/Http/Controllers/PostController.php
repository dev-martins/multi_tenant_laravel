<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Post::get(), 200);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()], 500);
        }
    }

    public function createPost(Request $request)
    {
        try {
            $post = auth()->user();
            $post->posts()->create($request->all());
            return response()->json(['msg' => 'Post cadastrado!'], 201);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage(), 'line' => $th->getLine()], 500);
        }
    }
}
