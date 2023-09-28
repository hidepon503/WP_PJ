<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relation;

class RelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => '契約中'
        ];
        Relation::create($param);
        $param = [
            'name' => '返却済み'
        ];
        Relation::create($param);
        $param = [
            'name' => '死亡'
        ];
        Relation::create($param);
    }
}
