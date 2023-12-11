@extends('layouts.app')

@section('content')
    <div style="display: flex;">
        <div class="flex-container" style="display: flex; flex-direction: column; width: 50%;">
            <!-- 上部：＜と店舗名と＞横一列 -->
            <div style="display: flex; align-items: center;">
                <!-- 左側ボタン -->
                <button onclick="showPreviousShop()">＜</button>
                <h2 id="shopName">{{ $shop->name }}</h2>
                <!-- 右側ボタン -->
                <button onclick="showNextShop()">＞</button>
            </div>

            <!-- 下部：image_urlとdescription横一列 -->
            <div style="display: flex; flex-direction: column;">
                <img id="shopImage" src="{{ $shop->image_url }}" alt="{{ $shop->name }}" style="max-width: 100%;">
                <p id="shopDescription">{{ $shop->description }}</p>
            </div>
        </div>

        <!-- 右側：予約フォーム -->
        <div id="reservationForm" style="flex: 1; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
            <h3>予約</h3> <!-- 予約のタイトルを追加 -->
            <!-- 日付選択 -->
            <label for="reservation_date">日付：</label>
            <input type="date" id="reservation_date" name="reservation_date" required onchange="updateReservationDetails()">
            <br>

            <!-- 時間選択 -->
            <label for="reservation_time">時間：</label>
            <input type="time" id="reservation_time" name="reservation_time" required onchange="updateReservationDetails()">
            <br>

            <!-- 人数選択 -->
            <label for="number_of_people">人数：</label>
            <input type="number" id="number_of_people" name="number_of_people" min="1" required onchange="updateReservationDetails()">
            <br>

            <!-- 予約確認 -->
            <div id="reservationDetailsContainer">
                <p>予約確認：</p>
                <div id="reservationDetails" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; margin-top: 10px;">
                    <!-- ここに予約内容の確認を表示 -->
                </div>
            </div>

            <!-- 予約ボタン -->
            <form method="POST" action="{{ route('reservations.store', ['shopId' => $shop->id]) }}">
                @csrf
                <!-- フォームのフィールドはここに記述 -->
                <button type="submit">予約する</button>
            </form>
        </div>
    </div>

    <script>
const shops = {!! json_encode($shops) !!}; // ビューから渡された店舗のリスト
let currentIndex = shops.findIndex(shop => shop.id === {{ $shop->id }});

function showPreviousShop() {
    if (currentIndex > 0) {
        currentIndex--;
        showShopDetails();
    }
}

function showNextShop() {
    if (currentIndex < shops.length - 1) {
        currentIndex++;
        showShopDetails();
    }
}

function showShopDetails() {
    const currentShop = shops[currentIndex];
    document.getElementById('shopName').innerText = currentShop.name;
    document.getElementById('shopImage').src = currentShop.image_url;
    document.getElementById('shopDescription').innerText = currentShop.description;
}

// 初回表示時に現在の店舗詳細を表示
showShopDetails();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // DOMが完全に読み込まれたときにイベントリスナーを追加する
        document.getElementById('reservation_date').addEventListener('change', updateReservationDetails);
        document.getElementById('reservation_time').addEventListener('change', updateReservationDetails);
        document.getElementById('number_of_people').addEventListener('change', updateReservationDetails);
    });

    function updateReservationDetails() {
        // 選択された日付、時間、人数を取得
        var selectedDate = document.getElementById('reservation_date').value;
        var selectedTime = document.getElementById('reservation_time').value;
        var numberOfPeople = document.getElementById('number_of_people').value;

        // 予約確認エリアを更新
        document.getElementById('reservationDetails').innerHTML = `
            <p>日付: ${selectedDate}</p>
            <p>時間: ${selectedTime}</p>
            <p>人数: ${numberOfPeople}人</p>
        `;
    }
</script>
@endsection
