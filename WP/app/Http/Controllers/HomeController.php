<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // catsテーブルから登録された最新の猫の情報を１２匹分取得する
        $cats = Cat::orderBy('created_at', 'desc')->take(8)->get();

        // 2. 各Catインスタンスにリアルタイムの年齢を計算するメソッドを追加
        foreach ($cats as $cat) {
            $cat->age = $this->calculateAge($cat->birthday);
        }

        // 取得した猫の情報をビューに渡す
        return view('user.index', compact('cats'));
    }

    public function show(Cat $cat)
    {
        // <a href="{{ route('cat.show', $cat->id) }}" で渡された猫のidを元に、catsテーブルから該当する猫の情報を取得する
        $cat = Cat::find($cat->id);
        // catsテーブルから取得したadmin_idを元に、adminsテーブルから該当する管理者の情報を取得する
        $admin = $cat->admin;
        // 2. 各Catインスタンスにリアルタイムの年齢を計算するメソッドを追加
        $cat->age = $this->calculateAge($cat->birthday);

        return view('user.show', compact('cat', 'admin'));

    }
    


     /**
     * 猫のリアルタイムの年齢を計算する
     *
     * @param  string  $birthday
     * @return int
     */
    private function calculateAge($birthday)
    {
        return Carbon::parse($birthday)->age;
    }
}
