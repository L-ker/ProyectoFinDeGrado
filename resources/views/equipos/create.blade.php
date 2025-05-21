<x-layouts.layout>
    <form method="POST" action="{{route('equipos.store')}}">
        @csrf
        <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md scrollbar-hide flex flex-col items-center justify-start space-y-4">
            @for ($i = 1; $i <= 6; $i++)
                <h1 class="text-7xl text-white font-bold">Pokémon #{{ $i }}</h1>
                <div class="w-175v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
                    
                    <!-- Select Pokémon -->
                    <label for="pokemon_{{ $i }}">Pokémon:</label>
                    <select name="pokemon_{{ $i }}[name]" id="pokemon_{{ $i }}" class="pokemon-select w-full mb-2" data-index="{{ $i }}">
                        <option value="">-- Selecciona un Pokémon --</option>
                        @foreach ($pokemonList as $pokemon)
                            <option value="{{ $pokemon['name'] }}" data-sprite="{{ $pokemon['sprite'] }}">{{ $pokemon['name'] }}</option>
                        @endforeach
                    </select>

                    <!-- Sprite oculto -->
                    <input type="hidden" name="pokemon_{{ $i }}[sprite]" id="sprite_{{ $i }}">

                    <!-- Select movimientos -->
                    <label for="moves_{{ $i }}">Movimientos:</label>
                    <select name="pokemon_{{ $i }}[moves][]" id="moves_{{ $i }}" class="moves-select w-full mb-2" multiple="multiple">
                        <!-- Opciones cargadas por JS -->
                    </select>

                    <!-- Select objeto -->
                    <label for="item_{{ $i }}">Objeto:</label>
                    <select name="pokemon_{{ $i }}[item]" id="item_{{ $i }}" class="item-select w-full mb-2">
                        <option value="">-- Selecciona un objeto --</option>
                        @foreach ($itemList as $item)
                            <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>

                </div>
            @endfor
        </div>
    </form>

    <!-- Estilos y scripts de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            function matchStart(params, data) {
                if ($.trim(params.term) === '') return data;
                if (data.text.toLowerCase().startsWith(params.term.toLowerCase())) return data;
                return null;
            }

            $('.pokemon-select, .item-select').select2({
                matcher: matchStart,
                placeholder: "-- Selecciona una opción --",
                allowClear: true,
                width: '100%'
            });

            $('.moves-select').select2({
                matcher: matchStart,
                placeholder: "Selecciona movimientos",
                width: '100%'
            });

            // Cuando cambie el Pokémon
            $('.pokemon-select').on('change', function () {
                let index = $(this).data('index');
                let pokemonName = $(this).val();
                let selectedOption = $(this).find('option:selected');
                let sprite = selectedOption.data('sprite');

                // Setear el valor del input oculto del sprite
                $('#sprite_' + index).val(sprite);

                let $movesSelect = $('#moves_' + index);
                $movesSelect.empty();

                if (!pokemonName) {
                    $movesSelect.trigger('change');
                    return;
                }

                let pokemonList = @json($pokemonList);
                let pokemon = pokemonList.find(p => p.name === pokemonName);

                if (pokemon && pokemon.moves) {
                    pokemon.moves.forEach(move => {
                        let newOption = new Option(move, move, false, false);
                        $movesSelect.append(newOption);
                    });
                }

                $movesSelect.trigger('change');
            });
        });
    </script>
</x-layouts.layout>

<!-- <x-layouts.layout>
    <form method="POST" action="{{route('equipos.store')}}">
        @csrf
        <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md scrollbar-hide flex flex-col items-center justify-start space-y-4">
            @for ($i = 1; $i <= 6; $i++)
                <h1 class="text-7xl text-white font-bold">Pokémon #{{ $i }}</h1>
                <div class="w-175v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
                    <!-- Select Pokémon -->
                    <label for="pokemon_{{ $i }}">Pokémon:</label>
                    <select name="pokemon_{{ $i }}[name]" id="pokemon_{{ $i }}" class="pokemon-select w-full mb-2" data-index="{{ $i }}">
                        <option value="">-- Selecciona un Pokémon --</option>
                        @foreach ($pokemonList as $pokemon)
                            <option value="{{ $pokemon['name'] }}">{{ $pokemon['name'] }}</option>
                        @endforeach
                    </select>

                    <!-- Select movimientos (vacío al cargar, se llenará dinámicamente) -->
                    <label for="moves_{{ $i }}">Movimientos:</label>
                    <select name="pokemon_{{ $i }}[moves][]" id="moves_{{ $i }}" class="moves-select w-full mb-2" multiple="multiple">
                        <!-- Opciones de movimientos cargadas vía JS -->
                    </select>

                    <!-- Select objeto -->
                    <label for="item_{{ $i }}">Objeto:</label>
                    <select name="pokemon_{{ $i }}[item]" id="item_{{ $i }}" class="item-select w-full mb-2">
                        <option value="">-- Selecciona un objeto --</option>
                        @foreach ($itemList as $item)
                            <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                        @endforeach
                    </select>

                </div>

            @endfor
        </div>
</form>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        function matchStart(params, data) {
            if ($.trim(params.term) === '') {
                return data;
            }
            if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) === 0) {
                return data;
            }
            return null;
        }

        // Inicializar selects Pokémon e ítems con Select2
        $('.pokemon-select, .item-select').select2({
            matcher: matchStart,
            placeholder: "-- Selecciona una opción --",
            allowClear: true,
            width: '100%'
        });

        // Inicializar selects de movimientos (vacíos por ahora)
        $('.moves-select').select2({
            matcher: matchStart,
            placeholder: "Selecciona movimientos",
            width: '100%'
        });

        // Cuando cambie el Pokémon, actualizar sus movimientos en el select correspondiente
        $('.pokemon-select').on('change', function() {
            let index = $(this).data('index');
            let pokemonName = $(this).val();

            let $movesSelect = $('#moves_' + index);
            $movesSelect.empty(); // Limpiar movimientos previos

            if (!pokemonName) {
                $movesSelect.trigger('change'); // refrescar select2
                return;
            }

            // Buscar el Pokémon en pokemonList para obtener movimientos
            let pokemon = @json($pokemonList).find(p => p.name === pokemonName);

            if (pokemon && pokemon.moves) {
                // Añadir movimientos como opciones
                pokemon.moves.forEach(move => {
                    let newOption = new Option(move, move, false, false);
                    $movesSelect.append(newOption);
                });
            }

            $movesSelect.trigger('change'); // refrescar select2
        });
    });
</script>

</x-layouts.layout> -->