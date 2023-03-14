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
        })
        ->orderBy('created_at', 'ASC')
        ->get();
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
        $id = auth()->user()->id;
        
        // $chats = Chat::where('my_id',$id)->get('my_id');
        // $chats = Chat::where('user_id',$id)->get('user_id');
        // $chats = Chat::where('my_id',$id)->orwhere('user_id',$id)->where('user_id', '!==', 'my_id')->groupBy('user_id', 'my_id')->get('user_id');
        // $chats = Chat::where('my_id',$id)->orwhere('user_id',$id)->groupBy('my_id','user_id')->get('my_id','user_id');

        $chats = Chat::where(function($query)use($id){$query->where('my_id',$id)->orWhere('user_id',$id);})
        ->select('user_id', 'my_id', Chat::raw('MAX(created_at)As created_at'),Chat::raw('MAX(comment)As comment'))
        // ->select('user_id', 'my_id', 'created_at','comment')
        ->groupBy('user_id', 'my_id')
        ->orderBy('created_at', 'desc')
        ->get();
        // ->groupBy('user_id', 'my_id')->where('user_id', '!==', 'my_id')->get('user_id', 'my_id');
        // dd($chats);
        return view('admin.chat.list', ['chats' => $chats]);
    }

    public function delete(Request $request)
    {
        $chats = Chat::find($request->id);
        $chats->delete();
        return back();
    }
}