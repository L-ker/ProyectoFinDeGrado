<x-layouts.layout>
    <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-start space-y-4">
        <div class="w-175v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
            @if(auth()->id() === $torneo->organizador)
                <form action="{{ route('torneos.iniciar', $torneo->id) }}" method="POST">
                @csrf
                    <button type="submit" class="btn btn-primary">Iniciar torneo</button>
                </form>
            @endif
            <div id="estado-torneo-container">
                <p id="estado-torneo">Estado actual: {{ $torneo->estado }}</p>

                @if($torneo->estado === 'inactivo')
                    <button id="btn-preparado" class="btn btn-primary">Preparado</button>
                @elseif($torneo->estado === 'activo')
                    <button id="btn-unirse" class="btn btn-success">Unirse</button>
                @endif
            </div>

            <script>
                const torneoId = {{ $torneo->id }};
                const container = document.getElementById('estado-torneo-container');

                function renderEstadoBoton(estado) {
                    container.innerHTML = `
                        <p id="estado-torneo">Estado actual: ${estado}</p>
                        ${
                            estado === 'inactivo' ? 
                            `<button id="btn-preparado" class="btn btn-primary">Preparado</button>` : 
                            estado === 'activo' ? 
                            `<button id="btn-unirse" class="btn btn-success">Unirse</button>` : ''
                        }
                    `;

                    const btnPreparado = document.getElementById('btn-preparado');
                    if (btnPreparado) {
                        btnPreparado.addEventListener('click', () => {
                            fetch(`/torneos/${torneoId}/preparado`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
    alert(data.message + (data.error ? "\nDetalles: " + data.error : ""));
})

                        });
                    }

                    const btnUnirse = document.getElementById('btn-unirse');
                    if (btnUnirse) {
                        btnUnirse.addEventListener('click', () => {
                            // Redirigir a la vista show de jugador en torneo
                            window.location.href = `/jugador-en-torneo/${torneoId}`;
                        });
                    }
                }

                // Inicializa con el estado que llega desde blade
                renderEstadoBoton("{{ $torneo->estado }}");

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
