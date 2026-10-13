<flux:page>
    <flux:heading>
        Recargos de Liquidación
        <flux:heading.action>
            <a href="{{ route('liquidacion-recargos.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nuevo Recargo
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\LiquidacionRecargo" paginate="15" searchable="descripcion,codigo">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="codigo" sortable>Código</flux:table.column>
            <flux:table.column name="descripcion" sortable>Descripción</flux:table.column>
            <flux:table.column name="tipoRecargo.nombre" sortable>Tipo de Recargo</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\LiquidacionRecargo">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>