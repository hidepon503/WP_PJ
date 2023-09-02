<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'gender' => '1'//男の子
        ];
        Gender::create($param);
        $param = [
            'gender' => '2'//女の子
        ];
        Gender::create($param);
    }

}
