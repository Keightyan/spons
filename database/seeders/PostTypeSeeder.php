<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\PostType;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostType::create(['name' => 'ジョインしたい']);
        PostType::create(['name' => 'メンバー募集']);
        PostType::create(['name' => '対戦したい']);
    }
}
