@extends('layouts.app')

@section('content')
<title>メッセージリスト</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
<link href="{{ asset('css/list.css') }}" rel="stylesheet">
<div class="container">
<div class="main-body p-0">
    <div class="inner-wrapper">
        <!-- Inner main -->
        <div class="">
            <div class="inner-main-body p-2 p-s collapse forum-content show">
                @foreach ($chats as $chat)
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
                                    
                                    <p class="text-secondary">
                                        lorem ipsum dolor sit amet lorem ipsum dolor sit amet lorem ipsum dolor sit amet
                                    </p>
                                    <p class="text-muted"><a href="javascript:void(0)">drewdan</a> replied <span class="text-secondary font-weight-bold">13 minutes ago</span></p>
                                </div>
                                <div class="text-muted small  align-self-center" style="text-align:right; text-decoration:none;">
                                    <button class="btn btn-rounded btn-info" >
                                        <a href="{{ action('App\Http\Controllers\Admin\ChatController@index',['user_id' => $chat->user->id]) }}" style="text-decoration:none; color :white;" class ="message">メッセージ</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /Inner main -->
    </div>
</div>
</div>
<!-- 
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($chats as $chat)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @if($chat->user->profile_image !== null)
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->user->id]) }}">
                                    <img src="{{ asset('storage/profile_image').'/'.$chat->user->profile_image }}" class="rounded-circle" width="50" height="50">
                                </a>
                            @else
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->user->id]) }}">
                                    <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                </a>
                            @endif
                            　
                            <div class="ml-2 d-flex flex-column">
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $chat->user->id]) }}">
                                    <p class="mb-0">{{ $chat->user->name }}</p>
                                </a>
                            </div>
                            @if (auth()->user()->isFollowed($chat->user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                @if (auth()->user()->isFollowing($chat->user->id))
                                    <form action="{{ route('unfollow', ['id' => $chat->user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['id' => $chat->user->id]) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-column" style= "margin:20px;">
                            <h5 class="mb-0 font-weight-bold">{{ $chat->user->profile }}</h5>
                        </div>
                        <div class="mr-3 d-flex align-items-center">
                            <a href="{{ action('App\Http\Controllers\Admin\ChatController@index',['user_id' => $chat->user->id]) }}"><i class="far fa-comment fa-fw"></i>チャット</a>
                        </div>  
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
        </div>
    </div> -->
@endsection