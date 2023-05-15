<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Card Match</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="public/img/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/welcome.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Card Match</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">Card Matchについて</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">特徴</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">アカウント作成について</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li> -->
                        @if (Route::has('login'))
                            @auth
                            <li class="nav-item"><a href="{{ url('/admin/post/index') }}" class="nav-link">ホームへ</a></li>
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">ログイン</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">新規登録</a></li>
                            @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Card Match</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">カードゲーム仲間を作るコミュニティーサイト</p>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary h-100" id="about">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-5">Card Matchとは</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">大会勢からカジュアル勢まで好きなカードゲームで交流し合えるWEBサイトです。</p>
                        <p class="text-white-75 mb-4">カードゲームについて話し合える仲間が見つかるコミュニティーです。</p>
                        <p class="text-white-75 mb-4">カードゲームを始めたいけど一緒にプレイする仲間がいない人にもオススメです。</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section h-100" id="services">
            <div class="container px-4 px-lg-5 h-100">
                <h2 class="text-center mt-2">特徴</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-chat square text fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">投稿機能</h3>
                            <p class="text-muted mb-0">好きな事を投稿して、みんなとの交流を広げよう。</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-search fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">検索機能</h3>
                            <p class="text-muted mb-0">自分のプレイしているカードゲームの投稿を検索できます。</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-envelope plus fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">メール機能</h3>
                            <p class="text-muted mb-0">コンタクトをとりたい人へメールを送れます。</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">プレイヤーを探す</h3>
                            <p class="text-muted mb-0">現在カードショップにて一緒にプレイ出来る人を探せます。</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <div id="portfolio">
        </div>
        <!-- Call to action-->
        <section class="page-section bg-primary2 text-white h-100">
            <div class="container px-4 px-lg-5 text-center h-100">
                <h2 class="mb-4 mt-5">さっそく使ってみよう！！</h2>
                <p class="text-white-75 mb-4">アカウントは無料で作成することができます。</p>
                <p class="text-white-75 mb-4">まずは試してみましょう！</p>
                <a class="btn btn-light btn-xl" href="{{ route('register') }}">新規会員登録</a>
            </div>
        </section>
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2023 - Card Match</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/welcome.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>




