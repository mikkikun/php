@extends('layouts.app')

@section('content')

@if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
          </ul>
    @endif

            <table>
            <tr>
            <td class = "">
                    @if($users->profile_image !== null)
                        <img src="{{ asset('storage/profile_image').'/'.$users->profile_image }}">
                    @endif
                </td>
                <td class = "">{{ $users->name }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $users->profile}}</td>
                <td class = ""><a href="{{ action('App\Http\Controllers\Admin\ProfileController@follow_page') }}">フォロー</a></td>
                <td class = ""><a href="{{ action('App\Http\Controllers\Admin\ProfileController@follower_page') }}">フォロワー</a></td>
            </tr>
            </table>


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
                </td>
            </tr>
            @endforeach
            </table>


@endsection