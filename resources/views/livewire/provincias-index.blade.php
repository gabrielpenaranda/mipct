<div>
    <div class="flex justify-end gap-2 mb-4 mr-4">

        <flux:input placeholder="{{ __('messages.buscarProvincias') }}" wire:model.live="search" class="w-2xl! ml-2!" />
        
        <flux:select wire:model.live="pagination" class="w-48!  ml-4!" placeholder="{{ __('messages.lineasPorPagina') }}">
            <flux:select.option>5</flux:select.option>
            <flux:select.option>10</flux:select.option>
            <flux:select.option>20</flux:select.option>
        </flux:select>

    </div>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        @if ($provincias->count())
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3" wire:click="order('codigo')">
                        {{ __('messages.codigo') }} <i class="fa-solid fa-magnifying-glass"></i>

                        @if ($sort == 'name')
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                            @endif
                        @else
                            <i class="fa-solid fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3" wire:click="order('nombre')">
                        {{ __('messages.nombre') }} <i class="fa-solid fa-magnifying-glass"></i>

                        @if ($sort == 'name')
                            @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                            @else
                                <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                            @endif
                        @else
                            <i class="fa-solid fa-sort float-right mt-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        {{ __('messages.acciones') }} 
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($provincias as $provincia)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td class="px-6 py-4">
                            {{ $provincia->codigo }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $provincia->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2 justify-center">
                                @can('provincias.edit')
                                    <a href="{{ route('provincias.edit', $provincia) }}" class="btn btn-secondary text-xs">{{ __('messages.editar') }}</a>
                                @endcan
                                @can('provincias.destroy')
                                      <form action="{{ route('provincias.destroy', $provincia) }}" method="POST" class="inline delete-form" onsubmit="event.preventDefault(); const form = this; Swal.fire({
                                            title: '{{ __('swal.estaSeguro') }}',
                                            text: '{{ __('swal.noSePuedeRevertir') }}',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonText: '{{ __('swal.siBorrar') }}',
                                            cancelButtonText: 'Cancelar',
                                        }).then((result) => { if (result.isConfirmed) { form.submit(); } });">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger text-xs">
                                              {{ __('messages.borrar') }}
                                          </button>
                                      </form>
                                  @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
            <div class="m-8">
                <span class="font-bold text-md md:text-xl lg:text-2xl">{{ __('messages.registrosNoEncontrados') }}</span>
            </div>
        @endif
    </table>
    @if ($provincias->count())
        {{ $provincias->links() }}
    @endif
</div>