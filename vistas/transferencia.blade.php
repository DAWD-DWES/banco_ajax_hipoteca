@extends('app')

@section('contenido')
<form method="post" action="index.php" novalidate>
    <div class="container">
        {{-- Fila con dos columnas: Cliente Origen y Cliente Destino --}}
        <div class="row">
            {{-- Cliente Origen --}}
            <div class="col-md-6">
                <h5>Cliente Origen</h5>
                <div class="form-group mt-4">
                    <label for="dniclienteorigen" class="form-label fw-semibold">DNI Cliente Origen:</label>
                    <input type="text" class="form-control" id="dniclienteorigen" name="dniclienteorigen" 
                           value="{{ ($dniClienteOrigen ?? '') }}" required
                           pattern="^[0-9]{8}[A-Za-z]$"
                           placeholder="Debe tener 8 números seguidos de una letra (ej: 12345678Z)">
                    <small id="dniclienteorigenError" class="text-danger"></small>
                </div>
                <div class="form-group mt-4">
                    <label for="idcuentaorigen" class="form-label fw-semibold">Cuenta Cliente Origen:</label>
                    <select class="form-control" id="idcuentaorigen" name="idcuentaorigen" required>
                        <option value="">Seleccione una cuenta</option>
                    </select>
                    <small id="idcuentaorigenError" class="text-danger"></small>
                </div>
            </div>

            {{-- Cliente Destino --}}
            <div class="col-md-6">
                <h5>Cliente Destino</h5>
                <div class="form-group mt-4">
                    <label for="dniclientedestino" class="form-label fw-semibold">DNI Cliente Destino:</label>
                    <input type="text" class="form-control" id="dniclientedestino" name="dniclientedestino" 
                           value="{{ ($dniClienteDestino ?? '') }}" required
                           pattern="^[0-9]{8}[A-Za-z]$"
                           placeholder="Debe tener 8 números seguidos de una letra (ej: 12345678Z)">
                    <small id="dniclientedestinoError" class="text-danger"></small>
                </div>
                <div class="form-group mt-4">
                    <label for="idcuentadestino" class="form-label fw-semibold">Cuenta Cliente Destino:</label>
                    <select class="form-control" id="idcuentadestino" name="idcuentadestino" required>
                        <option value="">Seleccione una cuenta</option>
                    </select>
                    <small id="idcuentadestinoError" class="text-danger"></small>
                </div>
            </div>
        </div>

        {{-- Segunda fila con Cantidad y Asunto --}}
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cantidad" class="form-label fw-semibold">Cantidad (€):</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" 
                           value="{{ ($cantidad ?? '') }}" required
                           placeholder="Introduce una cantidad (ej: 100.50)">
                    <small id="cantidadError" class="text-danger"></small>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="asunto" class="form-label fw-semibold">Asunto:</label>
                    <input type="text" class="form-control" id="asunto" name="asunto" 
                           value="{{ ($asunto ?? '') }}" required
                           pattern="^[a-zA-Z0-9ÁÉÍÓÚáéíóúñÑ\s.,:;\(\)\-]{1,140}$"
                           placeholder="El mensaje solo puede contener letras, números y espacios. Máximo 140 cars.">
                    <small id="asuntoError" class="text-danger"></small>
                </div>
            </div>
        </div>

        {{-- Botón --}}
        <div class="text-center">
            <button type="submit" class="btn btn-primary m-5" name="transferencia">Realizar Transferencia</button>
            <div id="resultadoTransferencia" class="mt-3"></div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script src="@asset('assets/js/validar.js')"></script>
<script src="@asset('assets/js/cargarcuentas.js')"></script>

@endpush
