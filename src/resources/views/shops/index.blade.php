@extends('layouts.app')

@section('content')

<div class="shop-list">
    @foreach($shops as $shop)
        <div class="shop-item">
            <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}">
            <div class="shop-details">
                <h2>{{ $shop->name }}</h2>
                <div class="area-genre">
                    <p># {{ $shop->region }}</p>
                    <p># {{ $shop->genre }}</p>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <!-- 詳しく見るボタン -->
                    <a href="{{ route('shops.detail', ['shop_id' => $shop->id]) }}" style="text-decoration: none;">
                        <button class="button-class">詳しくみる</button>
                    </a>
                    <!-- お気に入りボタン -->
                    <a href="#" class="favorite-button" data-shop-id="{{ $shop->id }}">
                        <i class="fas fa-heart"></i>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- JavaScriptの例（JQueryを使用） -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // お気に入りボタンのクリックイベント
        $('.favorite-button').click(function (e) {
            e.preventDefault();

            // ログイン状態を確認
            @auth
                var shopId = $(this).data('shop-id');

                // Ajaxを使用してお気に入りの追加をリクエスト
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{!! route('favorites.store') !!}',
                    type: 'POST',
                    data: {
                        shop_id: shopId,
                        _token: csrfToken
                    },
                    success: function (data) {
                        alert('お気に入りに追加しました！');
                    }
                });
            @else
                // ログインしていない場合はログイン画面にリダイレクト
                window.location.href = '{{ route('login') }}';
            @endauth
        });
    });
</script>

@endsection
