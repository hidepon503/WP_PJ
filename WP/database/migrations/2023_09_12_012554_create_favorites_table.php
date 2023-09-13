<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('favorites', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('cat_id');
        $table->timestamps();

        $table->unique(['user_id', 'cat_id']); // 同じ猫を同じユーザーが2回以上お気に入りできないようにする

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
