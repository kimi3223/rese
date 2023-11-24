@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- ここに店舗の詳細情報と画像を表示 -->
            </div>
            <div class="col-md-6">
                <!-- お気に入りボタン -->
                <button class="btn btn-outline-danger" id="favoriteButton">お気に入りに追加</button>
                <!-- マイページへのリンク -->
                <a href="{{ route('mypage') }}" class="btn btn-primary">マイページ</a>
            </div>
        </div>
    </div>

    <!-- JavaScriptの例（JQueryを使用） -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // お気に入りボタンのクリックイベント
            $('#favoriteButton').click(function () {
                // ここにお気に入り追加の処理を追加
                $.post('{{ route('favorite.add', ['id' => $shop->id]) }}', function (data) {
                    // 追加が成功した場合の処理
                    alert('お気に入りに追加しました！');
                });
            });
        });
    </script>
@endsection