<flux:page>
    <flux:heading>
        Nuevo Operador
        <flux:heading.action>
            <a href="{{ route('operadores.index') }}" class="flux-btn flux-btn-ghost">
                <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                Volver
            </a>
        </flux:heading.action>
    </flux:heading>

    <flux:card>
        <form method="POST" action="{{ route('operadores.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="codigo">Código</flux:label>
                    <flux:input id="codigo" name="codigo" required minlength="2" maxlength="10" />
                    <flux:error name="codigo" />
                </flux:field>

                <flux:field>
                    <flux:label for="tipo_persona">Tipo de Persona</flux:label>
                    <flux:select id="tipo_persona" name="tipo_persona" required>
                        <option value="">Seleccionar</option>
                        <option value="juridica">Jurídica</option>
                        <option value="natural">Natural</option>
                    </flux:select>
                    <flux:error name="tipo_persona" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label for="nombre_juridico">Razón Social / Nombre</flux:label>
                <flux:input id="nombre_juridico" name="nombre_juridico" required minlength="3" maxlength="100" />
                <flux:error name="nombre_juridico" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="correo_empresa">Correo Electrónico</flux:label>
                    <flux:input id="correo_empresa" name="correo_empresa" type="email" required maxlength="100" />
                    <flux:error name="correo_empresa" />
                </flux:field>

                <flux:field>
                    <flux:label for="telefono">Teléfono</flux:label>
                    <flux:input id="telefono" name="telefono" maxlength="30" />
                    <flux:error name="telefono" />
                </flux:field>
            </div>

            <flux:field>
                <flux:label for="numero_documento">Número de Documento</flux:label>
                <flux:input id="numero_documento" name="numero_documento" required minlength="5" maxlength="30" />
                <flux:error name="numero_documento" />
            </flux:field>

            <flux:field>
                <flux:label for="direccion">Dirección</flux:label>
                <flux:textarea id="direccion" name="direccion" rows="2" required minlength="5" maxlength="200" />
                <flux:error name="direccion" />
            </flux:field>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <flux:field>
                    <flux:label for="ciudad_id">Ciudad</flux:label>
                    <flux:select id="ciudad_id" name="ciudad_id" required>
                        <option value="">Seleccionar ciudad</option>
                        @foreach(\App\Models\Ciudad::orderBy('nombre')->get() as $ciudad)
                            <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="ciudad_id" />
                </flux:field>

                <flux:field>
                    <flux:label for="tipo_documento">Tipo de Documento</flux:label>
                    <flux:select id="tipo_documento" name="tipo_documento" required>
                        <option value="">Seleccionar tipo</option>
                        @foreach(\App\Models\TipoDocumento::orderBy('nombre')->get() as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="tipo_documento" />
                </flux:field>

                <flux:field>
                    <flux:label for="user_id">Usuario Responsable</flux:label>
                    <flux:select id="user_id" name="user_id" required>
                        <option value="">Seleccionar usuario</option>
                        @foreach(\App\Models\User::orderBy('name')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="user_id" />
                </flux:field>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label for="tipo_servicio_id">Tipo de Servicio</flux:label>
                    <flux:select id="tipo_servicio_id" name="tipo_servicio_id" required>
                        <option value="">Seleccionar servicio</option>
                        @foreach(\App\Models\TipoServicio::orderBy('nombre')->get() as $servicio)
                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="tipo_servicio_id" />
                </flux:field>

                <flux:field>
                    <flux:label for="linea_negocio_id">Línea de Negocio</flux:label>
                    <flux:select id="linea_negocio_id" name="linea_negocio_id" required>
                        <option value="">Seleccionar línea</option>
                        @foreach(\App\Models\LineaNegocio::orderBy('nombre')->get() as $linea)
                            <option value="{{ $linea->id }}">{{ $linea->nombre }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="linea_negocio_id" />
                </flux:field>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('operadores.index') }}" class="flux-btn flux-btn-ghost">Cancelar</a>
                <flux:button type="submit" variant="primary">Crear Operador</flux:button>
            </div>
        </form>
    </flux:card>
</flux:page>