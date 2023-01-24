<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'post_type_id',
        'prefecture_id',
        'title',
        'body',
        'image',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function post_type() {
        return $this->belongsTo(PostType::class, 'post_type_id');
    }

    public function prefecture() {
        return $this->belongsTo(Prefecture::class, 'prefecture_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id')->withTimestamps();
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
}
