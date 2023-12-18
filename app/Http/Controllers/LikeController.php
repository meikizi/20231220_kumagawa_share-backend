<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function like($user_uid, $post_id)
    {
        $like = new Like();
        $like->user_uid = $user_uid;
        $like->post_id = $post_id;
        $like->save();
        return response()->json([
            'message' => 'Created successfully',
        ], 200);
    }

    public function deleteLike($user_uid, $post_id)
    {
        $like = Like::where('user_uid', $user_uid)->where('post_id', $post_id)->first();
        $like->delete();
        if ($like) {
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
