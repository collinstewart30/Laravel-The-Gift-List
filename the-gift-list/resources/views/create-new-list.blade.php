<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Create a new list.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">



                    <form method="POST" action="/create-mylist">
                        @csrf

                        <!-- List Name -->
                        <div>
                            <x-input-label for="name" :value="__('List name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" />
                        </div>

                        <!-- List Description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('List Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" rows="4" required />
                        </div>

                        <div class="flex items-center justify-end mt-4 mb-8 sm:mb-2">
                            <x-primary-button class="ms-3">
                                {{ __('Submit List') }}
                            </x-primary-button>
                        </div>
                    </form>




                </div>
            </div>
        </div>
    </div>
</x-app-layout>
