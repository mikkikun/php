<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\FavoriteComment;


class FavoritesController extends Controller
{
    public function store(Request $request, Favorite $favorite)
    {
        $user_id = auth()->user()->id;
        $post_id = $request->post_id;
        $is_favorite = $favorite->isFavorite($user_id, $post_id);
        if(!$is_favorite) {
            $favorite->storeFavorite($user_id, $post_id);
            return back();
        }
        return back();
    }

    public function destroy(Request $request, Favorite $favorite)
    {
        $user_id = auth()->user()->id;
        $post_id = $request->post_id;
        // $favorite_id = $favorite->id;
        $is_favorite = $favorite->isFavorite($user_id, $post_id);

        if($is_favorite) {
            $favorite->destroyFavorite($user_id, $post_id);
            return back();
        }
        return back();
    }

    public function comment_store(Request $request, FavoriteComment $favorites_comments)
    {
        $user_id = auth()->user()->id;
        $comment_id = $request->comment_id;
        
        $is_favorite = $favorites_comments->isFavorite_comment($user_id, $comment_id);
        if(!$is_favorite) {
            $favorites_comments->storeFavorite_comment($user_id, $comment_id);
            return back();
        }
        return back();
    }

    public function comment_destroy(Request $request, FavoriteComment $favorites_comments)
    {
        $user_id = auth()->user()->id;
        $comment_id = $request->comment_id;
        // $favorite_id = $favorite->id;
        $is_favorite = $favorites_comments->isFavorite_comment($user_id, $comment_id);

        if($is_favorite) {
            $favorites_comments->destroyFavorite_comment($user_id, $comment_id);
            return back();
        }
        return back();
    }
    public function favorite_page(Request $request)
    {
        
        $id = $request->id;
        $favorites = new Favorite;
        $users = new User;
        $favorites = Favorite::where('post_id',$id)->get();
        return view('admin.post.favorite', ['favorites' => $favorites]);
    }

    public function comment_favorite_page(Request $request)
    {
        
        $id = $request->id;
        $favorites = new FavoriteComment;
        $users = new User;
        $favorites = FavoriteComment::where('comment_id',$id)->get();
        return view('admin.comment.favorite', ['favorites' => $favorites]);
    }
}
