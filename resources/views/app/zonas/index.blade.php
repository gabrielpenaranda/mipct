<flux:page>
    <flux:heading>
        Zonas
        <flux:heading.action>
            <a href="{{ route('zonas.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nueva Zona
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\Zona" paginate="15" searchable="nombre,codigo">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="codigo" sortable>Código</flux:table.column>
            <flux:table.column name="nombre" sortable>Nombre</flux:table.column>
            <flux:table.column name="description">Descripción</flux:table.column>
            <flux:table.column name="territorios_count" sortable>Territorios</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\Zona">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>