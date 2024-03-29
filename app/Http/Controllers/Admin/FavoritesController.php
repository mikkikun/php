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
use App\Models\FavoriteReplie;


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
        $favorites = Favorite::where('post_id',$id)->orderByDesc('updated_at')->paginate(10);
        return view('admin.post.favorite', ['favorites' => $favorites]);
    }

    public function comment_favorite_page(Request $request)
    {
        
        $id = $request->id;
        $favorites = new FavoriteComment;
        $favorites = FavoriteComment::where('comment_id',$id)->orderByDesc('updated_at')->paginate(10);
        return view('admin.comment.favorite', ['favorites' => $favorites]);
    }

    public function replie_favorite_page(Request $request)
    {
        
        $id = $request->id;
        $favorites = new FavoriteReplie;
        $favorites = FavoriteReplie::where('replie_id',$id)->orderByDesc('updated_at')->paginate(10);
        return view('admin.comment.favorite', ['favorites' => $favorites]);
    }

    public function replie_store(Request $request, FavoriteReplie $favorites_replie)
    {
        $user_id = auth()->user()->id;
        $replie_id = $request->replie_id;
        
        $is_favorite = $favorites_replie->isFavorite_replie($user_id, $replie_id);
        if(!$is_favorite) {
            $favorites_replie->storeFavorite_replie($user_id, $replie_id);
            return back();
        }
        return back();
    }

    public function replie_destroy(Request $request, FavoriteReplie $favorites_replie)
    {
        $user_id = auth()->user()->id;
        $replie_id = $request->replie_id;
        // $favorite_id = $favorite->id;
        $is_favorite = $favorites_replie->isFavorite_replie($user_id, $replie_id);

        if($is_favorite) {
            $favorites_replie->destroyFavorite_replie($user_id, $replie_id);
            return back();
        }
        return back();
    }

}
