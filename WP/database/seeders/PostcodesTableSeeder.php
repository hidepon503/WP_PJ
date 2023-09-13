<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Postcode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostcodesTableSeeder extends Seeder
{
    public function run()
    {
        // CSVファイルのパスを指定
        $csvData = File::get(database_path('seeders/postcodes.CSV')); 
        $rows = explode("\n", $csvData);

        foreach ($rows as $row) {
            $columns = explode(",", $row);
            if (!isset($columns[2], $columns[6], $columns[7], $columns[8])) 
            {
                // 必要なカラムが存在しない場合、この行をスキップ
                continue;
            }

            // ダブルクォートを取り除く
            $postcode = str_replace('"', '', $columns[2]);
            $prefecture = mb_convert_encoding(str_replace('"', '', $columns[6]), 'UTF-8', 'Shift-JIS');
            $city = mb_convert_encoding(str_replace('"', '', $columns[7]), 'UTF-8', 'Shift-JIS');
            $town = mb_convert_encoding(str_replace('"', '', $columns[8]), 'UTF-8', 'Shift-JIS');

            DB::table('postcodes')->insert([
                'postcode' => $postcode,
                'prefecture' => $prefecture,
                'city' => $city,
                'town' => $town,
            ]);
        }
    }
}
