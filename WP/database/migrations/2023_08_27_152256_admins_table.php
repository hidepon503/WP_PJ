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
            $table->string('tel')->notnull()->comment('電話番号');
            $table->unsignedInteger('postcode')->nullable()->comment('郵便番号');
            $table->string('address')->nullable()->comment('住所');
            $table->unsignedInteger('ceo_id')->nullable()->comment('代表者ID');
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
        Schema::dropIfExists('admins');
    }
};
