@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">プロフィール編集</div>
                <div class="card-body">
                    <form method="POST" action="{{ action('App\Http\Controllers\Admin\ProfileController@update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                            
                                @if($users_form->profile_image !== null)
                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users_form->id]) }}">
                                        <img src="{{ asset('storage/profile_image').'/'.$users_form->profile_image }}" class="rounded-circle" width="50" height="50">
                                    </a>
                                @else
                                    <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users_form->id]) }}">
                                        <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                    </a>
                                @endif
                                <div class="ml-2 d-flex flex-column">
                                    <p class="mb-0">　<a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users_form->id]) }}"style= "text-decoration: none" >{{ $users_form->name }}</a></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>名前</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="text" value="{{ $users_form->name }}">
                                <p></p>
                                <label  style= "font-size:20px;">プロフィール</label>
                                <textarea class="form-control" name="profile" rows="4">{{ $users_form->profile }}</textarea>
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
                                @if($users_form->profile_image !== null)
                                    <p>設定中:<img src="{{ asset('storage/profile_image').'/'.$users_form->profile_image }}" width="150" height="150">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                                        </label>
                                    </p>
                                @endif
                                <input type="hidden" name="id" value="{{ $users_form->id }}">
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">プロフィール編集</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('App\Http\Controllers\Admin\ProfileController@update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row align-items-center">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6 d-flex align-items-center">
                                <img src="{{ $users_form->profile_image }}" class="mr-2 rounded-circle" width="80" height="80" alt="profile_image">
                                <input type="file" name="profile_image" class="@error('profile_image') is-invalid @enderror" autocomplete="profile_image">

                                @error('')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $users_form->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $users_form->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">更新する</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






<form action="{{ action('App\Http\Controllers\Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
          </ul>
    @endif
    
    <label>名前</label>
    <input type="text" class="" name="name" value="{{ $users_form->name }}">
    <label>自己紹介文</label>
    <textarea class="" name="profile" rows="20" value="{{ $users_form->profile }}"></textarea>
    <label>画像</label>
    <input type="file" class="" name="profile_image" value="{{ $users_form->profile }}">



    <input type="hidden" name="id" value="{{ $users_form->id }}">
    {{ csrf_field() }}
    <input type="submit" class="btn btn-primary" value="更新">





</form>


@endsection