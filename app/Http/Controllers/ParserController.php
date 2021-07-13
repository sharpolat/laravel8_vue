<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use DOMDocument;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $html = file_get_contents('https://kolesa.kz/cars/'); 
        $dom->loadHTML($html);
        
        $html = $dom->saveHTML();
        print $html;
        // return view('autodata.parser.parser', compact('html'));
    }
}
