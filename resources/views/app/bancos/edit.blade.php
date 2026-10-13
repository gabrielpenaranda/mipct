<flux:page>
    <flux:heading>
        Editar Banco: {{ $banco->nombre }}
        <flux:heading.action>
            <a href="{{ route('bancos.show', $banco) }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('bancos.update', $banco) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <flux:field>
                <flux:label for="nombre">Nombre</flux:label>
                <flux:input id="nombre" name="nombre" value="{{ $banco->nombre }}" required minlength="3" maxlength="100" />
                <flux:error name="nombre" />
            </flux:field>

            <flux:field>
                <flux:label for="codigo">Código</flux:label>
                <flux:input id="codigo" name="codigo" value="{{ $banco->codigo }}" required minlength="2" maxlength="10" />
                <flux:error name="codigo" />
            </flux:field>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('bancos.show', $banco) }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Actualizar Banco</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>