<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // タイトル
            $table->text('body'); // 本文
            $table->string('image')->nullable(); // 画像
            $table->unsignedBigInteger('cat_id'); // 猫のID
            $table->unsignedBigInteger('user_id')->nullable(); // ユーザーのID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
