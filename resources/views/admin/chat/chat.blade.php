@extends('layouts.app')

@section('content')

<link href="{{ asset('css/chat.css') }}" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<title>メッセージ</title>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-md">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> メッセージ
                </div>
                <div class="panel-body">
                    <ul class="chat">
                        @foreach ($chats as $item)
                            @if($item->my_id == Auth::user()->id)
                                <li class="left clearfix"><span class="chat-img pull-left">
                                    @if(Auth::user()->profile_image !== null)
                                        <img src="{{Auth::user()->profile_image }}" class="rounded-circle" width="50" height="50">
                                    @else
                                        <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                    @endif
                                </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font">{{ Auth::user()->name }}</strong> <small class="pull-right text-muted">
                                                <span class="glyphicon glyphicon-time"></span>{{ $item->created_at }}</small>
                                        </div>
                                        <p>
                                            <h5>{{ $item->comment }}</h5>
                                            @if($item->image_path !== null)
                                                <img src="{{$item->image_path }}" width="150" height="150">
                                            @endif
                                        </p>
                                    </div>
                                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\ChatController@delete', ['id' => $item->id]) }}" class="mb-0">
                                            <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-align:right;">削除</button>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                </li>
                            @else
                                <li class="right clearfix"><span class="chat-img pull-right">
                                @if($users->profile_image !== null)
                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                        <img src="{{$users->profile_image }}" class="rounded-circle" width="50" height="50">
                                    </a>
                                @else
                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                        <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                    </a>
                                @endif
                                </span>
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>{{ $item->created_at }}</small>
                                            <strong class="pull-right primary-font">
                                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}"style= "text-decoration: none" >{{ $users->name }}</a>
                                            </strong>
                                        </div>
                                        <p>
                                        <h3>{{ $item->comment }}</h3>
                                        @if($item->image_path !== null)
                                            <img src="{{ asset('storage/chat').'/'.$item->image_path }}" width="150" height="150">
                                        @endif
                                        </p>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="panel-footer">
                    <div class="input-group">
                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\ChatController@add', ['id' => $users->id]) }}" enctype="multipart/form-data">
                            <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" placeholder="push massage (shift + Enter)" aria-label="With textarea"></textarea>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label>画像</label>
                            <input type="file" class="" name="image">
                            {{ csrf_field() }}
                            <span class="input-group-btn" style="text-align : right">
                                <button type="submit" id="submit" class="btn btn-warning btn-sm">送信</button>
                            </span>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection