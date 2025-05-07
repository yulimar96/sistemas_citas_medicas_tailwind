   <h1 class="text-3xl font-bold">{{ $organization->name }}</h1>

                <h2 class="mt-6">Sedes</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">Dirección</th>
                                <th class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organization->headquarters as $headquarter)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $headquarter->name }}</td>
                                    <td class="px-6 py-4">{{ $headquarter->address }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('headquarters.edit', $headquarter->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                        <form action="{{ route('headquarters.destroy', $headquarter->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('headquarters.create') }}" class="mt-4 inline-block text-blue-600 hover:underline">Agregar Sede</a>

                <h2 class="mt-6">Tipos de Organización</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">Descripción</th>
                                <th class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($organization->organizationalUnitTypes as $type)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $type->name }}</td>
                                    <td class="px-6 py-4">{{ $type->description }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('organizational-unit-types.edit', $type->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                        <form action="{{ route('organizational-unit-types.destroy', $type->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('organizational-unit-types.create') }}" class="mt-4 inline-block text-blue-600 hover:underline">Agregar Tipo de Organización</a>

                <h2 class="mt-6">Unidades Organizativas</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Nombre</th>
                                <th class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($organization->organizationalUnits as $unit)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">{{ $unit->name }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('organizational-units.edit', $unit->id) }}" class="text-blue-600 hover:underline">Editar</a>
                                        <form action="{{ route('organizational-units.destroy', $unit->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('organizational-units.create') }}" class="mt-4 inline-block text-blue-600 hover:underline">Agregar Unidad Organizativa</a>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/dataTable.js') }}"></script>
@endpush