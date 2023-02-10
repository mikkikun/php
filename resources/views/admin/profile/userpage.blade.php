@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        @if($users->profile_image !== null)
                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                <img src="{{ asset('storage/profile_image').'/'.$users->profile_image }}" class="rounded-circle" width="50" height="50">
                            </a>
                        @else
                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                            </a>
                        @endif
                        <div class="mt-3 d-flex flex-column">
                            <h4 class="mb-0 font-weight-bold"><a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}"style= "text-decoration: none" >{{ $users->name }}</a></h4>
                        </div>
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex">
                            <div>
                                @if ($users->id === Auth::user()->id)
                                    <a href="{{ route('profile-edit' , [Auth::user()->id]) }}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                    @if (Auth::user()->isFollowing($users->id))
                                        <form action="{{ route('unfollow', ['id' => $users]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">フォロー解除</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow', ['id' => $users]) }}" method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" class="btn btn-primary">フォローする</button>
                                        </form>
                                    @endif
                                    @if (Auth::user()->isFollowed($users->id))
                                        <span class="mt-2 px-1 bg-secondary text-light">フォローされています</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">投稿数</p>
                                <span>{{ count($posts) }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">フォロー数</p>
                                <span><a href="{{ action('App\Http\Controllers\Admin\ProfileController@follow_page',['id' => $users->id]) }}">{{ count($users->follows) }}</a></span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">フォロワー数</p>
                                <span><a href="{{ action('App\Http\Controllers\Admin\ProfileController@follower_page',['id' => $users->id]) }}">{{ count($users->followers) }}</a></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="mt-5 d-flex flex-column" style= "margin:20px;">
                    <h5 class="mb-0 font-weight-bold">{{ $users->profile }}</h5>
                </div>
            </div>
        </div>
        @if (isset($posts))
            @foreach ($posts as $post)
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @if($users->profile_image != null)
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                    <img src="{{ asset('storage/profile_image').'/'.$users->profile_image }}" class="rounded-circle" width="50" height="50">
                                </a>
                            @else
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                    <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                </a>
                            @endif
                            　
                            <div class="ml-2 d-flex flex-column flex-grow-1">
                                <p class="mb-0"><a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}"style= "text-decoration: none" >{{ $post->user->name }}</a></p>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $post->updated_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6>{{ $post->title}}（{{ $post->cardgame}}）</h6>
                            <h3>{{ $post->body }}</h3>    
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            @if($post->user_id == Auth::id())
                                <div class="mr-3 d-flex align-items-center">
                                    <a href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $post->id]) }}"><i class="far fa-comment fa-fw"></i>編集</a>
                                </div>
                                    　
                                    <div class="mr-3 d-flex align-items-center">
                                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\PostController@delete', ['id' => $post->id]) }}" class="mb-0">
                                            {{ csrf_field() }}
                                            <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-decoration:underline; ">削除</button>
                                        </form>
                                    </div>
                            @endif 
                            　
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ action('App\Http\Controllers\Admin\CommentsController@index', ['post_id' => $post->id, 'user_id' => $post->user->id]) }}"><i class="far fa-comment fa-fw"></i>コメント{{ count($post->comments) }}</a>
                            </div>
                            　
                            <div class="d-flex align-items-center">
                                @if (!in_array(Auth::user()->id, array_column($post->favorites->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ route('favorites') }}" class="mb-0">
                                        @csrf

                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"style="text-decoration:underline;">いいね</i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('unfavorites', ['post_id' => $post->id, 'user_id' => $post->user->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i>いいね解除</button>
                                    </form>
                                @endif
                                <p class="mb-0 text-secondary" ><a href="{{ action('App\Http\Controllers\Admin\FavoritesController@favorite_page',['id' => $post->id]) }}">{{ count($post->favorites) }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="mr-3 d-flex align-items-center">
    <a href="{{ action('App\Http\Controllers\Admin\ChatController@index',['user_id' => $users->id]) }}"><i class="far fa-comment fa-fw"></i>チャット</a>
</div>
@endsection