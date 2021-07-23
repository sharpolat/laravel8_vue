<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CountIncrementController extends Controller
{
    public function countIncrement(Request $request) {
            
        $count = $request->input('count');
        $i =  $request->input('i');
        $resultForText = $request->input('textNameForText');
        $resultForPhoto = $request->input('textNameForPhoto');
        if($resultForText){
            array_push($count, $resultForText);
        }else{
            array_push($count, $resultForPhoto);
        }
        $post_id = Post::latest()->first();
        $request->flashOnly(['username', 'email']);
        return view('blog.posts.create', compact('post_id','count'));
    }
}
