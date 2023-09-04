<script src="https://kit.fontawesome.com/53c4033439.js" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trashed Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (request()->routeIs('notes.index'))
                <div class="flex justify-between items-center dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("All Notes!") }}
                    </div>
        
                    <div>
                        <a href="{{ route('notes.create') }}" class="btn-link btn-lg mr-6 px-3 font-bold py-2 text-gray-200 dark:bg-gray-700 shadow-lg sm:rounded-lg">
                            + Add Note
                        </a>
                    </div>
                </div>
            @endif

            {{-- @if(isset($search))

                @forelse ($notes as $note)

                    <div class="my-5 px-5 pt-5 dark:bg-gray-800 shadow-sm sm:rounded-lg">
                        <a class="font-bold text-2xl text-gray-300"
                        @if (request()->routeIs('notes.index'))
                            href="{{ route('notes.show', $note) }}"
                        @else
                            href="{{ route('trashed.show', $note) }}"
                        @endif
                        >
                            {{$note->title}}
                        </a>

                        <p class="mt-2 truncate text-lg text-teal-700">
                            {{$note->text}}
                        </p>

                        <div class="flex justify-between items-center">
                            <div class="flex justify-start">
                                <span class="text-sm dark:text-gray-500">
                                    @if (!$note->trashed())
                                        {{ $note->updated_at->diffForHumans() }}
                                    @else
                                        {{ $note->deleted_at->diffForHumans() }}
                                    @endif
                                </span>
                            </div>

                            @if (request()->routeIs('notes.index'))
                                <div class="flex justify-start">
                                    <form action="{{ route('notes.edit', $note) }}" method="get">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="mr-2 p-2 text-green-700"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </form>

                                    <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="mr-2 p-2 text-red-600"><i class="fa-solid fa-circle-minus"></i></button>
                                    </form>
                                </div>
                            @else
                                <div class="flex justify-start">
                                    <form action="{{ route('trashed.restore', $note) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <button type="submit" class="mr-2 p-2 text-green-700"><i class="fas fa-redo-alt"></i></button>
                                    </form>

                                    <form action="{{ route('trashed.destroy', $note) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="mr-2 p-2 text-red-600" onclick="return confirm('Are you sure you want to delete this note!..')"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>

                    @empty
                    @if (request()->routeIs('notes.index'))
                        <div class="my-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2 class="font-bold text-2xl text-gray-300">
                                    You have no notes yet!..
                                </h2>
                            </div>
                        </div>

                    @else
                        <div class="my-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2 class="font-bold text-2xl text-gray-300">
                                    No items in the Trash!..
                                </h2>
                            </div>
                        </div>
                    @endif

                @endforelse

            @endif --}}

            @forelse ($notes as $note)
                <div class="my-5 px-5 pt-5 dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <a class="font-bold text-2xl text-gray-300"
                    @if (request()->routeIs('notes.index'))
                        href="{{ route('notes.show', $note) }}"
                    @else
                        href="{{ route('trashed.show', $note) }}"
                    @endif
                    >
                        {{$note->title}}
                    </a>

                    <p class="mt-2 truncate text-lg text-teal-700">
                        {{$note->text}}
                    </p>

                    <div class="flex justify-between items-center">
                        <div class="flex justify-start">
                            <span class="text-sm dark:text-gray-500">
                                @if (!$note->trashed())
                                    {{ $note->updated_at->diffForHumans() }}
                                @else
                                    {{ $note->deleted_at->diffForHumans() }}
                                @endif
                            </span>
                        </div>

                        @if (request()->routeIs('notes.index'))
                            <div class="flex justify-start">
                                <form action="{{ route('notes.edit', $note) }}" method="get">
                                    @method('put')
                                    @csrf
                                    <button type="submit" class="mr-2 p-2 text-green-700"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>

                                <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="mr-2 p-2 text-red-600"><i class="fa-solid fa-circle-minus"></i></button>
                                </form>
                            </div>
                        @else
                            <div class="flex justify-start">
                                <form action="{{ route('trashed.restore', $note) }}" method="post">
                                    @method('put')
                                    @csrf
                                    <button type="submit" class="mr-2 p-2 text-green-700"><i class="fas fa-redo-alt"></i></button>
                                </form>

                                <form action="{{ route('trashed.destroy', $note) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="mr-2 p-2 text-red-600" onclick="return confirm('Are you sure you want to delete this note!..')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                @empty
                @if (request()->routeIs('notes.index'))
                <div class="my-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="font-bold text-2xl text-gray-300">
                            You have no notes yet!..
                        </h2>
                    </div>
                </div>
                @else
                <div class="my-5 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="font-bold text-2xl text-gray-300">
                            No items in the Trash!..
                        </h2>
                    </div>
                </div>
                @endif

            @endforelse

            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
