<x-layouts.layout>
    @if (session("mensaje"))
        <script>
            alert(@json(session("mensaje")));
        </script>
    @endif


    <div class="w-200v h-65v rounded-xl bg-rojoClaro overflow-y-auto p-2 shadow-md text-acentuar1 scrollbar-hide flex flex-col items-center justify-center space-y-4">
        <div class="w-175v h-45v rounded-xl bg-white p-4 shadow-md text-black scrollbar-hide flex flex-col space-y-4">
            <div class="overflow-x-auto">
                <table class="table table-auto w-full table-xs table-pin-rows table-pin-cols">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            @foreach($columnNames as $columnName)
                                <th class="py-2 px-4">{{ __($columnName) }}</th>
                            @endforeach
                            <th></th><th></th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 border-b">
                                @foreach($columnNames as $columnName)
                                    <td class="py-2 px-4">{{ $user->$columnName }}</td>
                                @endforeach
                                <!-- Botón hacer organizador -->
                                <td>
                                    <form action="{{ route('users.hacerOrganizador', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres hacer organizador a este usuario?')">
                                    @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800 flex items-center gap-1" title="Hacer organizador">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.layout>
