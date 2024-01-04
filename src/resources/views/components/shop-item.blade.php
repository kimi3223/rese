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
            <a href="{{ route('shop.detail', ['shop_id' => $shop->id]) }}" style="text-decoration: none;">
                <button class="button-class">詳しくみる</button>
            </a>
            <!-- お気に入りボタン -->
            @auth
                <?php
                    $isFavorite = in_array($shop->id, $favoriteShopIds);
                    $heartClass = $isFavorite ? 'fas' : 'far';
                    $heartColor = $isFavorite ? 'red' : 'black';
                ?>
                <a href="/" class="favorite-button" data-shop-id="{{ $shop->id }}" style="color: {{ $heartColor }};">
                    <i class="fa-heart {{ $heartClass }}"></i>
                </a>
            @else
                <!-- ログアウト時のデフォルトアイコン（黒枠） -->
                <a href="{{ route('login') }}" style="color: black;">
                    <i class="fa-heart far"></i>
                </a>
            @endauth
        </div>
    </div>


