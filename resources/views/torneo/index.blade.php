<!-- <x-layouts.layout>
    @if (session("mensaje"))
        <div id="message" role="alert" class="alert alert-info">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-current"
                fill="none"
                viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{session("mensaje")}}</span>
        </div>
    @endif
    <!-- DIV GRANDE -->
    <div class="flex flex-col h-full">
        <div class="flex-grow overflow-x-auto bg-indigoDye text-white min-h-0">
            <table class="table table-auto w-full table-xs table-pin-rows table-pin-cols">
                <!-- COLUMNAS -->
                <thead>
                    <tr>
                        @foreach($campos as $campo)
                            <th>{{__($campo)}}</th>
                        @endforeach
                        <th></th><th></th><th></th>
                    </tr>
                </thead>
                <!-- FILAS -->
                <tbody>
                    @foreach($filas as $fila)
                        <tr>
                            @foreach($campos as $campo)
                                <td>{{$fila->$campo}}</td>
                            @endforeach
                            <!-- BOTON EDITAR -->
                            <td>
                                <a href="{{ route('usuarios.edit', $fila->id) }}" class="inline-flex items-center hover:text-blue-600" aria-label="Editar usuario">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9M16.5 3.5l4.5 4.5M19.5 7.5l-8.5 8.5-4 1 1-4L16.5 3.5z" />
                                    </svg>
                                </a>
                            </td>
                            <!-- BOTON BORRAR -->
                            <td>
                                <form onsubmit="event.preventDefault()" id="formulario{{$fila->id}}" action="{{ route('usuarios.destroy', $fila->id) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="confirmDelete({{$fila->id}})" class="text-red-600 hover:text-red-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke="white" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <!-- BOTON VER -->
                            <td>
                                <a href="{{ route('usuarios.show', $fila->id) }}" class="text-white hover:text-blue-600 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke="white" d="M12 4.5C7.031 4.5 3 8.25 3 12s4.031 7.5 9 7.5 9-4.75 9-7.5-4.031-7.5-9-7.5z"/>
                                        <circle cx="12" cy="12" r="3" stroke="white" stroke-width="1.5" fill="none"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '{{__('¿Estás seguro?')}}',
                text: '{{__('Esta acción no se puede deshacer.')}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '{{ __('Sí, eliminar')}}',
                cancelButtonText: '{{__('Cancelar')}}',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formulario' + id).submit();
                }
            });
        }

        setTimeout(() => {
        document.getElementById("message")?.remove();
    }, 3000);
    </script>
</x-layouts.layout> -->