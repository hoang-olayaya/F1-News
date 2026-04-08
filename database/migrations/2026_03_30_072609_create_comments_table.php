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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại nối với người dùng (user_id)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Khóa ngoại nối với bài viết (post_id)
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            // Nội dung bình luận
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
