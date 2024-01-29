<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 管理者ユーザーを作成
        User::create([
            'name' => 'yama',
            'email' => 'yama@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 別のユーザーを作成
        User::create([
            'name' => 'John Dai',
            'email' => 'john.dai@example.com', // 異なるメールアドレスを指定
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

    }
}
