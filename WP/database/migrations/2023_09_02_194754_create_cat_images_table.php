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
        Schema::create('cat_images', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY, NOT NULL
            $table->string('name', 255)->nullable(false); // NOT NULL
        
            // cat_idカラムの追加
            $table->unsignedBigInteger('cat_id');
        
            // 外部キーとしての制約
            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');
        
            $table->timestamps();
        
            // INDEXES
            $table->index('cat_id');
        });
    }
    
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('cat_images');
        }
};
