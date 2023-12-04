@extends('layouts.app')

@section('content')
    <div style="display: flex;">
        <!-- 左側：店の詳細情報 -->
        <div style="flex: 1; padding: 20px;">
            <h2>{{ $shop->name }}</h2>
            <img src="{{ $shop->image_url }}" alt="{{ $shop->name }}" style="max-width: 100%;">
            <p>{{ $shop->description }}</p>
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
