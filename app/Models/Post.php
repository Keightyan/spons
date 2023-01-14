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
        return $this->belongsTo(Category::class);
    }

    public function post_type() {
        return $this->belongsTo(PostType::class);
    }

    public function prefecture() {
        return $this->belongsTo(Prefecture::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'user_id')->withTimestamps();
    }

    public function messages() {
        return $this->hasMany(Message::class);
    }
}
