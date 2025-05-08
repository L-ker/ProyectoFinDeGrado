<header class="hidden md:flex h-15v bg-rojoClaro flex flex-row justify-between px-3 py-1 items-center">
    <img class="w-28 md:w-36 lg:w-44 max-h-[90%] h-auto" src="{{ asset('images/logo.png') }}" alt="{{__('logo')}}">
    <div>
        @auth
            <div class="flex items-center gap-4">
                <span class="bg-white text-black font-semibold py-2 px-4 rounded-lg shadow">
                    {{ __("Usuario") }}: {{ auth()->user()->name }}
                </span>
    
                <form action="{{ route('logout') }}" method="POST">
                        @csrf
                    <input class="bg-white text-black font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition duration-200" type="submit" value="{{ __('Logout') }}">
                </form>
            </div>
        @endauth
        @guest
                <a class="bg-white text-black font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition duration-200" href="{{route("login")}}">Login</a>
                <a class="bg-white text-black font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition duration-200" href="{{route("register")}}">Register</a>
        @endguest
    </div>
</header>