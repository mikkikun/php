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
          // 検索されたら検索結果を取得する
            $posts = Post::where('title', $cond_title)->get();
        } else {
          // それ以外はすべてのニュースを取得する
            $posts = Post::all();
        }
        return view('admin.post.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }

    
}
