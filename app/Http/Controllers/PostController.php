<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostContent;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(4);
        return view('blog.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = 3;
        return view('blog.posts.create', compact('count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Добавление данных в PostContent в разные поля бд, не смотря как много данных придет из вне
        $data = $request->input();
        $data2 = $data;
        $num = count($data['body']);
        for($i = 0; $i < $num; $i++) {
            //text add
            if($data['body'][$i]) {
                $data2['body'] = $data['body'][$i];
                $item = (new PostContent())->create($data2); 
                $data2 = $data;
            }
            //photo add
            else{
                //
            }
            
        }
        if( $item ) {
            return back();
        }
        else {
            return back()->withErrors(['msg'=>'Ошибка заполнения поста'])
                         ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postId = Post::find($id);
        $comments = Comment::where("post_id", "=" ,$id)->with('user')->latest()->get();
        return view('blog.posts.show', compact('postId', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
