@extends('layouts.app')

@section('content')
<title>いいねリスト</title>
<link href="{{ asset('css/favorite.css') }}" rel="stylesheet">
<div class="container">
    <div class="profile ">
        <div class="profile-container">
            <div class="profile-content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tab-content p-0 mt-5 px-1">
                            <div class="tab-pane fade active show" id="profile-followers">
                                <div class="list-group">
                                    @forelse ($favorites as $favorite)
                                        <div class="list-group-item d-flex align-items-center">
                                            @if($favorite->user->profile_image !== null)
                                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $favorite->user->id]) }}">
                                                    <img src="{{ asset('storage/profile_image').'/'.$favorite->user->profile_image }}" class="rounded-circle" width="50" height="50">
                                                </a>
                                            @else
                                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $favorite->user->id]) }}">
                                                    <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                                                </a>
                                            @endif
                                            <div class="flex-fill pl-3 pr-3" style="padding:20px;">
                                                <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $favorite->user->id]) }}" class="text-dark font-weight-600" style="text-decoration: none;">{{ $favorite->user->name }}</a>
                                                <div class="text-muted fs-13px">
                                                    @if (auth()->user()->isFollowed($favorite->user->id))
                                                        <span class="px-1 bg-secondary text-light">フォローされています</span>
                                                    @endif
                                                </div>
                                            </div>
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
                                    @empty
                                        <div class="favorite_empty"></div>
                                    @endforelse
                                    <div class="row m-3">
                                        {{ $favorites->appends(request()->query())->links('pagination::bootstrap-4')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- <div class="container">
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
    </div> -->
@endsection