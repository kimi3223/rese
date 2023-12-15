<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'shop_id'); // 'shop_id' は users テーブルの外部キー
    }

    public function favoriteShops()
    {
        return $this->belongsToMany(User::class, 'favorites', 'shop_id', 'user_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }


    protected $table = 'shops';
    protected $fillable = ['name', 'region', 'genre', 'description', 'image_url'];
}
