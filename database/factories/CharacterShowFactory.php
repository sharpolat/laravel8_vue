<?php

namespace Database\Factories;

use App\Models\CharacterShow;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Character;

class CharacterShowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CharacterShow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $characterId = Character::orderByRaw("RAND()")->first();
        return [
            'character_id' => $characterId,
            'body' => $this->faker->text(100),
            'title' => $this->faker->slug(1),
            'photo'=> 'https://source.unsplash.com/random',
        ];
    }
}
