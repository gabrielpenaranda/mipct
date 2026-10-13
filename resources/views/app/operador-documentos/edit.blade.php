<flux:page>
    <flux:heading>
        Editar Documento: {{ $operadorDocumento->nombre }}
        <flux:heading.action>
            <a href="{{ route('operador-documentos.show', $operadorDocumento) }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('operador-documentos.update', $operadorDocumento) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label for="nombre">Nombre</flux:label>
                <flux:input id="nombre" name="nombre" value="{{ $operadorDocumento->nombre }}" required minlength="3" maxlength="100" />
                <flux:error name="nombre" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="tipo_documento_id">Tipo de Documento</flux:label>
                    <flux:select id="tipo_documento_id" name="tipo_documento_id" required>
                        <option value="">Seleccionar tipo</option>
                        @foreach(\App\Models\TipoDocumento::orderBy('nombre')->get() as $tipo)
                            <option value="{{ $tipo->id }}" {{ $operadorDocumento->tipo_documento_id == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </flux:select>
                    <flux:error name="tipo_documento_id" />
                </flux:field>

                <flux:field>
                    <flux:label for="operador_id">Operador</flux:label>
                    <flux:select id="operador_id" name="operador_id" required>
                        <option value="">Seleccionar operador</option>
                        @foreach(\App\Models\Operador::orderBy('nombre_juridico')->get() as $operador)
                            <option value="{{ $operador->id }}" {{ $operadorDocumento->operador_id == $operador->id ? 'selected' : '' }}>
                                {{ $operador->nombre_juridico }}
                            </option>
                        @endforeach
                    </flux:select>
                    <flux:error name="operador_id" />
                </flux:field>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('operador-documentos.show', $operadorDocumento) }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Actualizar Documento</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>