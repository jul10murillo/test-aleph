@extends('layouts.app')

@section('title', 'Registros de la CMDB')

@section('content')
<div class="container mt-4">
    <!-- Encabezado con botón de regreso -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Registros de la CMDB</h2>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">← Volver a Categorías</a>
    </div>

    @if($records->isEmpty())
        <div class="alert alert-warning">No hay registros para esta categoría.</div>
    @else
        <div class="card">
            <div class="card-header bg-dark text-white">
                Lista de Registros
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Identificador</th>
                            <th>Nombre</th>
                            <th>Fecha de Creación</th>
                            <th>Activo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr>
                                <td>{{ $record['identificador'] }}</td>
                                <td>{{ $record['nombre'] }}</td>
                                <td>{{ $record['extra_data']['fecha_creacion'] ?? 'No disponible' }}</td>
                                <td>{{ $record['extra_data']['activado'] == 1 ? 'Sí' : 'No' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botón de Exportar -->
        <div class="mt-3">
            <a href="{{ route('cmdb.export', ['categoryId' => $categoryId, 'categoryName' => urlencode($categoryName)]) }}" 
               class="btn btn-primary">
                📤 Exportar Registros
            </a>
        </div>
    @endif

    <hr>

    <!-- Sección de Importación y Descarga de Plantilla -->
    <div class="row mt-4">
        <!-- Descargar Plantilla -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Descargar Plantilla de Importación
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('cmdb.template.download') }}" class="btn btn-info">📥 Descargar Plantilla</a>
                </div>
            </div>
        </div>

        <!-- Importar Registros -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Importar Registros
                </div>
                <div class="card-body">
                    <form action="{{ route('cmdb.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="categoria_id" value="{{ $categoryId }}"> <!-- Pasar el categoria_id -->
                        <input type="file" name="file" class="form-control mb-2" required>
                        <button type="submit" class="btn btn-success w-100">📂 Importar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection