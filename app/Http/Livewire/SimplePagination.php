<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Tag;

class SimplePagination extends Component
{
    use WithPagination;

    protected $listeners = ['refresh' => '$refresh'];

    public $sortBy = 'id';
    public $sortAsc = true;

    public $q;
    public $per_page = 15;

    public function render()
    {
        $results = $this->query()
            ->when($this->q, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->q . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->per_page);

        return view('livewire.simple-pagination', [
            'results' => $results
        ]);
    }

    public function sortBy($field)
    {
        if ($field == $this->sortBy) {
            $this->sortAsc = !$this->sortAsc;
        }
        $this->sortBy = $field;
    }

    public function updatingQ() 
    {
        $this->resetPage();
    }

    public function updatingPerPage() 
    {
        $this->resetPage();
    }

    public function query()
    {
        return Tag::query();
    }
}
