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
            'answer' => 'マッチング申請中',
        ];
        Request::create($param);
        $param = [
            'answer' => '契約中'
        ];
        Request::create($param);
        $param = [
            'answer' => '拒否'
        ];
        Request::create($param);
        $param = [
            'answer' => '返却申請中'
        ];
        Request::create($param);
        $param = [
            'answer' => '返却済'
        ];
        Request::create($param);
        $param = [
            'answer' => '看取り報告'
        ];
        Request::create($param);
        $param = [
            'answer' => '看取り完了'
        ];
        Request::create($param);
    }
}
