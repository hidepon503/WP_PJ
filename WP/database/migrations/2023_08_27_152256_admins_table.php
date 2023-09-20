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
        Schema::create('admins', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->comment('動物保護団体名');
            $table->string('email')->unique()->notnull()->comment('メールアドレス');
            $table->string('password')->notnull()->comment('パスワード');
            $table->string('image')->nullable()->comment('団体の写真');
            $table->string('introduction')->nullable()->comment('紹介文');
            $table->string('ceoImage')->nullable()->comment('代表者の写真');
            $table->unsignedInteger('ceoName')->nullable()->comment('代表者名');
            $table->string('ceoMessage')->nullable()->comment('代表者のメッセージ');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->integer('postcode')->nullable()->comment('郵便番号');
            $table->string('prefecture')->nullable()->comment('都道府県');
            $table->string('city')->nullable()->comment('市区町村');
            $table->string('town')->nullable()->comment('大字');
            $table->string('street')->nullable()->comment('番地');
            $table->string('building')->nullable()->comment('建物名・部屋番号');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
