<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Note!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <form action="{{ route('notes.update', $note) }}" method="post" class="p-6 space-y-6">

                    @method('put')
                    @csrf

                    <x-text-input type="text"
                    name="title"
                    field="title" 
                    placeholder="Title" 
                    class="w-full mt-2 py-2 px-4 text-gray-200 border rounded-lg dark:bg-gray-900" 
                    autocomplete="off"
                    :value="@old('title', $note->title)"></x-text-input>

                    <x-textarea 
                    name="text" 
                    field="text" 
                    placeholder="Start typing here....." 
                    class="w-full h-64 mt-1 py-2 px-4 text-gray-200 resize-none border rounded-lg dark:bg-gray-900"
                    autocomplete="off"
                    :value="@old('text', $note->text)"></x-textarea>

                    <button class="btn-link btn-lg mr-6 px-5 py-2 dark:bg-gray-700 shadow-lg sm:rounded-lg">Update note</button>
                </form>
                
            </div>            
        </div>
    </div>
</x-app-layout>
