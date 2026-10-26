@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pages/centros.css') }}">
@endsection

@section('content')

<div class="centros-page">

    <div class="centro-card">

        <div class="centro-header">

            <div>

                <span>FORMACIÓN SENA</span>

                <h1>
                    Detalle del <strong>centro.</strong>
                </h1>

            </div>

            <a
                href="{{ route('training_center.index') }}"
                class="centro-cancel"
            >
                <i class="bi bi-arrow-left"></i>
                Volver
            </a>

        </div>

        <div class="centro-detail-grid">

            <div class="centro-detail-item">

                <span>ID</span>

                <strong>
                    #{{ $training_center['id'] ?? '' }}
                </strong>

            </div>

            <div class="centro-detail-item">

                <span>NOMBRE</span>

                <strong>
                    {{ $training_center['name'] ?? '' }}
                </strong>

            </div>

            <div class="centro-detail-item">

                <span>UBICACIÓN</span>

                <strong>
                    {{ $training_center['location'] ?? '' }}
                </strong>

            </div>

        </div>

        <div class="centro-actions">

            <a
                href="{{ route('training_center.edit', $training_center['id'] ?? '') }}"
                class="centros-button"
            >
                <i class="bi bi-pencil"></i>
                Editar centro
            </a>

            <a
                href="{{ route('training_center.index') }}"
                class="centro-cancel"
            >
                Regresar a la lista
            </a>

        </div>

    </div>

</div>

@endsection