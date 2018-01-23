<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return response()->json($posts);
    }

    public function view($postID)
    {
        $post = Post::find($postID);
        return response()->json($post);
    }

    public function create(Request $request)
    {
        $post = Post::create($request->all());
        return response()->json($post);
    }

    public function update(Request $request , $postID)
    {
        $post = Post::find($postID);
        $post->title = $request['title'];
        $post->body = $request['body'];
        $post->views = $request['views'];
        $post->save();
        return response()->json($post);
    }

    public function delete($postID)
    {
        $post = Post::find($postID);
        $post->delete();
        return response()->json('Removed Succssefully');
    }
}