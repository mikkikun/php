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
        $chats->comment = $request->comment;
        // Chat::create([
        //   'user_id' => $users->id,
        //   'name' => $users->name,
        //   'chats' => $chats
        // ]); 
        return back();
    }
}
