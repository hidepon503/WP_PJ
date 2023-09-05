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
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->notNull();
            $table->foreignId('admin_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('gender_id')->constrained()->onDelete('cascade')->notNull();
            $table->foreignId('kind_id')->notNull();
            $table->date('birthday')->nullable();
            $table->decimal('weight', 5,2)->notNull();
            $table->string('introduction')->nullable();
            $table->integer('soracom')->unique()->nullable();
            $table->integer('hellolight')->unique()->nullable();
            $table->integer('apple')->unique()->nullable();
            $table->boolean('lostchild')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};
