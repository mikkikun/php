CardMatch
カードゲーマー同士が交流出来るサイトです。
自分が持ってるカードゲームを一緒にプレイ出来る友達も探せます！！
レスポンシブ対応しているのでスマホからもご確認いただけます。 スクリーンショット 
![Uploading スクリーンショット 2023-05-17 21.56.57.png…]()

URL
http://the-view.work/
画面中部のゲストログインボタンから、メールアドレスとパスワードを入力せずにログインできます。

使用技術
Ruby 2.5.7
Ruby on Rails 5.2.4
MySQL 5.7
Nginx
Puma
AWS
VPC
EC2
RDS
Route53
Docker/Docker-compose
CircleCi CI/CD
Capistrano3
RSpec
Google Maps API
AWS構成図
スクリーンショット 2020-05-07 11 14 01

CircleCi CI/CD
Githubへのpush時に、RspecとRubocopが自動で実行されます。
masterブランチへのpushでは、RspecとRubocopが成功した場合、EC2への自動デプロイが実行されます
機能一覧
ユーザー登録、ログイン機能(devise)
投稿機能
画像投稿(refile)
位置情報検索機能(geocoder)
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
