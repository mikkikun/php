<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/chat.css') }}" rel="stylesheet">
    
</head>
<body>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('/') }}#"> {{ config('', 'CardMatch') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar1">
        <ul class="navbar-nav ml-auto"> 
            @guest
                @if (Route::has('login'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item">
                        <a class="btn ml-2 btn-warning" href="{{ route('create' , [Auth::user()->id])}}">投稿</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('top')}}">{{ __('みんなの投稿') }} <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('follow_pose')}}"> {{ __('フォロー中の投稿') }} </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">                    
                        <a class="dropdown-item" href="{{ route('mypage' , ['id' =>Auth::user()->id]) }}">
                            {{ __('マイページ') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('profile-edit') }}">
                            {{ __('プロフィール編集') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('chat-list') }}">
                            {{ __('メッセージ') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('chat-list') }}">
                            {{ __('カードゲーマーを探す') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('profile-delete-page') }}">
                            {{ __('アカウント削除') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('ログアウト') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

    <!--  -->

        <main class="" style="background-color:#8dd1e9;">
            @yield('content')
        </main>
</body>
</html>
