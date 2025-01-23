<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $list->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="/edit-list/{{ $list->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- List Name -->
                        <div>
                            <x-input-label for="name" :value="__('List name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                value="{{ $list->name }}" />
                        </div>

                        <!-- List Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('List Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                value="{{ $list->description }}" rows="4" required />
                        </div>

                        <div class="flex items-center justify-end mt-4 mb-8 sm:mb-2">
                            <x-primary-button class="ms-3">
                                {{ __('Update List Information') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>*TODO: Output items here with form to add item to list</p>

                    <form method="POST" action="/add-new-item/{{ $list->id }}">
                        @csrf

                        <!-- Item Name -->
                        <div>
                            <x-input-label for="name" :value="__('Item Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                required />
                        </div>

                        <!-- Item URL -->
                        <div class="mt-4">
                            <x-input-label for="item_url" :value="__('Item URL')" />
                            <x-text-input id="item_url" class="block mt-1 w-full" type="text" name="item_url"
                                required />
                        </div>

                        <div class="flex items-center justify-end mt-4 mb-8 sm:mb-2">
                            <x-primary-button class="ms-3">
                                {{ __('Add Item') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
