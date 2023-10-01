<?php

namespace App\Http\Controllers\Cat;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Cat;
use App\Models\Request as RequestModel;
use App\Models\UserCat;
use App\Models\Matching;
use App\Models\PostImage;
use App\Models\PostVideo;
use Carbon\Carbon;


class CatPostController extends Controller
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

        // マッチングした猫の詳細ページにリダイレクト
        return view('cats.post', compact('cat','age', 'kind', 'gender'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'media.*' => 'required|mimes:jpeg,png,jpg,gif,mp4,avi,mkv|max:20480', // 20MBの上限
        ]);

        // Postの作成
        $posts = new Post();
        $posts->title = $request->title;
        $posts->body = $request->body;
        $posts->cat_id = $request->cat_id;
        $posts->save();

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
        
        $cat = Cat::find($request->cat_id);
        $matching = Matching::where('cat_id', $cat->id)->where('user_id', auth()->id())->first();

        if($cat->birthday) {
            $birthday = new \Carbon\Carbon($cat->birthday);
            $now = \Carbon\Carbon::now();
            $age = $now->diffInYears($birthday); // 猫の年齢を計算
        } else {
            $age = null; // birthdayが設定されていない場合はnullを設定
        }

        $posts = Post::where('cat_id', $request->cat_id)->get();
return view('cats.show', compact('cat','age','matching', 'posts')); // 'posts'を追加

    }

    /**
     * Display the specified resource.
     */
    public function show($cat, Post $posts)
    {
        // cat_idとuser_idを使って、正確なmatchingを取得
        $matching = Matching::where('cat_id', $cat)->where('user_id', auth()->id())->first();

        if (!$matching) {
            abort(404);  // 見つからない場合は404エラーを返す
        }

        // ログインしているユーザーのIDと一致するuser_idを持つレコードをuser_catsテーブルから取得し、変数に代入。さらにuser_catsテーブルと外部キー接続しているrelationsテーブルから、nameを取得する。
        $user_cat = UserCat::where('user_id', auth()->id())->where('cat_id', $cat)->with('relation')->first();

        if($matching->cat->birthday) {
            $birthday = new \Carbon\Carbon($matching->cat->birthday);
            $now = \Carbon\Carbon::now();
            $age = $now->diffInYears($birthday); // 猫の年齢を計算
        } else {
            $age = null; // birthdayが設定されていない場合はnullを設定
        }

        $admin = $matching->cat->admin;
        $kind = $matching->cat->kind;
        $gender = $matching->cat->gender;

        $posts = Post::where('cat_id', $cat->id)->get();

        $post_images = PostImage::where('post_id', $posts->id)->get();
        $post_videos = PostVideo::where('post_id', $posts->id)->get();


        // マッチングした猫の詳細ページにリダイレクト
        return view('user.postShow', compact('matching',  'user_cat', 'age','admin', 'kind', 'gender', 'post_images', 'post_videos', 'posts'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
