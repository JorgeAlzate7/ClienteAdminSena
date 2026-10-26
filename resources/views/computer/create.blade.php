@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pages/computadores.css') }}">
@endsection

@section('content')

<div class="computadores-page">

    <div class="computador-form-card">

        <div class="computador-form-header">

            <div>

                <span>GESTIÓN DE EQUIPOS</span>

                <h1>
                    Nuevo <strong>computador.</strong>
                </h1>

                <p>
                    Registra un nuevo computador en el sistema.
                </p>

            </div>

            <a
                href="{{ route('computer.index') }}"
                class="computer-cancel"
            >
                <i class="bi bi-arrow-left"></i>
                Volver
            </a>

        </div>


        <form
            action="{{ route('computer.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            <div class="computer-form-group">

                <label for="number">
                    Número del computador
                </label>

                <input
                    type="text"
                    name="number"
                    id="number"
                    placeholder="Ejemplo: 001"
                    value="{{ old('number') }}"
                    required
                >

                @error('number')
                    <small class="error" style="color: red;">{{ $message }}</small>
                @enderror

            </div>


            <div class="computer-form-group">

                <label for="brand">
                    Marca
                </label>

                <input
                    type="text"
                    name="brand"
                    id="brand"
                    placeholder="Ejemplo: Lenovo"
                    value="{{ old('brand') }}"
                    required
                >

                @error('brand')
                    <small class="error" style="color: red;">{{ $message }}</small>
                @enderror

            </div>


            <div class="computer-form-group">

                <label for="imagen">
                    Imagen / Foto del computador
                </label>

                <input
                    type="file"
                    name="imagen"
                    id="imagen"
                    accept="image/*"
                    required
                >

                @error('imagen')
                    <small class="error" style="color: red;">{{ $message }}</small>
                @enderror

            </div>


            <div class="computer-form-actions">

                <a
                    href="{{ route('computer.index') }}"
                    class="computer-cancel"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="computadores-button"
                >
                    <i class="bi bi-plus-circle"></i>
                    Crear computador
                </button>

            </div>

        </form>

    </div>

</div>

@endsection