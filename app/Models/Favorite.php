<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Favorite extends Model
{
    public $timestamps = false;

    public function isFavorite($user_id, $post_id) 
    {
        return $this->where('user_id', $user_id)->where('post_id', $post_id)->first();
    }

    public function storeFavorite($user_id,  $post_id)
    {
        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->save();

        return;
    }

    public function destroyFavorite($user_id,  $post_id)
    {

        $this->user_id = $user_id;
        $this->post_id = $post_id;
        $this->where('user_id', $user_id)->where('post_id', $post_id)->delete();
        return;
    }
    // いいねしているかどうかの判定処理
    // public function isFavorite($user_id, $post_id) 
    // {
    //     return (boolean) $this->where('user_id', $user_id)->where('post_id', $post_id)->first();
    // }
    

    // public function storeFavorite($user_id, $post_id)
    // {
    //     $this->user_id = $user_id;
    //     $this->post_id = $post_id;
    //     $this->save();
    //     return;
    // }

    // public function destroyFavorite($user_id, $post_id)
    // {
    //     $this->user_id = $user_id;
    //     $this->post_id = $post_id;
    //     $this->delete();
    //     return;
    //     // $this->where('id', $user_id, $post_id)->
    // }
}
