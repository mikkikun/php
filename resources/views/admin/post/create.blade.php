@extends('layouts.app')

@section('content')
<title>投稿ページ</title>
<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-8 my-5">
            <div class="card">
                <div class="card-header ">投稿ページ</div>
                    <div class="card-body">
                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\PostController@create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                
                                    @if($users->profile_image !== null)
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                            <img src="{{ $users->profile_image }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @else
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                            <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @endif
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">　<a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}"style= "text-decoration: none" >{{ $users->name }}</a></p>
                                    </div>
                                </div>
                                <div class="col-md-12 my-3">
                                    <label class="my-2">タイトル</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" autocomplete="text"  placeholder="25文字以内">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                    <label  class="my-2" style= "font-size:20px;">本文</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" name="body"  autocomplete="text" rows="4" placeholder="255文字以内"></textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0 my-2">
                                <div class="col-md-12 text-right">
                                    <select type="text" class="form-control @error('cardgame') is-invalid @enderror" name="cardgame"  autocomplete="select" >
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
                                    @error('cardgame')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <label>画像</label>
                                    <input type="file" class="" name="image">
                                    {{ csrf_field() }}
                                </div>
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <button type="submit" class="btn btn-primary">
                                        投稿する
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection