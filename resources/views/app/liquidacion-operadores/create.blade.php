<flux:page>
    <flux:heading>
        Nueva Liquidación de Operador
        <flux:heading.action>
            <a href="{{ route('liquidacion-operadores.index') }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('liquidacion-operadores.store') }}" class="space-y-6">
            @csrf

            <flux:field>
                <flux:label for="numero_liquidacion">Número de Liquidación</flux:label>
                <flux:input id="numero_liquidacion" name="numero_liquidacion" required minlength="3" maxlength="50" />
                <flux:error name="numero_liquidacion" />
            </flux:field>

            <flux:field>
                <flux:label for="concepto">Concepto</flux:label>
                <flux:textarea id="concepto" name="concepto" rows="2" required minlength="3" maxlength="200" />
                <flux:error name="concepto" />
            </flux:field>

            <flux:field>
                <flux:label for="recargo">Recargo</flux:label>
                <flux:textarea id="recargo" name="recargo" rows="2" required minlength="3" maxlength="200" />
                <flux:error name="recargo" />
            </flux:field>

            <flux:field>
                <flux:label for="multa">Multa</flux:label>
                <flux:textarea id="multa" name="multa" rows="2" required minlength="3" maxlength="200" />
                <flux:error name="multa" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="total_concepto">Total Concepto</flux:label>
                    <flux:input id="total_concepto" name="total_concepto" type="number" step="0.01" min="0" required />
                    <flux:error name="total_concepto" />
                </flux:field>

                <flux:field>
                    <flux:label for="total_recargo">Total Recargo</flux:label>
                    <flux:input id="total_recargo" name="total_recargo" type="number" step="0.01" min="0" required />
                    <flux:error name="total_recargo" />
                </flux:field>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="total_multa">Total Multa</flux:label>
                    <flux:input id="total_multa" name="total_multa" type="number" step="0.01" min="0" required />
                    <flux:error name="total_multa" />
                </flux:field>

                <flux:field>
                    <flux:label for="total_liquidacion">Total Liquidación</flux:label>
                    <flux:input id="total_liquidacion" name="total_liquidacion" type="number" step="0.01" min="0" required />
                    <flux:error name="total_liquidacion" />
                </flux:field>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="fecha">Fecha Desde</flux:label>
                    <flux:input id="fecha" name="fecha" type="date" required />
                    <flux:error name="fecha" />
                </flux:field>

                <flux:field>
                    <flux:label for="fecha_hasta">Fecha Hasta</flux:label>
                    <flux:input id="fecha_hasta" name="fecha_hasta" type="date" required />
                    <flux:error name="fecha_hasta" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label for="es_pagado">¿Pagado?</flux:label>
                <flux:checkbox id="es_pagado" name="es_pagado" />
                <flux:error name="es_pagado" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="operador_id">Operador</flux:label>
                    <flux:select id="operador_id" name="operador_id" required>
                        <option value="">Seleccionar operador</option>
                        @foreach(\App\Models\Operador::orderBy('nombre_juridico')->get() as $operador)
                            <option value="{{ $operador->id }}">{{ $operador->nombre_juridico }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="operador_id" />
                </flux:field>

                <flux:field>
                    <flux:label for="user_id">Usuario (Registrado por)</flux:label>
                    <flux:select id="user_id" name="user_id" required>
                        <option value="">Seleccionar usuario</option>
                        @foreach(\App\Models\User::orderBy('name')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="user_id" />
                </flux:field>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('liquidacion-operadores.index') }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Crear Liquidación</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>