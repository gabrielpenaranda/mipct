<flux:page>
    <flux:heading>
        Nuevo Concepto de Liquidación
        <flux:heading.action>
            <a href="{{ route('liquidacion-conceptos.index') }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('liquidacion-conceptos.store') }}" class="space-y-6">
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

            <flux:field>
                <flux:label for="descripcion">Descripción</flux:label>
                <flux:textarea id="descripcion" name="descripcion" rows="3" required minlength="3" maxlength="200" />
                <flux:error name="descripcion" />
            </flux:field>

            <flux:field>
                <flux:label for="monto">Monto</flux:label>
                <flux:input id="monto" name="monto" type="number" step="0.01" min="0" required />
                <flux:error name="monto" />
            </flux:field>

            <flux:field>
                <flux:label for="linea_negocio_id">Línea de Negocio</flux:label>
                <flux:select id="linea_negocio_id" name="linea_negocio_id" required>
                    <option value="">Seleccionar línea de negocio</option>
                    @foreach(\App\Models\LineaNegocio::orderBy('nombre')->get() as $linea)
                        <option value="{{ $linea->id }}">{{ $linea->nombre }}</option>
                    @endforeach
                </flux:select>
                <flux:error name="linea_negocio_id" />
            </flux:field>

            <flux:field>
                <flux:label for="liquidacion_categoria_id">Categoría</flux:label>
                <flux:select id="liquidacion_categoria_id" name="liquidacion_categoria_id" required>
                    <option value="">Seleccionar categoría</option>
                    @foreach(\App\Models\LiquidacionCategoria::orderBy('nombre')->get() as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </flux:select>
                <flux:error name="liquidacion_categoria_id" />
            </flux:field>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('liquidacion-conceptos.index') }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Crear Concepto</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>