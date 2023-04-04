<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = array('id');

    public static $rules = array(
        'title' => ['required', 'string', 'max:25'],
        'body' => ['required', 'string', 'max:255'],
        'cardgame'  => 'required'
    );
    

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    //かり
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }


}
