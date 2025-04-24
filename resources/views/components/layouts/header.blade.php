<header class="hidden md:flex h-20v bg-rojoClaro flex flex-row justify-between px-3 py-1 items-center">
    <img class="w-28 md:w-36 lg:w-44 max-h-[90%] h-auto" src="{{ asset('images/logo.png') }}" alt="{{__('logo')}}">
    <h1 class = "hidden md:block text-white text-5xl" >{{__("PKM TOURNAMENT")}}</h1>
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