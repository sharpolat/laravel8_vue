<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostContent;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    static $count;
   
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
        
        // Submit button previewAction
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
        // !!!!! нужно прописать чтобы не было hidden input нужно брать инфу здесь !!!!!
        $dataForPost = $request->only('title', 'tags', 'view_count', 'post_type_id', 'user_id', 'comment_count'); 
        $itemForPost = (new Post())->create($dataForPost);
        $postId = Post::latest()->first();
        // Добавление данных в Post->PostContent в разные поля бд, не смотря как много данных придет из вне
        $dataForText = $request->only('id','body', 'post_id');
        $dataForPhoto = $request->only('id', 'photo', 'post_id');
        // Либо создание поста image+text либо по отдельности
        if(isset($dataForText['body']) && isset($dataForPhoto['photo'])){
            $arrayMergeForData = $dataForText['body'] + $dataForPhoto['photo'];
            ksort($arrayMergeForData);
        }
        elseif(isset($dataForText['body'])) {
            $onlyBodyData = $dataForText['body'];
        }
        else{
            $onlyImageData = $dataForPhoto['photo'];
        }
        if(isset($onlyBodyData)) {
            foreach($onlyBodyData as $item) {
                $dataForText2['body'] = $item;
                $dataForText2['post_id'] = $postId['id'];
                $itemForText = (new PostContent())->create($dataForText2);
            }
        }
        if(isset($onlyImageData)) {
            foreach($onlyImageData as $item) {
                if(is_readable($item)) {
                    $images = $request->file('photo');
                    $destinationPath = 'image/';
                    foreach($images as $image){
                        if($item->getClientOriginalName() == $image->getClientOriginalName()){
                            $postImage = date('YmdHis').gettimeofday()["usec"] . "." . $image->getClientOriginalExtension();
                            $image->move($destinationPath, $postImage);
                            $input['photo'] = "$postImage";
                        }
                    }
                    if($input['photo']) {
                        $input['post_id'] = $postId['id'];
                        $itemForImage = (new PostContent())->create($input);
                    }
                }
            }
        }
        $dataForText2 = $dataForText;
        if(isset($arrayMergeForData)){
            foreach($arrayMergeForData as $item) {
                if(is_readable($item)) {
                    $images = $request->file('photo');
                    $destinationPath = 'image/';
                    foreach($images as $image){
                        if($item->getClientOriginalName() == $image->getClientOriginalName()){
                            $postImage = date('YmdHis').gettimeofday()["usec"] . "." . $image->getClientOriginalExtension();
                            $image->move($destinationPath, $postImage);
                            $input['photo'] = "$postImage";
                        }
                    }
                    if($input['photo']) {
                        $input['post_id'] = $postId['id'];
                        $itemForImage = (new PostContent())->create($input);
                    }
                }
                else{
                    $dataForText2['body'] = $item;
                    $dataForText2['post_id'] = $postId['id'];
                    $itemForText = (new PostContent())->create($dataForText2);
                }
            }
        }
        // if(isset($request)) {
        //     $numForText = count($dataForText['body']);
        //     for($i = 0; $i < $numForText; $i++) {
        //         //add text
        //         if($dataForText['body'][$i]) {
        //             $dataForText2['body'] = $dataForText['body'][$i];
        //             $dataForText2['post_id'] = $dataForText['post_id'] + 1;
        //             $itemForPostContent = (new PostContent())->create($dataForText2);
        //             $dataForText2 = $dataForText;
        //         }
        //     }
        // }

        // if(isset($dataForPhoto['photo'])) {
        //     if($images = $request->file('photo')) {
        //         $destinationPath = 'image/';
        //         foreach($images as $image){
        //             $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //             $image->move($destinationPath, $postImage);
        //             $input['photo'] = "$postImage";
        //         }
        //     }
        //     if($input['photo']) {
        //         $input['post_id'] = $dataForPhoto['post_id'] + 1;
        //         $itemForPostContent = (new PostContent())->create($input);
        //     }
        // }

        // dd($itemForPostContent, $itemForPost);
        if(isset($arrayMergeForData)) {
            if( $itemForImage && $itemForText) {
                return back()->withSuccess('Пост создан успешно')->withInput();
            }
            else {
                return back()->withErrors(['msg'=>'Ошибка заполнения поста'])
                             ->withInput();
            }
        }
        if(isset($onlyBodyData)) {
            if($itemForText) {
                return back()->withSuccess('Пост создан успешно')->withInput();
            }
            else {
                return back()->withErrors(['msg'=>'Ошибка заполнения поста'])
                             ->withInput();
            }
        }
        if(isset($onlyImageData)) {
            if($itemForImage) {
                return back()->withSuccess('Пост создан успешно')->withInput();
            }
            else {
                return back()->withErrors(['msg'=>'Ошибка заполнения поста'])
                             ->withInput();
            }
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
        $comments = Comment::where("post_id", "=", $id)->with('user')->latest()->get();
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
