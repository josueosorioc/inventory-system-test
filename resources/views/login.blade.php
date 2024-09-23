@extends('main')

@section('title', 'Inicio de sesión')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('validate.login') }}" class="card py-5 px-3 shadow" method="POST">
                    @csrf
                    <h1 class="fs-4 text-center mb-4">Inicio de sesión</h1>
                    {{-- message --}}
                    @include('partials.message')
                    {{-- --}}
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" placeholder="" required>
                        <label>Correo electrónico</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" name="password" placeholder="" required>
                        <label>Contraseña</label>
                    </div>
                    <button type="submit" class="btn btn-primary">ACCEDER</button>
                </form>
            </div>
        </div>
    </div>
@endsection
