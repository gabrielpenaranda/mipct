<flux:page>
    <flux:heading>
        Nuevo Tipo de Pago
        <flux:heading.action>
            <a href="{{ route('tipo-pagos.index') }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('tipo-pagos.store') }}" class="space-y-6">
            @csrf

            <flux:field>
                <flux:label for="codigo">Código</flux:label>
                <flux:input id="codigo" name="codigo" required minlength="2" maxlength="10" />
                <flux:error name="codigo" />
            </flux:field>

            <flux:field>
                <flux:label for="nombre">Nombre</flux:label>
                <flux:input id="nombre" name="nombre" required minlength="3" maxlength="100" />
                <flux:error name="nombre" />
            </flux:field>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('tipo-pagos.index') }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Crear Tipo de Pago</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>