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

        $msg->sender_user_id = $request->sender_user_id;
        $msg->receiver_user_id = $request->receiver_user_id;
        $msg->post_id = $request->post_id;
        $msg->body = $request->body;

        $msg->save();

        return redirect()->route('post.show', $post)->with('message', 'メッセージを送信しました！');
    }

    public function index()
    {
        $from_id = auth()->user()->id;
        $to_posts = Message::pluck('post_id');
        foreach($to_posts as $to_post) {
        }

        $query = Message::query()->with('sender_user')->where('post_id', $to_post);
        $query->where('sender_user_id', $from_id)->distinct()->select('post_id');

        // foreach($messages1 as $msg1) {

        // }

        $messages = $query->paginate(20);

        return view('message.index', compact('messages'));
    }

    public function users(Post $post)
    {
        $from_ids = $post->messages;
        foreach ($from_ids as $from_id) {
        }

        $query = Message::query()->with('sender_user')->where('post_id', $post->id);
        $query->where('sender_user_id', $from_id->sender_user_id)->distinct()->select('sender_user_id');
        $messages = $query->paginate(20);
        return view('message.users', compact('messages', 'post', 'from_id'));
    }

    public function message(Post $post, User $user)
    {
        $from_id = auth()->user()->id;
        $to_id = $post->user->id;

        $query = Message::query()->with('sender_user')->where('post_id', $post->id);
        $query->where(function ($q) use ($from_id) {
            $q->where('sender_user_id', $from_id);
            $q->orWhere('receiver_user_id', $from_id);
        });
        $query->where(function ($q) use ($to_id) {
            $q->where('sender_user_id', $to_id);
            $q->orWhere('receiver_user_id', $to_id);
        });

        $messages = $query->paginate(20);

        return view('message.message', compact('messages', 'post', 'from_id', 'to_id'));
    }

    public function store2(MessageRequest $request) // message()の画面からの送信用
    {
        $msg = new Message();

        $msg->sender_user_id = $request->sender_user_id;
        $msg->receiver_user_id = $request->receiver_user_id;
        $msg->post_id = $request->post_id;
        $msg->body = $request->body;

        $msg->save();

        return redirect()->route('message.message', ['post' => $msg->post_id, 'user' => $msg->sender_user_id])->with('message', 'メッセージを送信しました！');
    }
}
