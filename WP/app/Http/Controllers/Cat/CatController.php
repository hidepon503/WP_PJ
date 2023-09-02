<?php

namespace App\Http\Controllers\Cat;

use App\Models\Cat;
use App\Models\Admin;
use App\Models\Gender;
use App\Models\Kind;
use Illuminate\Http\Request;
use App\Http\Requests\CatRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\CatImage;


// ... 以下、クラスの定義などのコード



class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // adminが登録した猫情報の一覧取得
        $admin = Auth::guard('admin')->user();
        $cats = Cat::where('admin_id', $admin->id)->get();
        return view('cats.index', compact('admin','cats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();
        $genders = Gender::all();
        $kinds = Kind::all();
        return view('cats.create', compact('admin','genders','kinds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);

        // 管理者IDの取得と代入はこの一行で十分
        $form['admin_id'] = Auth::guard('admin')->id();
        
        $form['kind_id'] = $request->input('kind_id');  

        $cat = new Cat;
        $cat->fill($form);
        $cat->save();

        // 画像の保存処理
        if ($request->hasFile('image')) {
            $catName = $cat->name;  // 猫の名前を取得
            $timestamp = now()->format('YmdHis');  // 現在のタイムスタンプを取得
            $uniqueString = $this->generateUniqueString();  // ユニークな文字列を生成
            $extension = $request->file('image')->getClientOriginalExtension();  // 画像の拡張子を取得
            $imageName = "{$catName}_{$timestamp}_{$uniqueString}.{$extension}";  // 最終的なファイル名を作成

            // 画像をストレージに保存し、ファイル名を指定する
            $path = $request->file('image')->storeAs('public/images/cats', $imageName);
            
            // データベースのimageカラムにファイル名をセット
            $cat->image = $imageName;  
            $cat->save();  // imageを更新するために再度保存
        }

        return redirect()->route('index.cats')->with('success', '猫情報を登録しました。');
    }








    /**
     * Display the specified resource.
     */
    public function show(Cat $cat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cat $cat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cat $cat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cat $cat)
    {
        //
    }

    private function generateUniqueString() 
    {
        // ここでユニークな文字列を生成します
        $uniqueString = Str::random(10);
        return $uniqueString;
    }
}
