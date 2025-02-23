@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="container mt-4">
    <!-- Encabezado con botón de regreso -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">📂 Categorías</h2>
        <a href="{{ url('/') }}" class="btn btn-secondary">🏠 Inicio</a>
    </div>

    <!-- Verifica si hay categorías -->
    @if($categories->isEmpty())
        <div class="alert alert-warning text-center">No hay categorías disponibles.</div>
    @else
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Lista de Categorías</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>📁 Nombre de Categoría</th>
                            <th>🗂 Campos CMDB</th>
                            <th>🔎 Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="align-middle"><strong>{{ $category['name'] }}</strong></td>
                                <td>
                                    <ul class="mb-0 pl-3">
                                        @foreach($category['cmdb_fields'] as $field)
                                            <li>✔️ {{ $field }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('cmdb.show', $category['id']) }}" class="btn btn-outline-primary">
                                        📁 Ver Registros
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    {{ $categories->links() }}
                </ul>
            </nav>
        </div>
    @endif
</div>
@endsection