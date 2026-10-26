<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TeacherController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');

        $teachers = $this->fetchDataFromApi(
            $url . '/teacher/list'
        );

        return view(
            'teacher.index',
            compact('teachers')
        );
    }
}