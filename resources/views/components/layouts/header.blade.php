<!-- HEADER DE MOVIL -->
<header class="md:hidden h-auto h-20v bg-indigoDye flex flex-col justify-center items-center py-2 space-y-1">
    <div class="flex justify-between items-center w-full px-4">
        <!-- SI HACES CLICK FUERA SE CIERRA -->
        <button id="hamburger-menu" class="text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <h1 class="text-white text-3xl">{{__("GESTION USUARIOS")}}</h1>

        <div>
            @auth
                <span class="text-white">{{ __("Usuario") }}: {{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input class="btn btn-glass" type="submit" value="{{ __('Logout') }}">
                </form>
            @endauth
            @guest
                <a class="btn btn-glass" href="{{ route('login') }}">{{ __("Login") }}</a>
                <a class="btn btn-glass" href="{{ route('register') }}">{{ __("Register") }}</a>
            @endguest
        </div>
    </div>

    <nav id="mobile-menu" class="hidden space-y-2 mt-4 w-full text-center bg-indigoDye text-white z-50 absolute top-0 left-0 right-0 p-4">
        @guest
            <div class="min-h-[10vh] bg-argentinianBlue flex flex-col px-3 justify-center text-white">
                <span>{{ __("Inicia sesión para acceder a las tablas de la base de datos") }}</span>
            </div>
        @endguest
        @auth
            <nav class="min-h-[10vh] bg-argentinianBlue flex flex-col px-3 justify-center space-y-4">
                <a class="btn btn-sm btn-info w-full" href="{{ route('usuarios.index') }}">{{ __("Mostrar usuarios") }}</a>
                <a class="btn btn-sm btn-primary w-full" href="{{ route('usuarios.create') }}">{{ __("Crear usuario") }}</a>
                <a class="btn btn-sm btn-primary w-full" href="{{ route('home') }}">{{ __("Inicio") }}</a>
                <a class="btn btn-sm btn-primary w-full" href="{{ route('puntuaciones.create') }}">{{ __("Crear puntuacion") }}</a>
                <a class="btn btn-sm btn-info w-full" href="{{ route('puntuaciones.index') }}">{{ __("Mostrar puntuaciones") }}</a>
            </nav>
        @endauth
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    const hamburgerButton = document.getElementById('hamburger-menu');
    const mobileMenu = document.getElementById('mobile-menu');


    hamburgerButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden'); 
    });


    document.addEventListener('click', (e) => {
        if (!mobileMenu.contains(e.target) && !hamburgerButton.contains(e.target)) {
            mobileMenu.classList.add('hidden'); 
        }
    });
</script>
 
 <!-- HEADER DE DESKTOP -->
 <header class="hidden md:flex h-15v bg-indigoDye flex flex-row justify-between px-3 py-1 items-center">
 <img class="w-28 md:w-36 lg:w-44 max-h-[90%] h-auto" src="{{ asset('images/logo.png') }}" alt="{{__('logo')}}">
    <h1 class = "hidden md:block text-white text-5xl" >{{__("GESTION USUARIOS")}}</h1>
    <div>
        @auth
            <span class="text-white">{{  __("Usuario")}}: {{ auth()->user()->name }}
            </span>
            <form action="{{route("logout")}}" method="POST">
                @csrf
                <input class="btn  btn-glass" type="submit" value="{{__('Logout')}}">
            </form>
        @endauth
        @guest
                <a class="btn  btn-glass" href="{{route("login")}}">{{__("Login")}}</a>
                <a class="btn  btn-glass" href="{{route("register")}}">{{__("Register")}}</a>
        @endguest

    </div>

 </header>