<flux:page>
    <flux:heading>
        Notas de Ingreso
        <flux:heading.action>
            <a href="{{ route('nota-ingresos.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nueva Nota
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\NotaIngreso" paginate="15" searchable="fecha_desde,monto">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="fecha_desde" sortable>Fecha Desde</flux:table.column>
            <flux:table.column name="fecha_hasta" sortable>Fecha Hasta</flux:table.column>
            <flux:table.column name="monto" sortable>Monto</flux:table.column>
            <flux:table.column name="banco.nombre" sortable>Banco</flux:table.column>
            <flux:table.column name="tipoPago.nombre" sortable>Tipo Pago</flux:table.column>
            <flux:table.column name="liquidacionOperador.numero_liquidacion" sortable>Liquidación</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\NotaIngreso">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>