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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable()->comment('写真');
            $table->string('tel')->nullable()->comment('電話番号');
            $table->integer('postcode')->nullable()->comment('郵便番号');
            $table->string('prefecture')->nullable()->comment('都道府県');
            $table->string('city')->nullable()->comment('市区町村');
            $table->string('town')->nullable()->comment('大字');
            $table->string('street')->nullable()->comment('番地');
            $table->string('building')->nullable()->comment('建物名・部屋番号');
            $table->date('birthday')->nullable()->comment('誕生日');
            $table->string('introduction')->nullable()->comment('紹介文');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
