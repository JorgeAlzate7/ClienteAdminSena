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
                    Editar <strong>computador.</strong>
                </h1>

                <p>
                    Actualiza la información del computador en el sistema.
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
            action="{{ route('computer.update', $computer['id']) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')

            <div class="computer-form-group">

                <label for="number">
                    Número del computador
                </label>

                <input
                    type="number"
                    name="number"
                    id="number"
                    placeholder="Ejemplo: 001"
                    value="{{ old('number', $computer['number'] ?? '') }}"
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
                    value="{{ old('brand', $computer['brand'] ?? '') }}"
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

                @if (!empty($computer['imagen_url']))
                    <div style="margin-bottom: 10px;">
                        <span style="font-size: 0.85rem; color: #666; display: block; margin-bottom: 5px;">Imagen actual:</span>
                        <img 
                            src="{{ $computer['imagen_url'] }}" 
                            alt="Imagen actual" 
                            style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    name="imagen"
                    id="imagen"
                    accept="image/*"
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
                    <i class="bi bi-pencil"></i>
                    Actualizar computador
                </button>

            </div>

        </form>

    </div>

</div>

@endsection