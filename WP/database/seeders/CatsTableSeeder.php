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

        // for ($i = 0; $i < 50; $i++) {
        //     Cat::create([
        //         'name' => $faker->name,
        //         'admin_id' => $faker->numberBetween(1, 1),  // 仮にadmin_idを1-5の間でランダムに割り当てる
        //         'image' => ('blUFnF4va5RG6IORlNzUUQk3E9c8FU5ih3fHDH4B.jpg'),
        //         'birthday' => $faker->date(),
        //         'weight' => $faker->randomFloat(2, 1, 10),  // 2桁の小数、1〜10kgの範囲でランダムに生成
        //         'gender_id' => $faker->numberBetween(1, 2),  // 仮にgender_idを1-3の間でランダムに割り当てる
        //         'kind_id' => $faker->numberBetween(1, 50),   // 仮にkind_idを1-10の間でランダムに割り当てる
        //         'status_id' => $faker->numberBetween(2, 2),  // 仮にstatus_idを2-2の間でランダムに割り当てる
        //         'introduction' => $faker->sentence,
        //         'insuranceCard' => null,
        //         'soracom' => null,
        //         'hellolight' => null,
        //         'apple' => null,
        //     ]);

        $param =[//1
            'name' => '海（うみ）',
            'admin_id' => 1,
            'image' => 'umi.jpg',
            'birthday' => '2016-08-06',
            'weight' => 2.2,
            'gender_id' => 2,
            'kind_id' => 1,
            'status_id' => 2,
            'introduction' => '2016年8月6日生まれの女の子です。人懐っこくて、抱っこも大好きです。他の猫とも仲良くできます。',
            'insuranceCard' => null,
            'soracom' => null,
            'hellolight' => null,
            'apple' => null,
        ];
        Cat::create($param);

        $param =[//2
            'name' => 'キキ',
            'admin_id' => 1,
            'image' => '3848209_s.jpg',
            'birthday' => '2010-09-26',
            'weight' =>  $faker->randomFloat(2, 1, 10),  // 2桁の小数、1〜10kgの範囲でランダムに生成
            'gender_id' => 1,
            'kind_id' => 4,//$faker->numberBetween(1, 50),   // 仮にkind_idを1-10の間でランダムに割り当てる
            'status_id' => 2,
            'introduction' => 'アメリカンショートヘアの男の子。わんぱくで遊ぶのが大好き。抱っこも好きで、好きな人のお腹の上で寝るのが大好きです。',
            'insuranceCard' => null,
            'soracom' => null,
            'hellolight' => null,
            'apple' => null,
        ];
        Cat::create($param);

        $param =[//3
            'name' => 'ペッパー',
            'admin_id' => 1,
            'image' => 'IMG_2460.jpeg',
            'birthday' => '2020-01-26',
            'weight' => $faker->randomFloat(2, 1, 10),
            'gender_id' => 2,
            'kind_id' => 1,
            'status_id' => 2,
            'introduction' => '空を飛べると勘違いしている可愛い子です',
            'insuranceCard' => null,
            'soracom' => null,
            'hellolight' => null,
            'apple' => null,
        ];
        Cat::create($param);

        $param = [//4
            'name' => 'ジャック',
            'admin_id' => 1,
            'image' => 'IMG_2144.jpg',
            'birthday' => '2018-05-26',
            'weight' => $faker->randomFloat(2, 1, 10),
            'gender_id' => 1,
            'kind_id' => 1,
            'status_id' => 2,
            'introduction' => 'とても元気で、遊ぶのが大好きな男の子です。他の猫とも仲良くできます。',
        ];
        Cat::create($param);

        $param = [//5
            'name' => 'メグ',
            'admin_id' => 2,
            'image' => 'IMG_2168.jpg',
            'birthday' => '2017-11-29',
            'weight' => $faker->randomFloat(2, 1, 10),
            'gender_id' => 2,
            'kind_id' => 1,
            'status_id' => 2,
            'introduction' => '人懐っこくて、抱っこも大好きです。他の猫とも仲良くできます。',
        ];
        Cat::create($param);

        $param = [//6
            'name' => 'ミルク',
            'admin_id' => 2,
            'image' => 'alvan-nee-ZCHj_2lJP00-unsplash.jpg',
            // fakerで25歳までの生年月日を生成
            'birthday' => $faker->dateTimeBetween('-25 years', '-1 years')->format('Y-m-d'),
            // 2桁の小数、1〜10kgの範囲でランダムに生成
            'weight' => $faker->randomFloat(2, 1, 10), 
            // 仮にgender_idを1-3の間でランダムに割り当てる
            'gender_id' => $faker->numberBetween(1, 2),  
            // 仮にkind_idを1-10の間でランダムに割り当てる
            'kind_id' => $faker->numberBetween(1, 50),   
            'status_id' => $faker->numberBetween(2, 2),  
            // 仮にstatus_idを2-2の間でランダムに割り当てる
            'introduction' => '猫じゃらしで遊ぶのが大好きな子です。他の猫とも仲良くできます。',
            'insuranceCard' => null,
            'soracom' => null,
            'hellolight' => null,
            'apple' => null,
        ];
        Cat::create($param);

        $param = [//7
            'name' => 'まる',
            'admin_id' => 2,
            'image' => 'cat-2934720_1280.jpg',
            // fakerで25歳までの生年月日を生成
            'birthday' => $faker->dateTimeBetween('-25 years', '-1 years')->format('Y-m-d'),
            // 2桁の小数、1〜10kgの範囲でランダムに生成
            'weight' => $faker->randomFloat(2, 1, 10), 
            // 仮にgender_idを1-3の間でランダムに割り当てる
            'gender_id' => $faker->numberBetween(1, 2),  
            // 仮にkind_idを1-10の間でランダムに割り当てる
            'kind_id' => $faker->numberBetween(1, 50),   
            'status_id' => $faker->numberBetween(2, 2),  
            // 仮にstatus_idを2-2の間でランダムに割り当てる
            'introduction' => 'おっとりとした性格の子です。他の猫とも仲良くできます。',
            'insuranceCard' => null,
            'soracom' => null,
            'hellolight' => null,
            'apple' => null,
        ];
        Cat::create($param);

        $param = [//8
            'name' => 'マロン',
            'admin_id' => 2,
            'image' => 'jae-park-7GX5aICb5i4-unsplash.jpg',
            // fakerで25歳までの生年月日を生成
            'birthday' => $faker->dateTimeBetween('-25 years', '-1 years')->format('Y-m-d'),
            // 2桁の小数、1〜10kgの範囲でランダムに生成
            'weight' => $faker->randomFloat(2, 1, 10), 
            // 仮にgender_idを1-3の間でランダムに割り当てる
            'gender_id' => $faker->numberBetween(1, 2),  
            // 仮にkind_idを1-10の間でランダムに割り当てる
            'kind_id' => $faker->numberBetween(1, 50),   
            'status_id' => $faker->numberBetween(2, 2),  
            // 仮にstatus_idを2-2の間でランダムに割り当てる
            'introduction' => '猫じゃらしで遊ぶのが大好きな子です。他の猫とも仲良くできます。',
            'insuranceCard' => null,
            'soracom' => null,
            'hellolight' => null,
            'apple' => null,
        ];
        Cat::create($param);

        $param = [//9
            'name' => 'じゃらん',
            'admin_id' => 2,
            'image' => 'cat-323262_640.jpg',
            // fakerで25歳までの生年月日を生成
            'birthday' => $faker->dateTimeBetween('-25 years', '-1 years')->format('Y-m-d'),
            // 2桁の小数、1〜10kgの範囲でランダムに生成
            'weight' => $faker->randomFloat(2, 1, 10), 
            // 仮にgender_idを1-3の間でランダムに割り当てる
            'gender_id' => $faker->numberBetween(1, 2),  
            // 仮にkind_idを1-10の間でランダムに割り当てる
            'kind_id' => $faker->numberBetween(1, 50),   
            'status_id' => $faker->numberBetween(2, 2),  
            // 仮にstatus_idを2-2の間でランダムに割り当てる
            'introduction' => '猫じゃらしで遊ぶのが大好きな子です。他の猫とも仲良くできます。',
            'insuranceCard' => null,
            'soracom' => null,
            'hellolight' => null,
            'apple' => null,
        ];
        Cat::create($param);

        $param = [//10
            'name' => 'ミケ',
            'admin_id' => 2,
            'image' => 'cat-3336579_640.jpg',
            // fakerで25歳までの生年月日を生成
            'birthday' => $faker->dateTimeBetween('-25 years', '-1 years')->format('Y-m-d'),
            // 2桁の小数、1〜10kgの範囲でランダムに生成
            'weight' => $faker->randomFloat(2, 1, 10), 
            // 仮にgender_idを1-3の間でランダムに割り当てる
            'gender_id' => $faker->numberBetween(1, 2),  
            // 仮にkind_idを1-10の間でランダムに割り当てる
            'kind_id' => $faker->numberBetween(1, 50),   
            'status_id' => $faker->numberBetween(2, 2),  
            // 仮にstatus_idを2-2の間でランダムに割り当てる
            'introduction' => '猫じゃらしで遊ぶのが大好きな子です。他の猫とも仲良くできます。',
            'insuranceCard' => null,
            'soracom' => null,
            'hellolight' => null,
            'apple' => null,
        ];
        Cat::create($param);






    }

    
}