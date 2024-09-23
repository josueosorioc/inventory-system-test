@extends('main')

@section('title', $articulo->nombre)

@section('content')
    <div class="container mt-5">
        <div class="row ">
            <div class="col-md-12 text-end">
                <a href="{{ route('list.articles') }}" class="btn btn-sm btn-secondary">Volver</a>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-12">
                <h3 class="mb-3">Artículo {{ $articulo->nombre }}</h3>

                <p><strong>Cantidad:</strong> {{ $articulo->cantidad }}</p>
                <p><strong>Precio:</strong> ${{ $articulo->precio }}</p>

                <p><strong>Registrado por:</strong> {{ $articulo->user->name }}</p>

                <p><strong>Descripción:</strong></p>
                <p>
                    {!! $articulo->descripcion !!}
                </p>

                <p><strong>Fecha de creación:</strong> {{ $articulo->created_at->format('d/m/Y H:m') }}</p>
            </div>
        </div>
    </div>
@endsection
