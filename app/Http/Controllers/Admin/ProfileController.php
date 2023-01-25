<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
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
        
        if (isset($users_form['profile_image'])) {
            $path = $request->file('profile_image')->store('public/profile_image');
            $users->profile_image = basename($path);
            unset($users_form['profile_image']);
        } elseif (0 == strcmp($request->remove, 'true')) {
            $users->profile_image = null;
        }



        $users->save();
        return redirect('admin/post/index');
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

    public function index(Request $request)
    {
        $users = User::find(Auth::id());
        return view('admin.profile.mypage', ['users' => $users]);
    }
}
