<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lore extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function loreContent() {
        return $this->hasMany(LoreContent::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
