<x-layouts.layout>
    <!-- Contenedor para el gif y la capa negra -->
    <div class="relative w-full h-[75vh]">
        <!-- Capa negra transparente entre la letra y el gif -->
        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

        <!-- Gif ajustado a la pantalla, asegurándose que ocupe todo el espacio disponible -->
        <img src="{{ asset('images/GifCoronacion.gif') }}" alt="Gif de coronación" class="absolute inset-0 w-full h-full object-cover" />

        <!-- Frase centrada sobre el gif -->
        <div class="absolute inset-0 flex items-center justify-center z-20 text-white text-4xl font-bold text-center">
            ¿Podrás convertirte en el campeón?
        </div>

        <!-- Contenedor para el botón y la barra de volumen -->
        <div class="absolute bottom-4 right-4 z-30">
            <!-- Botón de mute/desmute -->
            <button onclick="toggleMute()" id="mute-button" class="bg-white p-2 rounded-full shadow-lg hover:bg-gray-300 focus:outline-none">
                <svg id="volume-icon" class="w-8 h-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path id="volume-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9v6l6 3V6l-6 3zM15 12c0-2.21 1.79-4 4-4s4 1.79 4 4"></path>
                </svg>
            </button>

            <!-- Barra de volumen (invisible hasta que el hover esté activado) -->
            <div id="volume-slider-container" class="hidden absolute bottom-[50px] right-0 w-40 bg-gray-700 p-2 rounded-lg mt-2">
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
    // Función para alternar mute y desmute en el audio
    function toggleMute() {
        var audio = document.getElementById('background-music');
        var icon = document.getElementById('volume-icon');
        var volumePath = document.getElementById('volume-path');
        var volumeSliderContainer = document.getElementById('volume-slider-container');
        var volumeSlider = document.getElementById('volume-slider');

        // Alternar el estado de mute
        audio.muted = !audio.muted;

        // Cambiar el icono según el estado de mute
        if (audio.muted) {
            volumePath.setAttribute("d", "M6 18L18 6M6 6l12 12"); // X
        } else {
            volumePath.setAttribute("d", "M3 9v6l6 3V6l-6 3zM15 12c0-2.21 1.79-4 4-4s4 1.79 4 4"); // Altavoz con ondas
        }

        // Mostrar u ocultar la barra de volumen cuando no está muteado
        if (!audio.muted) {
            volumeSliderContainer.classList.remove('hidden');
        } else {
            volumeSliderContainer.classList.add('hidden');
        }
    }

    // Función para cambiar el volumen del audio según el slider
    document.getElementById('volume-slider').addEventListener('input', function() {
        var audio = document.getElementById('background-music');
        audio.volume = this.value;
    });

    // Mostrar la barra de volumen cuando el ratón pase por encima del botón
    document.getElementById('mute-button').addEventListener('mouseenter', function() {
        var audio = document.getElementById('background-music');
        var volumeSliderContainer = document.getElementById('volume-slider-container');
        if (!audio.muted) {
            volumeSliderContainer.classList.remove('hidden');
        }
    });

    // Mostrar la barra de volumen cuando el ratón esté sobre ella
    document.getElementById('volume-slider-container').addEventListener('mouseenter', function() {
        this.classList.remove('hidden');
    });

    // Mantener la barra de volumen visible mientras interactúas con ella
    document.getElementById('volume-slider-container').addEventListener('mouseleave', function() {
        this.classList.add('hidden');
    });

    // Ocultar la barra de volumen cuando el ratón salga del contenedor completo
    document.querySelector('.absolute.bottom-4.right-4').addEventListener('mouseleave', function() {
        var volumeSliderContainer = document.getElementById('volume-slider-container');
        setTimeout(function() {
            // Solo ocultar si el ratón no está sobre el control de volumen
            if (!volumeSliderContainer.matches(':hover')) {
                volumeSliderContainer.classList.add('hidden');
            }
        }, 200);
    });
</script>
