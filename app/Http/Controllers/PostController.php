<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;

class PostController extends Controller
{
    public function index($user_uid)
    {
        $posts = Post::all();

        $likes = collect();
        foreach ($posts as $post) {
            $like_lists = [];
            $like = Like::where('post_id', $post->id)->where('user_uid', $user_uid)->first();
            if ($like == null) {
                $like = 0;
            }
            $likes_count = Like::where('post_id', $post->id)
                ->count('id');
            $like_lists['post_id'] = $post->id;
            $like_lists['like'] = $like;
            $like_lists['likes_count'] = $likes_count;
            $likes->push($like_lists);
        }

        return response()->json([
            'posts' => $posts,
            'likes' => $likes,
        ], 200);
    }

    public function getPost($user_uid, $post_id)
    {
        $post = Post::where('id', $post_id)->first();

        $like_list = [];
        $like = Like::where('post_id', $post->id)->where('user_uid', $user_uid)->first();
        if ($like == null) {
            $like = 0;
        }
        $likes_count = Like::where('post_id', $post->id)
            ->count('id');
        $like_list['post_id'] = $post->id;
        $like_list['like'] = $like;
        $like_list['likes_count'] = $likes_count;

        return response()->json([
            'post' => $post,
            'like_list' => $like_list,
        ], 200);
    }

    public function store(Request $request)
    {
        $user = User::where('uid', $request->user_uid)->first();
        $post = new Post();
        $post->user_uid = $user->uid;
        $post->name = $user->name;
        $post->post = $request->post;
        $post->save();
        return response()->json([
            'data' => $post
        ], 201);
    }

    public function delete($post_id)
    {
        $post = Post::where('id', $post_id)->delete();
        if ($post) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
}
