<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function home()
    {
        return view('admin.post.index');
    }

    public function add()
    {
        $users = User::find(Auth::id());
        return view('admin.post.create',['users' => $users]);
    }

    public function create(Request $request)
    {
        $this->validate($request, Post::$rules);
        $posts = new Post;
        $posts->user_id = Auth::id();
        $form = $request->all();
        if (isset($form['image'])) {
            // $path = $request->file('image')->store('public/image');
            // $posts->image_path = basename($path);
            $path = Storage::disk('s3')->putFile('image', $request->file('image'), 'public');
            $posts->image_path = Storage::disk('s3')->url($path);
        } else {
            $posts->image_path = null;
        }
        unset($form['_token']);
        unset($form['image']);
        $posts->fill($form);
        $posts->save();
        return redirect('admin/post/index');
    }

    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Post::where('cardgame', $cond_title)->orderByDesc('updated_at')->paginate(5);
        } else {
            $posts = Post::orderByDesc('updated_at')->paginate(10);
        }
        return view('admin.post.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
    {
        $users = User::find(Auth::id());
        $posts = Post::find($request->id);
        if (empty($posts)) {
        abort(404);    
        }
        return view('admin.post.edit', ['post_form' => $posts , 'users' => $users]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Post::$rules);
        $posts = Post::find($request->id);
        $post_form = $request->all();
        if (isset($post_form['image'])) {
            // $path = $request->file('image')->store('public/image');
            // $posts->image_path = basename($path);
            $path = Storage::disk('s3')->putFile('image', $request->file('image'), 'public');
            $posts->image_path = Storage::disk('s3')->url($path);
            unset($post_form['image']);
        } elseif (0 == strcmp($request->remove, 'true')) {
            $posts->image_path = null;
        }
        unset($post_form['_token']);
        unset($post_form['remove']);
        // dd($posts);
        $posts->fill($post_form)->save();
        return redirect('admin/post/index');
    }

    public function delete(Request $request)
    {
        $posts = new Post;
        $posts = Post::find($request->id);
        $posts->delete();
        return back();
    }

    public function follow_pose(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Post::where('cardgame', $cond_title)->orderByDesc('updated_at')->paginate(5);
        } else {
            $posts = Post::query()->whereIn('user_id', Auth::user()->follows()->pluck('followed_id'))->orWhere('user_id', Auth::user()->id)->orderByDesc('updated_at')->paginate(10);
        }
        return view('admin.post.follow_pose', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

}
