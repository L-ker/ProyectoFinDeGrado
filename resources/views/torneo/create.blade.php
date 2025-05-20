<x-layouts.layout>
    <form action="{{ route('torneos.store')}}" method="POST" id="formulario">
        @csrf
        <div>
            <input type="hidden" name="organizador_id" value="{{ auth()->user()->id }}">
            <x-input-label for="fecha" value="fecha (formato dd/mm/yyyy):"/>
            <x-text-input id="fecha" class="block mt-1 w-full" type="text" name="fecha"/>
            <x-input-label for="modalidad" value="modalidad:"/>
            <select id="modalidad" name="modalidad" class="block mt-1 w-full rounded border-gray-300">
                @foreach (config('modalidades') as $modalidad)
                    <option value="{{ $modalidad }}" {{ $index === 0 ? 'selected' : '' }}>
                        {{ $modalidad }}
                    </option>
                @endforeach
            </select>
            <!--tengo que mirar como tengo lo de los idiomas en mi otro proyecto y guardar las modalidades de la misma manera, aqui la seleccionarias con un select-->
        </div>
        <div class="mt-4 flex justify-end gap-2">
            <button class="btn btn-sm btn-primary" type="submit">Crear</button>
            <a class="btn btn-sm btn-primary" href="{{ route('puntuaciones.index') }}">Cancelar</a>
        </div>
    </form>

    <script>
       ocument.getElementById("formulario").addEventListener("submit", comprobarFormulario);

        function comprobarFormulario(event) {
        const fechaInput = document.getElementById("fecha").value;
        const formatoFecha = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;

        if (!formatoFecha.test(fechaInput)) {
            event.preventDefault();
            //deberia de cambiarlo a sweet alerts o algo que se vea mas bonito aunque no es totalmente necesario
            alert("La fecha debe tener el formato dd/mm/yyyy");
        }
        const [dia, mes, anio] = fechaInput.split('/').map(Number);
        const fecha = new Date(anio, mes - 1, dia);
        if (
            fecha.getFullYear() !== anio ||
            fecha.getMonth() !== mes - 1 ||
            fecha.getDate() !== dia
        ) {
            event.preventDefault();
            alert("La fecha ingresada no es válida.");
        }
        }
    </script>
</x-layouts.layout>