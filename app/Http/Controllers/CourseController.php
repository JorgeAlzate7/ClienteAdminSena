<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);

        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');

        $courses = $this->fetchDataFromApi(
            $url . '/course/list'
        );

        return view(
            'course.index',
            compact('courses')
        );
    }
}