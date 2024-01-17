#	Rese						
<img width="1120" alt="スクリーンショット 2024-01-05 15 23 23" src="https://github.com/kimi3223/rese/assets/139026084/a785cf5c-0f33-4639-b096-da661e831587">
							
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
<img width="334" alt="スクリーンショット 2024-01-05 15 29 25" src="https://github.com/kimi3223/rese/assets/139026084/8e9790fe-007c-424f-a555-1cf212ef3397">							
							
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
							
							
												

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
