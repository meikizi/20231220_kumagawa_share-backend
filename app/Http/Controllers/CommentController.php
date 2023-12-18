<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller
{
    public function getComment($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->get();

        return response()->json([
            'comments' => $comments,
        ], 200);
    }

    public function comment(Request $request)
    {
        $user = User::where('uid', $request->user_uid)->first();
        $comment = new Comment();
        $comment->user_uid = $user->uid;
        $comment->post_id = $request->post_id;
        $comment->name = $user->name;
        $comment->comment = $request->comment;
        $comment->save();
        return response()->json([
            'data' => $comment
        ], 201);
    }
}
