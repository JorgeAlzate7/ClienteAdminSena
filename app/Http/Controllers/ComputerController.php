<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Computer;
use Illuminate\Support\Facades\Http;


class ComputerController extends Controller
{
    

    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();

    }

     public function index()   
    {

        $url = env('URL_SERVER_API');

        $computers = $this->fetchDataFromApi($url . '/computer');

        return view('computer.index', compact('computers'));
    }

    public function show($id)
    {

        $url = env('URL_SERVER_API');

        $computers = $this->fetchDataFromApi($url . '/computer/' . $id);

        return view('computer.show', compact('computers'));
    }

}
