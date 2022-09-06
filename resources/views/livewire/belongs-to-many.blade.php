<div class="mt-8">
    <div class="flex justify-between">
        <div class="text-2xl">Products</div>
        <x:tall-crud-generator::button mode="add" wire:click="$emitTo('belongs-to-many-child', 'showCreateForm');">Create New</x:tall-crud-generator::button> 
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
            <div class="flex">
                <input wire:model.debounce.500ms="q" type="search" placeholder="Search" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                <span class="ml-3 mt-2" wire:loading.delay wire:target="q">
                    <x:tall-crud-generator::loading-indicator />
                </span>
            </div>
            <x:tall-crud-generator::select class="block w-1/10" wire:model="per_page">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </x:tall-crud-generator::select>
        </div>
        <x:tall-crud-generator::table class="mt-4" wire:loading.class.delay="opacity-50">
            <x-slot name="header">
                <x:tall-crud-generator::table-column>
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x:tall-crud-generator::sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </x:tall-crud-generator::table-column>
                <x:tall-crud-generator::table-column>
                    <div class="flex items-center">
                        <button wire:click="sortBy('name')">Name</button>
                        <x:tall-crud-generator::sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </x:tall-crud-generator::table-column>
                <x:tall-crud-generator::table-column>
                    <div class="flex items-center">
                        <button wire:click="sortBy('price')">Price</button>
                        <x:tall-crud-generator::sort-icon sortField="price" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </x:tall-crud-generator::table-column>
                <x:tall-crud-generator::table-column>Sku</x:tall-crud-generator::table-column>
                <x:tall-crud-generator::table-column>Actions</x:tall-crud-generator::table-column>
            </x-slot>
            @foreach($results as $result)
                <tr class="hover:bg-gray-300 {{ ($loop->even ) ? 'bg-gray-100' : ''}}" >
                    <x:tall-crud-generator::table-column>{{ $result->id}}</x:tall-crud-generator::table-column>
                    <x:tall-crud-generator::table-column>{{ $result->name}}</x:tall-crud-generator::table-column>
                    <x:tall-crud-generator::table-column>{{ $result->price}}</x:tall-crud-generator::table-column>
                    <x:tall-crud-generator::table-column>{{ $result->sku}}</x:tall-crud-generator::table-column>
                    <x:tall-crud-generator::table-column>
                        <x:tall-crud-generator::button mode="edit" wire:click="$emitTo('belongs-to-many-child', 'showEditForm',  {{ $result->id}});">Edit</x:tall-crud-generator::button>
                        <x:tall-crud-generator::button mode="delete" wire:click="$emitTo('belongs-to-many-child', 'showDeleteForm',  {{ $result->id}});">Delete</x:tall-crud-generator::button>
                    </x:tall-crud-generator::table-column>
               </tr>
            @endforeach
        </x:tall-crud-generator::table>
    </div>

    <div class="mt-4">
        {{ $results->links() }}
    </div>
    @livewire('belongs-to-many-child')    @livewire('livewire-toast')
</div>