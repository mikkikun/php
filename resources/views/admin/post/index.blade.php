@extends('layouts.app')

@section('content')
<div class="container">
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
                            <p class="mb-0 text-secondary" >{{ count($data->favorites) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
</div>
    <div class="my-4 d-flex justify-content-center">
        
    </div>
</div>

<!-- <div class="col-md-4">
                <a href="{{ action('App\Http\Controllers\Admin\PostController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div> -->
@endsection