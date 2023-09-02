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
            'gender' => '♂'
        ];
        Gender::create($param);
        $param = [
            'gender' => '♀'
        ];
        Gender::create($param);
    }

}
