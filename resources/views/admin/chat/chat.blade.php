@extends('layouts.app')

@section('content')
<div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header">チャット</div>
                <div class="card-body chat-card">
                    @foreach ($chats as $item)
                    <!-- @include('admin.chat.index', ['item' => $item]) -->
                        @if($item->my_id == Auth::user()->id)
                            <div class="col-md-8 mb-3">
                                <div class="card">
                                    <div class="card-haeder p-3 w-100 d-flex">
                                        @if(Auth::user()->profile_image !== null)
                                            <img src="{{ asset('storage/profile_image').'/'.Auth::user()->profile_image }}" class="rounded-circle" width="50" height="50">
                                        @else
                                            <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                        @endif
                                        <div class="ml-2 d-flex flex-column">
                                            <p class="mb-0">{{ Auth::user()->name }}</p>
                                        </div>
                                        <div class="d-flex justify-content-end flex-grow-1">
                                            <p class="mb-0 text-secondary">{{ $item->created_at }}</p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $item->comment }}</h3>
                                        @if($item->image_path !== null)
                                            <img src="{{ asset('storage/chat').'/'.$item->image_path }}" width="150" height="150">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-8 mb-3">
                                <div class="card">
                                    <div class="card-haeder p-3 w-100 d-flex">
                                        @if($users->profile_image !== null)
                                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                                <img src="{{ asset('storage/profile_image').'/'.$users->profile_image }}" class="rounded-circle" width="50" height="50">
                                            </a>
                                        @else
                                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                                <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                            </a>
                                        @endif
                                        <div class="ml-2 d-flex flex-column">
                                            <p class="mb-0"><a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}"style= "text-decoration: none" >{{ $users->name }}</a></p>
                                        </div>
                                        <div class="d-flex justify-content-end flex-grow-1">
                                            <p class="mb-0 text-secondary">{{ $item->created_at }}</p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3>{{ $item->comment }}</h3>
                                        @if($item->image_path !== null)
                                            <img src="{{ asset('storage/chat').'/'.$item->image_path }}" width="150" height="150">
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<form method="POST" action="{{ action('App\Http\Controllers\Admin\ChatController@add', ['id' => $users->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="comment-container row justify-content-center">
        <div class="input-group comment-area">
            <textarea class="form-control" id="comment" name="comment" placeholder="push massage (shift + Enter)"
                aria-label="With textarea"
                onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
            <label>画像</label>
            <input type="file" class="" name="image">
            {{ csrf_field() }}
            <button type="submit" id="submit" class="btn btn-outline-primary comment-btn">送信</button>
        </div>
    </div>
</form>
@endsection