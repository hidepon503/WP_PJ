<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\User;
//Strの読み込み



class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => '田中 太郎',
                'email' => 's@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('11111111'),
                'remember_token' => Str::random(10),
                'tel' => '09012345678',
                'postcode' => '1111111',
                'prefecture' => '北海道',
                'city' => '札幌市中央区',
                'town' => '南6条西',
                'street' => '25丁目1-6',
                'building' => 'ツキネコカフェ', 
                'birthday' => '1990-01-01',
                'introduction' => 'よろしくお願いします。'
            ],
            [
                'name' => '佐藤 花子',
                'email' => 'sato.hanako@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('secret123'),
                'remember_token' => Str::random(10),
                'tel' => '09012345678',
                'postcode' => '1111111',
                'prefecture' => '北海道',
                'city' => '札幌市中央区',
                'town' => '南6条西',
                'street' => '25丁目1-6',
                'building' => 'ツキネコカフェ', 
                'birthday' => '1990-01-01',
                'introduction' => 'よろしくお願いします。'
            ],
            [
                'name' => '鈴木 一郎',
                'email' => 'suzuki.ichiro@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'tel' => '09012345678',
                'postcode' => '1111111',
                'prefecture' => '北海道',
                'city' => '札幌市中央区',
                'town' => '南6条西',
                'street' => '25丁目1-6',
                'building' => 'ツキネコカフェ', 
                'birthday' => '1990-01-01',
                'introduction' => 'よろしくお願いします。'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

