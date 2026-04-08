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
            $table->unsignedBigInteger('user_id'); // Khóa ngoại Tác giả
            $table->unsignedBigInteger('category_id'); // Khóa ngoại Chuyên mục
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary'); // Tóm tắt
            $table->longText('content'); // Nội dung chi tiết (CKEditor)
            $table->string('thumbnail')->nullable(); // Ảnh đại diện
            $table->integer('views')->default(0); // Lượt xem
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->timestamp('published_at')->nullable();
            $table->softDeletes(); // Hỗ trợ xóa mềm
            $table->timestamps();

            // Khai báo liên kết khóa ngoại (Foreign Keys)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
