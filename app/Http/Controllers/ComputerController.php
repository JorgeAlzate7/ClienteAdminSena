<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    // Método privado para manejar llamadas HTTP repetitivas
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');

        $computers = $this->fetchDataFromApi($url . '/computer/list');

        return view('computer.index', compact('computers'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');

        $computer = $this->fetchDataFromApi($url . '/computer/show/' . $id);

        return view('computer.show', compact('computer'));
    }

    public function create()
    {
        return view('computer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255',
            'brand'  => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $url = env('URL_SERVER_API');
        $file = $request->file('imagen');

        // Enviamos la imagen adjunta + number, brand y marca
        Http::attach('imagen', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post($url . '/computer/store', [
                'number' => $request->number,
                'brand'  => $request->brand,
                'marca'  => $request->brand,
            ]);

        return redirect()->route('computer.index');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');

        $computer = $this->fetchDataFromApi($url . '/computer/show/' . $id);

        return view('computer.edit', compact('computer'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        // Si el usuario subió una NUEVA imagen al editar:
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');

            Http::attach('imagen', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                ->post($url . '/computer/' . $id, [
                    '_method' => 'PUT',
                    'number'  => $request->input('number'),
                    'brand'   => $request->input('brand'),
                    'marca'   => $request->input('brand'),
                ]);
        } else {
            // Si no subió foto nueva, actualizamos solo los textos
            Http::put($url . '/computer/' . $id, [
                'number' => $request->input('number'),
                'brand'  => $request->input('brand'),
                'marca'  => $request->input('brand'),
            ]);
        }

        return redirect()->route('computer.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');

        Http::delete($url . '/computer/' . $id);

        return redirect()->route('computer.index');
    }
}