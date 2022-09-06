<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tag;

class DeleteModalChild extends Component
{
    protected $listeners = [
        'showDeleteForm',
        '',
        '',
    ];

    public $item;

    protected $rules = [
    ];

    protected $validationAttributes = [
    ];

    public $confirmingItemDeletion = false;
    public $primaryKey;

    public function render()
    {
        return view('livewire.delete-modal-child');
    }

    public function showDeleteForm($id)
    {
        $this->confirmingItemDeletion = true;
        $this->primaryKey = $id;
    }

    public function deleteItem()
    {
        Tag::destroy($this->primaryKey);
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->emitTo('delete-modal', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }

}
