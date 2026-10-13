<flux:page>
    <flux:heading>
        Nueva Multa de Liquidación
        <flux:heading.action>
            <a href="{{ route('liquidacion-multas.index') }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('liquidacion-multas.store') }}" class="space-y-6">
            @csrf

            <flux:field>
                <flux:label for="codigo">Código</flux:label>
                <flux:input id="codigo" name="codigo" required minlength="2" maxlength="10" />
                <flux:error name="codigo" />
            </flux:field>

            <flux:field>
                <flux:label for="descripcion">Descripción</flux:label>
                <flux:textarea id="descripcion" name="descripcion" rows="3" required minlength="3" maxlength="200" />
                <flux:error name="descripcion" />
            </flux:field>

            <flux:field>
                <flux:label for="tipo_multa_id">Tipo de Multa</flux:label>
                <flux:select id="tipo_multa_id" name="tipo_multa_id" required>
                    <option value="">Seleccionar tipo de multa</option>
                    @foreach(\App\Models\TipoMulta::orderBy('nombre')->get() as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </flux:select>
                <flux:error name="tipo_multa_id" />
            </flux:field>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('liquidacion-multas.index') }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Crear Multa</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>