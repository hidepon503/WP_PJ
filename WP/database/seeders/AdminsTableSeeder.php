<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;



class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => 'ツキネコ北海道',
            'email' => '1@gmail.com',
            'password' => Hash::make('11111111'),
            'tel' => '09012345678',
            'postcode' => '1111111',
            'prefecture' => '北海道',
            'city' => '札幌市中央区',
            'town' => '南6条西',
            'street' => '25丁目1-6',
            'building' => 'ツキネコカフェ', 
            
        ];
        Admin::create($param);

        $param = [
            'name' => 'ツキネコ東京',
            'email' => '2@gmail.com',
            'password' => Hash::make('22222222'),
            'tel' => '09012345678',
            'postcode' => '1111111',
            'prefecture' => '東京都',
            'city' => '渋谷区',
            'town' => '代々木上原',
            'street' => '25丁目1-6',
            'building' => 'ツキネコカフェ', 
        ];
        Admin::create($param);

        $param = [
            'name' => '保護猫カフェさくら',
            'email' => '3@gmail.com',
            'password' => Hash::make('33333333'),
            'tel' => '09012345678',
            'postcode' => '1111111',
            'prefecture' => '埼玉県',
            'city' => '越谷市',
            'town' => '錦町',
            'street' => '25丁目1-6',
            'building' => 'ツキネコカフェ', 
            
        ];
        Admin::create($param);

        $param = [
            'name' => 'もりねこ',
            'email' => '4@gmail.com',
            'password' => Hash::make('44444444'),
            'tel' => '09012345678',
            'postcode' => '1111111',
            'prefecture' => '岩手県',
            'city' => '盛岡市',
            'town' => 'xxx',
            'street' => '25丁目1-6',
            'building' => 'ツキネコカフェ', 
            
        ];
        Admin::create($param);

        $param = [
            'name' => '里親の会川口',
            'email' => '5@gmail.com',
            'password' => Hash::make('55555555'),
            'tel' => '09012345678',
            'postcode' => '1111111',
            'prefecture' => '福岡県',
            'city' => '福岡市博多区',
            'town' => '南6条西',
            'street' => '25丁目1-6',
            'building' => 'ツキネコカフェ', 
        ];
        Admin::create($param);
    }
}
