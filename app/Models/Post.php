<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 
        'summary', 'content', 'thumbnail', 'views', 
        'status', 'published_at'
    ];

    // Mối quan hệ N-1: 1 Bài viết thuộc về 1 Chuyên mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Mối quan hệ N-1: 1 Bài viết được đăng bởi 1 User (Tác giả)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mối quan hệ 1-N: 1 Bài viết có nhiều Bình luận
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }
}