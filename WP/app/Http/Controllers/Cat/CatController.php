<?php

namespace App\Http\Controllers\Cat;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\Admin;
use App\Models\Gender;
use App\Models\Kind;
use App\Models\Status;
use App\Http\Requests\CatRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\CatImage;
use Carbon\Carbon;
use App\Models\UserCat;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\PostImage;
use App\Models\PostVideo;
use App\Models\Matching;

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

        $catIds = $cats->pluck('id');
        $userCats = UserCat::whereIn('cat_id', $catIds)->with('user')->get();
        // cat_idをキーとして、関連するユーザーを取得
        $userByCat = [];
        foreach ($userCats as $userCat) {
            $userByCat[$userCat->cat_id] = User::find($userCat->user_id);
        }
        
        $cats = Cat::paginate(50);
        
        return view('cats.index', compact('admin','cats','userByCat'));
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

        $admin = Auth::guard('admin')->user();

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
        $post_images = $request->file('post_images');
        $post_videos = $request->file('post_videos');

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

        $catIds = $cat->pluck('id');
        $userCats = UserCat::whereIn('cat_id', $catIds)->with('user')->get();
        // cat_idをキーとして、関連するユーザーを取得
        $userByCat = [];
        foreach ($userCats as $userCat) {
            $userByCat[$userCat->cat_id] = User::find($userCat->user_id);
        }
        
        //postテーブルのcat_idと一致するレコードを取得
        $posts = Post::with(['images', 'videos'])->where('cat_id', $cat->id)->get();
        //postテーブルのidと一致するレコードを取得
        $postIds = $posts->pluck('id');
        
        foreach ($posts as $post) {
            $post->image = PostImage::where('post_id', $post->id)->first();
            $post->video = PostVideo::where('post_id', $post->id)->first();
        }
        
        foreach ($posts as $post) {
            $post->getFirstMedia();
        }
        
        return view('cats.show', compact('cat','age','userByCat','posts'));
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

        return view('cats.edit', compact('admin','cat', 'age','genders','kinds'));
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

    public function make($cat_id)
    {
        $cat = Cat::find($cat_id);
        
        if($cat->birthday) {
            $birthday = new \Carbon\Carbon($cat->birthday);
            $now = \Carbon\Carbon::now();
            $age = $now->diffInYears($birthday); // 猫の年齢を計算
        } else {
            $age = null; // birthdayが設定されていない場合はnullを設定
        }

        $kind = $cat->kind;
        $gender = $cat->gender;
        $matching = Matching::where('cat_id', $cat_id)->first();

        // マッチングした猫の詳細ページにリダイレクト
        return view('cats.post', compact('cat','age', 'kind', 'gender', 'matching'));
    }

    public function save(Request $request, Cat $cat)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'media.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,avi,mkv|max:20480', // 20MBの上限
        ]);
        // Postの作成
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->cat_id = $request->cat_id;
        $post->save();
        // ファイルの保存
        if($request->hasFile('media')) {
            foreach($request->file('media') as $file) {
                $path = Storage::disk('public')->putFile('media', $file); // 'media'は保存するディレクトリ
                if (in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'gif'])) {
                    // 画像の場合、post_imagesテーブルに保存
                    $image = new PostImage();
                    $image->post_id = $post->id;
                    $image->image_path = $path;
                    $image->save();
                } else {
                    // 動画の場合、post_videosテーブルに保存
                    $video = new PostVideo();
                    $video->post_id = $post->id;
                    $video->video_path = $path;
                    $video->save();
                }
            }
        }
        $cat->load('admin','gender','kind');
        // ここでは、猫の年齢を計算しています。
        $age = Carbon::parse($cat->birthday)->age;
        
        // まず、ログインしている管理者の情報を取得しています。
        $admin = Auth::guard('admin')->user();
        $catIds = $cat->pluck('id');
        $userCats = UserCat::whereIn('cat_id', $catIds)->with('user')->get();
        // cat_idをキーとして、関連するユーザーを取得
        $userByCat = [];
        foreach ($userCats as $userCat) {
            $userByCat[$userCat->cat_id] = User::find($userCat->user_id);
        }
        
        //postテーブルのcat_idと一致するレコードを取得
        $posts = Post::with(['images', 'videos'])->where('cat_id', $cat->id)->get();
        //postテーブルのidと一致するレコードを取得
        $postIds = $posts->pluck('id');
        
        foreach ($posts as $post) {
            $post->image = PostImage::where('post_id', $post->id)->first();
            $post->video = PostVideo::where('post_id', $post->id)->first();
        }

        foreach ($posts as $post) {
            $post->getFirstMedia();
        }

        return view('cats.show', compact('cat','age','userByCat', 'posts')); 
    }

public function postShow($cat, Post $post)
{
    // Catの取得
    $cat = Cat::findOrFail($cat);

    // マッチングデータの取得
    $matching = Matching::where('cat_id', $cat->id)->first();

    // ログインしている管理者の情報の取得
    $admin = Auth::guard('admin')->user();

    // ユーザーと猫のリレーションデータの取得
    $userCats = UserCat::where('cat_id', $cat->id)->with('user')->get();
    $userByCat = [];
    foreach ($userCats as $userCat) {
        $userByCat[$userCat->cat_id] = $userCat->user;
    }

    // 猫の年齢計算
    if($cat->birthday) {
        $birthday = new \Carbon\Carbon($cat->birthday);
        $now = \Carbon\Carbon::now();
        $age = $now->diffInYears($birthday); 
    } else {
        $age = null; 
    }

    // 投稿の画像と動画の取得
    $post_images = PostImage::where('post_id', $post->id)->get();
    $post_videos = PostVideo::where('post_id', $post->id)->get();

    // ビューにデータを渡して表示
    return view('cats.postShow', compact(
        'cat', 
        'matching', 
        'userByCat', 
        'age', 
        'admin', 
        'post_images', 
        'post_videos', 
        'post'
    ));
}

}
