<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Keight', 'email' => 'keightyan@gmail.com', 'team' => null, 'introduction' => '管理者です。', 'password' => bcrypt('admin'), 'role' => 2]);
        User::create(['name' => '他ユーザーA', 'email' => 'user2@user2.com', 'team' => '〇〇ソフトボールクラブ', 'introduction' => 'よろしくお願いします。', 'password' => bcrypt('user'), 'role' => 1]);
        User::create(['name' => '他ユーザーB', 'email' => 'user3@user3.com', 'team' => '〇〇サッカークラブ', 'introduction' => 'よろしくです。', 'password' => bcrypt('user'), 'role' => 1]);
        User::create(['name' => '他ユーザーC', 'email' => 'user4@user4.com', 'team' => null, 'introduction' => 'よろしくお願いいたします。', 'password' => bcrypt('user'), 'role' => 1]);
        User::create(['name' => '他ユーザーD', 'email' => 'user5@user5.com', 'team' => null, 'introduction' => 'よろしく！', 'password' => bcrypt('user'), 'role' => 1]);
    }
}
