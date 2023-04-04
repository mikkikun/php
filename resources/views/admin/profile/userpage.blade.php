@extends('layouts.app')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="ja">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="{{ asset('css/userpage.css') }}" rel="stylesheet">
	<title>ユーザーページ</title>
	<style>
		.h7
		{
			font-size: 0.9rem
		}
	</style>
</head>
<body>


<div class="container">
    <div class="col-lg-8" style="margin:0 auto;">
        <div class="panel profile-cover">
            <div class="profile-cover__img">
                @if($users->profile_image !== null)
                    <img src="{{ asset('storage/profile_image').'/'.$users->profile_image }}" class="rounded-circle" width="120" height="120">    
                @else
                    <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="120" height="120">
                @endif
                <h3 class="h3">{{ $users->name }}</h3>
                @if (Auth::user()->isFollowed($users->id))
                    <span class="mt-4 px-1 bg-secondary text-light">フォローされています</span>
                @endif
            </div>
            <div class="profile-cover__action bg--img" data-overlay="0.3">
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
                @endif
                @if ($users->id !== Auth::user()->id)
                    <button class="btn btn-rounded btn-info ">
                        <a href="{{ action('App\Http\Controllers\Admin\ChatController@index',['user_id' => $users->id]) }}" class = "message">メッセージ</a>
                    </button>
                @endif
            </div>
            <div class="profile-cover__info">
                <ul class="nav">
                    <li><strong>{{ count($postcount) }}</strong>投稿数</li>
                    <li><strong><a href="{{ action('App\Http\Controllers\Admin\ProfileController@follow_page',['id' => $users->id]) }}" class= "follow">{{ count($users->follows) }}</a></strong>フォロー</li>
                    <li><strong><a href="{{ action('App\Http\Controllers\Admin\ProfileController@follower_page',['id' => $users->id]) }}" class= "follow">{{ count($users->followers) }}</a></strong>フォロワー</li>
                </ul>
            </div>
            <div class="mt-5 d-flex flex-column" style= "padding:20px;">
                    <h5 class="mb-0 font-weight-bold">{{ $users->profile }}</h5>
            </div>
        </div>
        <div class="panel">
            <section class="card mt-4">
                <h3 class="panel-title mt-2 p-2">{{ $users->name }}さんの投稿一覧</h3>
                    @forelse ($posts as $data)
                        <div class="border p-2">
                            @if($data->user_id == Auth::id())
                                <div class="dropdown" style="text-align:right;">
                                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item text-primary" href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $data->id]) }}">編集</a>
                                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\PostController@delete', ['id' => $data->id]) }}" class="mb-0">
                                        <button type="submit" class="dropdown-item del-btn" style="color:#FF0000;">削除</button>
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <!-- post header -->
                            <div class="row m-0">
                                <div class="">
                                    @if($data->user->profile_image !== null)
                                        <a class="text-decoration-none" href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $data->user->id]) }}">
                                            <img class="rounded-circle" src="{{ asset('storage/profile_image').'/'.$data->user->profile_image }}" width="50" height="50" alt="...">
                                        </a>
                                    @else
                                        <a class="text-decoration-none" href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $data->user->id]) }}">
                                            <img class="rounded-circle" src="{{ asset('storage/profile_image/nodata.png') }}" width="50" height="50" alt="...">
                                        </a>
                                    @endif
                                </div>
                                <div class="flex-grow-1 pl-2">
                                    <a class="text-decoration-none" href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $data->user->id]) }}">
                                        <h2 class="text-capitalize h5 mb-0">{{ $data->user->name }}</h2>
                                    </a> 
                                    <p class="small text-secondary m-0 mt-0" style="text-align:right;">{{ $data->updated_at }}</p>
                                    <p class="text-capitalize h3 mt-0">{{ $data->title}}（{{ $data->cardgame}}）</p>
                                </div>
                            </div>
                            <!-- post body -->
                            <div class="row m-0">
                                <p class="my-1">{{ $data->body}}</p>
                                
                            </div>
                            <hr class="my-1 row m-0">
                                @if($data->image_path !== null)
                                    <img src="{{ asset('storage/image').'/'.$data->image_path }}" width="150" height="150">
                                @endif
                            <!-- post footer begins -->
                            <footer class="row m-3">
                                <!-- post actions -->
                                <div class="my-1">
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-0">
                                            @if (!in_array(Auth::user()->id, array_column($data->favorites->toArray(), 'user_id'), TRUE))
                                                <form method="POST" action="{{ route('favorites') }}" class="small text-decoration-none">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="{{ $data->id }}">
                                                    <button type="submit" class="btn p-0 border-0 text-primary">
                                                        <i class="far fa-heart fa-fw"></i>
                                                        {{ count($data->favorites) }}いいね
                                                    </button>
                                                        <a href="{{ action('App\Http\Controllers\Admin\FavoritesController@favorite_page',['id' => $data->id]) }}">
                                                            <div class = "fas  fa-user"></div>
                                                        </a>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('unfavorites', ['post_id' => $data->id, 'user_id' => $data->user->id]) }}" class="mb-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn p-0 border-0 text-danger">
                                                        <i class="fas fa-heart fa-fw"></i>
                                                        {{ count($data->favorites) }}いいね解除
                                                    </button>
                                                        <a href="{{ action('App\Http\Controllers\Admin\FavoritesController@favorite_page',['id' => $data->id]) }}" >
                                                            <div class = "fas  fa-user"></div>
                                                        </a>
                                                </form>
                                            @endif
                                            
                                        </li>
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-right-0 border-top-0 border-bottom-0">
                                            <a class="small text-decoration-none" href="{{ action('App\Http\Controllers\Admin\CommentsController@index', ['post_id' => $data->id, 'user_id' => $data->user->id]) }}">
                                                <i class="fas fa-comment-alt"></i> {{ count($data->comments) }} Comment
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </footer>
                            <!-- post footer ends -->
                        </div>
                    @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">投稿はまだありません。</p>
                    </li>
                    @endforelse
                    <div class="row m-3">
                        {{ $posts->appends(request()->query())->links('pagination::bootstrap-4')}}
                    </div>
				</section>
        </div>
    </div>
</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
@endsection