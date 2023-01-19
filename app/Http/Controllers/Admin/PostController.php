<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;

class PostController extends Controller
{
    public function add()
    {
        return view('admin.post.create');
    }

    public function create(Request $request)
    {
        $post = new Post;
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
        return redirect('admin/post/create');
    }  

    
}
