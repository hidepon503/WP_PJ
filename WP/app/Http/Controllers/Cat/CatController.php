<?php

namespace App\Http\Controllers\Cat;

use App\Models\Cat;
use App\Models\Admin;
use App\Models\Gender;
use App\Models\Kind;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Requests\CatRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\CatImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


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
        // 各猫に対して、年齢を計算して付加する
        $cats = $cats->map(function($cat) {
            $cat->age = Carbon::parse($cat->birthday)->age;
            return $cat;
        });
        
        
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
        $statuses = Status::all();
        return view('cats.create', compact('admin','genders','kinds', 'statuses'));
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
        // kind_idの取得と代入はこの一行で十分
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

    /**猫の詳細画面**/
    public function show(Cat $cat)
    {
        // ここでは、猫の詳細画面を表示するために必要なデータを取得しています。
        // まず猫の情報を取得しますが、これはaタグの引数で受け取った$catをそのまま使っています。
        //そのためaタグが＄cat = Cat::find($cat->id); と同じ意味になり、ここでは不要です。

        // admin,gender,kindの情報を事前に取得しておきます。
        // これらの情報は、猫の情報を表示するために必要になるためです。
        $cat->load('admin','gender','kind');

        // ここでは、猫の年齢を計算しています。
        $age = Carbon::parse($cat->birthday)->age;

        // まず、ログインしている管理者の情報を取得しています。
        $admin = Auth::guard('admin')->user();
        
        return view('cats.show', compact('admin','cat','age'));
    }

    /**
     * 猫の編集画面を表示する
     */
    public function edit(Cat $cat)
    {
        // ここでは、猫の年齢を計算しています。
        $age = Carbon::parse($cat->birthday)->age;
        // まず、ログインしている管理者の情報を取得しています。
        $admin = Auth::guard('admin')->user();
        //gender,kindの情報を事前に取得しておきます。
        $genders = Gender::all();
        $kinds = Kind::all();

        return view('cats.edit', compact('admin','cat','age','genders','kinds'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cat $cat)
    {
        // 画像の保存処理
        if ($request->hasFile('image')) {
            // 古い画像を削除
            $oldImage = $cat->image;
            if (Storage::exists('public/images/cats/' . $oldImage)) {
                Storage::delete('public/images/cats/' . $oldImage);
            }
            $catName = $cat->name;
            $timestamp = now()->format('YmdHis');
            $uniqueString = $this->generateUniqueString();
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = "{$catName}_{$timestamp}_{$uniqueString}.{$extension}";
        
            // 画像をストレージに保存
            $path = $request->file('image')->storeAs('public/images/cats', $imageName);
        
            // リクエストのデータから'image'を除去
            $input = $request->except('image');
            $input['image'] = $imageName;
            
            $cat->fill($input)->save();
        } else {
            // 画像以外のデータを更新
            $cat->fill($request->all())->save();
        }
    
        $age = Carbon::parse($cat->birthday)->age;
        $admin = Auth::guard('admin')->user();
    
        return view('cats.show', compact('admin', 'cat', 'age'));
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

    // ユーザーの操作
    // 
    public function userShow(Cat $cat)
    {
        // ここでは、猫の詳細画面を表示するために必要なデータを取得しています。
        // まず猫の情報を取得しますが、これはaタグの引数で受け取った$catをそのまま使っています。
        //そのためaタグが＄cat = Cat::find($cat->id); と同じ意味になり、ここでは不要です。

        // admin,gender,kindの情報を事前に取得しておきます。
        // これらの情報は、猫の情報を表示するために必要になるためです。
        $cat->load('admin','gender','kind');

        // ここでは、猫の年齢を計算しています。
        $age = Carbon::parse($cat->birthday)->age;

        // まず、ログインしている管理者の情報を取得しています。
        $admin = Auth::guard('admin')->user();
        
        return view('cats.show', compact('admin','cat','age'));
    }
}
