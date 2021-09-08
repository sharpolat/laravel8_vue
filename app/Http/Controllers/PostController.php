<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Services\Blog\BlogService;
use Illuminate\Auth\AuthServiceProvider;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('PostContent')->latest()->paginate(4);
        return view('blog.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = [''];
        $i = 0;
        $post_id = Post::latest()->first();
        return view('blog.posts.create', compact('post_id', 'count', 'i'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Submit buttons
        if(isset($request->previewAction)){
            return redirect()
                            ->route('preview')
                            ->withInput();
        }
        if(isset($request->textIncrement)){
            return redirect()
                            ->route('count.textCountIncrement')
                            ->withInput();
        }
        if(isset($request->photoIncrement)){
            return redirect()
                            ->route('count.imageCountIncrement')
                            ->withInput();
        }

        // Для начала создание самого поста для последующего добавление данных(post_contents)
        $this->blogService->postCreate('title', 'tags', 'view_count', 'post_type_id', 'user_id', 'comment_count');

        // Добавление данных в Post->PostContent в разные поля бд, не смотря как много данных придет из вне
        $dataForText = $request->only('id','body', 'post_id');
        $dataForPhoto = $request->only('id', 'photo', 'post_id');
        $item = $this->blogService->postContentCreate($dataForText, $dataForPhoto);
        
        if($item) {
            return back()->withSuccess('Пост создан успешно')->withInput();
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
        $postId = Post::with('PostContent')->find($id);
        $comments = Comment::where("post_id", "=", $id)->with('user')->with('nestedComment')->latest()->get();
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
        $delete = Post::find($id)->delete();
        return back();
    }
}
