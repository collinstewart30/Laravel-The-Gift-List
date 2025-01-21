<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ auth()->user()->name }}'s Lists
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
            @foreach ($lists as $list)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-2">
                    <div class="p-3 text-gray-900 dark:text-gray-100 flex flex-row">
                        <div>
                            <h3 class="font-semibold text-xl">{{ $list['name'] }}</h3>
                            <p>{{ $list['description'] }}</p>
                        </div>
                        <div class="flex grow justify-end items-center">
                            <p><a href="/edit-list/{{ $list->id }}">Edit</a></p>
                            <p>&nbsp;|&nbsp;</p>
                            <div>
                                <form action="delete-list/{{ $list->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button>Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
