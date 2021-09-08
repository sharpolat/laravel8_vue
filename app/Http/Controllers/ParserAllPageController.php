<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parser;
use DOMDocument;

class ParserAllPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Вывод последних из всего сайта
        $rowIncrement = 0;
        $rowIncrementDiff = 0;
        $rowCount = 0;
        // $increment = Parser::max('last_parser_id');
        $idArr = [];
        $dom = new DOMDocument;
        $result = 0;
        $increment = 122714062;
        $whileTrueIncrement = $increment + 10000;
       
        libxml_use_internal_errors(true);

        $start = microtime(true);
        for($i = $increment; $i < $whileTrueIncrement; $i++) {
            $rowIncrement = $i;
            $urlPlusId = 'https://' . $i;
            $file_headers = @get_headers($urlPlusId); 
            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
            { 
                echo $i . ' нет' . '<br>';
            } 
            else { 
                $result = $i;
                $i += 1000;
            }
            // Проверка на 10 подряд запросов, если 10, то прерывается весь цикл( значит записей больше нет )
            $rowIncrementDiff = $i;
            if(( $rowIncrementDiff - $rowIncrement ) == 0){
                $rowCount += 1;
            }
            else{
                $rowCount = 0;
            }
            if($rowCount == 10) {
                echo 'последние в этих десятитысячах' . '<br>';
                break;
            }
        }
        echo 'Последний найденный в десятитысячной ' . $result . '<br>';
        $whileTrueIncrement2 = $result + 1000;
        for($i = $result; $i < $whileTrueIncrement2; $i++) {
            $rowIncrement = $i;
            $urlPlusId = 'https://' . $i;
            $file_headers = @get_headers($urlPlusId); 
            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
            { 
                echo $i . ' нет' . '<br>';
            } 
            else { 
                $result = $i;
                $i += 100;
            }
            // Проверка на 10 подряд запросов, если 10, то прерывается весь цикл( значит записей больше нет )
            $rowIncrementDiff = $i;
            if(( $rowIncrementDiff - $rowIncrement ) == 0){
                $rowCount += 1;
            }
            else{
                $rowCount = 0;
            }
            if($rowCount == 10) {
                echo 'последние в этой тысяче' . '<br>';
                break;
            }
        }
        echo 'Последний найденный в тысячной ' . $result .  '<br>';
        $whileTrueIncrement3 = $result + 100;
        for($i = $result; $i < $whileTrueIncrement3; $i++) {
            $rowIncrement = $i;
            $urlPlusId = 'https://' . $i;
            $file_headers = @get_headers($urlPlusId); 
            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
            { 
                echo $i . ' нет' . '<br>';
            } 
            else { 
                $result = $i;
                $i += 10;
            }
            // Проверка на 10 подряд запросов, если 10, то прерывается весь цикл( значит записей больше нет )
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


        // $whileTrueIncrement = $increment + 100;
        // for($i = $increment; $i < $whileTrueIncrement; $i++) {
        //     $rowIncrement = $i;
        //     $urlPlusId = 'https://' . $i;
        //     $file_headers = @get_headers($urlPlusId); 
        //     if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') 
        //     { 
        //         echo $i . ' нет' . '<br>';
        //     } 
        //     else { 
        //         $html = file_get_contents($urlPlusId); 
        //         $dom->loadHTML($html);
        //         $html = $dom->saveHTML();
        //         // Span parser for name, brand, year
        //         $spans = $dom->getElementsByTagName('span');
        //         $k = 0;
        //         while($span = $spans->item($k++))
        //         {
        //             foreach($span->attributes as $attr)
        //             {
        //                 if($attr->value == 'name'){ 
        //                     $auto_model = $span->nodeValue;
        //                 }
        //                 if($attr->value == 'brand'){ 
        //                     $auto_brand = $span->nodeValue;
        //                 }
        //                 if($attr->value == 'year'){ 
        //                     $auto_year = $span->nodeValue;
        //                 }
        //             }
        //         }
        //         // Title parser for price and full information
        //         $items = $dom->getElementsByTagName('title');
        //         if($items->length > 0){
        //             $all_info = $items->item(0)->nodeValue;
        //         }
        //         if (Parser::where('ad_id', '=', $i)->exists()) {
        //             // exists
        //         }
        //         else {
        //             $done = Parser::create([
        //                 'ad_id' => $i,
        //                 'auto_model' => $auto_model,
        //                 'auto_brand' => $auto_brand,
        //                 'auto_year' => $auto_year,
        //                 'all_info' => $all_info,
        //             ]);
        //         }
                
        //         array_push($idArr, $i);
        //         $result = $i;
        //         $i += 1;
        //     }
        //     // Проверка на 15 подряд запросов, если 15, то прерывается весь цикл( значит записей больше нет )
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
        
        echo "Последний id = " . $result . "<br>";
        $time = microtime(true) - $start;
        echo $time . '<br>';


        // $done = Parser::create([
        //     'last_parser_id' => $result,
        // ]);
        

        // return view('autodata.parser.parser', compact('idArr'));
        
        // Вывод последних из главной страницы

        // $carName = [];
        // foreach ($idArr as $id) {
        //     $urlPlusId = 'https://' . $id;
        //     $html = file_get_contents($urlPlusId); 
        //     $dom->loadHTML($html);
        //     dd($dom);
        //     $html = $dom->saveHTML();
        //     $spans = $dom->getElementsByTagName('span');
        //     $i = 0;
        //     while($span = $spans->item($i++))
        //     {
        //         foreach($span->attributes as $attr)
        //         {
        //             if($attr->value == 'a-el-info-title'){ // Найти название машины
        //                 array_push($carName, $span->nodeValue);
        //             }
        //         }
        //     }
        // }


        // foreach($carName as $car) {
        //     echo $car . '<br>';
        // }


        
        // $html = file_get_contents('https://'); 
        // $dom->loadHTML($html);
        
        // dd($dom);
        // $html = $dom->saveHTML();

        // $divs = $dom->getElementsByTagName('div');
        // $spans = $dom->getElementsByTagName('span');
        // $i = 0;
        // while($span = $spans->item($i++))
        // {
        //     foreach($span->attributes as $attr)
        //     {
        //         if($attr->value == 'a-el-info-title'){
        //             array_push($carName, $span->nodeValue);
        //         }
        //     }
        // }
        // $i = 0;
        // while($div = $divs->item($i++))
        // {
        //     foreach($div->attributes as $attr)
        //     {
        //         if($attr->name == 'data-id'){
        //             array_push($idArr, $attr->value);
        //         }
        //     }
        // }
        // return view('autodata.parser.parser', compact('idArr', 'carName'));
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
        $urlPlusId = 'https://' . $id;
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
