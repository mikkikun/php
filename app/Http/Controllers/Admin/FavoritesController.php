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
        $user = auth()->user();
        $post_id = $request->post_id;
        dd($request);
        $is_favorite = $favorite->isFavorite($user->id, $post_id);

        if(!$is_favorite) {
            $favorite->storeFavorite($user->id, $post_id);
            return back();
        }
        return back();
    }

    public function destroy(Request $request, Favorite $favorite)
    {
        $user = auth()->user();
        $post_id = $request->post_id;
        $favorite_id = $favorite->id;
        $is_favorite = $favorite->isFavorite($user->id, $post_id);
        if($is_favorite) {
            $favorite->destroyFavorite($user->id, $post_id);
            return back();
        }
        return back();
    }
}
