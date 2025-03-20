{{-- Usamos la vista app como plantilla --}}
@extends('app')

{{-- Sección para el mensaje de error de conexión a la base de datos --}}
@section('contenido')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card text-center shadow-lg border-danger" style="max-width: 500px;">
        <div class="card-body">
            <h2 class="text-danger">
                <i class="bi bi-exclamation-triangle-fill"></i> Error de Conexión
            </h2>
            <p class="mt-3">No se pudo conectar a la base de datos. Por favor, inténtelo de nuevo más tarde.</p>
            <p class="text-muted">Si el problema persiste, contacte con el soporte técnico.</p>
        </div>
    </div>
</div>
@endsection