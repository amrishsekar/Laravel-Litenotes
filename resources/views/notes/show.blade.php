<script src="https://kit.fontawesome.com/53c4033439.js" crossorigin="anonymous"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notes.show') ? __('Notes') : __('Trashed Notes') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="my-5 p-5 dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl text-gray-300">{{$note->title}}</h2>

                <p class="mt-2 text-lg text-teal-700 nt-6 whitespace-pre-wrap">{{$note->text}}</p>

                <div class="flex justify-between items-center">
                    <span class="text-sm dark:text-gray-500">
                        @if (!$note->trashed())
                            {{ $note->updated_at->diffForHumans() }}
                        @else
                            {{ $note->deleted_at->diffForHumans() }}
                        @endif
                    </span>

                    @if (request()->routeIs('notes.show'))
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

        </div>
    </div>
</x-app-layout>
