@extends('layouts.app')

@section('content')
            <h2>投稿画面</h2>
            <div class="col-md-4">
                <a href="{{ action('App\Http\Controllers\Admin\PostController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <form action="{{ action('App\Http\Controllers\Admin\PostController@index') }}" method="get">
            <label class="col-md-2">タイトル</label>
            <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="検索">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">タイトル</th>
                        <th width="50%">本文</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th>{{ $post->id }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
@endsection