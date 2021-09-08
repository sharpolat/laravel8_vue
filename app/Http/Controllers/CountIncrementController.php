<?php

namespace App\Http\Controllers;

use App\Services\Blog\IncrementService;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Character;

class CountIncrementController extends Controller
{
    protected $incrementService;

    public function __construct(IncrementService $incrementService) {
        $this->incrementService = $incrementService; 
    }

    // Count for posts editor
    public function textCountIncrement() {
        $result = $this->incrementService->countIncrement(Post::class, 'text');
        return view('blog.posts.create', $result);
    }

    public function imageCountIncrement() {
        $result = $this->incrementService->countIncrement(Post::class, 'photo');
        return view('blog.posts.create', $result);
    }


    // Count for characters editor
    public function characterTitleCountIncrement() {
        $result = $this->incrementService->countIncrement(Character::class, 'title');
        return view('character.create', $result);
    }

    public function characterTextCountIncrement() {
        $result = $this->incrementService->countIncrement(Character::class, 'body');
        return view('character.create', $result);
    }

    public function characterImageCountIncrement() {
        $result = $this->incrementService->countIncrement(Character::class, 'photo');
        return view('character.create', $result);
    }
}
