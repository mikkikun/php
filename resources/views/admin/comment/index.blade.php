@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
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
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0">　<a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}"style= "text-decoration: none" >{{ $users->name }}</a></p>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $posts->updated_at }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <h6>{{ $posts->title}}（{{ $posts->cardgame}}）</h6>
                    <h3>{{ $posts->body}}</h3>
                        @if($posts->image_path !== null)
                            <img src="{{ asset('storage/image').'/'.$posts->image_path }}" width="150" height="150">
                        @endif
                </div>
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                    @if($posts->user_id == Auth::user()->id)
                        <div class="mr-3 d-flex align-items-center">
                            <a href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $posts->id]) }}"><i class="far fa-comment fa-fw"></i>編集</a>
                        </div>
                        　
                        <div class="mr-3 d-flex align-items-center">
                            <form method="POST" action="{{ action('App\Http\Controllers\Admin\PostController@delete', ['id' => $posts->id]) }}" class="mb-0">
                                {{ csrf_field() }}
                                <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-decoration:underline; ">削除</button>
                            </form>
                        </div>
                    @endif
                    　
                    <div class="d-flex align-items-center">
                        @if (!in_array(Auth::user()->id, array_column($posts->favorites->toArray(), 'user_id'), TRUE))
                            <form method="POST" action="{{ route('favorites') }}" class="mb-0">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"style="text-decoration:underline;">いいね</i></button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('unfavorites', ['post_id' => $posts->id, 'user_id' => $posts->user->id]) }}" class="mb-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i>いいね解除</button>
                            </form>
                        @endif
                        <p class="mb-0 text-secondary" ><a href="{{ action('App\Http\Controllers\Admin\FavoritesController@favorite_page',['id' => $posts->id]) }}">{{ count($posts->favorites) }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <ul class="list-group">
                @forelse ($comments as $comment)
                    <li class="list-group-item">
                        <div class="py-3 w-100 d-flex">
                            @if($comment->user->profile_image !== null)
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comment->user->id]) }}">
                                    <img src="{{ asset('storage/profile_image').'/'.$comment->user->profile_image }}" class="rounded-circle" width="50" height="50">
                                </a>
                            @else
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comment->user->id]) }}">
                                    <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                </a>
                            @endif
                            　
                            <div class="ml-2 d-flex flex-column">
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comment->user->id]) }}">
                                    <p class="mb-0">{{ $comment->user->name }}</p>
                                </a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! nl2br(e($comment->body)) !!}
                        </div>
                            @if($comment->image_path !== null)
                                <img src="{{ asset('storage/image').'/'.$comment->image_path }}" width="150" height="150">
                            @endif
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            @if($comment->user_id == Auth::user()->id)
                                <div class="mr-3 d-flex align-items-center">
                                    <a href="{{ action('App\Http\Controllers\Admin\CommentsController@edit', ['comments' => $comment ,'posts' => $posts , 'users' => $users]) }}"><i class="far fa-comment fa-fw"></i>編集</a>
                                </div>
                                　
                                <div class="mr-3 d-flex align-items-center">
                                    <form method="POST" action="{{ action('App\Http\Controllers\Admin\CommentsController@delete', ['id' => $comment->id]) }}" class="mb-0">
                                        @method("DELETE")
                                        {{ csrf_field() }}
                                        <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-decoration:underline; ">削除</button>
                                    </form>
                                </div>
                            @endif
                            　
                            <div class="d-flex align-items-center">
                                @if (!in_array(Auth::user()->id, array_column($comment->favorites_comments->toArray(), 'user_id'), TRUE))
                                    <form method="POST" action="{{ route('favorites_comment') }}" class="mb-0">
                                        @csrf
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"style="text-decoration:underline;">いいね</i></button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('unfavorites_comment', ['comment_id' => $comment->id, 'user_id' => $comment->user->id]) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i>いいね解除</button>
                                    </form>
                                @endif
                                <p class="mb-0 text-secondary" ><a href="{{ action('App\Http\Controllers\Admin\FavoritesController@comment_favorite_page',['id' => $comment->id]) }}">{{ count($comment->favorites_comments) }}</a></p>
                            </div>
                    </li>
                    <p></p>
                @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">コメントはまだありません。</p>
                    </li>
                @endforelse
                <li class="list-group-item">
                    <div class="py-3">
                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\CommentsController@create', ['id' => $posts->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    @if(Auth::user()->profile_image !== null)
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => Auth::user()->id]) }}">
                                            <img src="{{ asset('storage/profile_image/' .Auth::user()->profile_image) }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @else
                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => Auth::user()->id]) }}">
                                        <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                    </a>
                                    @endif
                                    　
                                    <div class="ml-2 d-flex flex-column">
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => Auth::user()->id]) }}">
                                        <p class="mb-0">{{ Auth::user()->name }}</p>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="body" required autocomplete="text" rows="4">{{ old('body') }}</textarea>
                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-right">
                                    <p class="mb-4 text-danger">255文字以内</p>
                                    <label>画像</label>
                                    <input type="file" class="" name="image_path">
                                        {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">
                                        コメントする
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection