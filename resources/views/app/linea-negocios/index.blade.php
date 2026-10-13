<flux:page>
    <flux:heading>
        Líneas de Negocio
        <flux:heading.action>
            <a href="{{ route('linea-negocios.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nueva Línea
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\LineaNegocio" paginate="15" searchable="nombre,codigo">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="codigo" sortable>Código</flux:table.column>
            <flux:table.column name="nombre" sortable>Nombre</flux:table.column>
            <flux:table.column name="descripcion">Descripción</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\LineaNegocio">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>