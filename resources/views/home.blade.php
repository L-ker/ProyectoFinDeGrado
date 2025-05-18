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
    <!-- <div class="w-200v h-65v border border-black overflow-y-auto p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-start space-y-4">
        <div class="w-200v text-rojoClaro flex flex-col items-center justify-start text-5xl">
            <h1>Calendario</h1>
        </div>
        <div class="w-200v h-70v border border-black bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
        </div>
    </div> -->
    <div class="container w-200v border border-black h-65v flex flex-col items-center justify-start">
        <div class="grid" style="display: grid; height: 100%; width: 100%; grid-template-columns: repeat(4, 1fr); grid-template-rows: 0.4fr 1fr 1fr 1fr; gap: 16px; background-color: #eee; padding: 8px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25), 0 1px 2px rgba(0, 0, 0, 0.1);">
    <!-- Div con el titulo y boton -->
      <div class="flex flex-col items-center justify-start" style="grid-column: span 4; grid-row: span 1;">
        <h1 class="text-rojoClaro text-5xl">Calendario</h1>
      </div>
    <!-- Div con dias -->
      <div class="flex flex-col bg-rojoClaro items-center justify-start" style="grid-column: span 4; grid-row: span 3;display: flex; align-items: center; justify-content: center;">
        <p>Broccoli</p>
      </div>
    
    </div>
  </div>
</x-layouts.layout>
@endauth