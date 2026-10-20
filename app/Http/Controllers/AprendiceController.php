<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AprendiceController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        
        // $response->json() devuelve un arreglo asociativo de PHP
        return $response->json() ?? [];
    }

    public function index()
    {
        $url = env('URL_SERVER_API');

        $aprendices = $this->fetchDataFromApi(
            $url . '/aprendice/list'
        );

        return view('aprendice.index', compact('aprendices'));
    }

    public function create()
    {
        $url = env('URL_SERVER_API');

        $courses = $this->fetchDataFromApi(
            $url . '/course/list'
        );

        $computers = $this->fetchDataFromApi(
            $url . '/computer/list'
        );

        return view(
            'aprendice.create',
            compact('courses', 'computers')
        );
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');

        // Se quita el _token de Laravel para enviar solo los campos de la tabla
        Http::post(
            $url . '/aprendice/store',
            $request->except('_token')
        );

        return redirect()->route('aprendice.index');
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');

        $aprendice = $this->fetchDataFromApi(
            $url . '/aprendice/show/' . $id
        );

        return view('aprendice.show', compact('aprendice'));
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');

        $aprendice = $this->fetchDataFromApi(
            $url . '/aprendice/show/' . $id
        );

        $courses = $this->fetchDataFromApi(
            $url . '/course/list'
        );

        $computers = $this->fetchDataFromApi(
            $url . '/computer/list'
        );

        return view(
            'aprendice.edit',
            compact('aprendice', 'courses', 'computers')
        );
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        Http::put(
            $url . '/aprendice/' . $id,
            $request->except(['_token', '_method'])
        );

        return redirect()->route('aprendice.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');

        Http::delete(
            $url . '/aprendice/' . $id
        );

        return redirect()->route('aprendice.index');
    }
}