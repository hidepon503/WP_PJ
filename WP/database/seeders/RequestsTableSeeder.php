<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Request;

class RequestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'answer' => 'マッチング受付',
        ];
        Request::create($param);
        $param = [
            'answer' => 'マッチング受理'
        ];
        Request::create($param);
        $param = [
            'answer' => 'マッチング拒否'
        ];
        Request::create($param);
        $param = [
            'answer' => '返却申請'
        ];
        Request::create($param);
        $param = [
            'answer' => '返却受理'
        ];
        Request::create($param);
        $param = [
            'answer' => '看取り申請'
        ];
        Request::create($param);
        $param = [
            'answer' => '看取り受理'
        ];
        Request::create($param);
    }
}
