<?php

namespace App\Services\Blog;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Character;



class IncrementService {

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function countIncrement($model, $push) {
        $count = $this->request->old('count');
        array_push($count, $push);
        $post_id = $model::latest()->first();
        $result = compact('post_id', 'count');
        return $result;
    }
}