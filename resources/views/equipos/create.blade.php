<x-layouts.layout>
        <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden; /* Importante: evita scroll innecesario global */
        }
    </style>
    <form method="POST" action="{{ route('equipos.store') }}">
        @csrf
        <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-start space-y-4">
            @for ($i = 1; $i <= 6; $i++)
                <h1 class="text-4xl text-white font-bold">Pokémon #{{ $i }}</h1>
                <div class="w-full max-w-4xl rounded-xl bg-white p-4 shadow-md text-black flex flex-col space-y-4">

                    <!-- Select Pokémon -->
                    <label for="pokemon_{{ $i }}">Pokémon:</label>
                    <select name="pokemon_{{ $i }}[name]" id="pokemon_{{ $i }}" class="pokemon-select w-full mb-2"
                        data-index="{{ $i }}">
                        <option value="">-- Selecciona un Pokémon --</option>
                        @foreach ($pokemonList as $pokemon)
                            <option value="{{ $pokemon['name'] }}" data-sprite="{{ $pokemon['sprite'] }}">{{ $pokemon['name'] }}
                            </option>
                        @endforeach
                    </select>

                    <label for="terastallizations">teracristalizacion:</label>
                    <select id="terastallizations" name="terastallizations" class="block mt-1 w-full rounded border-gray-300">
                    @foreach (config('terastallizations') as $terastallization)
                            <option value="{{ $terastallization }}" {{ $loop->first ? 'selected' : '' }}>
                            {{ $terastallization }}
                        </option>
                    @endforeach
                    </select>

                    <!-- Sprite oculto -->
                    <input type="hidden" name="pokemon_{{ $i }}[sprite]" id="sprite_{{ $i }}">

                    <!-- Select movimientos -->
                    <label for="moves_{{ $i }}">Movimientos:</label>
                    <select name="pokemon_{{ $i }}[moves][]" id="moves_{{ $i }}" class="moves-select w-full mb-2"
                        multiple="multiple">
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

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                Guardar equipo
            </button>
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
                width: '100%',
                maximumSelectionLength: 4
            });

            $('.pokemon-select').on('change', function () {
                let index = $(this).data('index');
                let pokemonName = $(this).val();
                let selectedOption = $(this).find('option:selected');
                let sprite = selectedOption.data('sprite');

                $('#sprite_' + index).val(sprite);

                let $movesSelect = $('#moves_' + index);
                $movesSelect.empty();

                if (!pokemonName) {
                    $movesSelect.trigger('change');
                    return;
                }

                $.get(`https://pokeapi.co/api/v2/pokemon/${pokemonName.toLowerCase()}`, function (data) {
                    let moves = data.moves.map(m => m.move.name);
                    moves.sort();

                    moves.forEach(move => {
                        let option = new Option(move, move, false, false);
                        $movesSelect.append(option);
                    });

                    $movesSelect.trigger('change');
                });
            });
        });
    </script>
</x-layouts.layout>