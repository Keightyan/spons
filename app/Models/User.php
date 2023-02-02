<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'team',
        'gender',
        'birthday',
        'favorites',
        'introduction',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmark_posts()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id')->withTimestamps();
    }

    public function is_bookmark($postId)
    {
        return $this->bookmarks()->where('post_id', $postId)->exists();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'relations', 'follow_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'relations', 'followed_id', 'follow_id')->withTimestamps();
    }

    public function follow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id === $userId;

        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }

    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id === $userId;

        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {

            return false;
        }
    }

    public function is_following($userId)
    {
        return $this->followings()->where('followed_id', $userId)->exists();
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'receiver_user_id');
    }

    public function senders()
    {
        return $this->belongsToMany(User::class, 'messages', 'sender_user_id', 'receiver_user_id');
    }

    public function receivers()
    {
        return $this->belongsToMany(User::class, 'messages', 'receiver_user_id', 'sender_user_id');
    }

    // ユーザが送信または受信した全メッセージ
    public function all_messages()
    {
        $receive_message = $this->hasMany(Message::class, 'receiver_user_id')->get();
        $send_message    = $this->hasMany(Message::class, 'sender_user_id')->get();
        $messages        = $receive_message->union($send_message)->sortByDesc('created_at');

        // target_idキーを作成し、メッセージ相手のuser_idを格納する
        $all_messages = collect([]);
        foreach ($messages as $message) {
            if ($message->receiver_user_id != $this->id) {
                $message['target_id'] = $message->receiver_user_id;
            } else {
                $message['target_id'] = $message->sender_user_id;
            }
            $all_messages->add($message);
        }
        return $all_messages;
    }
}
