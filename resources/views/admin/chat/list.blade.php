@extends('layouts.app')

@section('content')
<title>メッセージリスト</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
<link href="{{ asset('css/list.css') }}" rel="stylesheet">
<div class="container">
    <div class="main-body p-0">
        <!-- Inner main -->
        <div class="">
            <div class="inner-main-body p-2 p-s collapse forum-content show">
                @foreach ($chats as $chat)
                    @if($chat->my_id !== auth()->user()->id)
                        <div class="card mb-2">
                            <div class="card-body p-2 p-sm-3">
                                <div class="media forum-item">
                                    @if($chat->my_user->profile_image !== null)
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->my_user->id]) }}">
                                            <img src="{{ asset('storage/profile_image').'/'.$chat->my_user->profile_image }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @else
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->my_user->id]) }}">
                                            <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @endif
                                    <div class="media-body">
                                        <h6>
                                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->my_user->id]) }}" data-toggle="collapse" data-target=".forum-content" class="text-body" style= "text-decoration:none;">{{ $chat->my_user->name }}</a>
                                            @if (auth()->user()->isFollowed($chat->my_user->id))
                                                <span class="px-1 bg-secondary text-light">フォローされています</span>
                                            @endif
                                        </h6>
                                        
                                        <p class="text-secondary">{{ $chat->created_at }}</p>
                                        <h3 class="my-4">{{ $chat->my_user->name }}: {{ $chat->comment }}</h3>
                                    </div>
                                    <div class="text-muted small  align-self-center" style="text-align:right; text-decoration:none;">
                                        <button class="btn btn-rounded btn-info" >
                                            <a href="{{ action('App\Http\Controllers\Admin\ChatController@index',['user_id' => $chat->my_user->id]) }}" style="text-decoration:none; color :white;" class ="message">メッセージ</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($chat->my_id == auth()->user()->id)
                        <div class="card mb-2">
                            <div class="card-body p-2 p-sm-3">
                                <div class="media forum-item">
                                    @if($chat->user->profile_image !== null)
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->user->id]) }}">
                                            <img src="{{ asset('storage/profile_image').'/'.$chat->user->profile_image }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @else
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->user->id]) }}">
                                            <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @endif
                                    <div class="media-body">
                                        <h6>
                                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->user->id]) }}" data-toggle="collapse" data-target=".forum-content" class="text-body" style= "text-decoration:none;">{{ $chat->user->name }}</a>
                                            @if (auth()->user()->isFollowed($chat->user->id))
                                                <span class="px-1 bg-secondary text-light">フォローされています</span>
                                            @endif
                                        </h6>
                                        
                                        <p class="text-secondary">{{ $chat->created_at }}</p>  
                                        <h3 class="my-4">自分: {{ $chat->comment }}</h3>
                                    </div>
                                    <div class="text-muted small  align-self-center" style="text-align:right; text-decoration:none;">
                                        <button class="btn btn-rounded btn-info" >
                                            <a href="{{ action('App\Http\Controllers\Admin\ChatController@index',['user_id' => $chat->user->id]) }}" style="text-decoration:none; color :white;" class ="message">メッセージ</a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row m-3">
                    {{ $chats->appends(request()->query())->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
        <!-- /Inner main -->
    </div>
</div>

@endsection