@guest
    <div class="hidden md:flex min-h-[10vh] bg-argentinianBlue flex-col md:flex-row px-3 justify-center text-white">
        <span>{{__("Inicia sesión para acceder a las tablas de la base de datos")}}</span>
    </div>
@endguest
@auth
<nav class="hidden md:flex min-h-[10vh] bg-argentinianBlue flex-col md:flex-row px-3 justify-center space-x-4 mb-2">
    <a class="btn btn-sm btn-info" href="{{ route('usuarios.index') }}">{{__("Mostrar usuarios")}}</a>
    <a class="btn btn-sm btn-primary" href="{{ route('usuarios.create') }}">{{__("Crear usuario")}}</a>
    <a class="btn btn-sm btn-primary" href="{{ route('home') }}">{{__("Inicio")}}</a>
    <a class="btn btn-sm btn-primary" href="{{ route('puntuaciones.create') }}">{{__("Crear puntuacion")}}</a>
    <a class="btn btn-sm btn-info" href="{{ route('puntuaciones.index') }}">{{__("Mostrar puntuaciones")}}</a>
</nav>
@endauth
