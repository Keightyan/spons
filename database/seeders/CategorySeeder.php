<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => '野球', 'image' => 'ico_baseball.png']);
        Category::create(['name' => 'ソフトボール', 'image' => 'ico_softball.png']);
        Category::create(['name' => 'サッカー', 'image' => 'ico_soccer.png']);
        Category::create(['name' => 'フットサル', 'image' => 'ico_futsal.png']);
        Category::create(['name' => 'テニス', 'image' => 'ico_tennis.png']);
        Category::create(['name' => 'バドミントン', 'image' => 'ico_badminton.png']);
        Category::create(['name' => 'バスケットボール', 'image' => 'ico_basketball.png']);
        Category::create(['name' => 'ゴルフ', 'image' => 'ico_golf.png']);
    }
}
