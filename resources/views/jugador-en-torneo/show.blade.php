<x-layouts.layout>
    <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-start space-y-4">
        <div class="w-175v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
            @if (auth()->id() === $torneo->organizador)
                {{-- Vista para el organizador --}}
                <h2 class="text-xl font-bold">Panel del organizador</h2>

                {{-- Aquí puedes poner botones o acciones especiales como editar resultados, avanzar rondas, etc. --}}
                <p>Desde aquí puedes gestionar el torneo y ver los enfrentamientos.</p>
            @else
                {{-- Vista para jugadores --}}
                <h2 class="text-xl font-bold">Tus enfrentamientos</h2>

                {{-- Aquí podrías mostrar el módulo en el que participa el jugador actual --}}
                <p>En esta sección podrás ver tus combates y resultados.</p>
            @endif
        </div>
    </div>
</x-layouts.layout>
