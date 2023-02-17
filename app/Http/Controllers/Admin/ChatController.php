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
        $my_id = auth()->user()->id;
        $users = User::find($request->user_id);
        $user_id =$users->id;
        // $chats = Chat::where('my_id',$my_id)->where('user_id',$user_id)->get();
        $chats = Chat::where('my_id',$my_id)->where('user_id',$user_id)
            ->orWhere(function($query) use($my_id, $user_id){
            $query->where('user_id', $my_id)->where('my_id', $user_id);
        })->get();
        return view('admin.chat.chat', ['chats' => $chats,'users' => $users]);
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
        return back();
    }

    public function list(Request $request)
    {
        $my_id = auth()->user()->id;
        $chats = Chat::where('my_id',$my_id)->orwhere('user_id',$my_id)
        ->groupBy('user_id')->where('user_id', '!==', 'my_id')->get('user_id');
        // $chats_comment = Chat::where('my_id',$my_id)->orwhere('user_id',$my_id)
        // ->get();
        // dd($chats_comment);
        return view('admin.chat.list', ['chats' => $chats]);
    }

    public function delete(Request $request)
    {
        $chats = Chat::find($request->id);
        $chats->delete();
        return back();
    }
}
