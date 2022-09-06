<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Brand;

class BelongsToManyChild extends Component
{
    protected $listeners = [
        'showDeleteForm',
        'showCreateForm',
        'showEditForm',
    ];

    public $item;
    public $categories = [];
    public $checkedCategories = [];
    public $tags = [];
    public $checkedTags = [];
    public $brands = [];

    protected $rules = [
        'item.name' => 'required|min:3|max:50',
        'item.price' => 'required|numeric',
        'item.sku' => 'required|min:3',
        'item.status' => '',
        'item.brand_id' => 'required',
    ];

    protected $validationAttributes = [
        'item.name' => 'Name',
        'item.price' => 'Price',
        'item.sku' => 'Sku',
        'item.status' => 'Active',
        'item.brand_id' => 'Brand',
    ];

    public $confirmingItemDeletion = false;
    public $primaryKey;
    public $confirmingItemCreation = false;
    public $confirmingItemEdition = false;

    public function render()
    {
        return view('livewire.belongs-to-many-child');
    }

    public function showDeleteForm($id)
    {
        $this->confirmingItemDeletion = true;
        $this->primaryKey = $id;
    }

    public function deleteItem()
    {
        Product::destroy($this->primaryKey);
        $this->confirmingItemDeletion = false;
        $this->primaryKey = '';
        $this->reset(['item']);
        $this->emitTo('belongs-to-many', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Deleted Successfully');
    }
 
    public function showCreateForm()
    {
        $this->confirmingItemCreation = true;
        $this->resetErrorBag();
        $this->reset(['item']);

        $this->categories = Category::all();
        $this->checkedCategories = [];

        $this->tags = Tag::all();
        $this->checkedTags = [];

        $this->brands = Brand::all();
    }

    public function createItem() 
    {
        $this->validate();
        $item = Product::create([
            'name' => $this->item['name'] ?? '', 
            'price' => $this->item['price'] ?? '', 
            'sku' => $this->item['sku'] ?? '', 
            'status' => $this->item['status'] ?? 0, 
            'brand_id' => $this->item['brand_id'] ?? 0, 
        ]);
        $item->categories()->attach($this->checkedCategories);
        $item->tags()->attach($this->checkedTags);

        $this->confirmingItemCreation = false;
        $this->emitTo('belongs-to-many', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Added Successfully');
    }
 
    public function showEditForm(Product $product)
    {
        $this->resetErrorBag();
        $this->item = $product;
        $this->confirmingItemEdition = true;

        $this->checkedCategories = $product->categories->pluck("id")->map(function ($i) {
            return (string)$i;
        })->toArray();
        $this->categories = Category::all();

        $this->checkedTags = $product->tags->pluck("id")->map(function ($i) {
            return (string)$i;
        })->toArray();
        $this->tags = Tag::all();


        $this->brands = Brand::all();
    }

    public function editItem() 
    {
        $this->validate();
        $this->item->save();

        $this->item->categories()->sync($this->checkedCategories);
        $this->checkedCategories = [];

        $this->item->tags()->sync($this->checkedTags);
        $this->checkedTags = [];
        $this->confirmingItemEdition = false;
        $this->primaryKey = '';
        $this->emitTo('belongs-to-many', 'refresh');
        $this->emitTo('livewire-toast', 'show', 'Record Updated Successfully');
    }

}
