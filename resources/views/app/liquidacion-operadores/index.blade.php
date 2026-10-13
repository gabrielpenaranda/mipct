<flux:page>
    <flux:heading>
        Liquidaciones de Operadores
        <flux:heading.action>
            <a href="{{ route('liquidacion-operadores.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nueva Liquidación
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\LiquidacionOperador" paginate="15" searchable="numero_liquidacion,concepto">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="numero_liquidacion" sortable>Nº Liquidación</flux:table.column>
            <flux:table.column name="concepto" sortable>Concepto</flux:table.column>
            <flux:table.column name="operador.nombre_juridico" sortable>Operador</flux:table.column>
            <flux:table.column name="total_liquidacion" sortable>Total</flux:table.column>
            <flux:table.column name="es_pagado" sortable>Pagado</flux:table.column>
            <flux:table.column name="fecha" sortable>Fecha</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\LiquidacionOperador">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>