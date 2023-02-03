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
        $posts = Post::find($request->post_id);
        // dd($request->post_id);
        $users = User::find($request->user_id);
        // dd($users);
        $comments = Comment::query()->whereIn('post_id', Post::find($request->post_id)->comments()->pluck('post_id'))->get();
        
        return view('admin.comment.index', ['posts' => $posts,'users' => $users ,'comments' => $comments]);
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

    // public function edit(Request $request)
    // {
    //     $comments = Comment::find($request->id);
    //     if (empty($comments)) {
    //     abort(404);    
    //     }
    //     return view('admin.comment.edit', ['comment_form' => $comments]);
    // }

    // public function update(Request $request)
    // {
        
    //     $this->validate($request, Comment::$rules);
    //     $comments = Comment::find($request->id);
    //     $comment_form = $request->all();
    //     $comments->body = $request->body;
    //     if (isset($comment_form['image'])) {
    //         $path = $request->file('image')->store('public/image');
    //         $comment->image_path = basename($path);
    //         unset($comment_form['image']);
    //     } elseif (0 == strcmp($request->remove, 'true')) {
    //         $comment->image_path = null;
    //     }
    //     $comments->save();

    //     return view('admin.comment.index');
    // }

    // public function delete(Request $request)
    // {
    //     $comments = new Comment;
    //     $comments = Comment::find($request->id);
    //     $comments->delete();
    //     return back();
    // }
}
