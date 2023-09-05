<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            'password' => '11111111',
            'tel' => '09012345678',
            'postcode' => '0600006',
            'address' => '北海道札幌市中央区南6条西25丁目1-6',
        ];
        Admin::create($param);

        $param = [
            'name' => 'ツキネコ東京',
            'email' => 'sample2@gmail.com',
            'password' => '22222222',
            'tel' => '09012345678',
            'postcode' => '0600006',
            'address' => '東京都千代田区千代田1-1',
        ];
        Admin::create($param);
    }
}
