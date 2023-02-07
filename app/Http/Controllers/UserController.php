<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Prefecture;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $posts = User::find($id)->posts()->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->get();

        return view('user.show', compact('user', 'posts'));
    }

    public function edit(User $user)
    {
        $user = auth()->user();
        $prefectures = Prefecture::all();

        // dd($user);

        return view('user.edit', compact('user', 'prefectures'));
    }

    public function update(UserRequest $request)
    {

        $user = auth()->user();     //　引数に渡すと他ユーザーのidを叩かれてしまう可能性があるので、ここで自身を指定している  

        $user->fill($request->all());

        if (request('profile_image')) {
            $original = $request->file('profile_image')->getClientOriginalName();
            $name = date('Ymd_His') . '_' . $original;
            $request->file('profile_image')->move('storage/profile_image', $name);
            $user->profile_image = $name;
        }

        $user->save();

        return redirect()->route('user.show', $user)->with('message', 'プロフィールを更新しました。');
    }

    public function destroy(User $user)
    {

        $admin = auth()->user();

        // dd($admin->role);

        if ($admin->role === 2) {
            $user->delete();
            return redirect()->route('post.index')->with('message', 'ユーザーを削除しました');
        }
    }
}
