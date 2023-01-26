@extends('layouts.app')

@section('content')

            <div class="col-md-4">
                <a href="{{ action('App\Http\Controllers\Admin\PostController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <form action="{{ action('App\Http\Controllers\Admin\PostController@index') }}" method="get">
            <label class="col-md-2">タイトル</label>
            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="検索">

            <table>
            @foreach($posts as $data)
            <tr>
                <td class = "">{{ $data->user->name }}</td>
                <td class = "">{{ $data->updated_at }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $data->title}}</td>
                <td class = "">{{ $data->body}}</td>
                <td class = "">{{ $data->cardgame}}</td>
                <td class = "">
                    @if($data->image_path !== null)
                        <img src="{{ asset('storage/image').'/'.$data->image_path }}">
                    @endif
                </td>
                <td class = "">
                @if($data->user_id == Auth::id())
                <form action="{{ action('App\Http\Controllers\Admin\PostController@delete', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="削除">
                </form>
                <div>
                    <a href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $data->id]) }}">編集</a>
                </div>
                
                @endif
                <div>
                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@indexpage', ['id' => $data->user->id]) }}">投稿者のページ</a>
                </div>
                </td>
            </tr>
            @endforeach
            </table>
            </form>
@endsection