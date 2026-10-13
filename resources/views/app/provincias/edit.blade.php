<x-layouts::app>

    <div class="max-w-7xl mx-auto">

        @livewire('language-selector')
        
        <div  class="mb-8 flex justify-between items-center">
            <flux:breadcrumbs> 
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                    {{ __('messages.dashboard') }}
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item href="{{ route('provincias.index') }}">
                    {{ __('messages.provincias') }}
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item>
                    {{ __('messages.editar') }}
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        
            <a href="{{ route('provincias.index') }}" class="btn btn-danger">{{ __('messages.listado') }}</a>
        </div>
        
        <div class="card">
            <p class="text-2xl mb-4">{{  __('messages.nuevaProvincia') }}</p>
            <form action="{{ route('provincias.update', $provincia) }}" method="POST">
                @csrf
                @method('PUT')
        
                <flux:field>
                    <flux:label class="mt-2!">{{ __('messages.codigo') }}</flux:label>
                    <flux:input name='codigo' placeholder="{{ __('messages.ingreseCodigo') }}" value="{{ old('codigo', $provincia->codigo) }}"/>
                    <flux:error name="codigo" />
                </flux:field>
        
                <flux:field>
                    <flux:label class="mt-2!">{{ __('messages.nombreProvincia') }}</flux:label>
                    <flux:input name='nombre' placeholder="{{ __('messages.ingreseNombre') }}" value="{{ old('nombre', $provincia->nombre) }}"/>
                    <flux:error name="nombre" />
                </flux:field>
                
        
                <div class="flex justify-end mt-4">
                    <flux:button variant="primary" type="submit">{{  __('messages.enviar') }}</flux:button>
                </div>
        
            </form>
        </div>
    </div>


</x-layouts::app>