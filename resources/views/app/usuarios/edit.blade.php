<flux:page>
    <flux:heading>
        Editar Usuario: {{ $usuario->nombre }} {{ $usuario->apellido }}
        <flux:heading.action>
            <a href="{{ route('usuarios.show', $usuario) }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('usuarios.update', $usuario) }}" class="space-y-6" id="usuario-form">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="nombre">Nombre</flux:label>
                    <flux:input id="nombre" name="nombre" value="{{ $usuario->nombre }}" required minlength="3" maxlength="30" />
                    <flux:error name="nombre" />
                </flux:field>

                <flux:field>
                    <flux:label for="apellido">Apellido</flux:label>
                    <flux:input id="apellido" name="apellido" value="{{ $usuario->apellido }}" required minlength="3" maxlength="40" />
                    <flux:error name="apellido" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label for="email">Email</flux:label>
                <flux:input id="email" name="email" type="email" value="{{ $usuario->email }}" required minlength="10" maxlength="40" />
                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label for="password">Contraseña (dejar vacío para no cambiar)</flux:label>
                <flux:input id="password" name="password" type="password" minlength="8" maxlength="20" />
                <flux:error name="password" />
            </flux:field>

            <flux:field>
                <flux:label for="tipo">Tipo de Usuario</flux:label>
                <flux:select id="tipo" name="tipo" required>
                    <option value="">Seleccionar tipo</option>
                    <option value="funcionario" {{ $usuario->tipo === 'funcionario' ? 'selected' : '' }}>Funcionario</option>
                    <option value="contribuyente" {{ $usuario->tipo === 'contribuyente' ? 'selected' : '' }}>Contribuyente</option>
                </flux:select>
                <flux:error name="tipo" />
            </flux:field>

            <div id="funcionario-fields" class="{{ $usuario->tipo === 'funcionario' ? '' : 'hidden' }} space-y-6">
                <flux:field>
                    <flux:label for="carnet">Carnet</flux:label>
                    <flux:input id="carnet" name="carnet" value="{{ $usuario->carnet }}" minlength="5" maxlength="15" />
                    <flux:error name="carnet" />
                </flux:field>

                <flux:field>
                    <flux:label for="es_inspector">¿Es Inspector?</flux:label>
                    <flux:checkbox id="es_inspector" name="es_inspector" {{ $usuario->es_inspector ? 'checked' : '' }} />
                    <flux:error name="es_inspector" />
                </flux:field>
            </div>

            <div id="contribuyente-fields" class="{{ $usuario->tipo === 'contribuyente' ? '' : 'hidden' }} space-y-6">
                <flux:field>
                    <flux:label for="empresa">Empresa</flux:label>
                    <flux:input id="empresa" name="empresa" value="{{ $usuario->empresa }}" minlength="3" maxlength="150" />
                    <flux:error name="empresa" />
                </flux:field>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="direccion">Dirección</flux:label>
                    <flux:input id="direccion" name="direccion" value="{{ $usuario->direccion }}" required minlength="10" maxlength="200" />
                    <flux:error name="direccion" />
                </flux:field>

                <flux:field>
                    <flux:label for="telefono">Teléfono</flux:label>
                    <flux:input id="telefono" name="telefono" value="{{ $usuario->telefono }}" maxlength="50" />
                    <flux:error name="telefono" />
                </flux:field>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <flux:field>
                    <flux:label for="numero_documento">Número Documento</flux:label>
                    <flux:input id="numero_documento" name="numero_documento" value="{{ $usuario->numero_documento }}" required minlength="5" maxlength="15" />
                    <flux:error name="numero_documento" />
                </flux:field>

                <flux:field>
                    <flux:label for="tipo_documento">Tipo Documento</flux:label>
                    <flux:select id="tipo_documento" name="tipo_documento" required>
                        <option value="">Seleccionar</option>
                        <option value="dip" {{ $usuario->tipo_documento === 'dip' ? 'selected' : '' }}>DIP</option>
                        <option value="nif" {{ $usuario->tipo_documento === 'nif' ? 'selected' : '' }}>NIF</option>
                        <option value="nie" {{ $usuario->tipo_documento === 'nie' ? 'selected' : '' }}>NIE</option>
                    </flux:select>
                    <flux:error name="tipo_documento" />
                </flux:field>

                <flux:field>
                    <flux:label for="ciudad_id">Ciudad</flux:label>
                    <flux:select id="ciudad_id" name="ciudad_id" required>
                        <option value="">Seleccionar ciudad</option>
                        @foreach(\App\Models\Ciudad::orderBy('nombre')->get() as $ciudad)
                            <option value="{{ $ciudad->id }}" {{ $usuario->ciudad_id == $ciudad->id ? 'selected' : '' }}>
                                {{ $ciudad->nombre }}
                            </option>
                        @endforeach
                    </flux:select>
                    <flux:error name="ciudad_id" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label for="es_activo">¿Activo?</flux:label>
                <flux:checkbox id="es_activo" name="es_activo" {{ $usuario->es_activo ? 'checked' : '' }} />
                <flux:error name="es_activo" />
            </flux:field>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('usuarios.show', $usuario) }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Actualizar Usuario</flux:button>
            </div>
        </form>
    </flux:card>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tipoSelect = document.getElementById('tipo');
            const funcionarioFields = document.getElementById('funcionario-fields');
            const contribuyenteFields = document.getElementById('contribuyente-fields');

            function toggleFields() {
                if (tipoSelect.value === 'funcionario') {
                    funcionarioFields.classList.remove('hidden');
                    contribuyenteFields.classList.add('hidden');
                } else if (tipoSelect.value === 'contribuyente') {
                    funcionarioFields.classList.add('hidden');
                    contribuyenteFields.classList.remove('hidden');
                } else {
                    funcionarioFields.classList.add('hidden');
                    contribuyenteFields.classList.add('hidden');
                }
            }

            tipoSelect.addEventListener('change', toggleFields);
        });
    </script>
</flux:page>