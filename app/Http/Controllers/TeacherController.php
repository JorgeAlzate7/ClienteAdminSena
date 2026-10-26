<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private function fetchDataFromApi($url)
{
    $response = Http::get($url);

    return $response->json() ?? [];
}

    public function index()
    {
        $url = env('URL_SERVER_API');

        $teachers = $this->fetchDataFromApi(
            $url . '/teacher/list'
        );

        return view('teacher.index', compact('teachers'));
    }

    public function create()
    {
        $url = env('URL_SERVER_API');

        $areas = $this->fetchDataFromApi(
            $url . '/area/list'
        );

        $training_centers = $this->fetchDataFromApi(
            $url . '/training_center/list'
        );

        return view('teacher.create', compact('areas', 'training_centers'));
    }

    public function store(Request $request)
    {
        $url = env('URL_SERVER_API');

        Http::post(
            $url . '/teacher/store',
            $request->except('_token')
        );

        return redirect()->route('teacher.index');
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');

        $teacher = $this->fetchDataFromApi(
            $url . '/teacher/show/' . $id
        );

        return view('teacher.show', compact('teacher'));
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');

        $teacher = $this->fetchDataFromApi(
            $url . '/teacher/show/' . $id
        );

        $areas = $this->fetchDataFromApi(
            $url . '/area/list'
        );

        $training_centers = $this->fetchDataFromApi(
            $url . '/training_center/list'
        );

        return view('teacher.edit', compact('teacher', 'areas', 'training_centers'));
    }

    public function update(Request $request, $id)
    {
        $url = env('URL_SERVER_API');

        Http::put(
            $url . '/teacher/' . $id,
            $request->except(['_token', '_method'])
        );

        return redirect()->route('teacher.index');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');

        Http::delete(
            $url . '/teacher/' . $id
        );

        return redirect()->route('teacher.index');
    }
}