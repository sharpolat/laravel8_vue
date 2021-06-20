<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $postId = Post::orderByRaw("RAND()")->first();
        $userId = User::orderByRaw("RAND()")->first();
        return [
            'post_id' => $postId,
            'body' => $this->faker->text(100),
            'user_display_name' => $this->faker->name(10),
            'user_id' => $userId,
        ];
    }
}
