<flux:page>
    <flux:heading>
        Usuarios
        <flux:heading.action>
            <a href="{{ route('usuarios.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nuevo Usuario
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\User" paginate="15" searchable="nombre,apellido,email,empresa">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="nombre" sortable>Nombre</flux:table.column>
            <flux:table.column name="apellido" sortable>Apellido</flux:table.column>
            <flux:table.column name="email" sortable>Email</flux:table.column>
            <flux:table.column name="tipo">Tipo</flux:table.column>
            <flux:table.column name="es_activo" sortable>Activo</flux:table.column>
            <flux:table.column name="ciudad.nombre" sortable>Ciudad</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\User">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>