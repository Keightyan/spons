<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prefecture;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(10);
        return view('user.index', compact('users'));
    }

    public function show($id) {

        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    public function edit($id) {
        $user = auth()->user();
        $prefectures = Prefecture::all();

        return view('user.edit', compact('user', 'prefectures'));
    }

    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('user.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('user.followers', $data);
    }
}
