@extends('layouts.app')  <!-- レイアウトファイルがある場合、その名前に変更 -->

@section('content')

<div class="search-results">
    <h2>検索結果</h2>

    @if ($shops->isEmpty())
        <p>検索結果がありません。</p>
    @else
        <div class="shop-list">
            @foreach($shops as $shop)
                <div class="shop-item">
                    <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}" @error($shop->image_url) style="display: none;" @enderror>
                    <div class="shop-details">
                        <h2>{{ $shop->name }}</h2>
                        <p># {{ $shop->region }}</p>
                        <p># {{ $shop->genre }}</p>
                        <!-- 他に表示したい詳細を追加 -->

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
    @endif
</div>

@endsection
