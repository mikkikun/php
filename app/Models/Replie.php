<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
class Replie extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = array('id');

    public static $rules = array(
        'body' => ['required', 'string', 'max:255'],
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites_replie()
    {
        return $this->hasMany(FavoriteReplie::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
