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
    public function create(User $user)
    {
        $from_id = auth()->user()->id;
        // dd($user->id === $from_id);
        $to_id = $user->id;
        // dd($to_id);

        if ($user->id !== $from_id) {
            return view('message.inquiry', compact('user', 'from_id', 'to_id'));
        } else {
            return view('post.index');
        }
    }

    public function store(MessageRequest $request, User $user)
    {
        $msg = new Message();

        $msg->sender_user_id = $request->sender_user_id;
        $msg->receiver_user_id = $request->receiver_user_id;
        // $msg->post_id = $request->post_id;
        $msg->body = $request->body;

        $msg->save();

        return redirect()->route('user.show', $user)->with('message', 'メッセージを送信しました！');
    }

    public function index()
    {
        // $from_id = auth()->user()->id;
        // $to_posts = Message::pluck('post_id');
        // foreach($to_posts as $to_post) {
        // }

        // $query = Message::query()->with('sender_user')->where('post_id', $to_post);
        // $query->where('sender_user_id', $from_id)->distinct()->select('post_id');

        // foreach($messages1 as $msg1) {

        // }

        // $messages = $query->paginate(20);

        // return view('message.index', compact('messages'));

        // $messages = auth()->user()->messages()->get();
        // // dd($messages);

        $receiver_ids_all   = auth()->user()->all_messages()->groupBy('target_id')->pluck(0)->pluck('target_id');
        $receiver_ids_order = implode(',', $receiver_ids_all->toArray());
        $receivers          = $receiver_ids_all->isNotEmpty() ? User::whereIn('id', $receiver_ids_all)->orderByRaw("FIELD(id, $receiver_ids_order)")->get() : [];

        // dd($receivers);
        return view('message.index', compact('receivers'));
    }

    public function message(User $user)
    {
        $from_id = auth()->user()->id;
        $to_id = $user->id;

        $query = Message::query();
        $query->where(function ($q) use ($from_id, $to_id) {
            $q->where('sender_user_id', $from_id);
            $q->where('receiver_user_id', $to_id);
        });
        $query->orWhere(function ($q) use ($from_id, $to_id) {
            $q->where('sender_user_id', $to_id);
            $q->where('receiver_user_id', $from_id);
        });

        $query->orderBy('created_at');
        $messages = $query->paginate(20);

        return view('message.message', compact('user', 'messages', 'from_id', 'to_id'));
    }

    public function store2(MessageRequest $request) // message()の画面からの送信用
    {
        $msg = new Message();

        $msg->sender_user_id = $request->sender_user_id;
        $msg->receiver_user_id = $request->receiver_user_id;
        // $msg->post_id = $request->post_id;
        $msg->body = $request->body;

        $msg->save();

        return redirect()->route('message.message', ['user' => $msg->receiver_user_id])->with('message', 'メッセージを送信しました！');
    }
}
