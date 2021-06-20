<?php

namespace Database\Factories;

use App\Models\PostTag;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $postId = Post::orderByRaw("RAND()")->first();
        $tagId = Tag::orderByRaw("RAND()")->first();
        return [
            'post_id' => $postId,
            'tag_id' => $tagId,
        ];
    }
}
