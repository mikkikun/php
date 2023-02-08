<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Favorite;


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
    // public function store(Request $request, Favorite $favorite)
    // {
    //     $user_id = auth()->user();
    //     $post_id = $request->post_id;
    //     $is_favorite = $favorite->isFavorite($user_id, $post_id);

    //     if(!$is_favorite) {
    //         $favorite->storeFavorite($user_id, $post_id);
    //         return back();
    //     }
    //     return back();
    // }

    // public function destroy(Request $request, Favorite $favorite)
    // {
    //     $user_id = auth()->user()->id;
    //     $post_id = $request->post_id;
    //     $favorite_id = $favorite->id;
    //     $is_favorite = $favorite->isFavorite($user_id, $post_id);
    //     if($is_favorite) {
    //         $favorite->destroyFavorite($favorite_id);
    //         return back();
    //     }
    //     return back();
    // }
}
