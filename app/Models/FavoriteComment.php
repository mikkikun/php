<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class FavoriteComment extends Model
{
    protected $table = 'favorites_comments';
    public function isFavorite_comment($user_id, $comment_id) 
    {
        return $this->where('user_id', $user_id)->where('comment_id', $comment_id)->first();
    }

    public function storeFavorite_comment($user_id,  $comment_id)
    {
        $this->user_id = $user_id;
        $this->comment_id = $comment_id;
        $this->save();

        return;
    }

    public function destroyFavorite_comment($user_id,  $comment_id)
    {

        $this->user_id = $user_id;
        $this->comment_id = $comment_id;
        $this->where('user_id', $user_id)->where('comment_id', $comment_id)->delete();
        return;
    }
    
}
