<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $users = User::find(Auth::id());
        if (empty($users)) {
        abort(404);    
        }
        return view('admin.profile.edit', ['users_form' => $users]);
    }

    public function update(Request $request)
    {
        $this->validate($request, User::$rules);
        $users = User::find(Auth::id());
        $users_form = $request->all();
        $users->name = $request->name;
        if($request->profile !== null) {
            $users->profile = $request->profile;
        }
        if (isset($users_form['image'])) {
            $path = $request->file('image')->store('public/profile_image');
            $users->profile_image = basename($path);
            unset($users_form['image']);
        } elseif (0 == strcmp($request->remove, 'true')) {
            $users->profile_image = null;
        }
        $users->save();
        $posts = Post::where('user_id', $request->id)->get();
        return view('admin.profile.userpage', ['posts' => $posts,'users' => $users]);
    }

    public function deletepage(Request $request)
    {
        $users = User::find(Auth::id());
        if (empty($users)) {
        abort(404);    
        }
        return view('admin.profile.delete', ['users_form' => $users]);
    }

    public function delete(Request $request)
    {
        $users = new User;
        $post = new Post;
        $users = User::find(Auth::id());
        $users->delete();

        // if($post->user_id == Auth::id()) {
        //     $post->delete();
        // }

        return redirect('/');
    }


    public function userpage(Request $request)
    {
        $users = User::find($request->id);
        $posts = Post::where('user_id', $request->id)->get();
        return view('admin.profile.userpage', ['posts' => $posts,'users' => $users]);
    }

    public function follow(Request $request)
    {
        
        $follower = auth()->user();
        $id = $request->id;
       // フォローしているか
        $is_following = $follower->isFollowing($id);
        if(!$is_following) {
           // フォローしていなければフォローする
            $follower->follow($id);
            return back();
        }
    }

   // フォロー解除
    public function unfollow(Request $request)
    {
        $follower = auth()->user();
        $id = $request->id;
       // フォローしているか
        $is_following = $follower->isFollowing($id);
        if($is_following) {
           // フォローしていればフォローを解除する
            $follower->unfollow($id);
            return back();
        }
    }

    public function follow_page(Request $request)
    {
        // $user = new User;
        // $all_users = $user->getAllUsers(auth()->user()->id);
        $id = $request->id;
        $users = User::query()->whereIn('id', User::find($id)->follows()->pluck('followed_id'))->latest()->get();
        $discrimination = "follow";
        return view('admin.profile.follow', ['users' => $users,'discrimination' => $discrimination]);
    }

    public function follower_page(Request $request)
    {
        // $user = new User;
        // $all_users = $user->getAllUsers(auth()->user()->id);
        $id = $request->id;
        $users = User::query()->whereIn('id', User::find($id)->followers()->pluck('following_id'))->latest()->get();
        $discrimination = "follower";
        return view('admin.profile.follow', ['users' => $users,'discrimination' => $discrimination]);
    }

}
