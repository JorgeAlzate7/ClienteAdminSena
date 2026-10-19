<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TrainingCenterController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    // GET: Listar centros (Apunta a /training_center/list)
    public function index()
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        $data = $this->fetchDataFromApi($url . '/training_center/list');

        $trainingCenters = collect($data ?? [])->map(function ($item) {
            return (object) $item;
        });

        return view('training_center.index', compact('trainingCenters'));
    }

    // GET: Formulario para crear
    public function create()
    {
        return view('training_center.create');
    }

    // POST: Guardar centro (Apunta a /training_center/store)
    public function store(Request $request)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        Http::post($url . '/training_center/store', $request->all());

        return redirect()->route('training_center.index');
    }

    // GET: Mostrar centro (Apunta a /training_center/show/{id})
    public function show($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        $data = $this->fetchDataFromApi($url . '/training_center/show/' . $id);

        if (!$data) {
            return redirect()->route('training_center.index');
        }

        $trainingCenter = (object) $data;
        return view('training_center.show', compact('trainingCenter'));
    }

    // GET: Formulario para editar
    public function edit($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        $data = $this->fetchDataFromApi($url . '/training_center/show/' . $id);

        if (!$data) {
            return redirect()->route('training_center.index');
        }

        $trainingCenter = (object) $data;
        return view('training_center.edit', compact('trainingCenter'));
    }

    // PUT: Actualizar centro (Apunta a /training_center/{id})
    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        Http::put($url . '/training_center/' . $id, $request->all());

        return redirect()->route('training_center.index');
    }

    // DELETE: Eliminar centro (Apunta a /training_center/{id})
    public function destroy($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        Http::delete($url . '/training_center/' . $id);

        return redirect()->route('training_center.index');
    }
}