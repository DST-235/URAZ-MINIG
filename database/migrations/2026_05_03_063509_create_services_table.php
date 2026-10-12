<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->json('name');
            $table->json('description');
            $table->json('short_description')->nullable();
            $table->json('features')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_nav')->default(true);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('services')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('services'); }
};
