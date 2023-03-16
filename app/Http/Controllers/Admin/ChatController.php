<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $this->validate($request, Chat::$rules);
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
        // // $chats = Chat::where('my_id',$id)->orwhere('user_id',$id)->where('user_id', '!==', 'my_id')->groupBy('user_id', 'my_id')->get('user_id');
        // // $chats = Chat::where('my_id',$id)->orwhere('user_id',$id)->groupBy('my_id','user_id')->get('my_id','user_id');
        // $chats = Chat::where(function($query)use($id){$query->where('my_id',$id)->orWhere('user_id',$id);})
        // ->select('user_id', 'my_id', Chat::raw('MAX(created_at)As created_at'),Chat::raw('MAX(comment)As comment'))
        // ->groupBy('user_id', 'my_id')
        // ->orderByDesc('updated_at')->paginate(5);
        // // ->groupBy('user_id', 'my_id')->where('user_id', '!==', 'my_id')->get('user_id', 'my_id');

        $chats = Chat::select('my_id', 'user_id', DB::raw('MAX(created_at) AS created_at'), DB::raw('MAX(comment) AS comment'))
        ->where('my_id', $id)
        ->orWhere('user_id', $id)
        ->groupBy(DB::raw('IF(my_id = '.$id.', user_id, my_id)'))
        ->orderByDesc('created_at')
        ->paginate(5);
        return view('admin.chat.list', ['chats' => $chats]);
    }

    public function delete(Request $request)
    {
        $chats = Chat::find($request->id);
        $chats->delete();
        return back();
    }
}

