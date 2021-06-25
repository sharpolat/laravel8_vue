<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function postType() {
        return $this->belongsTo(PostType::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function postContent() {
        return $this->hasMany(PostContent::class);
    }
}
