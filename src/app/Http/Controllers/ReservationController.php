<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request, $shopId)
    {
        $validatedData = $request->validate([
            'shop_date' => 'required|date',  // フィールド名修正
            'shop_time' => 'required|date_format:H:i',  // フィールド名修正
            'number_of_people' => 'required|integer|min:1',
        ]);

        $reservation = new Reservation([
            'shop_date' => $validatedData['shop_date'],
            'shop_time' => $validatedData['shop_time'],
            'number_of_people' => $validatedData['number_of_people'],
            'user_id' => Auth::id(),
            'shop_id' => $shopId,
        ]);

        $reservation->save();

        return view('done');
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
}
