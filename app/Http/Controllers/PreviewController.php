<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function preview(Request $request) {
        $old = old();
        return view('blog.posts.preview', compact('old'));
    }
}
