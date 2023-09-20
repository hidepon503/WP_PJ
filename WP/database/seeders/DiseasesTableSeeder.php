<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Disease;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => 'その他'
        ];
        Disease::create($param);
        $param = [
            'name' => '猫免疫不全ウイルス感染症(FIV)'
        ];
        Disease::create($param);
        $param = [
            'name' => '猫白血病ウイルス感染症(FeLV)'
        ];
        Disease::create($param);
        $param = [
            'name' => '猫伝染性腹膜炎(FIP)'
        ];
        Disease::create($param);
        $param = [
            'name' => '猫パルボウイルス感染症'
        ];
        $param = [
            'name' => '上部気道炎'
        ];
        Disease::create($param);
        $param = [
            'name' => '猫下部尿路疾患'
        ];
        Disease::create($param);
        $param = [
            'name' => '腎臓病'
        ];
        Disease::create($param);
        $param = [
            'name' => '歯肉炎・歯肉口内炎'
        ];
        Disease::create($param);
        $param = [
            'name' => '甲状腺機能亢進症'
        ];


    }
}
