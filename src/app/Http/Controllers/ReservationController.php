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
        $reservation = new Reservation([
            'shop_id' => $request->input('shop_id'),
            'shop_date' => $request->input('shop_date'),
            'shop_time' => $request->input('shop_time'),
            'number_of_guests' => $request->input('number_of_guests'),
            // 他に必要なデータがあれば追加
        ]);

        // ユーザーに紐づけて保存
        $user->reservations()->save($reservation);

        return redirect()->route('shops.done')->with('success', '予約が成功しました。');

    } else {
        // ログインしていない場合の処理（ログアウト時のリダイレクトなど）
        // 例えばログインページにリダイレクトする場合
        return redirect()->route('login')->with('error', '予約するにはログインが必要です。');
    }
}

    public function destroy(Request $request, $reservationId)
    {
        $reservation = Reservation::find($reservationId);

        if ($reservation) {
            $reservation->delete();
            return redirect()->route('user.mypage')->with('success', '予約が取り消されました。');
        }

        return redirect()->route('user.mypage')->with('error', '予約の取り消しに失敗しました。');
    }

    public function showReservationDonePage()
    {
        // 予約が成功した後の処理を行う

        // 例えば、done.blade.php ビューを表示する場合
        return view('shops.done');
    }
}
