<flux:page>
    <flux:heading>
        Editar Territorio: {{ $territorio->nombre }}
        <flux:heading.action>
            <a href="{{ route('territorios.show', $territorio) }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('territorios.update', $territorio) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label for="codigo">Código</flux:label>
                <flux:input id="codigo" name="codigo" value="{{ $territorio->codigo }}" required minlength="2" maxlength="10" />
                <flux:error name="codigo" />
            </flux:field>

            <flux:field>
                <flux:label for="nombre">Nombre</flux:label>
                <flux:input id="nombre" name="nombre" value="{{ $territorio->nombre }}" required minlength="3" maxlength="50" />
                <flux:error name="nombre" />
            </flux:field>

            <flux:field>
                <flux:label for="description">Descripción</flux:label>
                <flux:textarea id="description" name="description" rows="3" maxlength="200">{{ $territorio->description }}</flux:textarea>
                <flux:error name="description" />
            </flux:field>

            <flux:field>
                <flux:label for="es_asignado">¿Asignado?</flux:label>
                <flux:checkbox id="es_asignado" name="es_asignado" {{ $territorio->es_asignado ? 'checked' : '' }} />
                <flux:error name="es_asignado" />
            </flux:field>

            <flux:field>
                <flux:label for="zona_id">Zona</flux:label>
                <flux:select id="zona_id" name="zona_id" required>
                    <option value="">Seleccionar zona</option>
                    @foreach(\App\Models\Zona::orderBy('nombre')->get() as $zona)
                        <option value="{{ $zona->id }}" {{ $territorio->zona_id == $zona->id ? 'selected' : '' }}>
                            {{ $zona->nombre }}
                        </option>
                    @endforeach
                </flux:select>
                <flux:error name="zona_id" />
            </flux:field>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('territorios.show', $territorio) }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Actualizar Territorio</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>