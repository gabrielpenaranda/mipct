<flux:page>
    <flux:heading>
        Pagos
        <flux:heading.action>
            <a href="{{ route('pagos.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nuevo Pago
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\Pago" paginate="15" searchable="numero_recibo,fecha">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="fecha" sortable>Fecha</flux:table.column>
            <flux:table.column name="monto" sortable>Monto</flux:table.column>
            <flux:table.column name="numero_recibo" sortable>Nº Recibo</flux:table.column>
            <flux:table.column name="banco.nombre" sortable>Banco</flux:table.column>
            <flux:table.column name="tipoPago.nombre" sortable>Tipo Pago</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\Pago">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>