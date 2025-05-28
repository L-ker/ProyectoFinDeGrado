<footer class="h-10v footer bg-black text-white items-center p-4 flex justify-between">
    Proyecto sin ánimo de lucro desarrollado con fines educativos.<br>
    Elementos inspirados en la franquicia Pokémon © Nintendo / Game Freak / The Pokémon Company.

    @if(auth()->check() && (auth()->user()->es_organizador || auth()->user()->es_administrador))
        <a href="{{ route('users.index' )}}"><button class="bg-rojoClaro text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">Ver usuarios</button></a>
    @endif
</footer>
