@extends('layouts.app')

@section('content')
<div class="chat-container row justify-content-center">
    <div class="chat-area">
        <div class="card">
            <div class="card-header">チャット</div>
                <div class="card-body chat-card">
                    @foreach ($chats as $item)
                    @include('admin.chat.index', ['item' => $item])
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