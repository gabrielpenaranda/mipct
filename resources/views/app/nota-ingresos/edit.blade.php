<flux:page>
    <flux:heading>
        Editar Nota de Ingreso: {{ $notaIngreso->id }}
        <flux:heading.action>
            <a href="{{ route('nota-ingresos.show', $notaIngreso) }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('nota-ingresos.update', $notaIngreso) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="fecha_desde">Fecha Desde</flux:label>
                    <flux:input id="fecha_desde" name="fecha_desde" type="date" value="{{ $notaIngreso->fecha_desde->format('Y-m-d') }}" required />
                    <flux:error name="fecha_desde" />
                </flux:field>

                <flux:field>
                    <flux:label for="fecha_hasta">Fecha Hasta</flux:label>
                    <flux:input id="fecha_hasta" name="fecha_hasta" type="date" value="{{ $notaIngreso->fecha_hasta->format('Y-m-d') }}" required />
                    <flux:error name="fecha_hasta" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label for="monto">Monto</flux:label>
                <flux:input id="monto" name="monto" type="number" step="0.01" min="0" value="{{ $notaIngreso->monto }}" required />
                <flux:error name="monto" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <flux:field>
                    <flux:label for="banco_id">Banco</flux:label>
                    <flux:select id="banco_id" name="banco_id" required>
                        <option value="">Seleccionar banco</option>
                        @foreach(\App\Models\Banco::orderBy('nombre')->get() as $banco)
                            <option value="{{ $banco->id }}" {{ $notaIngreso->banco_id == $banco->id ? 'selected' : '' }}>
                                {{ $banco->nombre }}
                            </option>
                        @endforeach
                    </flux:select>
                    <flux:error name="banco_id" />
                </flux:field>

                <flux:field>
                    <flux:label for="tipo_pago_id">Tipo de Pago</flux:label>
                    <flux:select id="tipo_pago_id" name="tipo_pago_id" required>
                        <option value="">Seleccionar tipo de pago</option>
                        @foreach(\App\Models\TipoPago::orderBy('nombre')->get() as $tipo)
                            <option value="{{ $tipo->id }}" {{ $notaIngreso->tipo_pago_id == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </flux:select>
                    <flux:error name="tipo_pago_id" />
                </flux:field>

                <flux:field>
                    <flux:label for="liquidacion_operador_id">Liquidación Operador</flux:label>
                    <flux:select id="liquidacion_operador_id" name="liquidacion_operador_id" required>
                        <option value="">Seleccionar liquidación</option>
                        @foreach(\App\Models\LiquidacionOperador::orderBy('numero_liquidacion')->get() as $liq)
                            <option value="{{ $liq->id }}" {{ $notaIngreso->liquidacion_operador_id == $liq->id ? 'selected' : '' }}>
                                {{ $liq->numero_liquidacion }} - {{ $liq->operador->nombre_juridico ?? '' }}
                            </option>
                        @endforeach
                    </flux:select>
                    <flux:error name="liquidacion_operador_id" />
                </flux:field>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('nota-ingresos.show', $notaIngreso) }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Actualizar Nota de Ingreso</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>