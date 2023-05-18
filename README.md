<h1>CardMatch</h1>
<p>カードゲーマー同士の交流が出来るサイトです。</p>
<p>自分が持ってるカードゲームを一緒にプレイ出来る友達も探せます！！</p>
<p>レスポンシブ対応しているのでスマホからもご確認いただけます。</p> 


<h1>URL</h1>
<p>https://cardmatch.click/<p>
<p>画面右上のログインボタンから、ゲストログインできます。<p>

<h1>使用技術</h1>
<p>HTML/CSS</p>
<p>Javascript</p>
<p>Bootstrap</p>
<p>PHP 8.0.13</p>
<p>Laravel 8.83.27</p>
<p>MySQL 8.0.33</p>
<p>phpMyAdmin 5.2.1</p>
<p>Nginx</p>
<p>AWS(EC2, S3, RDS, Route 53, ELB)</p>
<p>Docker 20.10.23 / Docker compose 2.15.1 (開発環境)</p>
<p>GitHub Actions</p>
<p>Google Maps API</p>
<p>git(gitHub)</p>
<p>Visual Studio Code</p>
<p>Adobe XD(画面遷移図)</p>
<p>lucidchart(ER図)</p>
<p>Drawio(AWS構成図)</p>

<h1>AWS構成図</h1>


<h2>GitHub Actions</h2>
<p>Githubへのpush時に、UnitTestが自動で実行されます。</p>
<p>masterブランチへのpushでは、UnitTestが成功した場合、EC2への自動デプロイが実行されます</p>

<h1>機能一覧</h1>
<li>投稿機能</li>
<ul>ユーザー登録、ログイン機能(devise)</ul>

画像投稿(refile)
位置情報検索機能(geocoder)
</ul>
いいね機能(Ajax)
ランキング機能
コメント機能(Ajax)
フォロー機能(Ajax)
ページネーション機能(kaminari)
無限スクロール(Ajax)
検索機能(ransack)
テスト
RSpec
単体テスト(model)
機能テスト(request)
統合テスト(feature)
