<x-layouts.layout>
    <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-start space-y-4">
        <h1 class="text-7xl font-bold">REGULACIÓN ACTUAL</h1>
        <a href="https://victoryroad.pro/sv-rules-regulations/#elementor-toc__heading-anchor-3">
            <img src="{{ asset('images/regulacion.png') }}"/>
        </a>
        <!-- <ul>
            <li>Solo pokemons de paldea</li>
            <li>Combates dobles</li>
            <li>Reglas oficiales (no repetir pokemons ni objetos)</li>
            <li>Las rondas duran un máximo de x</li>
        </ul> -->
        <h1 class="text-7xl font-bold">EQUIPOS</h1>
        <div class="w-175v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
            @if($equipos->isEmpty())
                <span>No tienes equipos creados aún.</span>
            @else
                @foreach($equipos as $equipo)
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-bold mb-2">Equipo #{{ $loop->iteration }}</h2>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach([$equipo->pokemon1, $equipo->pokemon2, $equipo->pokemon3, $equipo->pokemon4, $equipo->pokemon5, $equipo->pokemon6] as $pokemon)
                                <div class="bg-white p-2 rounded shadow text-center">
                                    <img src="{{ $pokemon->sprite }}" alt="{{ $pokemon->nombre }}" class="mx-auto w-20 h-20">
                                    <p class="font-semibold">{{ $pokemon->nombre }}</p>
                                    <p>Objeto: {{ $pokemon->objeto }}</p>
                                    <p>Teracristalización: {{ $pokemon->terastallization }}</p>
                                    <ul class="text-sm mt-1">
                                        <li>{{ $pokemon->movimiento1 }}</li>
                                        <li>{{ $pokemon->movimiento2 }}</li>
                                        <li>{{ $pokemon->movimiento3 }}</li>
                                        <li>{{ $pokemon->movimiento4 }}</li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

            <a class="w-fit bg-white text-black font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition duration-200" href="{{ route('equipos.create') }}">Crear equipo</a>
        </div>
    </div>
</x-layouts.layout>
