<flux:page>
    <flux:heading>
        Nuevo Pago
        <flux:heading.action>
            <a href="{{ route('pagos.index') }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('pagos.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="fecha">Fecha</flux:label>
                    <flux:input id="fecha" name="fecha" type="date" required />
                    <flux:error name="fecha" />
                </flux:field>

                <flux:field>
                    <flux:label for="monto">Monto</flux:label>
                    <flux:input id="monto" name="monto" type="number" step="0.01" min="0" required />
                    <flux:error name="monto" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label for="numero_recibo">Número de Recibo</flux:label>
                <flux:input id="numero_recibo" name="numero_recibo" required minlength="1" maxlength="50" />
                <flux:error name="numero_recibo" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="banco_id">Banco</flux:label>
                    <flux:select id="banco_id" name="banco_id" required>
                        <option value="">Seleccionar banco</option>
                        @foreach(\App\Models\Banco::orderBy('nombre')->get() as $banco)
                            <option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="banco_id" />
                </flux:field>

                <flux:field>
                    <flux:label for="tipo_pago_id">Tipo de Pago</flux:label>
                    <flux:select id="tipo_pago_id" name="tipo_pago_id" required>
                        <option value="">Seleccionar tipo de pago</option>
                        @foreach(\App\Models\TipoPago::orderBy('nombre')->get() as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="tipo_pago_id" />
                </flux:field>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('pagos.index') }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Crear Pago</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>