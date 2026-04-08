<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Cho phép thêm dữ liệu vào các cột này
    protected $fillable = ['name', 'slug', 'status'];

    // Khai báo mối quan hệ 1-N: 1 Chuyên mục có nhiều Bài viết
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}