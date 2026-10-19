<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    // GET: Listar computadores (Apunta a /computer/list)
    public function index()
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        $data = $this->fetchDataFromApi($url . '/computer/list');

        // Protegemos si viene null o vacío y convertimos a Objeto para Blade ($computer->name)
        $computers = collect($data ?? [])->map(function ($item) {
            return (object) $item;
        });

        return view('computer.index', compact('computer'));
    }

    // GET: Formulario para crear
    public function create()
    {
        return view('computer.create');
    }

    // POST: Guardar computador (Apunta a /computer/store)
    public function store(Request $request)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        Http::post($url . '/computer/store', $request->all());

        return redirect()->route('computer.index');
    }

    // GET: Mostrar computador (Apunta a /computer/show/{id})
    public function show($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        $data = $this->fetchDataFromApi($url . '/computer/show/' . $id);

        if (!$data) {
            return redirect()->route('computer.index');
        }

        $computer = (object) $data;
        return view('computer.show', compact('computer'));
    }

    // GET: Formulario para editar
    public function edit($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        $data = $this->fetchDataFromApi($url . '/computer/show/' . $id);

        if (!$data) {
            return redirect()->route('computer.index');
        }

        $computer = (object) $data;
        return view('computer.edit', compact('computer'));
    }

    // PUT: Actualizar computador (Apunta a /computer/{id})
    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        Http::put($url . '/computer/' . $id, $request->all());

        return redirect()->route('computer.index');
    }

    // DELETE: Eliminar computador (Apunta a /computer/{id})
    public function destroy($id)
    {
        $url = env('URL_SERVER_API', 'http://127.0.0.1:8000/api');
        Http::delete($url . '/computer/' . $id);

        return redirect()->route('computer.index');
    }
}