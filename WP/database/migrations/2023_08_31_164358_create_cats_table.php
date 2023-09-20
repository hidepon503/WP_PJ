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
            $table->foreignId('admin_id')->constrained()->onDelete('cascade');
            $table->string('image')->notNull();
            $table->date('birthday')->nullable();
            $table->decimal('weight', 5,2)->notNull();
            $table->boolean('lostchild')->default(false);
            $table->foreignId('gender_id')->constrained()->onDelete('cascade')->notNull();
            $table->foreignId('kind_id')->notNull();
            $table->foreignId('status_id')->notNull();
            $table->string('introduction')->nullable();
            $table->string('insuranceCard')->nullable()->comment('保険証');
            $table->integer('soracom')->unique()->nullable();
            $table->integer('hellolight')->unique()->nullable();
            $table->integer('apple')->unique()->nullable();
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
