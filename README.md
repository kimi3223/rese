#	Rese						
<img width="1099" alt="スクリーンショット 2024-01-07 17 49 39" src="https://github.com/kimi3223/rese/assets/139026084/ecd79278-015e-4946-952d-d6b84b192aea">

							
##	作成目的						
	手数料のいらない予約システムが必要のため						
							
##	アプリケーションのURL						
							
	http://localhost						
	予約には会員登録が必要です						
	http://localhost/register						
							
##	機能一覧						
							
	会員登録						
	ログイン						
	ログアウト						
	ユーザー情報取得						
	ユーザー飲食店お気に入り一覧取得						
	ユーザー飲食店予約情報取得						
	飲食店一覧取得						
	飲食店詳細取得						
	飲食店お気に入り追加						
	飲食店お気に入り削除						
	飲食店予約情報追加						
	飲食店予約情報削除						
	エリアで検索する						
	ジャンルで検索する						
	予約変更機能						
							
##	使用技術						
							
	フロントエンド:HTML, CSS, JavaScript						
	バックエンド:PHP (Laravel フレームワーク 8.75)						
	MySQL データベース8.0.26						
	サーバー:Nginx1.21.1						
	コンテナ化:Docker, Docker Compose						
	開発環境管理:Composer2.1 (PHP のパッケージ管理)npm (Node.js のパッケージ管理)Git2.x (バージョン管理)						
							
##	テーブル設計						
<img width="876" alt="スクリーンショット 2024-01-07 17 46 27" src="https://github.com/kimi3223/rese/assets/139026084/e0fd3af8-9c9b-44fd-a2bd-cd22fbab34ee">
							
							
##	ER図						
<img width="369" alt="スクリーンショット 2024-01-05 15 29 40" src="https://github.com/kimi3223/rese/assets/139026084/28b2d00b-c78b-4426-987a-fc5e4a37c88f">
													
#	環境構築						
							
	1.リポジトリをクローン:						
	git clone git@github.com:kimi3223/rese.git						
							
	2.依存関係のインストール:						
	composer install						
							
	3.データベースのセットアップ:						
	php artisan migrate						
							
	4.環境変数の設定:						
	cp .env.example .env						
							
	5.アプリケーションの起動:						
	php artisan serve						
							
	アプリをローカルで実行できるようになる						
							
							
							
							
