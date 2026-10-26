<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TrainingCenterController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }

    public function create()
    {
        return view('training_center.create');
    }

    public function index()
    {
        $url = env('URL_SERVER_API');

        $training_centers = $this->fetchDataFromApi(
            $url . '/training_center/list'
        );

        return view(
            'training_center.index',
            compact('training_centers')
        );
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');

        Http::post($url . '/training_center/store', $request->all());

        return redirect()->route('training_center.index');
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');

        $training_center = $this->fetchDataFromApi(
            $url . '/training_center/show/' . $id
        );

        return view('training_center.show', compact('training_center'));
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');

        $training_center = $this->fetchDataFromApi(
            $url . '/training_center/show/' . $id
        );

        return view('training_center.edit', compact('training_center'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        Http::put($url . '/training_center/' . $id, $request->all());

        return redirect()->route('training_center.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');

        Http::delete($url . '/training_center/' . $id);

        return redirect()->route('training_center.index');
    }
}