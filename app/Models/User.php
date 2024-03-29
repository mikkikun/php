<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post;
use App\Models\follow;
use App\Models\Chat;
use App\Models\favorite;
use App\Models\Replie;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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

    public static $rules = array(
        'name' => ['required', 'string', 'max:25'],
        'profile' => ['required', 'string', 'max:255'],
    );

    

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'followed_id');
    }

    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

   // フォロー解除する
    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }

   // フォローしているか
    public function isFollowing($user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

   // フォローされているか
    public function isFollowed($user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }
    //かり
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritescomments()
    {
        return $this->hasMany(favoritescomment::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    

    public function replies()
    {
        return $this->hasMany(Replie::class);
    }

    public function favoritesreprie()
    {
        return $this->hasMany(favoritesReplie::class);
    }

    public function getNameCount()
    {
        return strlen($this->name);
    }
}
