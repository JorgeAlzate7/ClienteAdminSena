<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AprendiceController extends Controller
{
    
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    public function index()   //http://api.codersfree.test/v1/categories?included=posts
    {

        $url = env('URL_SERVER_API');

        $aprendices = $this->fetchDataFromApi($url . '/aprendice');
        // return $categories;
        return view('aprendice.index', compact('aprendices'));
    }

    public function show($id)
    {

        $url = env('URL_SERVER_API');

        $aprendice = $this->fetchDataFromApi($url . '/aprendice/' . $id);

        return view('aprendice.show', compact('aprendice'));
    }



}
