@extends('layouts.app')

@section('content')
<form action="{{ action('App\Http\Controllers\Admin\CommentsController@update') }}" method="post" enctype="multipart/form-data">
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