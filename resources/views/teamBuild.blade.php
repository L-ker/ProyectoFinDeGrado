<x-layouts.layout>
    <!-- @php
        var_dump($itemList)
    @endphp -->
    <!-- @foreach ($pokemonList as $pokemon)
        <div class="pokemon-card">
            <img src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}" />
            <p>{{ $pokemon['name'] }}</p>
        </div>
    @endforeach     -->
    <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-start space-y-4">
        <h1 class="text-7xl font-bold">REGULACIÓN ACTUAL</h1>
        <a href="https://victoryroad.pro/sv-rules-regulations/#elementor-toc__heading-anchor-3">
        <img src="{{ asset('images/regulacion.png') }}"/>
        </a>
    <p>Primer párrafo</p>
    <p>Segundo párrafo</p>
    <p>Contenido largo...</p>
    <p>Más contenido</p>
    <p>Más contenido</p>
    <p>Más contenido</p>
    <p>Más contenido</p>
    <p>Más contenido</p>
    <p>Más contenido</p> <p>Primer párrafo</p>
    <p>Segundo párrafo</p>
        <h1 class="text-7xl font-bold">EQUIPOS</h1>
        <div class="w-175v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
        <a class="w-fit bg-white text-black font-semibold py-2 px-4 rounded-lg shadow hover:bg-blue-700 transition duration-200" href="">Crear equipo</a>
        <div equipo="test">
            <p>Más contenido</p>
        </div>
        <p>Más contenido</p>
        <p>Más contenido</p>
        <p>Más contenido</p>
        <p>Más contenido</p>
        <p>Más contenido</p>
        <p>Más contenido</p>
        <p>Más contenido</p>
        <p>Más contenido</p>
        <p>Más contenido</p>
        <p>Más contenido</p>
        </div>
    </div>
</x-layouts.layout>