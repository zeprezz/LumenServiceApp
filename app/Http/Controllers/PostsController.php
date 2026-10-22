<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy("id", "DESC")->paginate(10);

        $output = [
            "message" => "posts",
            "results" => $posts
        ];

        return response()->json($posts, 200);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $post = Post::create($input);

        return response()->json($post, 200);
    }

    public function show($postId)
    {
        $post = Post::find($postId);

        return response()->json($post, 200);
    }

    public function update(Request $request, $postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'Post tidak ditemukan'
            ], 404);
        }

        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'Post tidak ditemukan'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post berhasil dihapus',
            'post_id' => $postId
        ], 200);
    }

}