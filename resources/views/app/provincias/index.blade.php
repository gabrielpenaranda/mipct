<x-layouts::app>

    <div class="max-w-7xl mx-auto">
        <div class="mb-4">
            @livewire('language-selector')
        </div>
        
        <div  class="mb-8 flex justify-between items-center">
            <flux:breadcrumbs> 
                <flux:breadcrumbs.item href="{{ route('dashboard') }}">
                    {{ __('messages.dashboard') }}
                </flux:breadcrumbs.item>
                <flux:breadcrumbs.item>
                    {{ __('messages.provincias') }}
                </flux:breadcrumbs.item>
            </flux:breadcrumbs>
        
            @can('provincias.create')
                <a href="{{ route('provincias.create') }}" class="btn btn-primary">{{ __('messages.nuevaProvincia') }}</a>
            @endcan
        </div>
        
        
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <p class="text-2xl mb-4">{{  __('messages.listadoDeProvincias') }}</p>
        
            @livewire('provincias-index')
        
        </div>
    </div>


    @push('js')
        {{-- <script>
            function confirmar() {

                forms = document.querySelectorAll('.delete-form');
                forms.forEach(form => {
                    form.addEventListener('submit', (e) => {
    
                        e.preventDefault();
    
                        Swal.fire({
                            title: {{ __('swal.Are you sure') }},
                            text: {{ _('swal.Cannot revert') }},
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: {{ __('swal.Yes, delete it') }},
                            cancelButtonText: "{{ __('swal.Cancel') }}",
                            }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            }
        </script>
        <script>
            document.addEventListener('livewire:load', () => {
                confirmar();
            });
        </script> --}}
        <script>
            Livewire.on('notify', (data) => {
                Swal.fire({
                    title: data.type === 'success' ? '¡Éxito!' : 'Error',
                    text: data.message,
                    icon: data.type,
                    timer: 3000,
                    showConfirmButton: false,
                });
            });
        </script>
    @endpush

</x-layouts::app>