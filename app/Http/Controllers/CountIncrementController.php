<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Character;

class CountIncrementController extends Controller
{
    public function countIncrement(Request $request) {
        dd($request->input());
        $count = ($request->input('count') !== null) ? $request->input('count') : $request->old('count');
        
        $resultForText = ($request->input('textNameForText') !== null) ? $request->input('textNameForText') : $request->old('textNameForText');
        $resultForPhoto = ($request->input('textNameForPhoto') !== null) ? $request->input('textNameForPhoto') : $request->old('textNameForPhoto');
        
        if($resultForText){
            array_push($count, $resultForText);
        }else{
            array_push($count, $resultForPhoto);
        }
        $post_id = Post::latest()->first();
        $request->flashOnly(['username', 'email']);
        return view('blog.posts.create', compact('post_id','count'));
    }
    public function countCharacterIncrement(Request $request) {  
        $count = $request->input('count');
        $resultForTitle = $request->input('textNameForTitle');
        $resultForPhoto = $request->input('textNameForPhoto');
        $resultForBody = $request->input('textNameForBody');
        if($resultForTitle){
            array_push($count, $resultForTitle);
        }
        elseif($resultForPhoto) {
            array_push($count, $resultForPhoto);
        }
        else{
            array_push($count, $resultForBody);
        }
        $characters = Character::latest()->first();
        return view('character.create', compact('characters', 'count'));
    }
}
