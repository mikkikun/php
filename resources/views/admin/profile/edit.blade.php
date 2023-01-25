@extends('layouts.app')

@section('content')
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