<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function home()
    {
        return view('admin.post.index');
    }

    public function add()
    {
        return view('admin.post.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Post::$rules);
        $post = new Post;
        $post->user_id = Auth::id();
        $form = $request->all();
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $post->image_path = basename($path);
        } else {
            $post->image_path = null;
        }
        unset($form['_token']);
        unset($form['image']);
        $post->fill($form);
        $post->save();
        return redirect('admin/post/index');
    }

    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Post::where('title', $cond_title)->get();
        } else {
            $posts = Post::all();
        }
        return view('admin.post.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    public function edit(Request $request)
    {
      // News Modelからデータを取得する
        $post = Post::find($request->id);
        if (empty($post)) {
        abort(404);    
        }
        return view('admin.post.edit', ['post_form' => $post]);
    }


    public function update(Request $request)
    {
        $this->validate($request, Post::$rules);
        $post = Post::find($request->id);
        $post_form = $request->all();
        if (isset($post_form['image'])) {
            $path = $request->file('image')->store('public/image');
            $post->image_path = basename($path);
            unset($post_form['image']);
        } elseif (0 == strcmp($request->remove, 'true')) {
            $post->image_path = null;
        }
        unset($post_form['_token']);
        unset($post_form['remove']);
        // 該当するデータを上書きして保存する
        $post->fill($post_form)->save();
        return redirect('admin/post/index');
    }

    public function delete(Request $request)
    {
        $post = new Post;
        $post = Post::find($request->id);
        $post->delete();
        return redirect('admin/post/index');
    }

}
