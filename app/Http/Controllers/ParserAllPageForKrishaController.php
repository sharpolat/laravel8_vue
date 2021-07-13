<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DOMDocument;

class ParserAllPageForKrishaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rowIncrement = 0;
        $rowIncrementDiff = 0;
        $rowCount = 0;
        $idArr = [];
        $dom = new DOMDocument;
        $result = 0;
        // $increment = Parser::max('last_parser_id');
        // 668354540
        $increment = 666394880;
        // $whileTrueIncrement = $increment + 10000;
        libxml_use_internal_errors(true);

        // for($i = $increment; $i < $whileTrueIncrement; $i++) {
        //     $rowIncrement = $i;
        //     $urlPlusId = 'https://krisha.kz//a/show/' . $i;
        //     $file_headers = @get_headers($urlPlusId); 
        //     if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
        //     { 
        //         echo $i . ' нет' . '<br>';
        //     } 
        //     else { 
        //         $result = $i;
        //         $i += 1000;
        //     }
        //     // Проверка на 10 подряд запросов, если 10, то прерывается весь цикл( значит записей больше нет )
        //     $rowIncrementDiff = $i;
        //     if(( $rowIncrementDiff - $rowIncrement ) == 0){
        //         $rowCount += 1;
        //     }
        //     else{
        //         $rowCount = 0;
        //     }
        //     if($rowCount == 15) {
        //         echo 'последние в этих десятитысячах' . '<br>';
        //         break;
        //     }
        // }
        // echo 'Последний найденный в десятитысячной ' . $result . '<br>';
        // $whileTrueIncrement2 = $result + 1000;
        // for($i = $result; $i < $whileTrueIncrement2; $i++) {
        //     $rowIncrement = $i;
        //     $urlPlusId = 'https://krisha.kz/a/show/' . $i;
        //     $file_headers = @get_headers($urlPlusId); 
        //     if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
        //     { 
        //         echo $i . ' нет' . '<br>';
        //     } 
        //     else { 
        //         $result = $i;
        //         $i += 100;
        //     }
        //     // Проверка на 10 подряд запросов, если 10, то прерывается весь цикл( значит записей больше нет )
        //     $rowIncrementDiff = $i;
        //     if(( $rowIncrementDiff - $rowIncrement ) == 0){
        //         $rowCount += 1;
        //     }
        //     else{
        //         $rowCount = 0;
        //     }
        //     if($rowCount == 15) {
        //         echo 'последние в этой тысяче' . '<br>';
        //         break;
        //     }
        // }
        // echo 'Последний найденный в тысячной ' . $result .  '<br>';
        // $whileTrueIncrement3 = 668354449 + 100;
        // for($i = 668354449; $i < $whileTrueIncrement3; $i++) {
        //     $rowIncrement = $i;
        //     $urlPlusId = 'https://krisha.kz/a/show/' . $i;
        //     $file_headers = @get_headers($urlPlusId); 
        //     if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
        //     { 
        //         echo $i . ' нет' . '<br>';
        //     } 
        //     else { 
        //         array_push($idArr, $i);
        //         $result = $i;
        //         $i += 10;
        //     }
        //     // Проверка на 10 подряд запросов, если 10, то прерывается весь цикл( значит записей больше нет )
        //     $rowIncrementDiff = $i;
        //     if(( $rowIncrementDiff - $rowIncrement ) == 0){
        //         $rowCount += 1;
        //     }
        //     else{
        //         $rowCount = 0;
        //     }
        //     if($rowCount == 10) {
        //         echo 'последние в этой сотне' . '<br>';
        //         break;
        //     }
        // }
                


        $whileTrueIncrement = $increment + 10;
        for($i = $increment; $i < $whileTrueIncrement; $i++) {
            $rowIncrement = $i;
            $urlPlusId = 'https://krisha.kz/a/show/' . $i;
            $file_headers = @get_headers($urlPlusId); 
            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
            { 
                echo $i . ' нет' . '<br>';
            } 
            else { 
                $html = file_get_contents($urlPlusId); 
                $dom->loadHTML($html);
                $html = $dom->saveHTML();
                // <a> parser for only rent
                $aBlocs = $dom->getElementsByTagName('a');
                $k = 0;
                while($aBloc = $aBlocs->item($k++))
                {
                    foreach($aBloc->attributes as $attr)
                    {
                        if($attr->value == '/arenda/ofisa/almaty/' && $attr->nodeName == 'itemid'){
                            dd($i);
                        }
                    }
                }
                // Title parser for price and full information
                // $items = $dom->getElementsByTagName('title');
                // if($items->length > 0){
                //     $all_info = $items->item(0)->nodeValue;
                // }
                // if (Parser::where('ad_id', '=', $i)->exists()) {
                //     // exists
                // }
                // else {
                //     $done = Parser::create([
                //         'ad_id' => $i,
                //         'auto_model' => $auto_model,
                //         'auto_brand' => $auto_brand,
                //         'auto_year' => $auto_year,
                //         'all_info' => $all_info,
                //     ]);
                // }
                
                array_push($idArr, $i);
                $result = $i;
            }
            // Проверка на 15 подряд запросов, если 15, то прерывается весь цикл( значит записей больше нет )
            $rowIncrementDiff = $i;
            if(( $rowIncrementDiff - $rowIncrement ) == 0){
                $rowCount += 1;
            }
            else{
                $rowCount = 0;
            }
            if($rowCount == 10) {
                echo 'последние в этой сотне' . '<br>';
                break;
            }
        }
        
        echo "Последний id = " . $result . "<br>";
        echo $time . '<br>';

        // добавления последнего найденного id
        // $done = Parser::create([
        //     'last_parser_id' => $result,
        // ]);

        echo $result . ' Последний ' . '<br>';
        return view('autodata.parser.parserForKrisha', compact('idArr'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $urlPlusId = 'https://krisha.kz/a/show/' . $id;
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $html = file_get_contents($urlPlusId); 
        $dom->loadHTML($html);
        dd($dom);
        $html = $dom->saveHTML();
        print $html;
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
