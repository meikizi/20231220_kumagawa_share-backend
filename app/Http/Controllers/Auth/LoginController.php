<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class LoginController extends Controller
{
    // ログインの処理
    public function login(Request $request)
    {
        // 新規登録の場合はユーザーUIDを設定し、登録済みの場合は該当するUserモデルを取得する。
        // インスタンスを作成するだけなので、まだレコードとして記録されていません。
        $user = User::firstOrNew(['uid' => $request->uid]);

        // 新規登録の場合はユーザーを作成してデータベースに保存する。
        if (!$user->exists) {
            $user = $this->createUser($user, $request);
        }

        // ログイン
        Auth::login($user);

        // Nuxtにレスポンスを返す、
        return response()->json([
            'uid' => $request->uid,
        ]);
    }

    // ユーザーの作成とデータベースに保存
    public function createUser(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->save();

        return User::where('uid', $user->uid)->first();
    }
}
