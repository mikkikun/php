@extends('layouts.app')

@section('content')
<form method="POST" action="{{route('add')}}">
    @csrf
    <div class="chat-container row justify-content-center">
        <div class="chat-area">
            <div class="card">
                <div class="card-header">Chat</div>
                <div class="card-body chat-card">
                @foreach ($chats as $item)
                @include('chat.index', ['item' => $item])
                @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="comment-container row justify-content-center">
        <div class="input-group comment-area">
            <textarea class="form-control" placeholder="input massage" aria-label="With textarea"></textarea>
            <button type="input-group-prepend button" class="btn btn-outline-primary comment-btn">送信</button>
        </div>
    </div>{{dd($user_id);}}
<form method="POST" action="{{ action('App\Http\Controllers\Admin\ChatController@add', ['id' => $user_id->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="comment-container row justify-content-center">
        <div class="input-group comment-area">
            <textarea class="form-control" id="comment" name="comment" placeholder="push massage (shift + Enter)"
                aria-label="With textarea"
                onkeydown="if(event.shiftKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
            <button type="submit" id="submit" class="btn btn-outline-primary comment-btn">送信</button>
        </div>
    </div>
</form>
@endsection