<div>

    <x:tall-crud-generator::confirmation-dialog wire:model="confirmingItemDeletion">
        <x-slot name="title">
            Delete Record
        </x-slot>

        <x-slot name="content">
            Are you sure you want to Delete Record?
        </x-slot>

        <x-slot name="footer">
            <x:tall-crud-generator::button wire:click="$set('confirmingItemDeletion', false)">Cancel</x:tall-crud-generator::button>
            <x:tall-crud-generator::button mode="delete" wire:loading.attr="disabled" wire:click="deleteItem()">Delete</x:tall-crud-generator::button>
        </x-slot>
    </x:tall-crud-generator::confirmation-dialog>

    <x:tall-crud-generator::dialog-modal wire:model="confirmingItemCreation">
        <x-slot name="title">
            Add Record
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x:tall-crud-generator::label>Name</x:tall-crud-generator::label>
                <x:tall-crud-generator::input class="block mt-1 w-1/2" type="text" wire:model.defer="item.name" />
                @error('item.name') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
            </div>
            <div class="mt-4">
                <x:tall-crud-generator::label>Price</x:tall-crud-generator::label>
                <x:tall-crud-generator::input class="block mt-1 w-1/2" type="text" wire:model.defer="item.price" />
                @error('item.price') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
            </div>
            <div class="mt-4">
                <x:tall-crud-generator::label>Sku</x:tall-crud-generator::label>
                <x:tall-crud-generator::input class="block mt-1 w-1/2" type="text" wire:model.defer="item.sku" />
                @error('item.sku') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
            </div>

            <h2 class="mt-4">Categories</h2>
            <div class="grid grid-cols-3">
                @foreach( $categories as $c)
                <x:tall-crud-generator::checkbox-wrapper class="mt-4">
                    <x:tall-crud-generator::label>{{$c->name}}</x:tall-crud-generator::label>
                    <x:tall-crud-generator::checkbox value="{{ $c->id }}" class="ml-2" wire:model.defer="checkedCategories" />
                </x:tall-crud-generator::checkbox-wrapper>
                @endforeach
            </div>

            <h2 class="mt-4">Tags</h2>
            <div class="grid grid-cols-3">
                @foreach( $tags as $c)
                <x:tall-crud-generator::checkbox-wrapper class="mt-4">
                    <x:tall-crud-generator::label>{{$c->name}}</x:tall-crud-generator::label>
                    <x:tall-crud-generator::checkbox value="{{ $c->id }}" class="ml-2" wire:model.defer="checkedTags" />
                </x:tall-crud-generator::checkbox-wrapper>
                @endforeach
            </div>

            <div class="grid grid-cols-3">
                <div class="mt-4">
                    <x:tall-crud-generator::label>Brand</x:tall-crud-generator::label>
                    <x:tall-crud-generator::select class="block mt-1 w-full" wire:model.defer="item.brand_id">
                        <option value="">Please Select</option>
                        @foreach($brands as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </x:tall-crud-generator::select>
                    @error('item.brand_id') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
                </div>
            </div>
            <x:tall-crud-generator::checkbox-wrapper class="mt-4">
                <x:tall-crud-generator::label>Active:</x:tall-crud-generator::label><x:tall-crud-generator::checkbox class="ml-2" wire:model.defer="item.status" />
            </x:tall-crud-generator::checkbox-wrapper>
            @error('item.status') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
        </x-slot>

        <x-slot name="footer">
            <x:tall-crud-generator::button wire:click="$set('confirmingItemCreation', false)">Cancel</x:tall-crud-generator::button>
            <x:tall-crud-generator::button mode="add" wire:loading.attr="disabled" wire:click="createItem()">Save</x:tall-crud-generator::button>
        </x-slot>
    </x:tall-crud-generator::dialog-modal>

    <x:tall-crud-generator::dialog-modal wire:model="confirmingItemEdition">
        <x-slot name="title">
            Edit Record
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x:tall-crud-generator::label>Name</x:tall-crud-generator::label>
                <x:tall-crud-generator::input class="block mt-1 w-1/2" type="text" wire:model.defer="item.name" />
                @error('item.name') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
            </div>
            <div class="mt-4">
                <x:tall-crud-generator::label>Price</x:tall-crud-generator::label>
                <x:tall-crud-generator::input class="block mt-1 w-1/2" type="text" wire:model.defer="item.price" />
                @error('item.price') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
            </div>
            <div class="mt-4">
                <x:tall-crud-generator::label>Sku</x:tall-crud-generator::label>
                <x:tall-crud-generator::input class="block mt-1 w-1/2" type="text" wire:model.defer="item.sku" />
                @error('item.sku') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
            </div>

            <h2 class="mt-4">Categories</h2>
            <div class="grid grid-cols-3">
                @foreach( $categories as $c)
                <x:tall-crud-generator::checkbox-wrapper class="mt-4">
                    <x:tall-crud-generator::label>{{$c->name}}</x:tall-crud-generator::label>
                    <x:tall-crud-generator::checkbox value="{{ $c->id }}" class="ml-2" wire:model.defer="checkedCategories" />
                </x:tall-crud-generator::checkbox-wrapper>
                @endforeach
            </div>

            <h2 class="mt-4">Tags</h2>
            <div class="grid grid-cols-3">
                @foreach( $tags as $c)
                <x:tall-crud-generator::checkbox-wrapper class="mt-4">
                    <x:tall-crud-generator::label>{{$c->name}}</x:tall-crud-generator::label>
                    <x:tall-crud-generator::checkbox value="{{ $c->id }}" class="ml-2" wire:model.defer="checkedTags" />
                </x:tall-crud-generator::checkbox-wrapper>
                @endforeach
            </div>

            <div class="grid grid-cols-3">
                <div class="mt-4">
                    <x:tall-crud-generator::label>Brand</x:tall-crud-generator::label>
                    <x:tall-crud-generator::select class="block mt-1 w-full" wire:model.defer="item.brand_id">
                        <option value="">Please Select</option>
                        @foreach($brands as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    </x:tall-crud-generator::select>
                    @error('item.brand_id') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
                </div>
            </div>
            <x:tall-crud-generator::checkbox-wrapper class="mt-4">
                <x:tall-crud-generator::label>Active:</x:tall-crud-generator::label><x:tall-crud-generator::checkbox class="ml-2" wire:model.defer="item.status" />
            </x:tall-crud-generator::checkbox-wrapper>
            @error('item.status') <x:tall-crud-generator::error-message>{{$message}}</x:tall-crud-generator::error-message> @enderror
        </x-slot>

        <x-slot name="footer">
            <x:tall-crud-generator::button wire:click="$set('confirmingItemEdition', false)">Cancel</x:tall-crud-generator::button>
            <x:tall-crud-generator::button mode="add" wire:loading.attr="disabled" wire:click="editItem()">Save</x:tall-crud-generator::button>
        </x-slot>
    </x:tall-crud-generator::dialog-modal>
</div>
