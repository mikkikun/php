@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($posts as $data)
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-haeder p-3 w-100 d-flex">
                        @if($data->user->profile_image !== null)
                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $data->user->id]) }}">
                                <img src="{{ asset('storage/profile_image').'/'.$data->user->profile_image }}" class="rounded-circle" width="50" height="50">
                            </a>
                        @endif
                        <div class="ml-2 d-flex flex-column">
                            <p class="mb-0">　{{ $data->user->name }}</p>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $data->updated_at }}</p>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <h6>{{ $data->title}}</h6>
                        <h3>{{ $data->body}}</h3>
                    </div>
                    <div class="card-footer py-1 d-flex justify-content-end bg-white">
                        @if($data->user_id == Auth::id())
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $data->id]) }}"><i class="far fa-comment fa-fw"></i>編集</a>
                            </div>
                            　
                            <div class="mr-3 d-flex align-items-center">
                                <form method="POST" action="{{ action('App\Http\Controllers\Admin\PostController@delete', ['id' => $data->id]) }}" class="mb-0">
                                    {{ csrf_field() }}
                                    <button type="submit" class="dropdown-item del-btn" style="color:#FF0000; text-decoration:underline; ">削除</button>
                                </form>
                            </div>
                        @endif 
                        　
                        <div class="mr-3 d-flex align-items-center">
                            <a href="{{ action('App\Http\Controllers\Admin\CommentsController@index', ['id' => $data->id]) }}"><i class="far fa-comment fa-fw"></i>コメント{{ count($data->comments) }}</a>
                        </div>
                        　
                        <div class="d-flex align-items-center">
                            <button type="" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                <p class="mb-0 text-secondary">いいね</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
</div>
    <div class="my-4 d-flex justify-content-center">
        
    </div>
</div>
@endsection