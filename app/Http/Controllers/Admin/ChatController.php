<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user_id = User::find($request->user_id);
        $chats = Chat::get();
        return view('admin.chat.chat', ['chats' => $chats, 'user_id' => $user_id]);
    }

    public function add(Request $request)
    {
        $chats = new Chat;
        
        $form = $request->all();
        $chats->comment = $request->comment;
        $chats->my_id = auth()->user()->id;
        $chats->user_id = $request->id;
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/chat');
            $chats->image_path = basename($path);
        } else {
            $chats->image_path = null;
        }
        unset($form['_token']);
        unset($form['image_path']);
        $chats->save();
        // Chat::create([
        //   'user_id' => $users->id,
        //   'name' => $users->name,
        //   'chats' => $chats
        // ]); 
        return back();
    }
}
