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
            'email' => 'sample@gmail.com',
            'password' => Hash::make('11111111'),
            'tel' => '09012345678',
            'postcode_id' => '1080',
            'address' => '北海道札幌市中央区南6条西25丁目1-6',
        ];
        Admin::create($param);

        $param = [
            'name' => 'ツキネコ東京',
            'email' => 'sample2@gmail.com',
            'password' => Hash::make('22222222'),
            'tel' => '09012345678',
            'postcode_id' => '5600',
            'address' => '東京都千代田区千代田1-1',
        ];
        Admin::create($param);

        $param = [
            'name' => '保護猫カフェさくら',
            'email' => 'sample3@gmail.com',
            'password' => Hash::make('33333333'),
            'tel' => '09012345678',
            'postcode_id' => '38000',
            'address' => '北海道札幌市中央区南6条西25丁目1-6',
        ];
        Admin::create($param);

        $param = [
            'name' => 'もりねこ',
            'email' => 'sample4@gmail.com',
            'password' => Hash::make('44444444'),
            'tel' => '09012345678',
            'postcode_id' => '60006',
            'address' => '東京都千代田区千代田1-1',
        ];
        Admin::create($param);

        $param = [
            'name' => '里親の会川口',
            'email' => 'sample5@gmail.com',
            'password' => Hash::make('55555555'),
            'tel' => '09012345678',
            'postcode_id' => '3406',
            'address' => '東京都千代田区千代田1-1',
        ];
        Admin::create($param);
    }
}
