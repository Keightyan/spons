<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostType;
use App\Models\Prefecture;
use App\Models\Message;

class MessageController extends Controller
{
    public function create(Post $post)
    {
        $from_id = auth()->user()->id;
        $to_id = $post->user->id;
        
        return view('message.inquiry', compact('post', 'from_id', 'to_id'));
    }

    public function store(MessageRequest $request, Post $post)
    {
        $msg = new Message();

        $msg->fill($request->all());

        $msg->save();

        return redirect()->route('post.show', $post)->with('message', 'メッセージを送信しました！');
    }

    public function message(Post $post) {

        $from_id = auth()->user()->id;
        $to_id = $post->user->id;

        $query = Message::query();
        $query->where(function($q) use ($from_id) {
            $q->where('sender_user_id', $from_id);
            $q->orWhere('receiver_user_id', $from_id);
        });
        $query->where(function($q) use ($to_id) {
            $q->where('sender_user_id', $to_id);
            $q->orWhere('receiver_user_id', $to_id);
        });

        $messages = $query->paginate(20);

        return view('message.message', compact('messages', 'post', 'from_id', 'to_id'));
    }
}
