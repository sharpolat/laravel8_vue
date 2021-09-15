<?php

namespace App\Http\Controllers;

use App\Models\GarbageForImage;
use Illuminate\Http\Request;

class ImagePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = GarbageForImage::latest()->paginate(8);
        return view('garbageForImages.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('garbageForImages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $items = $request->input();
            $imageData = $request->only('image');
            foreach($imageData as $item) {
                if(is_readable($item)) {
                    $images = $request->file('image');
                    $destinationPath = 'image/';
                    $postImage = date('YmdHis').gettimeofday()["usec"] . "." . $images->getClientOriginalExtension();
                    $images->move($destinationPath, $postImage);
                    $items['image'] = "$postImage";  
                }
            }
        
        $item = (new GarbageForImage())->create($items);
        $item->save();
        if($item) {
            return back()->withSuccess('обновления прошли успешно')->withInput();
        }
        else {
            return back()->withErrors(['msg'=>'Ошибка'])
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
        //
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
