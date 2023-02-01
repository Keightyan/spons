<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // トップページの新着の募集
        // if(Schema::hasTable('posts')) {
        //     $posts5 = Post::limit(5)->orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->get();
        //     view()->share('posts5', $posts5);
        // }

        // if(Schema::hasTable('posts')) {
        //     $categories = Category::all();
        //     view()->share('categories', $categories);
        // }
    }
}
