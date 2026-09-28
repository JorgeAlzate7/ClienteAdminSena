<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use Illuminate\Support\Facades\Http;

class AreaController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    public function index()   
    {

        $url = env('URL_SERVER_API');

        $areas = $this->fetchDataFromApi($url . '/area/list');

        return view('area.index', compact('areas'));
    }
    
    public function show($id)
    {
        $url = env('URL_SERVER_API');

        $area = $this->fetchDataFromApi($url . '/area/' . $id);

        return view('area.show', compact('area'));

    }
}
