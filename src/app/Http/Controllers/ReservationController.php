<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
    // ユーザーがログインしているかチェック
        if (Auth::check()) {
            // ログインしている場合、ユーザーに関連する予約データを保存
            $user = Auth::user();

            // リクエストからデータを取得（バリデーションを無効にする）
            $data = $request->all();

            // 予約データを保存
            $reservation = $user->reservations()->create([
                'shop_id' => $data['shop_id'],
                'shop_date' => $data['shop_date'],
                'shop_time' => $data['shop_time'],
                'number_of_guests' => $data['number_of_guests'],
                // 他に必要なデータがあれば追加
            ]);

            return redirect()->route('shops.done')->with('success', '予約が成功しました。');
        }

        // ログインしていない場合の処理
        return redirect()->route('login')->with('error', '予約するにはログインが必要です。');
    }

    public function destroy(Request $request, $reservationId)
    {
        $reservations = Reservation::find($reservationId);

        if ($reservations) {
            $reservations->delete();
            return redirect()->route('user.mypage')->with('success', '予約が取り消されました。');
        }

        return redirect()->route('user.mypage')->with('error', '予約の取り消しに失敗しました。');
    }


    public function done()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $reservationCount = $user->reservations->count();

            // Controller もしくは View 内で $index を定義
        return view('user.mypage', ['reservations' => $reservations, 'index' => $index]);
        }

        // ログインしていない場合の処理
        return redirect()->route('login')->with('error', 'ログインが必要です。');
    }

    public function getReservations()
    {
        $reservations = Reservation::orderBy('reservation_date', 'asc')
        ->orderBy('reservation_time', 'asc')
        ->get();

        return view('user.mypage', ['reservations' => $reservations]);
    }

    public function update(Request $request, $reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

    $newDate = $request->input('new_date');

    // 新しい評価データ
    $rating = $request->input('rating');
    $review = $request->input('review');

    if ($newDate !== '') {
        $reservation->update([
            'shop_date' => $newDate,
            'shop_time' => $request->input('new_time'),
            'number_of_guests' => $request->input('new_guests'),
            'rating' => $rating, // 新しい評価データを追加
            'review' => $review, // 新しい評価データを追加
        ]);

        return redirect('/mypage')->with('success', '予約が変更されました');
    } else {
        // 新しい日付が空の場合の処理を追加することも検討してください
        return redirect('/mypage')->with('error', '新しい日付が無効です');
    }
    }
    public function show($reservationId)
    {
            $reservation = Reservation::findOrFail($reservationId);

            return view('reservations.show', compact('reservation'));
    }

    public function edit($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);

        return view('reservations.edit', compact('reservation'));
    }
}