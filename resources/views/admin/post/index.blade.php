@extends('layouts.app')

@section('content')
            <h2>投稿画面</h2>
            <div class="col-md-4">
                <a href="{{ action('App\Http\Controllers\Admin\PostController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <form action="{{ action('App\Http\Controllers\Admin\PostController@index') }}" method="get">
            <label class="col-md-2">タイトル</label>
            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="検索">


            <table>
            @foreach($posts as $posts)
            <tr>
                <td class = "">{{ $posts->user->name }}</td>
                <td class = "">{{ $posts->updated_at }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $posts->title}}</td>
                <td class = "">{{ $posts->body}}</td>
                <td class = "">{{ $posts->cardgame}}</td>
                <td class = ""><img src="{{ asset('storage/app/public/image{$posts->image_path}') }}"></td>
                
                <td class = "">
                @if($posts->user_id == Auth::id())
                <form action="{{ action('App\Http\Controllers\Admin\PostController@delete', ['id' => $posts->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="削除">
                </form>
                <div>
                    <a href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $posts->id]) }}">編集</a>
                </div>
                @endif
                </td>
            </tr>
            @endforeach
            </table>
@endsection