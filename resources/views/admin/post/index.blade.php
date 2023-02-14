@extends('layouts.app')

@section('content')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

	<title>みんなの投稿</title>
	<style>
		.h7
		{
			font-size: 0.9rem
		}
	</style>
</head>
<body>
	<div class="container-fluid ">
		<div class="row ">
			<div class="col-9 my-5" style="margin:0 auto;">
				<!--- Post Form Begins -->
                <form action="{{ action('App\Http\Controllers\Admin\PostController@index') }}" method="get">
                    <label class="col-md-2" style= "font-size:20px;">投稿検索</label>
                        <select type="text" class="" name="cond_title" value="{{ $cond_title }}">
                            <option value="">カードゲームを選択してください</option>
                            <option value="遊戯王">遊戯王</option>
                            <option value="遊戯王ラッシュデュエル">遊戯王ラッシュデュエル</option>
                            <option value="デュエル・マスターズ">デュエル・マスターズ</option>
                            <option value="ポケモンカード">ポケモンカード</option>
                            <option value="ヴァイスシュヴァルツ">ヴァイスシュヴァルツ</option>
                            <option value="シャドウバース">シャドウバース</option>
                            <option value="ヴァンガード">ヴァンガード</option>
                            <option value="ONE PIECE">ONE PIECE</option>
                            <option value="マジック・ザ・ギャザリング">マジック・ザ・ギャザリング</option>
                            <option value="ウィクロス">ウィクロス</option>
                            <option value="その他">その他</option>
                        </select>
                        {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="検索">
                </form>
                <!--- Post Form Ends -->

				<!-- Post Begins -->
				<section class="card mt-4">
                    @foreach ($posts as $data)
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
                    @endforeach
				</section>
				<!-- Post Ends -->
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

<!-- <div class="container">
    <div class="row justify-content-center">
        <div style= "text-align:center; margin-bottom: 50px; ">
            <form action="{{ action('App\Http\Controllers\Admin\PostController@index') }}" method="get">
                <label class="col-md-2" style= "font-size:20px;">カードゲーム検索</label>
                    <select type="text" class="" name="cond_title" value="{{ $cond_title }}">
                        <option value="">選択してください</option>
                        <option value="遊戯王">遊戯王</option>
                        <option value="遊戯王ラッシュデュエル">遊戯王ラッシュデュエル</option>
                        <option value="デュエル・マスターズ">デュエル・マスターズ</option>
                        <option value="ポケモンカード">ポケモンカード</option>
                        <option value="ヴァイスシュヴァルツ">ヴァイスシュヴァルツ</option>
                        <option value="シャドウバース">シャドウバース</option>
                        <option value="ヴァンガード">ヴァンガード</option>
                        <option value="ONE PIECE">ONE PIECE</option>
                        <option value="マジック・ザ・ギャザリング">マジック・ザ・ギャザリング</option>
                        <option value="ウィクロス">ウィクロス</option>
                        <option value="その他">その他</option>
                    </select>
                    {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="検索">
            </form>
        </div>
        @foreach ($posts as $data)
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-haeder p-3 w-100 d-flex">
                        @if($data->user->profile_image !== null)
                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $data->user->id]) }}">
                                <img src="{{ asset('storage/profile_image').'/'.$data->user->profile_image }}" class="rounded-circle" width="50" height="50">
                            </a>
                        @else
                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $data->user->id]) }}">
                                <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                            </a>
                        @endif
                        <div class="ml-2 d-flex flex-column">
                            <p class="mb-0">　<a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $data->user->id]) }}"style= "text-decoration: none" >{{ $data->user->name }}</a></p>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $data->updated_at }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6>{{ $data->title}}（{{ $data->cardgame}}）</h6>
                        <h3>{{ $data->body}}</h3>
                        @if($data->image_path !== null)
                            <img src="{{ asset('storage/image').'/'.$data->image_path }}" width="150" height="150">
                        @endif
                    </div>
                    <div class="card-footer py-1 d-flex justify-content-end bg-white">
                        @if($data->user_id == Auth::id())
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $data->id]) }}"><i class="far fa-comment fa-fw"></i>編集</a>
                            </div>
                                　
                                <div class="mr-3 d-flex align-items-center">
                                    <form method="POST" action="{{ action('App\Http\Controllers\Admin\PostController@delete', ['id' => $data->id]) }}" class="mb-0">
                                        {{ csrf_field() }}
                                        <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-decoration:underline; ">削除</button>
                                    </form>
                                </div>
                        @endif 
                        　
                        <div class="mr-3 d-flex align-items-center">
                            <a href="{{ action('App\Http\Controllers\Admin\CommentsController@index', ['post_id' => $data->id, 'user_id' => $data->user->id]) }}"><i class="far fa-comment fa-fw"></i>コメント{{ count($data->comments) }}</a>
                        </div>
                        　
                        <div class="d-flex align-items-center">
                            @if (!in_array(Auth::user()->id, array_column($data->favorites->toArray(), 'user_id'), TRUE))
                                <form method="POST" action="{{ route('favorites') }}" class="mb-0">
                                    @csrf

                                    <input type="hidden" name="post_id" value="{{ $data->id }}">
                                    <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"style="text-decoration:underline;">いいね</i></button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('unfavorites', ['post_id' => $data->id, 'user_id' => $data->user->id]) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i>いいね解除</button>
                                </form>
                            @endif
                            <p class="mb-0 text-secondary" ><a href="{{ action('App\Http\Controllers\Admin\FavoritesController@favorite_page',['id' => $data->id]) }}">{{ count($data->favorites) }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
</div>
    <div class="my-4 d-flex justify-content-center">
        
    </div>
</div> -->

<!-- <div class="col-md-4">
                <a href="{{ action('App\Http\Controllers\Admin\PostController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div> -->
@endsection