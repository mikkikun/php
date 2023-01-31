<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $users = User::find($request->id);
        $posts = Post::find($request->id);
        $comments = Comment::query()->whereIn('post_id', Post::find($request->id)->comments()->pluck('post_id'))->get();
        
        return view('admin.comment.index', ['comments' => $comments, 'posts' => $posts,'users' => $users]);
    }

    public function create(Request $request)
    {
        $comments = new Comment;
        $comments->user_id = Auth::id();
        $comments->post_id = $request->id;
        $comments->body = $request->body;
        $form = $request->all();
        if (isset($form['image_path'])) {
            $path = $request->file('image_path')->store('public/image');
            $comments->image_path = basename($path);
        } else {
            $comments->image_path = null;
        }
        unset($form['_token']);
        unset($form['image']);
        $comments->save();
        return back();
    }

    public function delete(Request $request)
    {
        $comments = new Comment;
        $comments = Comment::find($request->id);
        
        return back();
    }
}
