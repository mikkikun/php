<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Models\Post;
use App\Models\User;
use App\Models\FavoriteComment;


class Comment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public static $rules = array(
        'body' => 'required',
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites_comments()
    {
        return $this->hasMany(FavoriteComment::class);
    }
}