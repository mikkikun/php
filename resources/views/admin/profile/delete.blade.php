@extends('layouts.app')

@section('content')
@if (count($errors) > 0)
        <ul>
            @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
          </ul>
    @endif
<h2>本当にアカウントを削除しますか？</h2>
<form action="{{ action('App\Http\Controllers\Admin\ProfileController@delete')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="削除">
</form>
@endsection