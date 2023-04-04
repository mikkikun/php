@extends('layouts.app')

@section('content')
<title>プロフィール編集</title>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 my-5">
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
                                            <img src="{{ $users_form->profile_image }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @else
                                        <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users_form->id]) }}">
                                            <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                        </a>
                                    @endif
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0"><a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users_form->id]) }}"style= "text-decoration: none" >{{ $users_form->name }}</a></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>名前</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="text" value="{{ $users_form->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label  style= "font-size:20px;">プロフィール</label>
                                    <textarea class="form-control @error('profile') is-invalid @enderror" name="profile" rows="4">{{ $users_form->profile }}</textarea>
                                    @error('profile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0 my-2">
                                <div class="col-md-12 p-5 w-100">
                                    <label>画像</label>
                                    <input type="file" class="p-2" name="image" >
                                    @if($users_form->profile_image !== null)
                                        <p>設定中:<img src="{{$users_form->profile_image }}" width="150" height="150">
                                            <label class="form-check-label col-md-12 p-2">
                                                <input type="checkbox" class="form-check-input p-2" name="remove" value="true">画像を削除
                                            </label>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-12 p-3 w-100 text-right">
                                    <input type="hidden" name="id" value="{{ $users_form->id }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">
                                        プロフィール編集
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