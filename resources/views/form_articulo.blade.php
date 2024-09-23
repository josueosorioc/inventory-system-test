@extends('main')

@section('title', !empty($articulo) ? 'Editar artículo' : 'Registrar artículo')

@section('content')
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3 class="mb-4">{{ !empty($articulo) ? 'Editar' : 'Registrar' }} artículo</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('list.articles') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                {{-- message --}}
                @include('partials.message')
                {{-- --}}
                <form method="POST" action="{{ route('save.article') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ !empty($articulo) ? $articulo->id : '' }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="nombre"
                                value="{{ !empty($articulo) ? $articulo->nombre : '' }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Precio:</label>
                            <input type="number" class="form-control" name="precio" step=".01"
                                value="{{ !empty($articulo) ? $articulo->precio : '' }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Cantidad:</label>
                            <input type="number" class="form-control" name="cantidad"
                                value="{{ !empty($articulo) ? $articulo->cantidad : '' }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label>Descripción:</label>
                            <textarea name="descripcion" class="form-control" rows="4">{{ !empty($articulo) ? $articulo->descripcion : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary px-5" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
