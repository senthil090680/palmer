<div class="mt-8 min-h-screen">
    <div class="flex justify-between">
        <div class="text-2xl">Products</div>
        <button type="submit" wire:click="$emitTo('products-child', 'showCreateForm');" class="text-blue-500">
            <x-tall-crud-icon-add />
        </button> 
    </div>

    <div class="mt-6">
        <div class="flex justify-between">
            <div class="flex">
                <x-tall-crud-input-search />
            </div>
            <div class="flex">

                <x-tall-crud-page-dropdown />
            </div>
        </div>
        <table class="w-full whitespace-no-wrap mt-4 shadow-2xl text-xs" wire:loading.class.delay="opacity-50">
            <thead>
                <tr class="text-left font-bold bg-blue-400">
                <td class="px-3 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('id')">Id</button>
                        <x-tall-crud-sort-icon sortField="id" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-3 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('name')">Name</button>
                        <x-tall-crud-sort-icon sortField="name" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-3 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('price')">Price</button>
                        <x-tall-crud-sort-icon sortField="price" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-3 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('sku')">SKU</button>
                        <x-tall-crud-sort-icon sortField="sku" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-3 py-2" >
                    <div class="flex items-center">
                        <button wire:click="sortBy('status')">Status</button>
                        <x-tall-crud-sort-icon sortField="status" :sort-by="$sortBy" :sort-asc="$sortAsc" />
                    </div>
                </td>
                <td class="px-3 py-2" >Actions</td>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue-400">
            @foreach($results as $result)
                <tr class="hover:bg-blue-300 {{ ($loop->even ) ? "bg-blue-100" : ""}}">
                    <td class="px-3 py-2" >{{ $result->id }}</td>
                    <td class="px-3 py-2" >{{ $result->name }}</td>
                    <td class="px-3 py-2" >{{ $result->price }}</td>
                    <td class="px-3 py-2" >{{ $result->sku }}</td>
                    <td class="px-3 py-2" >{{ $result->status }}</td>
                    <td class="px-3 py-2" >
                        <button type="submit" wire:click="$emitTo('products-child', 'showEditForm', {{ $result->id}});" class="text-green-500">
                            <x-tall-crud-icon-edit />
                        </button>
                        <button type="submit" wire:click="$emitTo('products-child', 'showDeleteForm', {{ $result->id}});" class="text-red-500">
                            <x-tall-crud-icon-delete />
                        </button>
                    </td>
               </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $results->links() }}
    </div>
    @livewire('products-child')
    @livewire('livewire-toast')
</div>