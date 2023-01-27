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
        $to_id = User::where('id', '!=', auth()->user()->id)->get();
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

        $receiver_ids = Message::where('sender_user_id', auth()->id())->groupBy('receiver_user_id')->orderBy('created_at', 'desc')->pluck('receiver_user_id');
        
        $receiver_ids_all = $receiver_ids->all();
        $receiver_ids_order = implode(',', $receiver_ids_all);
        $receivers = User::whereIn('id', $receiver_ids)->orderByRaw("FIELD(id, $receiver_ids_order)")->get();
        // dd($receivers);
        return view('message.index', compact('receivers'));
    }

    public function users(Post $post)
    {

        // $posts = auth()->user()->posts()->withCount('messages')->distinct()->select('sender_user_id')->get();
        // $from_ids = $post->messages;
        // foreach ($from_ids as $from_id) {

        // $query = Message::query()->with('sender_user')->where('post_id', $post->id);
        // $query->where('sender_user_id', $from_id->sender_user_id)->distinct()->select('sender_user_id');
        // $messages = $query->paginate(20);
        // return view('message.users', compact('posts', 'post'));
    }

    public function message(User $user)
    {
        $from_id = auth()->user()->id;
        $to_id = $user->id;

        $query = Message::query()->with('sender_user')->where('id', $user->id);
        $query->where(function ($q) use ($from_id) {
            $q->where('sender_user_id', $from_id);
            $q->orWhere('receiver_user_id', $from_id);
        });
        $query->where(function ($q) use ($to_id) {
            $q->where('sender_user_id', $to_id);
            $q->orWhere('receiver_user_id', $to_id);
        });

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

        return redirect()->route('message.message', ['user' => $msg->sender_user_id])->with('message', 'メッセージを送信しました！');
    }
}
