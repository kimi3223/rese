<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteShop extends Model
{
    use HasFactory;

    protected $table = 'favorite_shop';

    protected $fillable = [
        'user_id',
        'shop_id',
    ];

    // リレーション定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }
}
