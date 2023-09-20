<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => '準備中'
        ];
        Status::create($param);
        $param = [
            'name' => '募集中'
        ];
        Status::create($param);
        $param = [
            'name' => '家族決定'
        ];
        Status::create($param);
        $param = [
            'name' => '交渉中'
        ];
        Status::create($param);
        $param = [
            'name' => '脱走中'
        ];
        Status::create($param);
        $param = [
            'name' => '迷子中'
        ];
        Status::create($param);
        $param = [
            'name' => '死亡'
        ];
        Status::create($param);
    }
}
