<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }

    
    public function create()
    {
        return view('area.create');
    }

    
    
    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');

        Http::post(
            $url . '/area/store',
            $request->all()
        );

        return redirect()->route('area.index');
    }


    
    public function index()
    {
        $url = env('URL_SERVER_API');

        $areas = $this->fetchDataFromApi(
            $url . '/area/list'
        );

        return view('area.index', compact('areas'));
    }

    
    public function show($id)
    {
        $url = env('URL_SERVER_API');

        $area = $this->fetchDataFromApi(
            $url . '/area/show/' . $id
        );

        return view('area.show', compact('area'));
    }

    
    public function edit($id)
    {
        $url = env('URL_SERVER_API');

        $area = $this->fetchDataFromApi(
            $url . '/area/show/' . $id
        );

        return view('area.edit', compact('area'));
    }

    
    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        Http::put(
            $url . '/area/' . $id,
            $request->all()
        );

        return redirect()->route('area.index');
    }

    
    
    public function destroy($id)
    {
        $url = env('URL_SERVER_API');

        Http::delete($url . '/area/' . $id);

        return redirect()->route('area.index');
    }

}