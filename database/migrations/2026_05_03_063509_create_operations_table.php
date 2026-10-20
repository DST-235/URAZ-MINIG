<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('location')->nullable();
            $table->string('category')->nullable();
            $table->string('image')->nullable();
            $table->string('tags')->nullable();
            $table->date('active_since')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('operations'); }
};
