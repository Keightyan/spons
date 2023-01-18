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
        User::create(['name' => 'Keight', 'email' => 'keightyan@gmail.com', 'profile_image' => 'user_default.jpg', 'team' => null, 'prefecture_id' => 30, 'gender' => 1, 'birthday' => '1987/10/27', 'favorites' => '野球、バドミントン', 'introduction' => '管理者です。', 'password' => bcrypt('admin'), 'role' => 2]);
        User::create(['name' => '他ユーザーA', 'email' => 'user2@user2.com', 'profile_image' => 'user_default.jpg', 'team' => '〇〇ソフトボールクラブ', 'prefecture_id' => 1, 'gender' => 2, 'birthday' => '1998/6/20', 'favorites' => 'ソフトボール、野球', 'introduction' => 'よろしくお願いします。', 'password' => bcrypt('user'), 'role' => 1]);
        User::create(['name' => '他ユーザーB', 'email' => 'user3@user3.com', 'profile_image' => 'user_default.jpg', 'team' => '〇〇サッカークラブ', 'prefecture_id' => 2, 'gender' => 1, 'birthday' => '1990/03/15', 'favorites' => 'サッカー、バスケ', 'introduction' => 'よろしくです。', 'password' => bcrypt('user'), 'role' => 1]);
        User::create(['name' => '他ユーザーC', 'email' => 'user4@user4.com', 'profile_image' => 'user_default.jpg', 'team' => null, 'prefecture_id' => 3, 'gender' => 2, 'birthday' => '1995/01/01', 'favorites' => 'テニス', 'introduction' => 'よろしくお願いいたします。', 'password' => bcrypt('user'), 'role' => 1]);
        User::create(['name' => '他ユーザーD', 'email' => 'user5@user5.com', 'profile_image' => 'user_default.jpg', 'team' => null, 'prefecture_id' => 4, 'gender' => 1, 'birthday' => '1993/10/25', 'favorites' => 'バレーボール', 'introduction' => 'よろしく！', 'password' => bcrypt('user'), 'role' => 1]);
    }
}
