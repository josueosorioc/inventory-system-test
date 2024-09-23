<nav class="navbar navbar-expand-lg bg-secondary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Inventario</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            @guest
                <div class="navbar-nav">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('login') }}">Inicio de
                        sesión</a>
                    <a class="nav-link {{ Request::is('/registro') ? 'active' : '' }}"
                        href="{{ route('register') }}">Registro</a>
                </div>
            @endguest
            @auth
                <div class="navbar-nav">
                    <a class="nav-link" href="#">Artículos</a>
                    <a class="nav-link" href="#">Registrar artículo</a>
                    <a class="nav-link" href="{{ route('logout') }}">Cerrar sesión</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
