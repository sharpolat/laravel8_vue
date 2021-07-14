<?php

namespace Database\Factories;

use App\Models\PostContent;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostContent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $postId = Post::orderByRaw("RAND()")->first();
        return [
            'post_id' => $postId,
            'photo'=> 'image/20210709185002.jpeg',
            'body' => $this->faker->text(200),
        ];
    }
}
