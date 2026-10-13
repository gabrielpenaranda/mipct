<flux:page>
    <flux:heading>
        Operadores
        <flux:heading.action>
            <a href="{{ route('operadores.create') }}" class="flux-btn flux-btn-primary">
                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                Nuevo Operador
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <flux:table model="App\Models\Operador" paginate="15" searchable="nombre_juridico,codigo,correo_empresa">
            <flux:table.column name="id" sortable>ID</flux:table.column>
            <flux:table.column name="codigo" sortable>Código</flux:table.column>
            <flux:table.column name="nombre_juridico" sortable>Razón Social</flux:table.column>
            <flux:table.column name="correo_empresa" sortable>Correo</flux:table.column>
            <flux:table.column name="tipo_persona" sortable>Tipo</flux:table.column>
            <flux:table.column name="ciudad.nombre" sortable>Ciudad</flux:table.column>
            <flux:table.column name="lineaNegocio.nombre" sortable>Línea Negocio</flux:table.column>
            <flux:table.column name="actions">
                <flux:actions model="App\Models\Operador">
                    <flux:actions.view />
                    <flux:actions.edit />
                    <flux:actions.delete />
                </flux:actions>
            </flux:table.column>
        </flux:table>
    </flux:card>
</flux:page>