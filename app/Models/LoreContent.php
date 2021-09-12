<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoreContent extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function lore() {
        return $this->belongsTo(Lore::class);
    }
}
