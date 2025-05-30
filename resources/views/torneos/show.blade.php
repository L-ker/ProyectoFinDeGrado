<x-layouts.layout>
    @if (session('mensaje'))
    <script>
        alert(@json(session('mensaje')));
    </script>
    @endif

    <div class="w-200v h-65v rounded-xl bg-rojoClaro p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-center space-y-4">
        <div class="w-80v h-25v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
            @if(auth()->id() === $torneo->organizador)
                <form action="{{ route('torneos.iniciar', $torneo->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Iniciar torneo</button>
                </form>
            @endif

            <div id="estado-torneo-container">
                
            </div>

            <script>
                const torneoId = {{ $torneo->id }};
                const container = document.getElementById('estado-torneo-container');

                function renderEstadoBoton(estado) {
                    container.innerHTML = `
                        <p id="estado-torneo">Estado actual: ${estado}</p>
                        ${
                            estado === 'inactivo' ? `
                                <form method="POST" action="/torneos/${torneoId}/preparado">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label for="equipo_id">Selecciona tu equipo:</label>
                                    <select name="equipo_id" id="equipo_id" required class="form-select mb-2">
                                        <option value="" disabled selected>-- Elige un equipo --</option>
                                        @foreach ($equipos as $equipo)
                                            <option value="{{ $equipo }}">{{ $equipo }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Preparado</button>
                                </form>
                            ` : estado === 'activo' ? `
                                <button id="btn-unirse" class="btn btn-success">Unirse</button>
                            ` : estado === 'cerrado' ? `
                                <p class="text-gray-600 font-semibold">El torneo está cerrado.</p>
                            ` : ''
                        }
                    `;

                    const btnUnirse = document.getElementById('btn-unirse');
                    if (btnUnirse) {
                        btnUnirse.addEventListener('click', () => {
                            window.location.href = `/jugador-en-torneo/${torneoId}`;
                        });
                    }
                }

                // Inicializa con el estado desde Blade
                renderEstadoBoton("{{ $torneo->estado }}");

                // Actualiza cada 60s
                setInterval(() => {
                    fetch(`/torneos/${torneoId}/estado`)
                        .then(res => res.json())
                        .then(data => {
                            renderEstadoBoton(data.estado);
                        });
                }, 60000);
            </script>
        </div>
    </div>
</x-layouts.layout>
