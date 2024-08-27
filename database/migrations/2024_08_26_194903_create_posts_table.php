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
            $table->timestamps();
            $table->string('title',25);
            $table->text('content');
            $table->foreignId('category_id')->constrained('categories');
            $table->integer('author_id')->unsigned();  // sqlite limits
            $table->foreign('author_id')->references('id')->on('users');
            $table->text('tags');
            $table->string('status',10);
            $table->string('url')->unique();
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
