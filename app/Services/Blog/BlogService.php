<?php

namespace App\Services\Blog;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostContent;


class BlogService {

    public function postCreate(Request $request, ...$only) {
        $data = $request->only($only);
        $itemForPost = (new Post())->create($data);
    }
}