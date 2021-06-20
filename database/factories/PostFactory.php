<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\PostType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::orderByRaw("RAND()")->first();
        $postTypeId = PostType::orderByRaw("RAND()")->first();
        return [
            'title' => $this->faker->slug(2),
            'user_id' => $userId,
            'view_count' => $this->faker->randomNumber(3),
            'body' => $this->faker->text(100),
            'tags' => $this->faker->sentence(1),
            'comment_count' =>$this->faker->randomNumber(2),
            'post_type_id' => $postTypeId,
        ];
    }
}
