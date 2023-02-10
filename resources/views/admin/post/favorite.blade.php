@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($favorites as $favorite)
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            @if($favorite->user->profile_image !== null)
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $favorite->user->id]) }}">
                                    <img src="{{ asset('storage/profile_image').'/'.$favorite->user->profile_image }}" class="rounded-circle" width="50" height="50">
                                </a>
                            @else
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $favorite->user->id]) }}">
                                    <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                </a>
                            @endif
                            　
                            <div class="ml-2 d-flex flex-column">
                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $favorite->user->id]) }}">
                                    <p class="mb-0">{{ $favorite->user->name }}</p>
                                </a>
                            </div>
                            @if (auth()->user()->isFollowed($favorite->user->id))
                                <div class="px-2">
                                    <span class="px-1 bg-secondary text-light">フォローされています</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-end flex-grow-1">
                                @if (auth()->user()->isFollowing($favorite->user->id))
                                    <form action="{{ route('unfollow', ['id' => $favorite->user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['id' => $favorite->user->id]) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3 d-flex flex-column" style= "margin:20px;">
                            <h5 class="mb-0 font-weight-bold">{{ $favorite->user->profile }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="my-4 d-flex justify-content-center">
        </div>
    </div>
@endsection