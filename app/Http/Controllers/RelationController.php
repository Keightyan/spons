<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function store(Request $request, $id) {
        $user = auth()->user();
        $user->follow($id);
        return 'followed';
    }

    public function destroy($id) {
        $user = auth()->user();
        $user->unfollow($id);
        return 'unfollowed';
    }
}
