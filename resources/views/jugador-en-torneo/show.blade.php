<x-layouts.layout>
    <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-start space-y-4">
        <div class="w-175v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
            @if($torneo->ganador) 
                <h2 class="text-2xl font-bold mb-4 text-center">¡Torneo Finalizado!</h2>
    <p class="text-center text-lg">
        El ganador del torneo es: <strong>{{ $torneo->ganador->name ?? 'Usuario eliminado' }}</strong>
    </p>
            @else
                @if (auth()->id() === $torneo->organizador)
                    {{-- Vista para el organizador --}}
                    <h2 class="text-xl font-bold">Panel del organizador</h2>

                    {{-- Aquí puedes poner botones o acciones especiales como editar resultados, avanzar rondas, etc. --}}
                    <p>Desde aquí puedes gestionar el torneo y ver los enfrentamientos.</p>
                @else
                    {{-- Vista para jugadores --}}
                    <p class="text-sm">Ronda actual del torneo: <strong>{{ $torneo->ronda_actual }}</strong></p>

                    @php
                        $moduloActual = $modulos
                            ->where('ronda', $torneo->ronda_actual)
                            ->first(function ($modulo) {
                                return $modulo->user1_id === auth()->id() || $modulo->user2_id === auth()->id();
                            });
                    @endphp

                    @if ($moduloActual)
                        @php
                            $usuarioActualId = auth()->id();

                            // Detectar contrincante
                            if ($moduloActual->user1_id == $usuarioActualId) {
                                $contrincante = $moduloActual->usuario2;
                            } elseif ($moduloActual->user2_id == $usuarioActualId) {
                                $contrincante = $moduloActual->usuario1;
                            } else {
                                $contrincante = null; // No participa en este módulo
                            }

                            // Obtener equipo del contrincante si existe
                            $equipoContrincante = null;
                            if ($contrincante) {
                                $jugadorEnTorneoContrincante = \App\Models\JugadorEnTorneo::where('torneo_id', $torneo->id)
                                ->where('user_id', $contrincante->id)
                                ->with([
                                    'equipo.equipo.pokemon1',
                                    'equipo.equipo.pokemon2',
                                    'equipo.equipo.pokemon3',
                                    'equipo.equipo.pokemon4',
                                    'equipo.equipo.pokemon5',
                                    'equipo.equipo.pokemon6',
                                ])
                                ->first();


                                if ($jugadorEnTorneoContrincante && $jugadorEnTorneoContrincante->equipo) {
                                    $equipoContrincante = $jugadorEnTorneoContrincante->equipo->equipo;
                                }
                            }
                        @endphp

                        <div class="mt-2 p-4 bg-gray-100 rounded shadow">
                            <p><strong>Tu enfrentamiento:</strong></p>
                            @if ($contrincante)
                                <p>Tu contrincante es: {{ $contrincante->name }}</p>
                            @else
                                <p>Tu contrincante es: BYE</p>
                            @endif
                        </div>

                        @if ($equipoContrincante)
                            <div class="bg-gray-100 p-4 rounded-lg shadow mt-4">
                                <h2 class="text-xl font-bold mb-2">Equipo de {{ $contrincante->name }}</h2>
                                <div class="grid grid-cols-3 gap-4">
                                    @foreach([$equipoContrincante->pokemon1, $equipoContrincante->pokemon2, $equipoContrincante->pokemon3, $equipoContrincante->pokemon4, $equipoContrincante->pokemon5, $equipoContrincante->pokemon6] as $pokemon)
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
                        @elseif ($contrincante)
                            <p class="mt-2 italic text-gray-600">Este jugador no tiene equipo asignado.</p>
                        @endif

                        @if(session('success'))
                            <script>
                                alert("{{ session('success') }}");
                            </script>
                        @endif
                        @if(session('error'))
                            <script>
                                alert("{{ session('error') }}");
                            </script>
                        @endif

                        <p>Enlace de combate actual: 
                            @if ($moduloActual->enlace_definitivo)
                                <a href="{{ $moduloActual->enlace_definitivo }}" target="_blank" class="text-blue-600 underline">Ir al combate</a>
                            @else
                                No hay enlace aún.

                                <form action="{{ route('modulos.updateLink', $moduloActual) }}" method="POST" class="mt-2">
                                    @csrf
                                    <label for="enlace" class="block font-semibold">Enviar/Actualizar enlace del combate:</label>
                                    <input type="url" name="enlace" id="enlace" class="border rounded px-2 py-1 w-full" placeholder="https://..." required>
                                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Guardar enlace</button>
                                </form>
                            @endif
                        </p>

                    @else
                        <p class="text-red-600 mt-2">No tienes combate en esta ronda.</p>
                    @endif

                @endif
            @endif
            </div>
        </div>
        <script>
        setInterval(() => {

            location.reload();
        }, 60000); 
        </script>
            }
</x-layouts.layout>
