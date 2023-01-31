@extends('layouts.app')

@section('content')
            <tr>
                <td class = ""></td>
                <td class = "">{{ $posts->updated_at }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $posts->title}}</td>
                <td class = "">{{ $posts->body}}</td>
                <td class = "">{{ $posts->cardgame}}</td>
                <td class = "">
                    @if($posts->image_path !== null)
                        <img src="{{ asset('storage/image').'/'.$posts->image_path }}">
                    @endif
                </td>
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
                <div>
                @if($posts->user_id !== Auth::id())
                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $posts->user->id]) }}">投稿者のページ</a>
                @endif
                </div>
                

                </td>
            </tr>
            </table>
            </form>



            <table>
            @foreach($comments as $data)
            <tr>
            
                <td class = "">{{ $data->user->name }}</td>
                <td class = "">{{ $data->updated_at }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $data->body}}</td>
                <td class = "">
                    @if($data->image_path !== null)
                        <img src="{{ asset('storage/image').'/'.$data->image_path }}">
                    @endif
                </td>
                <td class = "">
                @if($data->user_id == Auth::id())
                <form action="{{ action('App\Http\Controllers\Admin\CommentsController@delete') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="削除">
                </form>
                <div>
                    <a href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $data->id]) }}">編集</a>
                </div>
                
                @endif
                <div>
                @if($data->user_id !== Auth::id())
                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $data->user->id]) }}">投稿者のページ</a>
                @endif
                </div>
                <div>
                </td>
            </tr>
            @endforeach
            </table>



<form action="{{ action('App\Http\Controllers\Admin\CommentsController@create', ['id' => $posts->id]) }}" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif

    <label>本文</label>
    <textarea class="" name="body" rows="20" >{{ old('body') }}</textarea>

    <label>画像</label>
    <input type="file" class="" name="image_path">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="コメント">
</form>


@endsection