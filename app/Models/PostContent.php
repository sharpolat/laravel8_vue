<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PostContent
 *
 * @property int $id
 * @property string|null $photo
 * @property string|null $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $post_id
 * @property-read \App\Models\Post $post
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostContent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PostContent extends Model
{
    use HasFactory;
    protected $fillable = ['body', 'post_id', 'photo'];
    
    public function post() {
        return $this->belongsTo(Post::class);
    }
}
