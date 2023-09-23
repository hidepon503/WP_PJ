<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Cat;

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ja_JP');  // 日本語のFakerインスタンスを作成

        for ($i = 0; $i < 50; $i++) {
            Cat::create([
                'name' => $faker->name,
                'admin_id' => $faker->numberBetween(1, 5),  // 仮にadmin_idを1-5の間でランダムに割り当てる
                'image' => ('blUFnF4va5RG6IORlNzUUQk3E9c8FU5ih3fHDH4B.jpg'),
                'birthday' => $faker->date(),
                'weight' => $faker->randomFloat(2, 1, 10),  // 2桁の小数、1〜10kgの範囲でランダムに生成
                'lostchild' => $faker->boolean,  // trueかfalseをランダムに生成
                'gender_id' => $faker->numberBetween(1, 2),  // 仮にgender_idを1-3の間でランダムに割り当てる
                'kind_id' => $faker->numberBetween(1, 50),   // 仮にkind_idを1-10の間でランダムに割り当てる
                'status_id' => $faker->numberBetween(2, 4),  // 仮にstatus_idを2-2の間でランダムに割り当てる
                'introduction' => $faker->sentence,
                'insuranceCard' => null,
                'soracom' => null,
                'hellolight' => null,
                'apple' => null,
            ]);
        }
    }
}