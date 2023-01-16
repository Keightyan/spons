<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create(['user_id' => 1, 'category_id' => 1, 'post_type_id' => 1, 'prefecture_id' => 30, 'title' => '草野球チームを探しています。', 'body' => "野球経験は小学校～高校まであります。\nピッチャー志望です。よろしくお願いします。"]);
        Post::create(['user_id' => 2, 'category_id' => 2, 'post_type_id' => 2, 'prefecture_id' => 1, 'title' => 'ソフトボールチームのメンバー募集！', 'body' => "経験者を募集です。\n詳細はメッセージください、よろしくお願いします。"]);
        Post::create(['user_id' => 3, 'category_id' => 3, 'post_type_id' => 3, 'prefecture_id' => 2, 'title' => 'サッカーの対戦相手を募集！', 'body' => "○月○日の○時から、○○グラウンドでサッカーの試合をしませんか？"]);
        Post::create(['user_id' => 4, 'category_id' => 4, 'post_type_id' => 1, 'prefecture_id' => 3, 'title' => 'フットサルチームに入りたい', 'body' => "経験はないですが、運動不足解消したいので、。\n○○市内で活動されているチームはないでしょうか？"]);
        Post::create(['user_id' => 5, 'category_id' => 5, 'post_type_id' => 2, 'prefecture_id' => 4, 'title' => 'テスト', 'body' => "テスト"]);
        Post::create(['user_id' => 2, 'category_id' => 1, 'post_type_id' => 1, 'prefecture_id' => 30, 'title' => 'テスト', 'body' => "テスト"]);
        Post::create(['user_id' => 2, 'category_id' => 2, 'post_type_id' => 2, 'prefecture_id' => 1, 'title' => 'テスト', 'body' => "テスト"]);
        Post::create(['user_id' => 3, 'category_id' => 3, 'post_type_id' => 3, 'prefecture_id' => 2, 'title' => 'テスト', 'body' => "テスト"]);
        Post::create(['user_id' => 4, 'category_id' => 4, 'post_type_id' => 1, 'prefecture_id' => 3, 'title' => 'テスト', 'body' => "テスト"]);
        Post::create(['user_id' => 1, 'category_id' => 5, 'post_type_id' => 2, 'prefecture_id' => 4, 'title' => 'テスト', 'body' => "テスト"]);
        Post::create(['user_id' => 5, 'category_id' => 5, 'post_type_id' => 2, 'prefecture_id' => 4, 'title' => 'テスト', 'body' => "テスト"]);
    }
}
