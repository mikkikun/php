@extends('layouts.app')

@section('content')
<title>コメント返信</title>
<div class="container" >
    <div class="row justify-content-center" >
        <div class="col-md-8 my-5">
            <div class="card">
                <div class="card-header ">コメント返信ページ</div>
                    <div class="card-body">
                        <form method="POST" action="{{ action('App\Http\Controllers\Admin\CommentsController@replie_create', ['comments' => $comments , 'users' => $users, 'posts' => $posts]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                
                                    @if($users->profile_image !== null)
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
                                </div>
                                <div class="col-md-12 my-3">
                                    <label  class="my-2" style= "font-size:20px;">本文</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" name="body"  autocomplete="text" rows="4">{{ old('body') }}</textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0 my-2">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <label>画像</label>
                                    <input type="file" class="" name="image_path">
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