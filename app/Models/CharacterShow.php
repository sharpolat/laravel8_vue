<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CharacterShow
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property string|null $photo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $character_id
 * @property-read \App\Models\Character $character
 * @method static \Database\Factories\CharacterShowFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow query()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterShow whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CharacterShow extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function character() {
        return $this->belongsTo(Character::class);
    }
}
