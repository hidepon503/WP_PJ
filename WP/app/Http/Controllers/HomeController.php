<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Gender;
use App\Models\Kind;
use App\Models\Postcode;
use App\Models\Admin;
use App\Models\User;
use App\Models\Matching;
use App\Models\UserCat;


class HomeController extends Controller
{
    public function index()
    {
        // catsテーブルから登録された最新の猫の情報を8匹分取得する
        $cats = Cat::orderBy('created_at', 'desc')->take(8)->get();

        // 2. 各Catインスタンスにリアルタイムの年齢を計算するメソッドを追加
        foreach ($cats as $cat) {
            $cat->age = $this->calculateAge($cat->birthday);
        }

        // user_catsテーブルから、ログインしているユーザーのidと一致するuser_idを持つレコードを取得する
        $user_cats = UserCat::where('user_id', auth()->id())->get();

        // 取得した猫の情報をビューに渡す
        return view('user.index', compact('cats', 'user_cats'));
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

    // 猫の検索画面を表示。
    public function search(Request $request)
    {
        // catsテーブルから登録された猫の情報を全て取得し、8匹ずつページネーションで表示する。猫の表示順序は、登録日時の最新順。
        $cats = Cat::orderBy('created_at', 'desc')->paginate(8);
        // 2. 各Catインスタンスにリアルタイムの年齢を計算するメソッドを追加
        foreach ($cats as $cat) {
            $cat->age = $this->calculateAge($cat->birthday);
        }

        // 検索フォームのセレクトボックスに表示するために、gendersテーブルとkindsテーブルの情報も取得する
        $genders = Gender::all();
        $kinds = Kind::all();

        // postcodeを入力したら、postcodeテーブルから、prefecture、city、townカラムの情報を取得し、自動的に入力する
        return view('user.search',compact('cats','genders','kinds'));
    }
    
    // 猫の検索結果画面を表示。
    public function searchResult(Request $request)
    {
        $query = Cat::query(); // 空のクエリから開始します。
        // リクエストデータをセッションに保存
        $request->flash();
        // gender_idが設定されているか確認し、クエリに追加します。
        if ($request->filled('gender_id')) {
            $query->where('gender_id', $request->input('gender_id'));
        }
        // kind_idが設定されているか確認し、クエリに追加します。
        if ($request->filled('kind_id')) {
            $query->where('kind_id', $request->input('kind_id'));
        }

        // 年齢の範囲でのフィルタリング
        if ($request->filled('min_age') || $request->filled('max_age')) {
            $maxDate = $request->filled('min_age') 
                ? now()->subYears($request->input('min_age'))->format('Y-m-d')
                : now()->format('Y-m-d');  // 最小年齢からの日付もしくは今日
        
            $minDate = $request->filled('max_age')
                ? now()->subYears($request->input('max_age'))->format('Y-m-d') 
                : null;  // 最大年齢からの日付もしくはnull
        
            if ($minDate) {
                $query->whereBetween('birthday', [$minDate, $maxDate]);
            } else {
                $query->where('birthday', '<=', $maxDate);
            }
        }

    // 並べ替えのロジックを追加
    $order = $request->input('order', 'created_at_desc'); // デフォルトは登録順の降順

    switch ($order) {
        case 'age_asc':
            $query->orderBy('birthday', 'asc'); // 年齢の昇順
            break;
        case 'age_desc':
            $query->orderBy('birthday', 'desc'); // 年齢の降順
            break;
        case 'created_at_asc':
            $query->orderBy('created_at', 'asc'); // 登録日の昇順
            break;
        default: // 'created_at_desc'
            $query->orderBy('created_at', 'desc'); // 登録日の降順
            break;
    }

    // 結果を並べ替えてページングします。
    $cats = $query->paginate(8);

        // 以前と同様に、各猫の実際の年齢を計算します。
        foreach ($cats as $cat) {
            $cat->age = $this->calculateAge($cat->birthday);
        }

        // 以前と同様に、gendersとkindsを取得します。
        $genders = Gender::all();
        $kinds = Kind::all();

        return view('user.search', compact('cats', 'genders', 'kinds'));
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
