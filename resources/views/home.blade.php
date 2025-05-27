@guest
<x-layouts.layout>
    <!-- Contenedor para el gif y la capa negra -->
    <div class="relative w-full h-[75vh]">
        <!-- Capa negra transparente entre la letra y el gif -->
        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

        <!-- Gif ajustado a la pantalla -->
        <img src="{{ asset('images/GifCoronacion.gif') }}" alt="Gif de coronación" class="absolute inset-0 w-full h-full object-cover" />

        <!-- Frase centrada -->
        <div class="absolute inset-0 flex items-center justify-center z-20 text-white text-4xl font-bold text-center">
            ¿Podrás convertirte en el campeón?
        </div>

        <!-- Botón de mute y volumen -->
        <div class="absolute bottom-4 right-4 z-30 group">
            <button onclick="toggleMute()" id="mute-button" class="bg-white p-2 rounded-full shadow-lg hover:bg-gray-300 focus:outline-none">
                <svg id="volume-icon" class="w-8 h-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path id="volume-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9v6l6 3V6l-6 3zM15 12c0-2.21 1.79-4 4-4s4 1.79 4 4"></path>
                </svg>
            </button>

            <!-- Barra de volumen hacia la izquierda -->
            <div id="volume-slider-container" class="hidden absolute bottom-[50px] right-[60px] w-40 bg-gray-700 p-2 rounded-lg mt-2">
                <input type="range" id="volume-slider" min="0" max="1" step="0.01" value="1" class="w-full h-2 bg-gray-300 rounded-full" />
            </div>
        </div>
    </div>

    <!-- Música de fondo -->
    <audio id="background-music" loop autoplay>
        <source src="{{ asset('audios/TrimmedIntro.mp3') }}" type="audio/mp3">
        Tu navegador no soporta el elemento de audio.
    </audio>
</x-layouts.layout>

<script>
    const audio = document.getElementById('background-music');
    const volumePath = document.getElementById('volume-path');
    const volumeSlider = document.getElementById('volume-slider');
    const volumeSliderContainer = document.getElementById('volume-slider-container');
    const muteButton = document.getElementById('mute-button');

    function toggleMute() {
        audio.muted = !audio.muted;

        // Cambiar icono
        if (audio.muted) {
            volumePath.setAttribute("d", "M6 18L18 6M6 6l12 12"); // cruz
        } else {
            volumePath.setAttribute("d", "M3 9v6l6 3V6l-6 3zM15 12c0-2.21 1.79-4 4-4s4 1.79 4 4");
        }

        // Mostrar u ocultar el control de volumen
        if (!audio.muted) {
            volumeSliderContainer.classList.remove('hidden');
        } else {
            volumeSliderContainer.classList.add('hidden');
        }
    }

    volumeSlider.addEventListener('input', function () {
        audio.volume = this.value;
    });

    muteButton.addEventListener('mouseenter', () => {
        if (!audio.muted) {
            volumeSliderContainer.classList.remove('hidden');
        }
    });

    volumeSliderContainer.addEventListener('mouseenter', () => {
        volumeSliderContainer.classList.remove('hidden');
    });

    volumeSliderContainer.addEventListener('mouseleave', () => {
        volumeSliderContainer.classList.add('hidden');
    });

    // Ocultar cuando se sale del contenedor
    document.querySelector('.absolute.bottom-4.right-4').addEventListener('mouseleave', () => {
        setTimeout(() => {
            if (!volumeSliderContainer.matches(':hover')) {
                volumeSliderContainer.classList.add('hidden');
            }
        }, 200);
    });

    // Reproducción en primer clic si el navegador lo bloqueó
    window.addEventListener('DOMContentLoaded', () => {
        audio.play().catch(() => {
            document.addEventListener('click', function playAfterClick() {
                audio.play().catch(err => console.warn("Error al reproducir audio:", err));
                document.removeEventListener('click', playAfterClick);
            });
        });
    });
</script>
@endguest

@auth
<x-layouts.layout>
    <div class="container w-200v border border-black h-65v flex flex-col items-center justify-start relative">
        <div class="grid" style="display: grid; height: 100%; width: 100%; grid-template-columns: repeat(4, 1fr); grid-template-rows: 0.4fr 1fr 1fr 1fr; gap: 16px; background-color: #eee; padding: 8px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25), 0 1px 2px rgba(0, 0, 0, 0.1);">
            <div class="relative flex items-center justify-between px-8" style="grid-column: span 4; grid-row: span 1;">      
                <a href="{{ route('equipos.index') }}"><img src="{{ asset('images/pokeballGirada.png') }}" alt="Logo"
                class="w-32 h-32 object-contain absolute -top-8 -left-8 z-10"></a>
                
                <h1 class="text-rojoClaro text-5xl text-center flex-grow">Calendario</h1>
                @if(auth()->check() && (auth()->user()->es_organizador || auth()->user()->es_administrador))
                    <a href="{{ route('torneos.create' )}}"><button class="bg-rojoClaro text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">Crear torneo</button></a>
                @endif
            </div>

            <div id="dias-container"
                class="flex flex-wrap bg-rojoClaro items-center justify-center p-2 overflow-auto"
                style="grid-column: span 4; grid-row: span 3;">
            </div>
        </div>
    </div>

    @php
        // Se crean dos arrays:
        // - $eventosPorDia contiene los torneos del mes actual organizados por día
        // - $fechasFinInscripcion contiene el nombre del torneo cuya inscripción finaliza ese día
        $eventosPorDia = [];
        $fechasFinInscripcion = [];

        foreach ($eventos ?? [] as $evento) {
            $dia = $evento->fecha_carbon->day;
            $finDia = $evento->fecha_fin_inscripcion_carbon->day;

            $eventosPorDia[$dia] = [
                'torneo_id' => $evento->torneo->id,
                'torneo_nombre' => $evento->torneo->nombre,
                'fecha' => $evento->fecha,
                'fin_inscripcion' => $evento->fecha_fin_inscripcion_carbon->format('d/m/Y'),
            ];

            $fechasFinInscripcion[$finDia] = $evento->torneo->nombre;
        }
    @endphp

    <!-- Pasamos los arrays PHP a JavaScript -->
    <script>
        const eventos = @json($eventosPorDia);
        const fechasFinInscripcion = @json($fechasFinInscripcion);
    </script>

    <!-- Script que genera el calendario día por día -->
    <script>
        const container = document.getElementById("dias-container");
        const today = new Date();
        const year = today.getFullYear();
        const month = today.getMonth();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let day = 1; day <= daysInMonth; day++) {
            // Crear el contenedor del día
            const dayDiv = document.createElement("div");
            dayDiv.className = "w-20v h-20v mx-1 my-1 flex flex-col items-center justify-start border border-black rounded p-2 relative bg-white";

            // Mostrar el número del día
            const dayNumber = document.createElement("div");
            dayNumber.textContent = day;
            dayNumber.className = "text-lg font-bold mb-1";
            dayDiv.appendChild(dayNumber);

            // Si ese día es la fecha fin de inscripción de un torneo, se muestra un aviso en rojo
            if (fechasFinInscripcion[day]) {
                const aviso = document.createElement("div");
                aviso.textContent = `Hoy es la fecha de fin de inscripción del torneo ${fechasFinInscripcion[day]}`;
                aviso.style.fontSize = "0.7rem";
                aviso.style.color = "red";
                aviso.style.textAlign = "center";
                aviso.style.marginBottom = "4px";
                dayDiv.appendChild(aviso);
                dayDiv.style.backgroundColor = "#ffe0e0";
            }

            // Si hay torneo ese día, se muestra un botón con el nombre del torneo
            if (eventos[day]) {
                const torneo = eventos[day];

                // Botón con el nombre del torneo
                const botonTorneo = document.createElement("button");
                botonTorneo.textContent = torneo.torneo_nombre;
                botonTorneo.className = "bg-yellow-500 text-white px-2 py-1 rounded shadow hover:bg-yellow-600 transition mb-1";

                // Contenedor oculto que aparecerá al hacer clic en el botón del torneo
                const contenedorBotones = document.createElement("div");
                contenedorBotones.style.display = "none";
                contenedorBotones.className = "flex flex-col gap-1";

                // Botón "Inscribirte"
                const btnInscribirse = document.createElement("button");
                btnInscribirse.textContent = "Inscribirte";
                btnInscribirse.className = "bg-green-600 text-white px-2 py-1 rounded hover:bg-green-700";

                // Botón "Cancelar"
                const btnCancelar = document.createElement("button");
                btnCancelar.textContent = "Cancelar";
                btnCancelar.className = "bg-gray-600 text-white px-2 py-1 rounded hover:bg-gray-700";

                // Añadir ambos botones al contenedor oculto
                contenedorBotones.appendChild(btnInscribirse);
                contenedorBotones.appendChild(btnCancelar);

                // Alternar visibilidad del contenedor al hacer clic en el botón del torneo
                botonTorneo.addEventListener("click", () => {
                    contenedorBotones.style.display = contenedorBotones.style.display === "none" ? "flex" : "none";
                });

                // Añadir botón del torneo y contenedor de botones al día
                dayDiv.appendChild(botonTorneo);
                dayDiv.appendChild(contenedorBotones);

                // Cambiar fondo si no tiene aviso de inscripción
                if (!fechasFinInscripcion[day]) {
                    dayDiv.style.backgroundColor = "#fff9c4"; // Fondo amarillo claro si no hay aviso rojo
                }
            }

            // Finalmente, añadir el día al calendario
            container.appendChild(dayDiv);
        }
    </script>
</x-layouts.layout>

@endauth