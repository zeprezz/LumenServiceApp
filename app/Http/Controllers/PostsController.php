<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if (
            $acceptHeader === 'application/json' ||
            $acceptHeader === 'application/xml'
        ) {
            $posts = Post::orderBy('id', 'DESC')->paginate(10);

            if ($acceptHeader === 'application/json') {
                return response()->json($posts->items(), 200);
            } else {
                $xml = new \SimpleXMLElement('<posts/>');

                foreach ($posts->items() as $item) {
                    $xmlItem = $xml->addChild('post');

                    $this->addPostFields($xmlItem, $item);
                }

                return response($xml->asXML(), 200)
                    ->header('Content-Type', 'application/xml');
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if (
            $acceptHeader === 'application/json' ||
            $acceptHeader === 'application/xml'
        ) {
            $contentTypeHeader = $request->header('Content-Type');

            if ($contentTypeHeader === 'application/json') {
                $input = $request->all();
                $post = Post::create($input);

                return $this->responsePost($post, $acceptHeader);
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    public function show(Request $request, $postId)
    {
        $acceptHeader = $request->header('Accept');

        if (
            $acceptHeader === 'application/json' ||
            $acceptHeader === 'application/xml'
        ) {
            $post = Post::find($postId);

            if (!$post) {
                return response('Post tidak ditemukan', 404);
            }

            return $this->responsePost($post, $acceptHeader);
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    public function update(Request $request, $postId)
    {
        $acceptHeader = $request->header('Accept');

        if (
            $acceptHeader === 'application/json' ||
            $acceptHeader === 'application/xml'
        ) {
            $contentTypeHeader = $request->header('Content-Type');

            if ($contentTypeHeader === 'application/json') {
                $post = Post::find($postId);

                if (!$post) {
                    return response('Post tidak ditemukan', 404);
                }

                $post->update($request->all());

                return $this->responsePost($post, $acceptHeader);
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    public function destroy(Request $request, $postId)
    {
        $acceptHeader = $request->header('Accept');

        if (
            $acceptHeader === 'application/json' ||
            $acceptHeader === 'application/xml'
        ) {
            $post = Post::find($postId);

            if (!$post) {
                return response('Post tidak ditemukan', 404);
            }

            $post->delete();

            if ($acceptHeader === 'application/json') {
                return response()->json([
                    'message' => 'Post berhasil dihapus',
                    'post_id' => $postId
                ], 200);
            } else {
                $xml = new \SimpleXMLElement('<response/>');

                $xml->addChild('message', 'Post berhasil dihapus');
                $xml->addChild('post_id', $post->id);

                return response($xml->asXML(), 200)
                    ->header('Content-Type', 'application/xml');
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    /**
     * Mengembalikan satu post dalam format JSON atau XML.
     */
    private function responsePost($post, $acceptHeader)
    {
        if ($acceptHeader === 'application/json') {
            return response()->json($post, 200);
        } else {
            $xml = new \SimpleXMLElement('<post/>');

            $this->addPostFields($xml, $post);

            return response($xml->asXML(), 200)
                ->header('Content-Type', 'application/xml');
        }
    }

    /**
     * Menambahkan field post ke elemen XML.
     */
    private function addPostFields($xml, $post)
    {
        $fields = [
            'id',
            'title',
            'status',
            'content',
            'user_id',
            'created_at',
            'updated_at'
        ];

        foreach ($fields as $field) {
            $value = htmlspecialchars(
                (string) $post->{$field},
                ENT_XML1 | ENT_QUOTES,
                'UTF-8'
            );

            $xml->addChild($field, $value);
        }
    }
}