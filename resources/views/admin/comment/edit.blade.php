@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">コメント編集ページ</div>
                <div class="card-body">
                    <form method="POST" action="{{ action('App\Http\Controllers\Admin\CommentsController@update' , ['comment_form' => $comment_form ,'post_id' => $post_id , 'user_id' => $user_id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                            
                                @if($comment_form->profile_image !== null)
                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comment_form->user->id]) }}">
                                        <img src="{{ asset('storage/profile_image').'/'.$comments->profile_image }}" class="rounded-circle" width="50" height="50">
                                    </a>
                                @else
                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comment_form->user->id]) }}">
                                        <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                    </a>
                                @endif
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">　<a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $comment_form->user->id]) }}"style= "text-decoration: none" >{{ $comment_form->user->name }}</a></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label  style= "font-size:20px;">本文</label>
                                <textarea class="form-control @error('text') is-invalid @enderror" name="body" required autocomplete="text" rows="4">{{ $comment_form->body }}</textarea>
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
                                <input type="file" class="" name="image" >
                                @if($comment_form->image_path !== null)
                                    <p>設定中:<img src="{{ asset('storage/image').'/'.$comment_form->image_path }}" width="150" height="150">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                        </label>
                                    </p>
                                @endif
                                <input type="hidden" name="id" value="{{ $comment_form->id }}">
                                {{ csrf_field() }}
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



<form action="" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
          </ul>
    @endif


    <label>本文</label>
    <textarea class="" name="body" rows="20">{{ $comment_form->body }}</textarea>

    <label>画像</label>
    <input type="file" class="" name="image">
    設定中: {{ $comment_form->image_path }}
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
    </label>

    <input type="hidden" name="id" value="{{ $comment_form->id }}">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="更新">

    </form>
@endsection