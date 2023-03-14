@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">コメント編集ページ</div>
                    <div class="card-body">
                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\CommentsController@update', ['comments' => $comments ,'posts' => $posts , 'users' => $users]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    @if(Auth::user()->profile_image !== null)
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comments->user->id]) }}">
                                            <img src="{{ asset('storage/profile_image').'/'.Auth::user()->profile_image }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @else
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comments->user->id]) }}">
                                            <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @endif
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0">　<a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comments->user->id]) }}"style= "text-decoration: none" >{{ $comments->user->name }}</a></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label  style= "font-size:20px;">本文</label>
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="body" required autocomplete="text" rows="4">{{ $comments->body }}</textarea>
                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="form-group row mb-0">
                                    <label>画像</label>
                                    <input type="file" class="" name="image" >
                                    @if($comments->image_path !== null)
                                        <p>設定中:<img src="{{ asset('storage/image').'/'.$comments->image_path }}" width="150" height="150">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                            </label>
                                        </p>
                                    @endif
                                    <input type="hidden" name="id" value="{{ $comments->id }}">
                                    {{ csrf_field() }}
                                </div>
                                <div class="col-md-12 p-3 w-100 text-right">
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