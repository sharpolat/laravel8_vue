<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Character;

class CountIncrementController extends Controller
{
    
    // Count for posts editor
    public function textCountIncrement(Request $request) {
        $count = $request->old('count');
        array_push($count, 'text');
        $post_id = Post::latest()->first();
        return view('blog.posts.create', compact('post_id','count'));
    }

    public function imageCountIncrement(Request $request) {
        $count = $request->old('count');
        array_push($count, 'photo');
        $post_id = Post::latest()->first();
        return view('blog.posts.create', compact('post_id','count'));
    }

    // Count for characters editor
    public function characterTitleCountIncrement(Request $request) {
        $count = $request->old('count');
        array_push($count, 'title');
        $characters = Character::latest()->first();
        return view('character.create', compact('characters', 'count'));
    }

    public function characterTextCountIncrement(Request $request) {
        $count = $request->old('count');
        array_push($count, 'body');
        $characters = Character::latest()->first();
        return view('character.create', compact('characters', 'count'));
    }

    public function characterImageCountIncrement(Request $request) {
        $count = $request->old('count');
        array_push($count, 'photo');
        $characters = Character::latest()->first();
        return view('character.create', compact('characters', 'count'));
    }
}
