<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('excerpt')->nullable();
            $table->json('content');
            $table->json('category')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('blog_posts'); }
};
