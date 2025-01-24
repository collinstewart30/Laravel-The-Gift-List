<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $list->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div id="noEditMode" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <div>
                        <h3 class="font-semibold text-lg mb-4">{{ $list->name }}</h3>
                        <p>{{ $list->description }}</p>
                    </div>
                    <div class="flex flex-grow justify-end">
                        <a href="#" id="editBtn">Edit Info</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="editMode" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                        <div class="flex items-center mt-4 mb-8 sm:mb-2">
                            <x-primary-button type="button" id="cancelBtn" class="mr-2">Cancel</x-primary-button>
                            <x-primary-button>{{ __('Update Info') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                <div class="p-3 text-gray-900 dark:text-gray-100 flex flex-col">
                    @if ($items->isEmpty())
                        <p>No items have been added to this list yet.</p>
                    @else
                        <h3 class="font-semibold text-lg mb-2">Items in {{ $list->name }}</h3>
                        <ul>
                            @foreach ($items as $item)
                                <li class="mt-2 ml-5 list-disc">
                                    <strong>{{ $item->name }}</strong><br>
                                    <a href="{{ $item->item_url }}" class="text-blue-500"
                                        target="_blank">{{ $item->item_url }}</a>
                                    <div>
                                        <form action="/delete-item/{{ $list->id }}/{{ $item->id }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button>Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg mb-4">Add a New Item</h3>
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
                            <x-primary-button>
                                {{ __('Add Item') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
