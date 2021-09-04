<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property int $view_count
 * @property string|null $tags
 * @property-read int|null $comment_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $post_type_id
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PostContent[] $postContent
 * @property-read int|null $post_content_count
 * @property-read \App\Models\PostType $postType
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCommentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereViewCount($value)
 * @mixin \Eloquent
 */
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

    public function nestedComment() {
        return $this->hasMany(NestedComment::class);
    }

    public function postContent() {
        return $this->hasMany(PostContent::class);
    }
}
