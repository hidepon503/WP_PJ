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
                'email' => '1@gmail.com',
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
                'email' => '2@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('22222222'),
                'remember_token' => Str::random(10),
                'tel' => '09012345678',
                'postcode' => '3340001',
                'prefecture' => '埼玉県',
                'city' => '川口市',
                'town' => '桜町',
                'street' => '1-6-12',
                'building' => '11', 
                'birthday' => '1990-01-01',
                'introduction' => 'よろしくお願いします。'
            ],
            [
                'name' => '鈴木 一郎',
                'email' => '3@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('33333333'),
                'remember_token' => Str::random(10),
                'tel' => '09012345678',
                'postcode' => '1111111',
                'prefecture' => '福岡県',
                'city' => '福岡市博多区',
                'town' => '南6条西',
                'street' => '25丁目1-6',
                'building' => 'ジーズアカデミー福岡校', 
                'birthday' => '1990-01-01',
                'introduction' => 'よろしくお願いします。'
            ],
            [
                'name' => 'ジーズ 二郎',
                'email' => '4@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('44444444'),
                'remember_token' => Str::random(10),
                'tel' => '09012345678',
                'postcode' => '1111111',
                'prefecture' => '福岡県',
                'city' => '福岡市博多区',
                'town' => '南6条西',
                'street' => '25丁目1-6',
                'building' => 'ジーズアカデミー福岡校', 
                'birthday' => '1990-01-01',
                'introduction' => 'よろしくお願いします。'
            ],
            [
                'name' => 'ジーズ 一郎',
                'email' => '5@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('55555555'),
                'remember_token' => Str::random(10),
                'tel' => '09012345678',
                'postcode' => '1111111',
                'prefecture' => '東京都',
                'city' => '渋谷区',
                'town' => '代々木上原',
                'street' => '25丁目1-6',
                'building' => 'ジーズアカデミー東京校', 
                'birthday' => '1990-01-01',
                'introduction' => 'よろしくお願いします。'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

