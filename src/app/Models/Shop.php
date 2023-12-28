<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'shop_id');
    }

    public function favoriteShops()
    {
        return $this->hasMany(FavoriteShop::class, 'shop_id');
    }

    public function shop()
    {
    return $this->hasMany(FavoriteShop::class, 'shop_id');
    }

    protected $table = 'shops';
    protected $fillable = ['name', 'region', 'genre', 'description', 'image_url'];
}
