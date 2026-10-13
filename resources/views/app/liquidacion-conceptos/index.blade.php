<flux:page>
    <flux:heading>
        Conceptos de Liquidación
        <flux:heading.action>
            <a href="{{ route('liquidacion-conceptos.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nuevo Concepto
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\LiquidacionConcepto" paginate="15" searchable="nombre,codigo">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="codigo" sortable>Código</flux:table.column>
            <flux:table.column name="nombre" sortable>Nombre</flux:table.column>
            <flux:table.column name="monto" sortable>Monto</flux:table.column>
            <flux:table.column name="lineaNegocio.nombre" sortable>Línea de Negocio</flux:table.column>
            <flux:table.column name="categoria.nombre" sortable>Categoría</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\LiquidacionConcepto">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>