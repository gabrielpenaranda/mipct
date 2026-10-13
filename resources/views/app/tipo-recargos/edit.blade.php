<flux:page>
    <flux:heading>
        Editar Tipo de Recargo: {{ $tipoRecargo->nombre }}
        <flux:heading.action>
            <a href="{{ route('tipo-recargos.show', $tipoRecargo) }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('tipo-recargos.update', $tipoRecargo) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label for="codigo">Código</flux:label>
                <flux:input id="codigo" name="codigo" value="{{ $tipoRecargo->codigo }}" required minlength="2" maxlength="10" />
                <flux:error name="codigo" />
            </flux:field>

            <flux:field>
                <flux:label for="nombre">Nombre</flux:label>
                <flux:input id="nombre" name="nombre" value="{{ $tipoRecargo->nombre }}" required minlength="3" maxlength="100" />
                <flux:error name="nombre" />
            </flux:field>

            <flux:field>
                <flux:label for="descripcion">Descripción</flux:label>
                <flux:textarea id="descripcion" name="descripcion" rows="3" required minlength="3" maxlength="200">{{ $tipoRecargo->descripcion }}</flux:textarea>
                <flux:error name="descripcion" />
            </flux:field>

            <flux:field>
                <flux:label for="concepto">Concepto</flux:label>
                <flux:textarea id="concepto" name="concepto" rows="3" required minlength="3" maxlength="200">{{ $tipoRecargo->concepto }}</flux:textarea>
                <flux:error name="concepto" />
            </flux:field>

            <flux:field>
                <flux:label for="monto">Monto</flux:label>
                <flux:input id="monto" name="monto" type="number" step="0.01" min="0" value="{{ $tipoRecargo->monto }}" required />
                <flux:error name="monto" />
            </flux:field>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('tipo-recargos.show', $tipoRecargo) }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Actualizar Tipo de Recargo</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>