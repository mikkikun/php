@extends('layouts.app')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="{{ asset('css/comment.css') }}" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!------ Include the above in your HEAD tag ---------->


	<title>コメント</title>
<div class="container py-4 ">
    <div class="row justify-content-center mb-5 ">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100 d-flex ">
                    @if($users->profile_image != null)
                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                            <img src="{{$users->profile_image }}" class="rounded-circle" width="50" height="50">
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
                        <p class="mb-0 text-secondary">{{ $posts->updated_at }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <h6>{{ $posts->title}}（{{ $posts->cardgame}}）</h6>
                    <h3>{{ $posts->body}}</h3>
                        @if($posts->image_path !== null)
                            <img src="{{$posts->image_path }}" width="150" height="150">
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
                                <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-decoration: none; ">削除</button>
                            </form>
                        </div>
                    @endif
                    <div class="d-flex align-items-center">
                        @if (!in_array(Auth::user()->id, array_column($posts->favorites->toArray(), 'user_id'), TRUE))
                            <form method="POST" action="{{ route('favorites') }}" class="small text-decoration-none">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                <button type="submit" class="btn p-0 border-0 text-primary">
                                    <i class="far fa-heart fa-fw"></i>
                                    {{ count($posts->favorites) }}いいね
                                </button>
                                <a href="{{ action('App\Http\Controllers\Admin\FavoritesController@favorite_page',['id' => $posts->id]) }}">
                                    <div class = "fas  fa-user"></div>
                                </a>
                            </form>
                        @else
                            <form method="POST" action="{{ route('unfavorites', ['post_id' => $posts->id, 'user_id' => $posts->user->id]) }}" class="mb-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn p-0 border-0 text-danger">
                                    <i class="fas fa-heart fa-fw"></i>
                                    {{ count($posts->favorites) }}いいね解除
                                </button>
                                <a href="{{ action('App\Http\Controllers\Admin\FavoritesController@favorite_page',['id' => $posts->id]) }}" >
                                    <div class = "fas  fa-user"></div>
                                </a>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="py-3">
                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\CommentsController@create', ['id' => $posts->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    @if(Auth::user()->profile_image !== null)
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => Auth::user()->id]) }}">
                                            <img src="{{Auth::user()->profile_image }}" class="rounded-circle" width="50" height="50">
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
                                    <textarea class="form-control @error('body') is-invalid @enderror" name="body" autocomplete="text" rows="4" placeholder="255文字以内でコメントを入力してください"></textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <label>画像</label>
                                    <input type="file" class="" name="image_path">
                                        {{ csrf_field() }}
                                </div>
                                <div class="col-md-12 p-3 w-100 text-right">
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
    
    <div class="container">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
        <div class="row">
        <!-- Contenedor Principal -->
            <div class="comments-container">
                <ul id="comments-list" class="comments-list">
                    @forelse ($comments as $comment)
                        <li>
                            <div class="card">
                                <div class="card-haeder p-3 w-100 d-flex">
                                    @if($comment->user->profile_image !== null)
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comment->user->id]) }}">
                                            <img src="{{ $comment->user->profile_image }}" class="rounded-circle" width="50" height="50">
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
                                    <h3>{!! nl2br(e($comment->body)) !!}</h3>
                                    @if($comment->image_path !== null)
                                        <img src="{{$comment->image_path }}" width="150" height="150">
                                    @endif
                                </div>
                                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                                    @if($comment->user_id == Auth::user()->id)
                                        <div class="mr-3 d-flex align-items-center">
                                            <a href="{{ action('App\Http\Controllers\Admin\CommentsController@edit', ['comments' => $comment ,'posts' => $posts , 'users' => $users]) }}"><i class="far fa-comment fa-fw"></i>編集</a>
                                        </div>
                                        <div class="mr-3 d-flex align-items-center">
                                            <form method="POST" action="{{ action('App\Http\Controllers\Admin\CommentsController@delete', ['comment_id' => $comment->id]) }}" class="mb-0">
                                                @method("DELETE")
                                                {{ csrf_field() }}
                                                <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-decoration: none;" >削除</button>
                                            </form>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center">
                                        <a href="{{ action('App\Http\Controllers\Admin\CommentsController@replie', ['comments' => $comment ,'posts' => $posts , 'users' => $users]) }}">
                                            <i class="far fa-comment fa-fw"></i>コメント
                                        </a>
                                        @if (!in_array(Auth::user()->id, array_column($comment->favorites_comments->toArray(), 'user_id'), TRUE))
                                            <form method="POST" action="{{ route('favorites_comment') }}" class="small text-decoration-none">
                                                @csrf
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                <button type="submit" class="btn p-0 border-0 text-primary">
                                                    <i class="far fa-heart fa-fw"></i>
                                                    {{ count($comment->favorites_comments) }}いいね
                                                </button>
                                                <a href="{{ action('App\Http\Controllers\Admin\FavoritesController@comment_favorite_page',['id' => $comment->id]) }}">
                                                    <div class = "fas  fa-user"></div>
                                                </a>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('unfavorites_comment', ['comment_id' => $comment->id, 'user_id' => $comment->user->id]) }}" class="mb-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn p-0 border-0 text-danger">
                                                    <i class="fas fa-heart fa-fw"></i>
                                                    {{ count($comment->favorites_comments) }}いいね解除
                                                </button>
                                                <a href="{{ action('App\Http\Controllers\Admin\FavoritesController@comment_favorite_page',['id' => $comment->id]) }}" >
                                                    <div class = "fas  fa-user"></div>
                                                </a>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @foreach($comment->replies as $replie)
                                <ul class="comments-list reply-list">
                                    <li>
                                        <!-- Avatar -->
                                        <div class="card">
                                            <div class="card-haeder p-3 w-100 d-flex">
                                                @if($replie->user->profile_image !== null)
                                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $replie->user->id]) }}">
                                                        <img src="{{$replie->user->profile_image }}" class="rounded-circle" width="50" height="50">
                                                    </a>
                                                @else
                                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $replie->user->id]) }}">
                                                        <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                                    </a>
                                                @endif
                                                <div class="ml-2 d-flex flex-column">
                                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $replie->user->id]) }}">
                                                        <p class="mb-0">{{ $replie->user->name }}</p>
                                                    </a>
                                                </div>
                                                <div class="d-flex justify-content-end flex-grow-1">
                                                    <p class="mb-0 text-secondary">{{ $replie->created_at->format('Y-m-d H:i') }}</p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h3>{!! nl2br(e($replie->body)) !!}</h3>
                                                @if($replie->image_path !== null)
                                                    <img src="{{$replie->image_path }}" width="150" height="150">
                                                @endif
                                            </div>
                                            <div class="card-footer py-1 d-flex justify-content-end bg-white">
                                                @if($replie->user_id == Auth::user()->id)
                                                    <div class="mr-3 d-flex align-items-center">
                                                        <a href="{{ action('App\Http\Controllers\Admin\CommentsController@replie_edit', ['replie' => $replie ,'posts' => $posts , 'users' => $users]) }}"><i class="far fa-comment fa-fw"></i>編集</a>
                                                    </div>
                                                    <div class="mr-3 d-flex align-items-center">
                                                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\CommentsController@delete', ['replie_id' => $replie->id]) }}" class="mb-0">
                                                            @method("DELETE")
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-decoration: none;" >削除</button>
                                                        </form>
                                                    </div>
                                                @endif
                                                <div class="d-flex align-items-center">
                                                    @if (!in_array(Auth::user()->id, array_column($replie->favorites_replie->toArray(), 'user_id'), TRUE))
                                                        <form method="POST" action="{{ route('favorites_replie') }}" class="small text-decoration-none">
                                                            @csrf
                                                            <input type="hidden" name="replie_id" value="{{ $replie->id }}">
                                                            <button type="submit" class="btn p-0 border-0 text-primary">
                                                                <i class="far fa-heart fa-fw"></i>
                                                                {{ count($replie->favorites_replie) }}いいね
                                                            </button>
                                                            <a href="{{ action('App\Http\Controllers\Admin\FavoritesController@replie_favorite_page',['id' => $replie->id]) }}">
                                                                <div class = "fas  fa-user"></div>
                                                            </a>
                                                        </form>
                                                    @else
                                                        <form method="POST" action="{{ route('unfavorites_replie', ['replie_id' => $replie->id, 'user_id' => $replie->user->id]) }}" class="mb-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn p-0 border-0 text-danger">
                                                                <i class="fas fa-heart fa-fw"></i>
                                                                {{ count($replie->favorites_replie) }}いいね解除
                                                            </button>
                                                            <a href="{{ action('App\Http\Controllers\Admin\FavoritesController@replie_favorite_page',['id' => $replie->id]) }}" >
                                                                <div class = "fas  fa-user"></div>
                                                            </a>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                    @empty
                        <li class="list-group-item">
                            <p class="mb-0 text-secondary">コメントはまだありません。</p>
                        </li>
                    @endforelse
                </ul>
                <div class="row m-3">
                        {{ $comments->appends(request()->query())->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection