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
            'answer' => 'マッチング申請中',//1
        ];
        Request::create($param);
        $param = [
            'answer' => '契約中'//2
        ];
        Request::create($param);
        $param = [
            'answer' => '拒否'//3
        ];
        Request::create($param);
        $param = [
            'answer' => '返却申請中'//4
        ];
        Request::create($param);
        $param = [
            'answer' => '返却済'//5
        ];
        Request::create($param);
        $param = [
            'answer' => '迷子申請中'//6
        ];
        Request::create($param);
        $param = [
            'answer' => '迷子登録完了'//7
        ];
        Request::create($param);
        $param = [
            'answer' => '迷子発見報告'//8
        ];
        Request::create($param);
        $param = [
            'answer' => '看取り報告'//9
        ];
        Request::create($param);
        $param = [
            'answer' => '看取り完了'//10
        ];
        Request::create($param);
    }
}
