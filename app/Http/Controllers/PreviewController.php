<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PreviewController extends Controller
{
    public function preview(Request $request) {
        
        $old = $request->old();
        dd($old);
        // $postId = Post::with('PostContent')->find($id);
        // $comments = Comment::where("post_id", "=", $id)->with('user')->with('nestedComment')->latest()->get();
        return view('blog.posts.preview', compact('old'));
    }
}
