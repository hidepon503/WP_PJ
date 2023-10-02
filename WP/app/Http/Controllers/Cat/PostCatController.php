<?php

namespace App\Http\Controllers\Cat;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Cat;
use App\Models\Post;
use App\Models\UserCat;
use App\Models\Matching;
use App\Models\PostImage;
use App\Models\PostVideo;
use Carbon\Carbon;

class PostCat extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cat_id)
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
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Cat $cat)
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
                    $image->post_id = $posts->id;
                    $image->image_path = $path;
                    $image->save();
                } else {
                    // 動画の場合、post_videosテーブルに保存
                    $video = new PostVideo();
                    $video->post_id = $posts->id;
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
