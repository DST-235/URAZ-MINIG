<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('page_key');
            $table->string('image')->nullable();
            $table->json('title')->nullable();
            $table->json('subtitle')->nullable();
            $table->json('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->enum('text_align', ['left','center','right'])->default('center');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('overlay_color')->default('rgba(0,0,0,0.5)');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('sliders'); }
};
