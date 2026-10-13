<?php

namespace App\Livewire;

use App\Models\Provincia;
use App\Models\RegistroActividad;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProvinciasIndex extends Component
{
    use WithPagination;

    public int $pagination = 5;

    public string $direction = 'desc';

    public string $sort = 'name';

    public string $search = '';

    public function render()
    {
        $provincias = Provincia::where('nombre', 'LIKE', '%'.$this->search.'%')->orWhere('codigo', 'LIKE', '%'.$this->search.'%')->orderBy($this->sort, $this->direction)->paginate($this->pagination);

        return view('livewire.provincias-index', compact('provincias'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedPagination($value)
    {
        $this->resetPage();
    }

    public function order($algo)
    {
        if ($this->sort === $algo) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $algo;
            $this->direction = 'asc';
        }
    }

}
