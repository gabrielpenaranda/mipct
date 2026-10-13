<flux:page>
    <flux:heading>
        Nueva Línea de Negocio
        <flux:heading.action>
            <a href="{{ route('linea-negocios.index') }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('linea-negocios.store') }}" class="space-y-6">
            @csrf

            <flux:field>
                <flux:label for="codigo">Código</flux:label>
                <flux:input id="codigo" name="codigo" required minlength="2" maxlength="10" />
                <flux:error name="codigo" />
            </flux:field>

            <flux:field>
                <flux:label for="nombre">Nombre</flux:label>
                <flux:input id="nombre" name="nombre" required minlength="3" maxlength="50" />
                <flux:error name="nombre" />
            </flux:field>

            <flux:field>
                <flux:label for="descripcion">Descripción</flux:label>
                <flux:textarea id="descripcion" name="descripcion" rows="3" maxlength="200" />
                <flux:error name="descripcion" />
            </flux:field>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('linea-negocios.index') }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Crear Línea de Negocio</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>