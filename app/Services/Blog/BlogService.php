<?php

namespace App\Services\Blog;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\PostContent;


class BlogService {

    protected $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;   
    }

    public function postCreate( ...$onlyRequest ) {
        $data = $this->request->only($onlyRequest);
        $itemForPost = (new Post())->create($data);
        return $this;
    }

    public function postContentCreate($dataForText, $dataForPhoto) {
        
        $postId = Post::latest()->first();
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
                    $images = $this->request->file('photo');
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
                    $images = $this->request->file('photo');
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
    }
}