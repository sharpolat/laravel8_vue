<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comment::where('user_id', $id)->with('post')->latest()->paginate(8);
        $user = User::find($id);
        return view('userProfile.show', compact('comments', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id)->first();
        return view('userProfile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $items = User::find($id)->first();
        
            $imageData = $request->only('profile_photo_path');
            foreach($imageData as $item) {
                if(is_readable($item)) {
                    $images = $request->file('profile_photo_path');
                    $destinationPath = 'image/';
                    $postImage = date('YmdHis').gettimeofday()["usec"] . "." . $images->getClientOriginalExtension();
                    $images->move($destinationPath, $postImage);
                    $items->profile_photo_path = "$postImage";  
                }
            }
        
        $items->name = $request->name;
        $items->about_me = $request->about_me;
        $items->save();
        if($items) {
            return back()->withSuccess('обновления прошли успешно')->withInput();
        }
        else {
            return back()->withErrors(['msg'=>'Ошибка'])
                         ->withInput();
        }
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