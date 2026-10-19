<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    private function fetchDataFromApi($url)
    {
        try {
            $response = Http::get($url);
            return $response->json();
        } catch (\Exception $e) {
            return [];
        }
    }

    // LISTAR (index)
    public function index()
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');

        $data = $this->fetchDataFromApi($url . '/area/list');

        // Si la API devuelve null o falla, aseguramos un array vacío [] para que no falle el @foreach
        $areas = collect($data ?? [])->map(function ($item) {
            return (object) $item;
        });

        return view('area.index', compact('areas'));
    }

    // VER DETALLE (show)
    public function show($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');

        $data = $this->fetchDataFromApi($url . '/area/show/' . $id);

        if (!$data) {
            return redirect()->route('area.index');
        }

        $area = (object) $data;

        return view('area.show', compact('area'));
    }

    // FORMULARIO CREAR (create)
    public function create()
    {
        return view('area.create');
    }

    // GUARDAR (store)
    public function store(Request $request)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');

        Http::post($url . '/area/store', $request->all());

        return redirect()->route('area.index');
    }

    // FORMULARIO EDITAR (edit)
    public function edit($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');

        $data = $this->fetchDataFromApi($url . '/area/show/' . $id);

        if (!$data) {
            return redirect()->route('area.index');
        }

        $area = (object) $data;

        return view('area.edit', compact('area'));
    }

    // ACTUALIZAR (update)
    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');

        Http::put($url . '/area/' . $id, $request->all());

        return redirect()->route('area.index');
    }

    // ELIMINAR (destroy)
    public function destroy($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');

        Http::delete($url . '/area/' . $id);

        return redirect()->route('area.index');
    }
}