<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostType;
use App\Models\Prefecture;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $categories = Category::all();
        $post_types = PostType::all();
        $prefectures = Prefecture::all();

        return view('post.create', compact('user', 'categories', 'post_types', 'prefectures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PostRequest $request)
    {
        // Post::create($request->all());

        $post = new Post();

        $post->fill($request->all());

        if (request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            $name = date('Ymd_His') . '_' . $original;
            $request->file('image')->move('storage/images', $name);
            $post->image = $name;
        }

        $post->save();

        return redirect()->route('post.create')->with('message', '募集を投稿しました！');
    }

    // public function confirm(PostRequest $request)
    // {
    //     $inputs = $request;

    //     return view('post.confirm', compact('inputs'));
    // }

    // public function complete(Request $request)
    // {

    //     if ($request->has("back")) {
    //         return redirect('create')->withInput();
    //     }

    //     $post = new Post();
    //     $post->fill($request->all());    // fillメソッドにより、下記5つの記述が不要
    //     // $contact->name = $request->name;
    //     // $contact->kana = $request->kana;
    //     // $contact->tel = $request->tel;
    //     // $contact->email = $request->email;
    //     // $contact->body = $request->body;

    //     $post->save();

    //     // サーバーに保存されているトークンを再生成し、二重送信を防止
    //     $request->session()->regenerateToken();

    //     return view('post.complete');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $user = auth()->user();
        $categories = Category::all();
        $post_types = PostType::all();
        $prefectures = Prefecture::all();

        return view('post.edit', compact('post', 'user', 'categories', 'post_types', 'prefectures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        $post->fill($request->all());

        if (request('image')) {
            $original = $request->file('image')->getClientOriginalName();
            $name = date('Ymd_His') . '_' . $original;
            $request->file('image')->move('storage/images', $name);
            $post->image = $name;
        }

        $post->save();

        return redirect()->route('post.show', $post)->with('message', '投稿を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index')->with('message', '投稿を削除しました');
    }

    public function bookmark_posts()
    {
        $posts = auth()->user()->bookmark_posts()->orderBy('created_at', 'desc')->paginate(10);
        // $data = [
        //     'posts' => $posts,
        // ];
        return view('post.bookmarks', compact('posts'));
    }

    public function search(Request $request)
    {
        $user = auth()->user();

        $categories = Category::all();
        $post_types = PostType::all();
        $prefectures = Prefecture::all();

        // 検索一覧ページの初期表示
        $posts10 = Post::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->paginate(10);

        // 検索結果用
        $query = Post::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc');

        $category_id = $request->category_id;
        $post_type_id = $request->post_type_id;
        $prefecture_id = $request->prefecture_id;

        // 検索された場合
        if ($request) {
            if ($category_id !== 'all_categories') {
                $query->where('category_id', $category_id);
            } elseif ($category_id === 'all_categories') {
                $query->pluck('category_id');
            }
            if ($post_type_id !== 'all_post_types') {
                $query->where('post_type_id', $post_type_id);
            } elseif ($post_type_id === 'all_post_types') {
                $query->pluck('post_type_id');
            }
            if ($prefecture_id !== 'all_prefectures') {
                $query->where('prefecture_id', $prefecture_id);
            } elseif ($prefecture_id === 'all_prefectures') {
                $query->pluck('prefecture_id');
            }
            $data = $query->paginate(10);
            
        } else {    // 検索されなかった場合（初期表示）
            return $posts10;
        }

        return view('post.search', compact('user', 'categories', 'post_types', 'prefectures', 'posts10', 'data', 'request'));
    }
}
