<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store($postId) {
        $user = auth()->user();
        if(!$user->is_bookmark($postId)) {
            $user->bookmark_posts()->attach($postId);
        }
        return 'added';
    }

    public function destroy($postId) {
        $user = auth()->user();
        if ($user->is_bookmark($postId)) {
            $user->bookmark_posts()->detach($postId);
        }
        return 'deleted';
    }
}
