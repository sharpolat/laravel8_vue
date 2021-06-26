<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $result = $request->input('body');
        $searchCharacters = Character::where("name", "like", "%". $result . "%")->paginate(5);
        return view('character.index', compact('searchCharacters'));
    }
}
