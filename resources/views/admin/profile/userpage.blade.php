@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-3 d-flex flex-column">
                        @if($users->profile_image !== null)
                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                <img src="{{ asset('storage/profile_image').'/'.$users->profile_image }}" class="rounded-circle" width="50" height="50">
                            </a>
                        @else
                            <a href="{{ action('App\Http\Controllers\Admin\ProfileController@userpage', ['id' => $users->id]) }}">
                                <img src="{{ asset('storage/profile_image/nodata.png') }}" class="rounded-circle" width="50" height="50">
                            </a>
                        @endif
                        <div class="mt-3 d-flex flex-column">
                            <h4 class="mb-0 font-weight-bold">{{ $users->name }}</h4>
                        </div>
                    </div>
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div class="d-flex">
                            <div>
                                @if ($users->id === Auth::user()->id)
                                    <a href="{{ route('profile-edit' , [Auth::user()->id]) }}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                    @if (Auth::user()->isFollowing($users->id))
                                        <form action="{{ route('unfollow', ['id' => $users]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">フォロー解除</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow', ['id' => $users]) }}" method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" class="btn btn-primary">フォローする</button>
                                        </form>
                                    @endif

                                    @if (Auth::user()->isFollowed($users->id))
                                        <span class="mt-2 px-1 bg-secondary text-light">フォローされています</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">ツイート数</p>
                                <span></span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">フォロー数</p>
                                <span></span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">フォロワー数</p>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            
                <div class="col-md-8 mb-3">
                    <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <img src="" class="rounded-circle" width="50" height="50">
                            <div class="ml-2 d-flex flex-column flex-grow-1">
                                <p class="mb-0"></p>
                                <a href="" class="text-secondary"></a>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary"></p>
                            </div>
                        </div>
                        <div class="card-body">
                            
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <form method="POST" action="" class="mb-0">
                                            @csrf
                                            @method('DELETE')

                                            <a href="" class="dropdown-item">編集</a>
                                            <button type="submit" class="dropdown-item del-btn">削除</button>
                                        </form>
                                    </div>
                                </div>
                            
                            <div class="mr-3 d-flex align-items-center">
                                <a href="#"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary"></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary"></p>
                            </div>
                        </div>
                    </div>
                </div>
            
        
    </div>
    <div class="my-4 d-flex justify-content-center">
        
    </div>
</div>







    
            <table>
            <tr>
            <td class = "">
                    @if($users->profile_image !== null)
                        <img src="{{ asset('storage/profile_image').'/'.$users->profile_image }}">
                    @endif
                </td>
                <td class = "">{{ $users->name }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $users->profile}}</td>
                <td class = ""><a href="{{ action('App\Http\Controllers\Admin\ProfileController@user_follow_page') }}">フォロー</a></td>
                <td class = ""><a href="{{ action('App\Http\Controllers\Admin\ProfileController@user_follower_page') }}">フォロワー</a></td>
            </tr>
            </table>

            
            <div class="d-flex justify-content-end flex-grow-1">
                               @if(Auth::id() != $users->id)
                               @if (Auth::user()->isFollowing($users->id))
                                   <form action="{{ route('unfollow', ['id' => $users]) }}" method="POST">
                                       {{ csrf_field() }}
                                       {{ method_field('DELETE') }}
 
                                       <button type="submit" class="btn btn-danger">フォロー解除</button>
                                   </form>
                               @else
                                   <form action="{{ route('follow', ['id' => $users]) }}" method="POST">
                                       {{ csrf_field() }}
 
                                       <button type="submit" class="btn btn-primary">フォローする</button>
                                   </form>
                               @endif
                               @endif








            <table>
            @foreach($posts as $data)
            <tr>
                <td class = "">{{ $data->user->name }}</td>
                <td class = "">{{ $data->updated_at }}</td>
            </tr>
            <tr class = "">
                <td class = "">{{ $data->title}}</td>
                <td class = "">{{ $data->body}}</td>
                <td class = "">{{ $data->cardgame}}</td>
                <td class = "">
                    @if($data->image_path !== null)
                        <img src="{{ asset('storage/image').'/'.$data->image_path }}">
                    @endif
                </td>
                <td class = "">
                @if($data->user_id == Auth::id())
                <form action="{{ action('App\Http\Controllers\Admin\PostController@delete', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="削除">
                </form>
                <div>
                    <a href="{{ action('App\Http\Controllers\Admin\PostController@edit', ['id' => $data->id]) }}">編集</a>
                </div>
                @endif
                </td>
            </tr>
            @endforeach
            </table>


@endsection