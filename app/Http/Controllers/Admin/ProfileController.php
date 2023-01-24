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
        $users = User::find(Auth::id());
        $users_form = $request->all();
        $users->fill($users_form)->save();
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

        if($post->user_id == Auth::id()) {
            $post->delete();
        }
        dd($post);

        return redirect('/');
    }
}
