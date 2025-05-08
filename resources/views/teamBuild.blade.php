@foreach ($pokemonList as $pokemon)
    <div class="pokemon-card">
        <img src="{{ $pokemon['sprite'] }}" alt="{{ $pokemon['name'] }}" />
        <p>{{ $pokemon['name'] }}</p>
    </div>
@endforeach