<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Tag;

class DeleteModal extends Component
{
    use WithPagination;

    protected $listeners = ['refresh' => '$refresh'];

    public $sortBy = 'id';
    public $sortAsc = true;

    public $per_page = 15;

    public function render()
    {
        $results = $this->query()
            ->orderBy($this->sortBy, $this->sortAsc ? 'ASC' : 'DESC')
            ->paginate($this->per_page);

        return view('livewire.delete-modal', [
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

    public function updatingPerPage() 
    {
        $this->resetPage();
    }

    public function query()
    {
        return Tag::query();
    }
}
