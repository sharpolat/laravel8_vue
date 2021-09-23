<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\CharacterShow;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mainCharacters = Character::where('is_main_character', 1)->latest()->paginate(3, ['*'], 'mainCharacters');
        $npcCharacters = Character::where('is_main_character', 0)->latest()->paginate(3, ['*'], 'npcCharacters');
        return view('character.index', compact('mainCharacters', 'npcCharacters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count = [''];
        $characters = Character::latest()->get();
        return view('character.create', compact('characters', 'count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if(isset($request->titleAdd)){
            return redirect()
                            ->route('count.characterTitleCountIncrement')
                            ->withInput();
        }
        if(isset($request->textAdd)){
            return redirect()
                            ->route('count.characterTextCountIncrement')
                            ->withInput();
        }
        if(isset($request->imageAdd)){
            return redirect()
                            ->route('count.characterImageCountIncrement')
                            ->withInput();
        }
        $dataForCharacterCreate = $request->only('name', 'mainBody', 'mainPhoto');
        $imagesForMainPhotos = array();
        $imagesForMainPhotos[] = $request->file('mainPhoto');
        $destinationPath = 'image/';
        foreach($imagesForMainPhotos as $image){
            if($dataForCharacterCreate['mainPhoto']->getClientOriginalName() == $image->getClientOriginalName()){
                $postImage = date('YmdHis').gettimeofday()["usec"] . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $postImage);
                $itemForPost['mainPhoto'] = "$postImage";
            }
        }
        $is_main_character = isset($request['mainCharacter']) ? 1 : 0;
        $doneData = Character::create([
            'body' => $dataForCharacterCreate['mainBody'],
            'name' => $dataForCharacterCreate['name'],
            'photo' => $itemForPost['mainPhoto'],
            'is_main_character' => $is_main_character,
        ])->save();
        
        $characterId = Character::latest()->first();
        $dataForTitle = $request->only('title', 'character_id');
        $dataForBody = $request->only('body', 'character_id');
        $dataForPhoto = $request->only('photo', 'character_id');
        // Либо создание поста image+text либо по отдельности
        if(isset($dataForTitle['title']) && isset($dataForPhoto['photo']) && isset($dataForBody['body'])){
            $arrayMergeForData = $dataForTitle['title'] + $dataForPhoto['photo'] + $dataForBody['body'];
            ksort($arrayMergeForData);
        }
        else {
            $onlyBodyTitleData = $dataForTitle['title'] + $dataForBody['body'];
            ksort($onlyBodyTitleData);
        }
        
        if(isset($arrayMergeForData)){
            foreach($arrayMergeForData as $item) {
                $dataForTitle2 = $dataForTitle;
                $dataForBody2 = $dataForBody;
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
                        $input['character_id'] = $characterId['id'];
                        $itemForImage = (new CharacterShow())->create($input);
                    }
                    
                }
                elseif(strlen($item) < 30){
                    $dataForTitle2['title'] = $item;
                    $dataForTitle2['character_id'] = $characterId['id'];
                    $itemForTitle = (new CharacterShow())->create($dataForTitle2);
                }
                else{
                    $dataForBody2['body'] = $item;
                    $dataForBody2['character_id'] = $characterId['id'];
                    $itemForBody2 = (new CharacterShow())->create($dataForBody2);
                }
            }
        }
        
        return back()->withSuccess('Пост создан успешно')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $characterData = Character::with('characterShow')->find($id);
        $chracterRandNames = Character::inRandomOrder()->limit(5)->get();
        return view('character.show', compact('characterData', 'chracterRandNames'));
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
        if($request->input('is_main_character') != null) {
            $item = character::find($id);
        }
        else{ $item = characterShow::find($id);}
        $data = $request->input();
        $result = $item->fill($data)->save();
            if($result) {
                return back();
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
        
        $characterDelete = Character::find($id)->delete();
        return back();
    }

    
}
